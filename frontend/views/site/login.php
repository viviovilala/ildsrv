<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<section>
   <img src="frontend/assets/img/bluetop.jpg" class="img-fluid" alt="">
    <div class="container">
    </div>
    <div class="container">
        <div class="text-center"><br><br>
            <!-- <p><?= Html::a('Home', ['/']); ?></p> -->
        </div>
    </div>
    <br>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 center-col">
				<div class="php-email-form"><br>
					<div class="text-center margin-40px-bottom">
						<?= Html::img('@web/images/upnvjt-logo-yellow.png', [
							'alt' => 'JDIH UPN Veteran Jawa Timur',
							'class' => 'img-fluid',
							'style' => 'max-width: 220px;',
						]) ?>
					</div>
					<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

					<?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username'])->label(false) ?>

					<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>

					<div class="row">
						<div class="col-sm-6 mb-2">
						</div>
						<div class="col-sm-6 text-left text-sm-right">
						</div>

					</div>
					<?= Html::submitButton('Masuk', ['class' => 'btn btn-success text-white', 'name' => 'login-button']) ?>
				</div><br>
			</div>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</section>