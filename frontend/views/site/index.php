<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\components\LazyImage;
use frontend\models\Dokumen;
use backend\models\FrontendConfig;

/* Set meta tags */

$this->title = 'JDIH - Jaringan Dokumentasi dan Informasi Hukum';
$this->description = 'Jaringan Dokumentasi dan Informasi Hukum';
$this->keywords = ['Jaringan', 'Dokumentasi', 'Informasi', 'Hukum'];

$heroPng = Url::to('@web/images/hero-bg.png');
$this->registerLinkTag(['rel' => 'preload', 'as' => 'image', 'href' => $heroPng, 'type' => 'image/png']);

$instansi = FrontendConfig::findOne(2);
$rawInstansi = $instansi ? $instansi->isi_konfig : '';
$instansiText = "UPN 'Veteran' Jawa Timur";

// Get totals using the existing helper method
$totalPeraturan = Dokumen::find()->total(1);
$totalMonografi = Dokumen::find()->total(2);
$totalArtikel   = Dokumen::find()->total(3);
$totalPutusan   = Dokumen::find()->total(4);

$totalBerlaku       = Dokumen::find()->where(['status' => 'Berlaku', 'is_publish' => 1, 'tipe_dokumen' => Dokumen::TYPE_PERATURAN])->count();
$totalTidakBerlaku  = Dokumen::find()->where(['status' => 'Tidak Berlaku', 'is_publish' => 1, 'tipe_dokumen' => Dokumen::TYPE_PERATURAN])->count();

?>

<style>
/* ==========================================================
   BERANDA JDIH - LAYOUT UTAMA
   ========================================================== */
.site-index{
    background:#f8f8f5;
    color:#23351f;
}

.search-landing-container{
    min-height:520px;
    position:relative;
    display:flex;
    flex-direction:column;
    justify-content:center;
    overflow:hidden;
    padding:90px max(5vw, 32px) 72px;
    background:#21451b;
}

.search-landing-media{
    position:absolute;
    inset:0;
    z-index:0;
    display:block;
}

.search-landing-bg{
    width:100%;
    height:100%;
    object-fit:cover;
    object-position:center;
}

.search-landing-container::after{
    content:"";
    position:absolute;
    inset:0;
    z-index:1;
    background:linear-gradient(90deg,rgba(25,57,20,.88) 0%,rgba(25,57,20,.72) 43%,rgba(25,57,20,.18) 100%);
}

.search-landing-container > *:not(.search-landing-media){
    position:relative;
    z-index:2;
}

.hero-brand{
    max-width:720px;
    margin:0 0 28px;
    color:#fff;
    font-family:Georgia,"Times New Roman",serif;
    font-size:clamp(2.8rem,5vw,4.8rem);
    font-weight:700;
    line-height:.98;
    letter-spacing:-.035em;
    text-shadow:0 3px 12px rgba(0,0,0,.22);
}

.hero-brand .hero-gold{color:#f5cf43;}
.hero-brand .hero-instansi{
    display:block;
    margin-top:24px;
    max-width:560px;
    color:rgba(255,255,255,.9);
    font-family:inherit;
    font-size:1rem;
    font-weight:400;
    line-height:1.65;
    letter-spacing:0;
    text-shadow:none;
}

.hero-search-form{width:100%;max-width:650px;margin:0;}
.search-input-wrapper{
    display:flex;
    align-items:center;
    width:100%;
    padding:5px;
    background:#fff;
    border:1px solid #ddd;
    border-radius:12px;
    box-shadow:0 10px 30px rgba(0,0,0,.14);
}
.search-input-wrapper .search-icon{
    margin-left:14px;
    color:#778077;
    font-size:1.1rem;
}
.search-landing-container .search-input{
    flex:1;
    min-width:0;
    padding:.85rem .8rem;
    border:0!important;
    outline:0!important;
    box-shadow:none!important;
    background:transparent;
    font-size:.95rem;
}
.search-btn{
    flex-shrink:0;
    padding:.78rem 1.45rem;
    border:0;
    border-radius:9px;
    background:#f5cf43;
    color:#24431d;
    font-weight:700;
}
.search-btn:hover,.search-btn:focus{background:#e9c137;color:#24431d;}

.quick-links{
    display:none;
}

/* ==========================================================
   KOLEKSI
   ========================================================== */
.koleksi-cards-section{
    padding:52px 0 38px!important;
    background:#fafaf7!important;
}
.koleksi-cards-section .container{max-width:1120px;}
.koleksi-cards-section .row.text-center{display:none;}

.home-collection-grid{
    display:grid;
    grid-template-columns:1.6fr 1fr 1fr;
    grid-template-rows:198px 148px;
    gap:18px;
}
.home-collection-card{
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    min-width:0;
    padding:18px;
    border:1px solid #d8ddd3;
    border-radius:14px;
    background:#fff;
    color:#20331c;
    text-decoration:none!important;
    box-shadow:0 5px 18px rgba(32,51,28,.035);
    transition:.2s ease;
}
.home-collection-card:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 26px rgba(32,51,28,.10);
}
.home-collection-card--main{
    grid-column:1;
    grid-row:1;
    padding:20px;
    background:#21491c;
    border-color:#21491c;
    color:#fff;
}
.home-collection-card--journal{
    grid-column:2;
    grid-row:2;
    flex-direction:row;
    align-items:center;
    gap:18px;
    background:#f6d044;
    border-color:#e3bd30;
}
.home-collection-card--journal .collection-content{flex:1;}
.home-collection-card--putusan{grid-column:1;grid-row:2;}
.home-collection-card--digital{grid-column:3;grid-row:2;}
.home-collection-card--mono{grid-column:2;grid-row:1;}
.home-collection-card--artikel{grid-column:3;grid-row:1;}

.collection-icon{
    width:40px;
    height:40px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:8px;
    background:#f1f3ee;
    color:#21491c;
    font-size:1.2rem;
}
.home-collection-card--main .collection-icon{
    background:rgba(255,255,255,.12);
    color:#f5cf43;
}
.home-collection-card--journal .collection-icon{
    width:50px;height:50px;border-radius:50%;
    background:rgba(255,255,255,.18);
}
.collection-title{
    margin:12px 0 8px;
    color:inherit;
    font-family:Georgia,"Times New Roman",serif;
    font-size:1.25rem;
    font-weight:700;
    line-height:1.2;
}
.collection-desc{
    margin:0;
    color:#657064;
    font-size:.82rem;
    line-height:1.55;
}
.home-collection-card--main .collection-desc{color:rgba(255,255,255,.78);}
.collection-link{
    display:inline-block;
    margin-top:10px;
    color:#21491c;
    font-size:.76rem;
    font-weight:800;
}
.home-collection-card--main .collection-link{color:#f5cf43;}
.collection-arrow{
    margin-left:auto;
    color:#34452f;
    font-size:1.4rem;
}
.home-collection-card--journal .collection-title{
    margin:0 0 3px;
    font-size:1.25rem;
}
.home-collection-card--journal .collection-desc{color:#695b26;}
.home-collection-card--journal .collection-arrow{font-size:1.5rem;}

.home-stats{
    padding:42px 0;
    background:#f1f2ef;
}
.home-stats-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:18px;
}
.home-stat{
    min-height:142px;
    padding:20px;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    text-align:center;
    background:#fff;
    border-radius:13px;
}
.home-stat i{
    color:#21491c;
    font-size:2rem;
}
.home-stat strong{
    display:block;
    margin:8px 0 4px;
    color:#21491c;
    font-family:Georgia,"Times New Roman",serif;
    font-size:2.35rem;
    line-height:1;
}
.home-stat span{
    color:#687166;
    font-size:.78rem;
}

/* ==========================================================
   PERATURAN TERBARU
   ========================================================== */
.latest-regulations{
    padding:48px 0 30px;
    background:#fafaf7;
}
.home-section-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    margin-bottom:18px;
}
.home-section-title{
    margin:0;
    color:#21491c;
    font-family:Georgia,"Times New Roman",serif;
    font-size:1.65rem;
    font-weight:700;
}
.home-section-link{
    color:#21491c;
    text-decoration:none;
    font-size:.8rem;
    font-weight:800;
}
.regulation-list{display:grid;gap:10px;}
.regulation-item{
    display:grid;
    grid-template-columns:110px 1fr auto;
    align-items:center;
    gap:18px;
    padding:14px 16px;
    background:#fff;
    border:1px solid #d8ddd3;
    border-radius:10px;
}
.regulation-badge{
    justify-self:start;
    padding:6px 10px;
    border-radius:999px;
    background:#e9eee8;
    color:#31502c;
    font-size:.64rem;
    font-weight:800;
}
.regulation-title{
    margin:0 0 6px;
    color:#27352a;
    font-size:.88rem;
    line-height:1.35;
}
.regulation-meta{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
    color:#747c73;
    font-size:.65rem;
}
.regulation-status{
    display:inline-block;
    margin-left:6px;
    padding:3px 7px;
    border-radius:4px;
    background:#dff2e1;
    color:#397b42;
    font-size:.6rem;
    font-weight:800;
}
.regulation-status--revoked{background:#f7dfdf;color:#a24d4d;}
.regulation-action{
    display:inline-flex;
    align-items:center;
    gap:7px;
    padding:9px 14px;
    border:2px solid #21491c;
    border-radius:7px;
    color:#21491c;
    text-decoration:none;
    font-size:.68rem;
    font-weight:800;
    white-space:nowrap;
}
.regulation-action:hover{background:#21491c;color:#fff;}

/* ==========================================================
   BERITA SINGKAT
   ========================================================== */
.news-strip{
    padding:42px 0 65px;
    margin:0;
    background:#f1f2ef;
    border:0;
}
.news-strip__title{
    margin:0;
    color:#21491c;
    font-family:Georgia,"Times New Roman",serif;
    font-size:1.65rem;
}
.news-strip__subtitle{color:#687166;font-size:.9rem;}
.news-strip__accent{
    width:48px;height:3px;margin:10px auto 0;
    background:#f5cf43;border-radius:3px;
}
.news-home-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:18px;
}
.news-home-card{
    overflow:hidden;
    background:#fff;
    border:1px solid #d8ddd3;
    border-radius:12px;
}
.news-home-card__image{
    display:block;
    width:100%;
    height:165px;
    object-fit:cover;
}
.news-home-card__body{padding:15px 17px 17px;}
.news-home-card__date{color:#7b8278;font-size:.66rem;}
.news-home-card__title{
    margin:8px 0;
    font-family:Georgia,"Times New Roman",serif;
    font-size:1rem;
    line-height:1.35;
}
.news-home-card__title a{color:#294027;text-decoration:none;}
.news-home-card__excerpt{
    margin:0 0 10px;
    color:#697169;
    font-size:.74rem;
    line-height:1.5;
}
.news-read-more{
    color:#21491c;
    font-size:.72rem;
    font-weight:800;
    text-decoration:none;
}

@media(max-width:900px){
    .home-collection-grid{
        grid-template-columns:repeat(2,1fr);
        grid-template-rows:auto;
    }
    .home-collection-card--main,
    .home-collection-card--mono,
    .home-collection-card--artikel,
    .home-collection-card--putusan,
    .home-collection-card--digital,
    .home-collection-card--journal{
        grid-column:auto;grid-row:auto;
    }
    .home-collection-card--main{min-height:190px;}
}
@media(max-width:700px){
    .search-landing-container{min-height:480px;padding:85px 22px 55px;}
    .hero-brand{font-size:clamp(2.3rem,11vw,3.3rem);}
    .hero-brand .hero-instansi{font-size:.85rem;}
    .home-stats-grid,.news-home-grid{grid-template-columns:1fr;}
    .regulation-item{grid-template-columns:1fr;gap:9px;}
    .regulation-action{justify-self:start;}
}
@media(max-width:520px){
    .home-collection-grid{grid-template-columns:1fr;}
    .home-collection-card--journal{flex-direction:row;}
    .search-input-wrapper{padding:4px;}
    .search-btn{padding:.72rem 1rem;}
    .search-landing-container .search-input{font-size:.8rem;}
}
@media(prefers-reduced-motion:reduce){
    .home-collection-card{transition:none;}
}
</style>


<div class="site-index">

    <!-- ==========================================================
         HERO
         ========================================================== -->
    <section class="search-landing-container">
        <picture class="search-landing-media" aria-hidden="true">
            <img
                src="<?= Html::encode($heroPng) ?>"
                alt=""
                class="search-landing-bg"
                width="1600"
                height="700"
                fetchpriority="high"
                decoding="async"
            >
        </picture>

        <h1 class="hero-brand" data-aos="fade-up">
            Informasi <span class="hero-gold">Hukum</span>
            <?php if ($instansiText !== ''): ?>
                <span class="hero-instansi">
                    Akses transparan terhadap regulasi dan produk hukum
                    Universitas Pembangunan Nasional "Veteran" Jawa Timur
                    untuk mewujudkan tata kelola kampus yang akuntabel.
                </span>
            <?php endif; ?>
        </h1>

        <form action="<?= Url::to(['dokumen/index']) ?>" method="GET"
              class="hero-search-form" data-aos="fade-up"
              data-aos-delay="100" role="search">
            <div class="search-input-wrapper">
                <i class="bi bi-search search-icon" aria-hidden="true"></i>
                <input
                    type="search"
                    name="DokumenSearch[judul]"
                    class="search-input"
                    placeholder="Cari peraturan, keputusan, atau artikel hukum..."
                    autocomplete="off"
                    aria-label="Cari dokumen hukum"
                >
                <button type="submit" class="btn search-btn">Cari</button>
            </div>
        </form>
    </section>


    <!-- ==========================================================
         KOLEKSI UTAMA
         ========================================================== -->
    <section class="koleksi-cards-section">
        <div class="container">

            <div class="home-collection-grid">

                <a href="<?= Url::to(['dokumen/peraturan']) ?>"
                   class="home-collection-card home-collection-card--main">
                    <div>
                        <div class="collection-icon">
                            <i class="bi bi-hammer"></i>
                        </div>
                        <h2 class="collection-title">Peraturan Universitas</h2>
                        <p class="collection-desc">
                            Kumpulan regulasi resmi, keputusan rektor,
                            dan dasar hukum operasional universitas.
                        </p>
                    </div>
                    <span class="collection-link">
                        Lihat Selengkapnya <i class="bi bi-arrow-right"></i>
                    </span>
                </a>

                <a href="<?= Url::to(['dokumen/monografi']) ?>"
                   class="home-collection-card home-collection-card--mono">
                    <div class="collection-icon"><i class="bi bi-book"></i></div>
                    <div>
                        <h2 class="collection-title">Monografi</h2>
                        <span class="collection-link">Explore <i class="bi bi-chevron-right"></i></span>
                    </div>
                </a>

                <a href="<?= Url::to(['dokumen/artikel']) ?>"
                   class="home-collection-card home-collection-card--artikel">
                    <div class="collection-icon"><i class="bi bi-journal-text"></i></div>
                    <div>
                        <h2 class="collection-title">Artikel Hukum</h2>
                        <span class="collection-link">Baca Artikel <i class="bi bi-chevron-right"></i></span>
                    </div>
                </a>

                <a href="<?= Url::to(['dokumen/putusan']) ?>"
                   class="home-collection-card home-collection-card--putusan">
                    <div class="collection-icon"><i class="bi bi-balance-scale"></i></div>
                    <div>
                        <h2 class="collection-title">Putusan</h2>
                        <span class="collection-link">Arsip <i class="bi bi-chevron-right"></i></span>
                    </div>
                </a>

                <a href="<?= Url::to(['dokumen/artikel']) ?>"
                   class="home-collection-card home-collection-card--journal">
                    <div class="collection-icon"><i class="bi bi-newspaper"></i></div>
                    <div class="collection-content">
                        <h2 class="collection-title">Jurnal Hukum</h2>
                        <p class="collection-desc">Akses koleksi digital jurnal hukum civitas akademika.</p>
                    </div>
                    <span class="collection-arrow"><i class="bi bi-arrow-right"></i></span>
                </a>

                <a href="<?= Url::to(['dokumen/index']) ?>"
                   class="home-collection-card home-collection-card--digital">
                    <div class="collection-icon"><i class="bi bi-fingerprint"></i></div>
                    <div>
                        <h2 class="collection-title">Digital</h2>
                        <span class="collection-link">Koleksi Digital</span>
                    </div>
                </a>

            </div>
        </div>
    </section>


    <!-- ==========================================================
         STATISTIK
         ========================================================== -->
    <section class="home-stats">
        <div class="container">
            <div class="home-stats-grid">

                <div class="home-stat">
                    <i class="bi bi-archive"></i>
                    <strong>271+</strong>
                    <span>Produk Hukum (Artikel, Monografi, Peraturan)</span>
                </div>

                <div class="home-stat">
                    <i class="bi bi-share"></i>
                    <strong>9+</strong>
                    <span>Publikasi Internal &amp; Pojok Kejaksaan</span>
                </div>

                <div class="home-stat">
                    <i class="bi bi-people"></i>
                    <strong>3069+</strong>
                    <span>Kunjungan Terverifikasi Hari Ini</span>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================================
         PERATURAN TERBARU
         ========================================================== -->
    <section class="latest-regulations">
        <div class="container">

            <div class="home-section-head">
                <h2 class="home-section-title">Peraturan Terbaru</h2>
                <a href="<?= Url::to(['dokumen/peraturan']) ?>" class="home-section-link">
                    Lihat Semua <i class="bi bi-chevron-right"></i>
                </a>
            </div>

            <div class="regulation-list">

                <article class="regulation-item">
                    <span class="regulation-badge">KEP-REKTOR</span>
                    <div>
                        <h3 class="regulation-title">
                            Keputusan Rektor No. 45/UN63/2024 tentang Penetapan Kalender Akademik Semester Gasal
                        </h3>
                        <div class="regulation-meta">
                            <span><i class="bi bi-calendar3"></i> 15 Okt 2024</span>
                            <span><i class="bi bi-download"></i> 1.2k Unduhan</span>
                            <span class="regulation-status">BERLAKU</span>
                        </div>
                    </div>
                    <a href="<?= Url::to(['dokumen/peraturan']) ?>" class="regulation-action">
                        <i class="bi bi-file-earmark-pdf"></i> Download PDF
                    </a>
                </article>

                <article class="regulation-item">
                    <span class="regulation-badge">PER-UNIVERSITAS</span>
                    <div>
                        <h3 class="regulation-title">
                            Peraturan Universitas No. 12 Tahun 2024 Mengenai Kode Etik Dosen dan Tenaga Kependidikan
                        </h3>
                        <div class="regulation-meta">
                            <span><i class="bi bi-calendar3"></i> 02 Okt 2024</span>
                            <span><i class="bi bi-download"></i> 850 Unduhan</span>
                            <span class="regulation-status">BERLAKU</span>
                        </div>
                    </div>
                    <a href="<?= Url::to(['dokumen/peraturan']) ?>" class="regulation-action">
                        <i class="bi bi-file-earmark-pdf"></i> Download PDF
                    </a>
                </article>

                <article class="regulation-item">
                    <span class="regulation-badge">KEP-REKTOR</span>
                    <div>
                        <h3 class="regulation-title">
                            Keputusan Rektor No. 11/UN63/2023 tentang Pedoman Operasional Standar Kemahasiswaan
                        </h3>
                        <div class="regulation-meta">
                            <span><i class="bi bi-calendar3"></i> 12 Jan 2023</span>
                            <span><i class="bi bi-download"></i> 2.4k Unduhan</span>
                            <span class="regulation-status regulation-status--revoked">DICABUT</span>
                        </div>
                    </div>
                    <a href="<?= Url::to(['dokumen/peraturan']) ?>" class="regulation-action">
                        <i class="bi bi-clock-history"></i> Lihat Riwayat
                    </a>
                </article>

            </div>
        </div>
    </section>


    <!-- ==========================================================
         BERITA SEDIKIT
         ========================================================== -->
    <?php
    /*
     * Gunakan data berita dari controller jika tersedia.
     * Jika belum ada data, gunakan tiga dummy yang memang memiliki
     * ID berita yang sudah dipakai pada halaman berita.
     */
    $homeNews = [];

    if (!empty($berita)) {
        foreach (array_slice($berita, 0, 3) as $data) {
            $homeNews[] = [
                'id' => (int)$data->id,
                'judul' => (string)$data->judul,
                'tanggal' => (string)$data->tanggal,
                'isi' => strip_tags((string)$data->isi),
                'image' => !empty($data->image)
                    ? '@web/common/dokumen/' . $data->image
                    : '@web/images/upnvjt-building.png',
            ];
        }
    }

    if (empty($homeNews)) {
        $homeNews = [
            [
                'id' => 9001,
                'judul' => 'Mahasiswa KKN UPN Veteran Jawa Timur Dorong Pengembangan Potensi Masyarakat',
                'tanggal' => '2026-08-26',
                'isi' => 'Mahasiswa UPN Veteran Jawa Timur melaksanakan kegiatan KKN sebagai bentuk pengabdian kepada masyarakat dan pengembangan potensi daerah.',
                'image' => '@web/uploads/berita/01-kkn-upnvjt.jpg.jpeg',
            ],
            [
                'id' => 9002,
                'judul' => 'KKNT MBKM UPN Veteran Jawa Timur Perkuat Kontribusi Mahasiswa di Masyarakat',
                'tanggal' => '2026-08-25',
                'isi' => 'Program KKNT MBKM menjadi salah satu bentuk implementasi pembelajaran mahasiswa di luar kampus melalui kegiatan pengabdian.',
                'image' => '@web/uploads/berita/02-kknt-mbkm.jpg.jpeg',
            ],
            [
                'id' => 9003,
                'judul' => 'UPN Veteran Jawa Timur Dorong Program KKN Internasional untuk Memperluas Pengabdian',
                'tanggal' => '2026-08-24',
                'isi' => 'Kegiatan KKN internasional menjadi bagian dari upaya UPN Veteran Jawa Timur memperluas pengalaman mahasiswa dan memperkuat kontribusi.',
                'image' => '@web/uploads/berita/04-kkn-internasional.jpg.jpeg',
            ],
        ];
    }
    ?>

    <section class="news-strip">
        <div class="container">

            <div class="home-section-head">
                <div>
                    <h2 class="home-section-title">Berita Terbaru</h2>
                    <p class="news-strip__subtitle mb-0">
                        Informasi dan kegiatan terkini seputar UPN Veteran Jawa Timur.
                    </p>
                </div>
                <a href="<?= Url::to(['berita/index']) ?>" class="home-section-link">
                    Lihat Semua <i class="bi bi-chevron-right"></i>
                </a>
            </div>

            <div class="news-home-grid">
                <?php foreach ($homeNews as $news): ?>
                    <?php
                    $newsImage = $news['image'];

                    if (strpos($newsImage, '@web/uploads/berita/') === 0) {
                        $newsFilename = basename($newsImage);
                        $newsPath = Yii::getAlias('@webroot/uploads/berita/' . $newsFilename);

                        if (!is_file($newsPath)) {
                            $newsImage = '@web/images/upnvjt-building.png';
                        }
                    }
                    ?>
                    <article class="news-home-card">

                        <?= Html::a(
                            LazyImage::img($newsImage, [
                                'class' => 'news-home-card__image',
                                'alt' => $news['judul'],
                                'loading' => 'lazy',
                            ]),
                            ['berita/view', 'id' => $news['id']],
                            ['aria-label' => 'Buka berita: ' . $news['judul']]
                        ) ?>

                        <div class="news-home-card__body">

                            <time class="news-home-card__date"
                                  datetime="<?= Html::encode($news['tanggal']) ?>">
                                <i class="bi bi-calendar3"></i>
                                <?= Html::encode(
                                    !empty($news['tanggal'])
                                        ? \common\components\DateHelper::formatIndonesian($news['tanggal'])
                                        : '-'
                                ) ?>
                            </time>

                            <h3 class="news-home-card__title">
                                <?= Html::a(
                                    Html::encode($news['judul']),
                                    ['berita/view', 'id' => $news['id']]
                                ) ?>
                            </h3>

                            <p class="news-home-card__excerpt">
                                <?= Html::encode(
                                    mb_strimwidth($news['isi'], 0, 145, '...')
                                ) ?>
                            </p>

                            <?= Html::a(
                                'Baca selengkapnya <i class="bi bi-arrow-right"></i>',
                                ['berita/view', 'id' => $news['id']],
                                ['class' => 'news-read-more']
                            ) ?>

                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

</div>
