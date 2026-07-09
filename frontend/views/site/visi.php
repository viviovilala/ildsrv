<?php

use backend\models\FrontendConfig;
use yii\helpers\Html;
use yii\helpers\Url;

$visi = FrontendConfig::findOne(10);
$this->title = 'Visi';
$heroImage = Url::to('@web/images/upnvjt-building.png');
?>

<section class="jdih-page">
    <div class="jdih-page-hero" style="background-image: linear-gradient(90deg, rgba(6,78,11,.86), rgba(6,78,11,.48)), url('<?= Html::encode($heroImage) ?>');">
        <div class="container">
            <span class="jdih-page-hero__eyebrow">Tentang Kami</span>
            <h1>Visi JDIH UPNVJT</h1>
            <p>Arah pengembangan layanan dokumentasi dan informasi hukum universitas.</p>
        </div>
    </div>

    <div class="jdih-page-body">
        <div class="container">
            <article class="jdih-page-card jdih-page-card--padded jdih-content">
                <?= $visi ? $visi->isi_konfig : '<p>Visi belum tersedia.</p>' ?>
            </article>
        </div>
    </div>
</section>
