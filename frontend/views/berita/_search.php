<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\BeritaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="berita-search-widget">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'berita-search-form',
        ],
    ]); ?>

        <div class="berita-search-form__group">

            <?= Html::activeTextInput(
                $model,
                'judul',
                [
                    'class' => 'berita-search-form__input',
                    'placeholder' => 'Cari berita...',
                    'autocomplete' => 'off',
                    'aria-label' => 'Cari berita',
                ]
            ) ?>

            <?= Html::button(
                '<i class="bi bi-search" aria-hidden="true"></i>',
                [
                    'type' => 'submit',
                    'class' => 'berita-search-form__submit',
                    'title' => 'Cari berita',
                    'aria-label' => 'Cari berita',
                ]
            ) ?>

        </div>

    <?php ActiveForm::end(); ?>

</div>