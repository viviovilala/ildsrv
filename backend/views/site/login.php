<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login Admin JDIH UPNVJT';
$brandLogo = Yii::getAlias('@web') . '/assets_b/img/logo-upn.png';
?>

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
</div>
