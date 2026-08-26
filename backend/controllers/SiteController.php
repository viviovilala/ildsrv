<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\AuthDebugLogger;
use common\models\LoginForm;
use common\models\SurveyKepuasan;
use common\models\VisitorStats;
use backend\models\Peraturan;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $startDate = date('Y-m-d', strtotime('-6 days'));
        $visitorStats = VisitorStats::find()
            ->select(['stat_date', 'unique_visits'])
            ->where(['stat_type' => VisitorStats::TYPE_DAILY, 'document_id' => null])
            ->andWhere(['>=', 'stat_date', $startDate])
            ->indexBy('stat_date')
            ->asArray()
            ->all();

        $visitorTrend = [];
        for ($offset = 6; $offset >= 0; $offset--) {
            $date = date('Y-m-d', strtotime("-{$offset} days"));
            $visitorTrend[] = [
                'label' => date('d M', strtotime($date)),
                'unique_visits' => (int) ($visitorStats[$date]['unique_visits'] ?? 0),
            ];
        }

        $recentDocuments = Peraturan::find()
            ->select(['id', 'judul', 'created_at', 'status_terakhir'])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(2)
            ->asArray()
            ->all();

        return $this->render('index', [
            'visitorTrend' => $visitorTrend,
            'surveyAggregate' => SurveyKepuasan::getAggregateStats(),
            'recentDocuments' => $recentDocuments,
        ]);
    }



    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }

        $model = new LoginForm();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->login()) {
                    return $this->redirect(['index']);
                }
            } else {
                AuthDebugLogger::log('backend_login_post_load_failed', [
                    'post_keys' => array_keys(Yii::$app->request->post()),
                ]);
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        
        Yii::$app->user->logout();

        return $this->redirect(['login']);
    }

}
