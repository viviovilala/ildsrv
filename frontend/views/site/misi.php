<?php

use backend\models\FrontendConfig;
use yii\helpers\Html;
use yii\helpers\Url;

$misi = FrontendConfig::findOne(11);
$this->title = 'Misi';
$heroImage = Url::to('@web/images/upnvjt-building.png');
?>

<section class="jdih-page">
    <div class="jdih-page-hero" style="background-image: linear-gradient(90deg, rgba(6,78,11,.86), rgba(6,78,11,.48)), url('<?= Html::encode($heroImage) ?>');">
        <div class="container">
            <span class="jdih-page-hero__eyebrow">Tentang Kami</span>
            <h1>Misi JDIH UPNVJT</h1>
            <p>Langkah layanan JDIH untuk mendukung transparansi hukum dan tata kelola kampus.</p>
        </div>
    </div>

    <div class="jdih-page-body">
        <div class="container">
            <article class="jdih-page-card jdih-page-card--padded jdih-content">
                <?= $misi ? $misi->isi_konfig : '<p>Misi belum tersedia.</p>' ?>
            </article>
        </div>
    </div>
</section>
