<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Kontak';
$heroImage = Url::to('@web/images/upnvjt-building.png');
?>

<section class="jdih-hero" style="min-height:420px;background-image:linear-gradient(90deg,rgba(6,78,11,.86),rgba(6,78,11,.48)),url('<?= Html::encode($heroImage) ?>')"><div class="container"><div class="jdih-hero__content"><span class="jdih-eyebrow">Kontak JDIH</span><h1>Hubungi JDIH UPNVJT</h1><p>Layanan informasi hukum kampus untuk civitas akademika, unit kerja, dan masyarakat.</p></div></div></section>
<section class="jdih-section"><div class="container"><div class="catalog-body" style="margin-top:0"><article class="catalog-filter"><h2>Informasi Layanan</h2><p><strong>Kantor</strong><br>Lt. 3 Gedung Rektorat, Kampus Gunung Anyar, UPN Veteran Jawa Timur, Surabaya</p><p><strong>Email</strong><br>sekretariat@upnjatim.ac.id</p><p><strong>Jam Layanan</strong><br>Senin - Jumat, 08.00 - 16.00 WIB</p></article><form class="catalog-filter" action="#" method="post"><h2>Kirim Pesan</h2><input type="text" placeholder="Nama lengkap"><br><br><input type="email" placeholder="Email"><br><br><input type="text" placeholder="Subjek pesan"><br><br><textarea rows="6" class="form-control" placeholder="Tulis pesan Anda"></textarea><button type="submit">Kirim Pesan</button></form></div></div></section>
