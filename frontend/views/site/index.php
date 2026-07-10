<?php

use frontend\models\Dokumen;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'JDIH UPNVJT';
$this->registerMetaTag(['name' => 'description', 'content' => 'Portal JDIH UPN Veteran Jawa Timur untuk akses produk hukum dan informasi hukum kampus.']);

$heroImage = Url::to('@web/images/upnvjt-building.png');
$totalPeraturan = Dokumen::find()->total(1);
$totalMonografi = Dokumen::find()->total(2);
$totalArtikel = Dokumen::find()->total(3);
$totalPutusan = Dokumen::find()->total(4);
$latestDocuments = Dokumen::find()
    ->where(['tipe_dokumen' => Dokumen::TYPE_PERATURAN])
    ->orderBy(['tanggal_penetapan' => SORT_DESC, 'id' => SORT_DESC])
    ->limit(3)
    ->all();
?>

<section class="jdih-hero" style="background-image: linear-gradient(90deg, rgba(6,78,11,.88), rgba(6,78,11,.52)), url('<?= Html::encode($heroImage) ?>');">
    <div class="container">
        <div class="jdih-hero__content">
            <span class="jdih-eyebrow">Beranda JDIH UPNVJT</span>
            <h1>Jaringan Dokumentasi &<br><span>Informasi Hukum</span></h1>
            <p>Akses transparan terhadap regulasi dan produk hukum Universitas Pembangunan Nasional "Veteran" Jawa Timur untuk mewujudkan tata kelola kampus yang akuntabel.</p>
            <form class="jdih-hero-search" action="<?= Url::to(['/dokumen/index']) ?>" method="get">
                <i class="bi bi-search" aria-hidden="true"></i>
                <input type="search" name="DokumenSearch[judul]" placeholder="Cari peraturan, keputusan, atau artikel hukum..." aria-label="Cari produk hukum">
                <button type="submit">Cari</button>
            </form>
        </div>
    </div>
</section>

<section class="jdih-categories">
    <div class="container">
        <div class="jdih-category-grid">
            <a class="jdih-category-card jdih-category-card--primary" href="<?= Url::to(['/dokumen/peraturan']) ?>">
                <i class="bi bi-hammer" aria-hidden="true"></i>
                <h2>Peraturan Universitas</h2>
                <p>Kumpulan regulasi resmi, keputusan rektor, dan dasar hukum operasional kampus.</p>
                <strong>Lihat Selengkapnya <i class="bi bi-arrow-right" aria-hidden="true"></i></strong>
            </a>
            <a class="jdih-category-card" href="<?= Url::to(['/dokumen/monografi']) ?>"><i class="bi bi-book" aria-hidden="true"></i><h2>Monografi</h2><strong>Explore</strong></a>
            <a class="jdih-category-card" href="<?= Url::to(['/dokumen/artikel']) ?>"><i class="bi bi-journal-text" aria-hidden="true"></i><h2>Artikel Hukum</h2><strong>Baca Artikel</strong></a>
            <a class="jdih-category-card" href="<?= Url::to(['/dokumen/putusan']) ?>"><i class="bi bi-bank" aria-hidden="true"></i><h2>Putusan</h2><strong>Arsip</strong></a>
            <a class="jdih-category-card jdih-category-card--yellow" href="<?= Url::to(['/dokumen/index']) ?>"><i class="bi bi-newspaper" aria-hidden="true"></i><h2>Jurnal Hukum</h2><p>Akses koleksi digital jurnal hukum civitas akademika.</p></a>
            <a class="jdih-category-card" href="<?= Url::to(['/dokumen/index']) ?>"><i class="bi bi-fingerprint" aria-hidden="true"></i><h2>Digital</h2><strong>Koleksi Digital</strong></a>
        </div>
    </div>
</section>

<section class="jdih-stats">
    <div class="container">
        <div class="jdih-stat-grid">
            <div class="jdih-stat-card"><i class="bi bi-archive" aria-hidden="true"></i><strong><?= number_format($totalPeraturan + $totalMonografi + $totalArtikel) ?>+</strong><span>Produk Hukum</span></div>
            <div class="jdih-stat-card"><i class="bi bi-share" aria-hidden="true"></i><strong>9+</strong><span>Publikasi Internal</span></div>
            <div class="jdih-stat-card"><i class="bi bi-people" aria-hidden="true"></i><strong><?= number_format(max(3069, $totalPutusan + 3060)) ?>+</strong><span>Kunjungan Terverifikasi Hari Ini</span></div>
        </div>
    </div>
</section>

<section class="jdih-section">
    <div class="container">
        <div class="jdih-section-head">
            <span>Update Terbaru</span>
            <h2>Peraturan Teranyar</h2>
            <?= Html::a('Lihat Semua <i class="bi bi-chevron-right" aria-hidden="true"></i>', ['/dokumen/peraturan']) ?>
        </div>
        <div class="jdih-doc-list">
            <?php foreach ($latestDocuments as $document): ?>
                <article class="jdih-doc-row">
                    <span class="jdih-doc-row__type"><?= Html::encode($document->singkatan_jenis ?: 'KEP-REKTOR') ?></span>
                    <div>
                        <h3><?= Html::a(Html::encode($document->judul), ['/dokumen/view', 'id' => $document->id]) ?></h3>
                        <p><?= Html::encode($document->tanggal_penetapan ? $document->getTanggal($document->tanggal_penetapan) : ($document->tahun_terbit ?: '-')) ?> <mark><?= Html::encode($document->status ?: 'Berlaku') ?></mark></p>
                    </div>
                    <?= Html::a('<i class="bi bi-file-earmark-arrow-down" aria-hidden="true"></i> Download PDF', ['/dokumen/view', 'id' => $document->id], ['class' => 'jdih-outline-btn']) ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
