<?php

use yii\helpers\Html;

echo Html::a(
    Html::encode($finalUrl),
    $finalUrl,
    ['target' => '_blank', 'rel' => 'noopener noreferrer']
);
