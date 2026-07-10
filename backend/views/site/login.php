<?php

<<<<<<< HEAD
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
=======
>>>>>>> d1a316e3a76d3b83e0d4b7c9d7be2d1f9f96d4d0
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login Admin JDIH UPNVJT';
$brandLogo = Yii::getAlias('@web') . '/assets_b/img/logo-upn.png';
?>

<<<<<<< HEAD




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
=======
<div class="jdih-admin-login">
    <div class="jdih-admin-login__brand">
        <img src="<?= Html::encode($brandLogo) ?>" alt="JDIH UPNVJT">
        <div><strong>JDIH</strong><span>UPNVJT</span></div>
    </div>
    <div class="jdih-admin-login__card">
        <div class="jdih-admin-login__accent"></div>
        <h1>Silahkan Login</h1>
        <p>Akses Portal Dokumentasi & Informasi Hukum</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => true, 'enableAjaxValidation' => false, 'options' => ['class' => 'jdih-admin-login__form']]); ?>
        <?= $form->field($model, 'username', ['template' => "{label}<div class=\"jdih-admin-input\"><i class=\"fa fa-user-o\"></i>{input}</div>{error}"])->textInput(['autocomplete' => 'off', 'placeholder' => 'admin']) ?>
        <?= $form->field($model, 'password', ['template' => "{label}<div class=\"jdih-admin-input\"><i class=\"fa fa-lock\"></i>{input}<i class=\"fa fa-eye\"></i></div>{error}"])->passwordInput(['autocomplete' => 'off', 'placeholder' => '********']) ?>
        <?php if (!empty(Yii::$app->params['recaptcha.enabled'])): ?>
            <?= $form->field($model, 'reCaptcha', ['template' => '{input}'])->widget(\himiklab\yii2\recaptcha\ReCaptcha3::className(), ['siteKey' => Yii::$app->params['recaptcha.siteKey'], 'action' => 'login']) ?>
        <?php endif; ?>
        <div class="jdih-admin-login__options">
            <?= $form->field($model, 'rememberMe')->checkbox()->label('Remember Me') ?>
            <?= Html::a('Lupa Password?', '#') ?>
        </div>
        <?= Html::submitButton('Sign In <i class="fa fa-sign-in"></i>', ['class' => 'jdih-admin-login__submit', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>
        <div class="jdih-admin-login__footer">Bukan administrator? <?= Html::a('Kembali ke Beranda', Yii::$app->homeUrl ?: '/') ?></div>
    </div>
    <p class="jdih-admin-login__copy">&copy; <?= date('Y') ?> JDIH UPN Veteran Jawa Timur. All Rights Reserved.</p>
>>>>>>> d1a316e3a76d3b83e0d4b7c9d7be2d1f9f96d4d0
</div>
