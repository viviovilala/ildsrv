<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Tentang JDIH UPNVJT';
$heroImage = Url::to('@web/images/upnvjt-building.png');
?>

<section class="jdih-hero" style="min-height:420px;background-image:linear-gradient(90deg,rgba(6,78,11,.86),rgba(6,78,11,.48)),url('<?= Html::encode($heroImage) ?>')"><div class="container"><div class="jdih-hero__content"><span class="jdih-eyebrow">Tentang Portal</span><h1>JDIH UPNVJT</h1><p>Portal dokumentasi dan informasi hukum UPN Veteran Jawa Timur untuk mendukung transparansi dan tata kelola kampus.</p></div></div></section>
<section class="jdih-section"><div class="container"><article class="catalog-filter" style="max-width:900px"><h2>Peran JDIH UPNVJT</h2><p>JDIH UPNVJT menyediakan akses terpadu terhadap regulasi akademik, keputusan, referensi hukum, berita, dan informasi kelembagaan. Redesign ini memperkuat pencarian, katalog, detail dokumen, dan pengalaman membaca berita tanpa mengubah core ILDIS.</p></article></div></section>
