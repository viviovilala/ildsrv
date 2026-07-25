<?php
use backend\models\FrontendConfig;
use yii\helpers\Html;
use yii\helpers\Url;
$visi = FrontendConfig::findOne(10);
$this->title = 'Visi';
$heroImage = Url::to('@web/images/upnvjt-building.png');
?>
<section class="jdih-hero" style="min-height:360px;background-image:linear-gradient(90deg,rgba(6,78,11,.86),rgba(6,78,11,.48)),url('<?= Html::encode($heroImage) ?>')"><div class="container"><div class="jdih-hero__content"><span class="jdih-eyebrow">Tentang Kami</span><h1>Visi JDIH UPNVJT</h1></div></div></section>
<section class="jdih-section"><div class="container"><article class="catalog-filter" style="max-width:900px"><?= $visi ? $visi->isi_konfig : '<p>Visi belum tersedia.</p>' ?></article></div></section>
