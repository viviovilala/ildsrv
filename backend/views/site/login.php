<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
// $this->params['breadcrumbs'][] = $this->title;

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

?>





<div class="jdih-login-shell">
    <div class="jdih-login">
        <div class="jdih-login__brand">
            <?= Html::img(Url::to('@web/assets_b/img/upnvjt-logo-yellow.png'), [
                'class' => 'jdih-login__logo',
                'alt' => 'Logo UPN Veteran Jawa Timur',
            ]) ?>
            <div>
                <h1 class="jdih-login__title">JDIH</h1>
                <p class="jdih-login__subtitle">UPNVJT</p>
            </div>
        </div>

        <div class="jdih-login__card">
            <div class="jdih-login__body">
                <h2 class="jdih-login__heading">Silahkan Login</h2>
                <p class="jdih-login__caption">Akses Portal Dokumentasi &amp; Informasi Hukum</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => true,'enableAjaxValidation' => false,]); ?>

            <?= $form
                ->field($model, 'username', $fieldOptions1)
                ->label(false)
                ->textInput(['autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('username')]) ?>

            <?= $form
                ->field($model, 'password', $fieldOptions2)
                ->label(false)
                ->passwordInput(['autocomplete' => 'off', 'placeholder' => $model->getAttributeLabel('password')]) ?>
            <?php if (!empty(Yii::$app->params['recaptcha.enabled'])): ?>
            <?= $form->field($model, 'reCaptcha', [
                'template' => '{input}',
            ])->widget(
                \himiklab\yii2\recaptcha\ReCaptcha3::className(),
                [
                    'siteKey' => Yii::$app->params['recaptcha.siteKey'],
                    'action' => 'login',
                ]
            ) ?>
            <?php endif; ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary jdih-login__button', 'name' => 'login-button']) ?>


            <?php ActiveForm::end(); ?>


            <!-- /.social-auth-links -->

            </div>
            <div class="jdih-login__footer">
                Bukan administrator? <?= Html::a('Kembali ke Beranda', '/') ?>
            </div>
        </div>
        <p class="jdih-login__copy">&copy; <?= date('Y') ?> JDIH UPN Veteran Jawa Timur. All Rights Reserved.</p>
    </div>
</div>
