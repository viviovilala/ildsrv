<?php

use frontend\models\Dokumen;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'JDIH UPNVJT';
<<<<<<< HEAD
$this->registerMetaTag(['name' => 'description', 'content' => 'Portal JDIH UPN Veteran Jawa Timur untuk akses produk hukum dan informasi hukum kampus.']);
=======
$this->registerMetaTag(['name' => 'description', 'content' => 'Portal JDIH UPN Veteran Jawa Timur untuk akses produk hukum, monografi, artikel, putusan, dan informasi hukum kampus.']);
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98

<<<<<<< HEAD
$this->title = 'JDIH - Jaringan Dokumentasi dan Informasi Hukum';
$this->description = 'Jaringan Dokumentasi dan Informasi Hukum';
$this->keywords = ['Jaringan', 'Dokumentasi', 'Informasi', 'Hukum'];

$heroPng = Url::to('@web/images/hero-bg.png');
$this->registerLinkTag(['rel' => 'preload', 'as' => 'image', 'href' => $heroPng, 'type' => 'image/png']);

$instansi = FrontendConfig::findOne(2);
$rawInstansi = $instansi ? $instansi->isi_konfig : '';
$instansiText = trim(strip_tags(str_ireplace(['<br>', '<br/>', '<br />'], ' ', $rawInstansi)));
$instansiText = preg_replace('/^JDIH[\s\-–—]*/iu', '', $instansiText);
if ($instansiText === '' || strcasecmp($instansiText, 'JDIH') === 0) {
    $instansiText = '';
}

// Get totals using the existing helper method
=======
$heroImage = Url::to('@web/images/upnvjt-building.png');
>>>>>>> d1a316e3a76d3b83e0d4b7c9d7be2d1f9f96d4d0
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

<<<<<<< HEAD
<section class="jdih-hero" style="background-image: linear-gradient(90deg, rgba(6,78,11,.88), rgba(6,78,11,.52)), url('<?= Html::encode($heroImage) ?>');">
    <div class="container">
        <div class="jdih-hero__content">
            <span class="jdih-eyebrow">Beranda JDIH UPNVJT</span>
            <h1>Jaringan Dokumentasi &<br><span>Informasi Hukum</span></h1>
            <p>Akses transparan terhadap regulasi dan produk hukum Universitas Pembangunan Nasional "Veteran" Jawa Timur untuk mewujudkan tata kelola kampus yang akuntabel.</p>
            <form class="jdih-hero-search" action="<?= Url::to(['/dokumen/index']) ?>" method="get">
=======
<section class="upn-home-hero" style="background-image: linear-gradient(90deg, rgba(6,78,11,.88), rgba(6,78,11,.52)), url('<?= Html::encode($heroImage) ?>');">
    <div class="container upn-home-hero__inner">
        <div class="upn-home-hero__content">
            <span class="upn-home-hero__eyebrow">Beranda JDIH UPNVJT</span>
            <h1>Jaringan Dokumentasi &<br><span>Informasi Hukum</span></h1>
            <p>
                Akses transparan terhadap regulasi dan produk hukum Universitas Pembangunan Nasional
                "Veteran" Jawa Timur untuk mewujudkan tata kelola kampus yang akuntabel.
            </p>

<<<<<<< HEAD
    .search-landing-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(26, 39, 82, 0.85);
        /* Dark navy overlay matching theme */
        z-index: 1;
    }

    .search-landing-container > *:not(.search-landing-media) {
        position: relative;
        z-index: 2;
    }

    .hero-brand {
        font-size: clamp(2.5rem, 9vw, 3.75rem);
        font-weight: 800;
        color: #ffffff;
        margin: 0 0 2rem;
        letter-spacing: 0.02em;
        line-height: 1.05;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
    }

    .hero-brand .hero-instansi {
        display: block;
        margin-top: 0.45em;
        font-size: 0.36em;
        font-weight: 500;
        letter-spacing: 0.01em;
        line-height: 1.35;
        color: rgba(255, 255, 255, 0.9);
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.35);
        max-width: 22em;
        margin-left: auto;
        margin-right: auto;
    }

    @media screen and (max-width: 576px) {
        .search-landing-container {
            min-height: 72svh;
            padding: 5.5rem 1rem 2.5rem;
        }

        .hero-brand {
            font-size: clamp(2.25rem, 11vw, 2.75rem);
            margin-bottom: 1.5rem;
        }

        .hero-brand .hero-instansi {
            font-size: 0.34em;
            max-width: 18em;
        }
    }

    .hero-search-form {
        width: 100%;
        max-width: 650px;
        margin: 0 auto;
    }

    .search-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 650px;
        margin: 0 auto;
        background: #ffffff;
        border: 1px solid #dfe1e5;
        border-radius: 999px;
        box-shadow: 0 2px 12px rgba(32, 33, 36, 0.12);
        padding: 5px;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .search-input-wrapper:focus-within {
        border-color: #cbd5e1;
        box-shadow: 0 4px 18px rgba(32, 33, 36, 0.16);
    }

    .search-landing-container .search-input {
        flex: 1 1 0;
        min-width: 0;
        width: 0;
        max-width: 100%;
        padding: 0.875rem 0.75rem 0.875rem 2.75rem;
        font-size: 1.05rem;
        border: none;
        border-radius: 0;
        background: transparent;
        box-shadow: none;
        outline: none;
    }

    .search-input:focus,
    .search-input:hover {
        box-shadow: none;
        border-color: transparent;
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.15rem;
        pointer-events: none;
    }

    .search-btn {
        flex-shrink: 0;
        border-radius: 999px;
        padding: 0.7rem 1.6rem;
        font-size: 0.95rem;
        font-weight: 600;
        letter-spacing: 0.01em;
        color: #ffffff;
        background-color: #1a2752;
        border: none;
        box-shadow: none;
        transition: background-color 0.2s ease;
    }

    .search-btn:hover,
    .search-btn:focus-visible {
        background-color: #243566;
        color: #ffffff;
        box-shadow: none;
    }

    .search-btn:active {
        background-color: #141d3d;
    }

    @media screen and (max-width: 480px) {
        .search-btn {
            padding: 0.65rem 1.15rem;
            font-size: 0.9rem;
        }

        .search-landing-container .search-input {
            font-size: 1rem;
            padding-left: 2.5rem;
        }
    }

    .quick-links {
        margin-top: 2.5rem;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 10px;
        width: 100%;
        max-width: 650px;
    }

    .quick-chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        width: auto;
        max-width: 100%;
        padding: 8px 16px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.22);
        border-radius: 999px;
        color: #ffffff;
        font-size: 0.9rem;
        font-weight: 500;
        line-height: 1.2;
        text-decoration: none;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        transition: background-color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .quick-chip:hover,
    .quick-chip:focus-visible {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        text-decoration: none;
        border-color: rgba(255, 193, 7, 0.55);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .quick-chip .badge-count {
        flex-shrink: 0;
        background: rgba(255, 193, 7, 0.92);
        color: #1a2752;
        padding: 2px 7px;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 700;
        line-height: 1.3;
    }

    @media screen and (max-width: 576px) {
        .quick-links {
            margin-top: 1.5rem;
            gap: 8px;
            max-width: 100%;
        }

        .quick-chip {
            padding: 7px 12px;
            font-size: 0.8rem;
            gap: 5px;
        }

        .quick-chip .badge-count {
            font-size: 0.65rem;
            padding: 1px 6px;
        }
    }

    @media screen and (max-width: 380px) {
        .quick-chip {
            padding: 6px 10px;
            font-size: 0.75rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .quick-chip {
            transition: none;
        }

        .quick-chip:hover,
        .quick-chip:focus-visible {
            transform: none;
        }
    }

    .news-strip {
        background: #f8fafc;
        padding: 3.5rem 0;
        margin-top: 4rem;
        border-top: 1px solid #e8edf4;
    }

    .news-strip__title {
        font-size: 2rem;
        font-weight: 700;
        color: #1a2752;
        letter-spacing: -0.5px;
        margin-bottom: 0.75rem;
    }

    .news-strip__subtitle {
        color: #64748b;
        font-size: 1.05rem;
        margin-bottom: 0;
    }

    .news-strip__accent {
        height: 4px;
        width: 60px;
        background-color: #ffc107;
        border-radius: 2px;
        margin: 1rem auto 0;
    }

    .news-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.2s ease;
    }

    .news-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06) !important;
    }

    .news-card__image {
        height: 200px;
        object-fit: cover;
    }

    .news-card__date {
        font-size: 0.8125rem;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .news-card__title {
        font-size: 1.0625rem;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 0.625rem;
    }

    .news-card__title a {
        color: #1a2752;
        text-decoration: none;
    }

    .news-card__title a:hover {
        color: #274685;
    }

    .news-card__excerpt {
        font-size: 0.9rem;
        line-height: 1.6;
        color: #64748b;
        margin-bottom: 0.75rem;
    }

    .news-read-more {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1a2752;
        text-decoration: none;
    }

    .news-read-more:hover {
        color: #274685;
        text-decoration: underline;
        text-underline-offset: 2px;
    }

    /* Koleksi Kami Cards */
    .koleksi-card {
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .koleksi-card__icon-box {
        width: 70px;
        height: 70px;
        background-color: rgba(26, 39, 82, 0.05);
    }

    .koleksi-card__icon {
        font-size: 2rem;
        color: #1a2752;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .koleksi-card__title {
        color: #1a2752;
    }

    .koleksi-card__desc {
        color: #64748b;
        line-height: 1.5;
    }

    .koleksi-card__count {
        color: #1a2752;
        font-size: 1.75rem;
    }

    .koleksi-card__divider {
        border-color: #f1f5f9 !important;
    }

    .koleksi-card-link:hover .koleksi-card,
    .koleksi-card-link:focus-visible .koleksi-card {
        background: #1a2752;
        box-shadow: 0 12px 28px rgba(26, 39, 82, 0.22);
        transform: translateY(-6px);
    }

    .koleksi-card-link:hover .koleksi-card__title,
    .koleksi-card-link:hover .koleksi-card__count {
        color: #ffffff;
    }

    .koleksi-card-link:hover .koleksi-card__desc {
        color: #cbd5e1;
    }

    .koleksi-card-link:hover .koleksi-card__icon-box {
        background-color: rgba(255, 193, 7, 0.15);
    }

    .koleksi-card-link:hover .koleksi-card__icon {
        color: #ffc107;
    }

    .koleksi-card-link:hover .koleksi-card__divider {
        border-color: rgba(255, 255, 255, 0.12) !important;
    }

    .koleksi-status-card {
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .koleksi-status-link:hover .koleksi-status-card,
    .koleksi-status-link:focus-visible .koleksi-status-card {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(26, 39, 82, 0.1);
    }
</style>

<div class="site-index">

        <div class="search-landing-container">
            <picture class="search-landing-media" aria-hidden="true">
                <img
                    src="<?= Html::encode($heroPng) ?>"
                    alt=""
                    class="search-landing-bg"
                    width="640"
                    height="640"
                    fetchpriority="high"
                    decoding="async"
                >
            </picture>

            <h1 class="hero-brand" data-aos="fade-up">
                Jaringan Dokumentasi &amp;<br>
                <span class="hero-gold">Informasi Hukum</span>
                <?php if ($instansiText !== ''): ?>
                    <span class="hero-instansi"><?= Html::encode($instansiText) ?></span>
                <?php endif; ?>
            </h1>

            <form action="<?= Url::to(['dokumen/index']) ?>" method="GET" class="w-100 hero-search-form" data-aos="fade-up" data-aos-delay="100" role="search">
                <div class="search-input-wrapper">
                    <i class="bi bi-search search-icon" aria-hidden="true"></i>
                    <input type="search" name="DokumenSearch[judul]" class="search-input" placeholder="Cari dokumen hukum, peraturan, putusan..." value="" autocomplete="off" aria-label="Cari dokumen hukum">
                    <button type="submit" class="btn search-btn">Cari</button>
                </div>
=======
            <form class="upn-home-search" action="<?= Url::to(['/dokumen/index']) ?>" method="get" role="search">
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
                <i class="bi bi-search" aria-hidden="true"></i>
                <input type="search" name="DokumenSearch[judul]" placeholder="Cari peraturan, keputusan, atau artikel hukum..." aria-label="Cari produk hukum">
                <button type="submit">Cari</button>
>>>>>>> d1a316e3a76d3b83e0d4b7c9d7be2d1f9f96d4d0
            </form>
<<<<<<< HEAD
=======
        </div>
    </div>
</section>

<section class="upn-category-section">
    <div class="container">
        <div class="upn-category-grid">
            <a class="upn-category-card upn-category-card--featured" href="<?= Url::to(['/dokumen/peraturan']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-hammer" aria-hidden="true"></i></span>
                <h2>Peraturan Universitas</h2>
                <p>Kumpulan regulasi resmi, keputusan rektor, dan dasar hukum operasional kampus.</p>
                <strong>Lihat Selengkapnya <i class="bi bi-arrow-right" aria-hidden="true"></i></strong>
            </a>

            <a class="upn-category-card" href="<?= Url::to(['/dokumen/monografi']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-book" aria-hidden="true"></i></span>
                <h2>Monografi</h2>
                <strong>Explore <i class="bi bi-chevron-right" aria-hidden="true"></i></strong>
            </a>

            <a class="upn-category-card" href="<?= Url::to(['/dokumen/artikel']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-journal-text" aria-hidden="true"></i></span>
                <h2>Artikel Hukum</h2>
                <strong>Baca Artikel <i class="bi bi-chevron-right" aria-hidden="true"></i></strong>
            </a>

            <a class="upn-category-card" href="<?= Url::to(['/dokumen/putusan']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-bank" aria-hidden="true"></i></span>
                <h2>Putusan</h2>
                <strong>Arsip <i class="bi bi-chevron-right" aria-hidden="true"></i></strong>
            </a>

            <a class="upn-category-card upn-category-card--gold" href="<?= Url::to(['/dokumen/index']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-newspaper" aria-hidden="true"></i></span>
                <h2>Jurnal Hukum</h2>
                <p>Akses koleksi digital jurnal hukum civitas akademika.</p>
                <i class="bi bi-arrow-right upn-category-card__arrow" aria-hidden="true"></i>
            </a>

            <a class="upn-category-card" href="<?= Url::to(['/dokumen/index']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-fingerprint" aria-hidden="true"></i></span>
                <h2>Digital</h2>
                <strong>Koleksi Digital</strong>
            </a>
        </div>
    </div>
</section>

<section class="upn-stat-section">
    <div class="container">
        <div class="upn-stat-grid">
            <div class="upn-stat-card">
                <i class="bi bi-archive" aria-hidden="true"></i>
                <strong><?= number_format($totalPeraturan + $totalMonografi + $totalArtikel) ?>+</strong>
                <span>Produk Hukum (Artikel, Monografi, Peraturan)</span>
            </div>
            <div class="upn-stat-card">
                <i class="bi bi-share" aria-hidden="true"></i>
                <strong>9+</strong>
                <span>Publikasi Internal & Pojok Kejaksaan</span>
            </div>
            <div class="upn-stat-card">
                <i class="bi bi-people" aria-hidden="true"></i>
                <strong><?= number_format(max(3069, $totalPutusan + 3060)) ?>+</strong>
                <span>Kunjungan Terverifikasi Hari Ini</span>
            </div>
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
        </div>
    </div>
</section>

<<<<<<< HEAD
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
=======
<section class="upn-latest-section">
    <div class="container">
        <div class="upn-section-heading">
            <span>Update Terbaru</span>
            <div>
                <h2>Peraturan Teranyar</h2>
            </div>
            <?= Html::a('Lihat Semua <i class="bi bi-chevron-right" aria-hidden="true"></i>', ['/dokumen/peraturan'], ['class' => 'upn-section-link']) ?>
        </div>

        <div class="upn-latest-list">
            <?php foreach ($latestDocuments as $document): ?>
                <article class="upn-latest-item">
                    <span class="upn-latest-item__type"><?= Html::encode($document->singkatan_jenis ?: 'KEP-REKTOR') ?></span>
                    <div>
                        <h3><?= Html::a(Html::encode($document->judul), ['/dokumen/view', 'id' => $document->id]) ?></h3>
                        <p>
                            <i class="bi bi-calendar4" aria-hidden="true"></i>
                            <?= Html::encode($document->tanggal_penetapan ? $document->getTanggal($document->tanggal_penetapan) : ($document->tahun_terbit ?: '-')) ?>
                            <span><?= number_format((int) $document->hit_download) ?> Unduhan</span>
                            <mark><?= Html::encode($document->status ?: 'Berlaku') ?></mark>
                        </p>
                    </div>
                    <?= Html::a('<i class="bi bi-file-earmark-arrow-down" aria-hidden="true"></i> Download PDF', ['/dokumen/view', 'id' => $document->id], ['class' => 'upn-outline-button']) ?>
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<<<<<<< HEAD
=======

<<<<<<< HEAD
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5 justify-content-center">
                            <!-- Peraturan -->
                            <div class="col">
                                <a href="<?= Url::to(['dokumen/peraturan']) ?>" class="text-decoration-none koleksi-card-link d-block h-100">
                                    <div class="card h-100 border-0 rounded koleksi-card">
                                        <div class="card-body p-4 text-center d-flex flex-column h-100">
                                            <div class="koleksi-card__icon-box mb-4 mx-auto rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-file-earmark-text koleksi-card__icon"></i>
                                            </div>
                                            <h5 class="koleksi-card__title font-weight-bold mb-3">Peraturan</h5>
                                            <p class="koleksi-card__desc small flex-grow-1">Peraturan Perundang-undangan tingkat pusat hingga daerah.</p>
                                            <div class="mt-3 pt-3 border-top koleksi-card__divider">
                                                <h3 class="koleksi-card__count font-weight-bold mb-0"><?= number_format($totalPeraturan) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Monografi -->
                            <div class="col">
                                <a href="<?= Url::to(['dokumen/monografi']) ?>" class="text-decoration-none koleksi-card-link d-block h-100">
                                    <div class="card h-100 border-0 rounded koleksi-card">
                                        <div class="card-body p-4 text-center d-flex flex-column h-100">
                                            <div class="koleksi-card__icon-box mb-4 mx-auto rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-book koleksi-card__icon"></i>
                                            </div>
                                            <h5 class="koleksi-card__title font-weight-bold mb-3">Monografi Hukum</h5>
                                            <p class="koleksi-card__desc small flex-grow-1">Buku, naskah akademik, dan hasil kajian hukum.</p>
                                            <div class="mt-3 pt-3 border-top koleksi-card__divider">
                                                <h3 class="koleksi-card__count font-weight-bold mb-0"><?= number_format($totalMonografi) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Artikel Hukum -->
                            <div class="col">
                                <a href="<?= Url::to(['dokumen/artikel']) ?>" class="text-decoration-none koleksi-card-link d-block h-100">
                                    <div class="card h-100 border-0 rounded koleksi-card">
                                        <div class="card-body p-4 text-center d-flex flex-column h-100">
                                            <div class="koleksi-card__icon-box mb-4 mx-auto rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-journal-text koleksi-card__icon"></i>
                                            </div>
                                            <h5 class="koleksi-card__title font-weight-bold mb-3">Artikel Hukum</h5>
                                            <p class="koleksi-card__desc small flex-grow-1">Artikel dan jurnal hukum cetak maupun elektronik.</p>
                                            <div class="mt-3 pt-3 border-top koleksi-card__divider">
                                                <h3 class="koleksi-card__count font-weight-bold mb-0"><?= number_format($totalArtikel) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Putusan -->
                            <div class="col">
                                <a href="<?= Url::to(['dokumen/putusan']) ?>" class="text-decoration-none koleksi-card-link d-block h-100">
                                    <div class="card h-100 border-0 rounded koleksi-card">
                                        <div class="card-body p-4 text-center d-flex flex-column h-100">
                                            <div class="koleksi-card__icon-box mb-4 mx-auto rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-bank koleksi-card__icon"></i>
                                            </div>
                                            <h5 class="koleksi-card__title font-weight-bold mb-3">Putusan</h5>
                                            <p class="koleksi-card__desc small flex-grow-1">Dokumen putusan pengadilan yang bernilai yurisprudensi.</p>
                                            <div class="mt-3 pt-3 border-top koleksi-card__divider">
                                                <h3 class="koleksi-card__count font-weight-bold mb-0"><?= number_format($totalPutusan) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Bottom Row (Status) -->
                        <div class="row justify-content-center g-4">
                            <!-- Peraturan Berlaku -->
                            <div class="col-md-5">
                                <a href="<?= Url::to(['dokumen/berlaku']) ?>" class="text-decoration-none koleksi-status-link d-block h-100">
                                    <div class="card border-0 rounded koleksi-status-card h-100">
                                        <div class="card-body p-4 d-flex align-items-center">
                                            <div class="icon-box rounded-circle d-flex align-items-center justify-content-center mr-4" style="width: 60px; height: 60px; background-color: rgba(16, 185, 129, 0.1); flex-shrink: 0;">
                                                <i class="bi bi-check2-circle" style="font-size: 1.8rem; color: #10b981;"></i>
                                            </div>
                                            <div class="flex-grow-1 text-left">
                                                <h6 class="font-weight-bold text-dark mb-1">Peraturan Berlaku</h6>
                                                <p class="mb-0 small" style="color: #64748b;">Kumpulan peraturan yang masih aktif.</p>
                                            </div>
                                            <div class="text-right pl-3 border-left ml-3">
                                                <h4 class="font-weight-bold mb-0" style="color: #10b981;"><?= number_format($totalBerlaku) ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Peraturan Tidak Berlaku -->
                            <div class="col-md-5">
                                <a href="<?= Url::to(['dokumen/tberlaku']) ?>" class="text-decoration-none koleksi-status-link d-block h-100">
                                    <div class="card border-0 rounded koleksi-status-card h-100">
                                        <div class="card-body p-4 d-flex align-items-center">
                                            <div class="icon-box rounded-circle d-flex align-items-center justify-content-center mr-4" style="width: 60px; height: 60px; background-color: rgba(239, 68, 68, 0.1); flex-shrink: 0;">
                                                <i class="bi bi-x-circle" style="font-size: 1.8rem; color: #ef4444;"></i>
                                            </div>
                                            <div class="flex-grow-1 text-left">
                                                <h6 class="font-weight-bold text-dark mb-1">Tidak Berlaku</h6>
                                                <p class="mb-0 small" style="color: #64748b;">Kumpulan peraturan yang telah dicabut.</p>
                                            </div>
                                            <div class="text-right pl-3 border-left ml-3">
                                                <h4 class="font-weight-bold mb-0" style="color: #ef4444;"><?= number_format($totalTidakBerlaku) ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- News Strip (Only on landing) -->
        <?= $this->render('_popular-documents', ['popularDocuments' => $popularDocuments ?? []]) ?>

        <?php if (!empty($berita)): ?>
            <section class="news-strip">
                <div class="container">
                    <div class="row text-center mb-5">
                        <div class="col-12">
                            <h2 class="news-strip__title">Berita Terbaru</h2>
                            <p class="news-strip__subtitle">Informasi dan kegiatan terkini seputar hukum</p>
                            <div class="news-strip__accent"></div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($berita as $data): ?>
                            <div class="col-lg-4 mb-4">
                                <article class="card h-100 border-0 shadow-sm rounded overflow-hidden news-card">
                                    <?= Html::a(LazyImage::img('@web/common/dokumen/' . $data->image, [
                                        'class' => 'card-img-top news-card__image w-100',
                                        'alt' => $data->judul,
                                    ]), ['berita/view', 'id' => $data->id]); ?>
                                    <div class="card-body p-4 d-flex flex-column">
                                        <time class="news-card__date" datetime="<?= Html::encode($data->tanggal) ?>">
                                            <?= \common\components\DateHelper::formatIndonesian($data->tanggal) ?>
                                        </time>
                                        <h3 class="news-card__title">
                                            <?= Html::a(Html::encode($data->judul), ['berita/view', 'id' => $data->id]) ?>
                                        </h3>
                                        <p class="news-card__excerpt flex-grow-1">
                                            <?= implode(' ', array_slice(explode(' ', strip_tags($data->isi)), 0, 18)) . '…' ?>
                                        </p>
                                        <?= Html::a('Baca selengkapnya →', ['berita/view', 'id' => $data->id], ['class' => 'news-read-more mt-auto']) ?>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-center mt-3">
                        <?= Html::a('Lihat semua berita <i class="bi bi-arrow-right"></i>', ['berita/index'], ['class' => 'btn btn-outline-primary rounded-pill px-4']); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

</div>
=======
<style>
.upn-home-hero{min-height:620px;background-size:cover;background-position:center;display:flex;align-items:center;color:#fff}
.upn-home-hero__inner{width:100%}
.upn-home-hero__content{max-width:760px;padding:90px 0 130px}
.upn-home-hero__eyebrow{display:block;margin-bottom:22px;font-weight:800;color:rgba(255,255,255,.78)}
.upn-home-hero h1{margin:0;font-family:Georgia,"Times New Roman",serif;font-size:clamp(42px,6vw,72px);line-height:1.08;font-weight:800;letter-spacing:0}
.upn-home-hero h1 span{color:#ffd200}
.upn-home-hero p{max-width:640px;margin:28px 0 30px;color:rgba(255,255,255,.86);font-size:17px;line-height:1.7}
.upn-home-search{max-width:620px;height:64px;display:flex;align-items:center;gap:14px;padding:8px 8px 8px 24px;background:#fff;border-radius:12px;box-shadow:0 20px 50px rgba(0,0,0,.24)}
.upn-home-search i{font-size:22px;color:#6b7168}
.upn-home-search input{flex:1;border:0;outline:0;color:#1e241c;font-size:15px;min-width:0}
.upn-home-search button{height:48px;border:0;border-radius:10px;background:#ffd200;color:#064e0b;font-weight:900;padding:0 26px}
.upn-category-section{background:#f8f7f2;padding:0 0 72px;margin-top:-52px;position:relative;z-index:2}
.upn-category-grid{display:grid;grid-template-columns:1.6fr 1fr 1fr;gap:24px}
.upn-category-card{min-height:172px;display:flex;flex-direction:column;justify-content:space-between;padding:28px;border:1px solid #d8dbd2;border-radius:12px;background:#fff;color:#1e241c;text-decoration:none;box-shadow:0 12px 30px rgba(30,36,28,.06);transition:transform .18s ease,box-shadow .18s ease}
.upn-category-card:hover{transform:translateY(-4px);box-shadow:0 20px 42px rgba(30,36,28,.12);color:#1e241c;text-decoration:none}
.upn-category-card--featured{grid-row:span 2;background:#064e0b;color:#fff}
.upn-category-card--featured:hover{color:#fff}
.upn-category-card--gold{background:#ffd200;grid-column:span 2}
.upn-category-card__icon{width:52px;height:52px;display:flex;align-items:center;justify-content:center;border-radius:10px;background:#eef5ed;color:#064e0b;font-size:24px}
.upn-category-card--featured .upn-category-card__icon{background:#0b5d1e;color:#ffd200}
.upn-category-card h2{margin:22px 0 12px;font-family:Georgia,"Times New Roman",serif;font-size:26px;letter-spacing:0}
.upn-category-card p{color:inherit;opacity:.78;line-height:1.65}
.upn-category-card strong{margin-top:auto;color:#064e0b}
.upn-category-card--featured strong{color:#ffd200}
.upn-category-card__arrow{position:absolute}
.upn-stat-section{background:#ecebe4;padding:78px 0}
.upn-stat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.upn-stat-card{padding:34px;border-radius:12px;background:#fff;text-align:center;color:#064e0b}
.upn-stat-card i{font-size:42px}
.upn-stat-card strong{display:block;margin:18px 0 8px;font-family:Georgia,"Times New Roman",serif;font-size:48px;line-height:1}
.upn-stat-card span{color:#6b7168}
.upn-latest-section{background:#f8f7f2;padding:84px 0}
.upn-section-heading{display:grid;grid-template-columns:1fr auto;gap:8px 24px;align-items:end;margin-bottom:28px}
.upn-section-heading>span{grid-column:1/-1;color:#8a7900;font-size:12px;font-weight:900;letter-spacing:.1em;text-transform:uppercase}
.upn-section-heading h2{margin:0;color:#064e0b;font-family:Georgia,"Times New Roman",serif;font-size:36px;letter-spacing:0}
.upn-section-link{color:#064e0b;font-weight:900;text-decoration:none}
.upn-latest-list{display:grid;gap:16px}
.upn-latest-item{display:grid;grid-template-columns:130px 1fr auto;align-items:center;gap:24px;padding:22px;border:1px solid #d8dbd2;border-radius:12px;background:#fff}
.upn-latest-item__type{display:inline-flex;justify-content:center;padding:8px 12px;border-radius:999px;background:#edf3ed;color:#064e0b;font-size:12px;font-weight:900}
.upn-latest-item h3{margin:0 0 8px;font-size:18px;line-height:1.35}
.upn-latest-item h3 a{color:#1e241c;text-decoration:none}
.upn-latest-item p{margin:0;color:#6b7168;font-size:13px}
.upn-latest-item p span{margin-left:14px}
.upn-latest-item mark{margin-left:14px;padding:4px 9px;border-radius:999px;background:#bdf3bf;color:#064e0b;font-weight:800}
.upn-outline-button{display:inline-flex;align-items:center;gap:8px;border:2px solid #064e0b;border-radius:8px;padding:12px 18px;color:#064e0b;font-weight:900;text-decoration:none;white-space:nowrap}
@media(max-width:991.98px){.upn-category-grid,.upn-stat-grid{grid-template-columns:1fr 1fr}.upn-category-card--featured,.upn-category-card--gold{grid-column:auto;grid-row:auto}.upn-latest-item{grid-template-columns:1fr}.upn-outline-button{justify-content:center}}
@media(max-width:575.98px){.upn-home-hero{min-height:560px}.upn-home-hero__content{padding:60px 0 96px}.upn-home-search{height:auto;flex-wrap:wrap;padding:16px}.upn-home-search button{width:100%}.upn-category-grid,.upn-stat-grid{grid-template-columns:1fr}.upn-category-section{margin-top:-32px}}
</style>
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
>>>>>>> d1a316e3a76d3b83e0d4b7c9d7be2d1f9f96d4d0
