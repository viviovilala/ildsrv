<?php

use backend\models\FrontendConfig;
use yii\helpers\Html;
use yii\helpers\Url;

$logo = FrontendConfig::findOne(12);
$this->title = 'Struktur Organisasi';
$heroImage = Url::to('@web/images/upnvjt-building.png');
?>

<section class="jdih-page">
    <div class="jdih-page-hero" style="background-image: linear-gradient(90deg, rgba(6,78,11,.86), rgba(6,78,11,.48)), url('<?= Html::encode($heroImage) ?>');">
        <div class="container">
            <span class="jdih-page-hero__eyebrow">Kelembagaan</span>
            <h1>Struktur Organisasi JDIH UPNVJT</h1>
            <p>Susunan pengelola layanan dokumentasi dan informasi hukum Universitas Pembangunan Nasional "Veteran" Jawa Timur.</p>
        </div>
    </div>

    <div class="jdih-page-body">
        <div class="container">
            <article class="jdih-page-card jdih-page-card--padded jdih-content">
                <h2>Struktur Organisasi</h2>
                <?php if ($logo && !empty($logo->isi_konfig)): ?>
                    <?= Html::img('@web/common/dokumen/' . $logo->isi_konfig, [
                        'class' => 'jdih-structure-image',
                        'alt' => 'Struktur Organisasi JDIH UPNVJT',
                    ]) ?>
                <?php else: ?>
                    <p>Data struktur organisasi belum tersedia.</p>
                <?php endif; ?>
            </article>
        </div>
    </div>
</section>
