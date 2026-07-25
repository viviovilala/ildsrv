<?php
use backend\models\FrontendConfig;
use yii\helpers\Html;
use yii\helpers\Url;
$struktur = FrontendConfig::findOne(12);
$this->title = 'Struktur Organisasi';
$heroImage = Url::to('@web/images/upnvjt-building.png');
?>
<section class="jdih-hero" style="min-height:360px;background-image:linear-gradient(90deg,rgba(6,78,11,.86),rgba(6,78,11,.48)),url('<?= Html::encode($heroImage) ?>')"><div class="container"><div class="jdih-hero__content"><span class="jdih-eyebrow">Kelembagaan</span><h1>Struktur Organisasi JDIH UPNVJT</h1></div></div></section>
<section class="jdih-section"><div class="container"><article class="catalog-filter"><?php if ($struktur && $struktur->isi_konfig): ?><?= Html::img('@web/common/dokumen/' . $struktur->isi_konfig, ['class' => 'img-fluid', 'alt' => 'Struktur Organisasi JDIH UPNVJT']) ?><?php else: ?><p>Data struktur organisasi belum tersedia.</p><?php endif; ?></article></div></section>
