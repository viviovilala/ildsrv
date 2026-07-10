<?php
<<<<<<< HEAD
use backend\models\FrontendConfig;
use yii\helpers\Html;
use yii\helpers\Url;
=======

use backend\models\FrontendConfig;
use yii\helpers\Html;
use yii\helpers\Url;

>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
$visi = FrontendConfig::findOne(10);
$this->title = 'Visi';
$heroImage = Url::to('@web/images/upnvjt-building.png');
?>
<<<<<<< HEAD
<section class="jdih-hero" style="min-height:360px;background-image:linear-gradient(90deg,rgba(6,78,11,.86),rgba(6,78,11,.48)),url('<?= Html::encode($heroImage) ?>')"><div class="container"><div class="jdih-hero__content"><span class="jdih-eyebrow">Tentang Kami</span><h1>Visi JDIH UPNVJT</h1></div></div></section>
<section class="jdih-section"><div class="container"><article class="catalog-filter" style="max-width:900px"><?= $visi ? $visi->isi_konfig : '<p>Visi belum tersedia.</p>' ?></article></div></section>
=======

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
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
