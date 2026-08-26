<?php

use frontend\models\Berita;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Berita & Informasi';

/*
|--------------------------------------------------------------------------
| FILTER KATEGORI
|--------------------------------------------------------------------------
*/

$category = trim((string) Yii::$app->request->get('category', ''));

/*
|--------------------------------------------------------------------------
| DATA DUMMY BERITA
|--------------------------------------------------------------------------
|
| Semua gambar harus berada di:
|
| frontend/web/uploads/berita/
|
| File:
| 01-kkn-upnvjt.jpg.jpeg
| 02-kknt-mbkm.jpg.jpeg
| 04-kkn-internasional.jpg.jpeg
| 05-wisuda-upnvjt.jpg.jpeg
| 06-kkn-tematik.jpg.jpeg
| hero-rektor-upnvjt.jpg.png
|
|--------------------------------------------------------------------------
*/

$dummyNews = [

    [
        'id' => 9001,
        'judul' => 'Mahasiswa KKN UPN Veteran Jawa Timur Dorong Pengembangan Potensi Masyarakat',
        'tanggal' => '2026-08-26',
        'image' => '01-kkn-upnvjt.jpg.jpeg',
        'kategori' => 'Kemahasiswaan',
        'isi' => 'Mahasiswa UPN Veteran Jawa Timur melaksanakan kegiatan Kuliah Kerja Nyata sebagai bentuk pengabdian kepada masyarakat. Program ini mendorong mahasiswa untuk menerapkan pengetahuan sekaligus membantu mengembangkan potensi masyarakat.',
        'penulis' => 'UPN Veteran Jawa Timur',
    ],

    [
        'id' => 9002,
        'judul' => 'KKNT MBKM UPN Veteran Jawa Timur Perkuat Kontribusi Mahasiswa di Masyarakat',
        'tanggal' => '2026-08-25',
        'image' => '02-kknt-mbkm.jpg.jpeg',
        'kategori' => 'Akademik',
        'isi' => 'Program KKNT MBKM menjadi salah satu bentuk implementasi pembelajaran mahasiswa di luar kampus. Melalui kegiatan ini mahasiswa memperoleh pengalaman sekaligus berkontribusi terhadap kebutuhan masyarakat.',
        'penulis' => 'UPN Veteran Jawa Timur',
    ],

    [
        'id' => 9003,
        'judul' => 'UPN Veteran Jawa Timur Dorong Program KKN Internasional untuk Memperluas Pengabdian',
        'tanggal' => '2026-08-24',
        'image' => '04-kkn-internasional.jpg.jpeg',
        'kategori' => 'Kemahasiswaan',
        'isi' => 'Kegiatan KKN internasional menjadi bagian dari upaya UPN Veteran Jawa Timur dalam memperluas pengalaman mahasiswa dan memperkuat kontribusi perguruan tinggi melalui kegiatan pengabdian di tingkat internasional.',
        'penulis' => 'UPN Veteran Jawa Timur',
    ],

    [
        'id' => 9004,
        'judul' => 'Wisuda UPN Veteran Jawa Timur, Rektor Tekankan Kompetensi dan Integritas Lulusan',
        'tanggal' => '2026-08-23',
        'image' => '05-wisuda-upnvjt.jpg.jpeg',
        'kategori' => 'Akademik',
        'isi' => 'Wisuda menjadi momentum penting bagi UPN Veteran Jawa Timur dalam melepas para lulusan. Para lulusan diharapkan mampu mengembangkan kompetensi, menjaga integritas, serta memberikan kontribusi positif bagi masyarakat dan bangsa.',
        'penulis' => 'UPN Veteran Jawa Timur',
    ],

    [
        'id' => 9005,
        'judul' => 'KKN Tematik UPN Veteran Jawa Timur Hadirkan Program Pengabdian Berkelanjutan',
        'tanggal' => '2026-08-22',
        'image' => '06-kkn-tematik.jpg.jpeg',
        'kategori' => 'Kemahasiswaan',
        'isi' => 'Program KKN Tematik UPN Veteran Jawa Timur mendorong mahasiswa untuk terlibat langsung dalam menyelesaikan berbagai persoalan masyarakat melalui program pengabdian yang terarah dan berkelanjutan.',
        'penulis' => 'UPN Veteran Jawa Timur',
    ],

    [
        'id' => 9006,
        'judul' => 'Rektor UPN Veteran Jawa Timur Dorong Penguatan Pendidikan, Inovasi, dan Pengabdian',
        'tanggal' => '2026-08-21',
        'image' => 'hero-rektor-upnvjt.jpg.png',
        'kategori' => 'Pengumuman',
        'isi' => 'UPN Veteran Jawa Timur terus mendorong penguatan kualitas pendidikan, inovasi, serta pengabdian kepada masyarakat sebagai bagian dari komitmen perguruan tinggi dalam menghasilkan sumber daya manusia yang unggul dan berintegritas.',
        'penulis' => 'UPN Veteran Jawa Timur',
    ],

];

/*
|--------------------------------------------------------------------------
| DETAIL DUMMY
|--------------------------------------------------------------------------
|
| Detail dibuka menggunakan:
|
| /berita/index?view=9001
|
|--------------------------------------------------------------------------
*/

$detailId = (int) Yii::$app->request->get('view', 0);

if ($detailId > 0) {

    $detailNews = null;

    foreach ($dummyNews as $item) {
        if ((int) $item['id'] === $detailId) {
            $detailNews = $item;
            break;
        }
    }

    if ($detailNews !== null) {

        $detailFile = Yii::getAlias(
            '@webroot/uploads/berita/' . basename($detailNews['image'])
        );

        if (is_file($detailFile)) {
            $detailImage = Yii::getAlias(
                '@web/uploads/berita/' . basename($detailNews['image'])
            );
        } else {
            $detailImage = Yii::getAlias(
                '@web/images/upnvjt-building.png'
            );
        }

        $detailDate = date(
            'd F Y',
            strtotime($detailNews['tanggal'])
        );
        ?>

        <div class="jdih-news-page jdih-news-detail-page">

            <section class="jdih-news-detail">

                <div class="jdih-news-detail__container">

                    <?= Html::a(
                        '<i class="bi bi-arrow-left"></i> Kembali ke Berita',
                        ['index'],
                        [
                            'class' => 'jdih-news-detail__back',
                        ]
                    ) ?>

                    <article class="jdih-news-detail__article">

                        <div class="jdih-news-detail__category">
                            <?= Html::encode($detailNews['kategori']) ?>
                        </div>

                        <h1>
                            <?= Html::encode($detailNews['judul']) ?>
                        </h1>

                        <div class="jdih-news-detail__meta">

                            <span>
                                <i class="bi bi-calendar4"></i>
                                <?= Html::encode($detailDate) ?>
                            </span>

                            <span>
                                <i class="bi bi-person"></i>
                                <?= Html::encode($detailNews['penulis']) ?>
                            </span>

                        </div>

                        <img
                            class="jdih-news-detail__image"
                            src="<?= Html::encode($detailImage) ?>"
                            alt="<?= Html::encode($detailNews['judul']) ?>"
                        >

                        <div class="jdih-news-detail__content">

                            <p>
                                <?= Html::encode($detailNews['isi']) ?>
                            </p>

                        </div>

                    </article>

                </div>

            </section>

        </div>

        <style>
            .jdih-news-detail-page {
                width: 100%;
                min-height: 70vh;
                background: #f8f8f4;
            }

            .jdih-news-detail {
                padding: 45px 0 75px;
            }

            .jdih-news-detail__container {
                width: min(100% - 56px, 920px);
                margin: 0 auto;
            }

            .jdih-news-detail__back {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 22px;
                color: #173f35 !important;
                font: 700 13px Arial, sans-serif;
                text-decoration: none !important;
            }

            .jdih-news-detail__article {
                overflow: hidden;
                background: #fff;
                border: 1px solid #dfe4dc;
                border-radius: 12px;
                box-shadow: 0 8px 30px rgba(23, 63, 53, .06);
            }

            .jdih-news-detail__category {
                display: inline-flex;
                margin: 32px 32px 0;
                padding: 7px 11px;
                border-radius: 4px;
                background: #173f35;
                color: #fff;
                font: 800 9px Arial, sans-serif;
                text-transform: uppercase;
            }

            .jdih-news-detail h1 {
                margin: 18px 32px 14px;
                color: #24433a;
                font: 700 clamp(30px, 4vw, 48px)/1.08 Georgia, "Times New Roman", serif;
                letter-spacing: -.02em;
            }

            .jdih-news-detail__meta {
                display: flex;
                flex-wrap: wrap;
                gap: 18px;
                margin: 0 32px 28px;
                color: #68736c;
                font: 12px Arial, sans-serif;
            }

            .jdih-news-detail__meta span {
                display: inline-flex;
                align-items: center;
                gap: 6px;
            }

            .jdih-news-detail__image {
                display: block;
                width: 100%;
                max-height: 560px;
                object-fit: cover;
            }

            .jdih-news-detail__content {
                padding: 30px 32px 40px;
                color: #46534c;
                font: 16px/1.8 Arial, sans-serif;
            }

            .jdih-news-detail__content p {
                max-width: 780px;
                margin: 0 auto;
            }

            @media (max-width: 767px) {

                .jdih-news-detail {
                    padding: 28px 0 50px;
                }

                .jdih-news-detail__container {
                    width: min(100% - 28px, 680px);
                }

                .jdih-news-detail__category {
                    margin: 22px 22px 0;
                }

                .jdih-news-detail h1 {
                    margin-left: 22px;
                    margin-right: 22px;
                    font-size: 30px;
                }

                .jdih-news-detail__meta {
                    margin-left: 22px;
                    margin-right: 22px;
                }

                .jdih-news-detail__content {
                    padding: 24px 22px 32px;
                }
            }
        </style>

        <?php
        return;
    }

    throw new \yii\web\NotFoundHttpException(
        'Berita tidak ditemukan.'
    );
}

/*
|--------------------------------------------------------------------------
| BUAT MODEL DUMMY
|--------------------------------------------------------------------------
*/

$dummyModels = [];

foreach ($dummyNews as $item) {

    $berita = new Berita();

    $berita->id = $item['id'];
    $berita->judul = $item['judul'];
    $berita->tanggal = $item['tanggal'];
    $berita->image = $item['image'];
    $berita->isi = $item['isi'];

    if ($berita->hasAttribute('kategori')) {
        $berita->kategori = $item['kategori'];
    }

    $dummyModels[] = $berita;
}

/*
|--------------------------------------------------------------------------
| FILTER
|--------------------------------------------------------------------------
*/

if ($category !== '') {

    $dummyModels = array_values(
        array_filter(
            $dummyModels,
            static function (Berita $berita) use ($dummyNews, $category): bool {

                foreach ($dummyNews as $item) {

                    if ((int) $item['id'] === (int) $berita->id) {

                        return mb_strtolower(
                            $item['kategori']
                        ) === mb_strtolower($category);
                    }
                }

                return false;
            }
        )
    );
}

/*
|--------------------------------------------------------------------------
| DATA PROVIDER
|--------------------------------------------------------------------------
*/

$dataProvider = new ArrayDataProvider([
    'allModels' => $dummyModels,

    'pagination' => [
        'pageSize' => 5,
        'pageParam' => 'page',
    ],

    'sort' => false,
]);

?>

<div class="jdih-news-page">

    <!-- =====================================================
         HERO / BANNER BERITA
         ====================================================== -->

    <section class="news-hero" aria-label="Berita utama JDIH UPN Veteran Jawa Timur">

        <div class="news-hero__media">
            <img
                class="news-hero__image"
                src="<?= Html::encode(Yii::getAlias('@web/uploads/berita/hero-rektor-upnvjt.jpg.png')) ?>"
                alt="UPN Veteran Jawa Timur"
                width="1600"
                height="520"
                fetchpriority="high"
                decoding="async"
            >
        </div>

        <div class="news-hero__overlay" aria-hidden="true"></div>

        <div class="news-hero__container">

            <div class="news-hero__content">

                <span class="news-hero__label">
                    BERITA UTAMA
                </span>

                <h1 class="news-hero__title">
                    Berita &amp; Informasi JDIH
                </h1>

                <p class="news-hero__excerpt">
                    Informasi dan kegiatan terkini Universitas Pembangunan Nasional
                    &quot;Veteran&quot; Jawa Timur yang terdokumentasi melalui Jaringan
                    Dokumentasi dan Informasi Hukum.
                </p>

                <a
                    href="#news-list"
                    class="news-hero__button"
                >
                    Lihat Berita
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>

            </div>

        </div>

    </section>

    <!-- =====================================================
         FILTER
    ====================================================== -->

    <section
        class="news-filter"
        aria-label="Filter berita"
    >

        <div class="container">

            <div class="news-filter__inner">

                <nav
                    class="news-chips"
                    aria-label="Kategori berita"
                >

                    <?= Html::a(
                        'Semua',
                        ['index'],
                        [
                            'class' => $category === ''
                                ? 'news-chip is-active'
                                : 'news-chip',
                        ]
                    ) ?>

                    <?= Html::a(
                        'Kebijakan',
                        ['index', 'category' => 'Kebijakan'],
                        [
                            'class' => mb_strtolower($category) === 'kebijakan'
                                ? 'news-chip is-active'
                                : 'news-chip',
                        ]
                    ) ?>

                    <?= Html::a(
                        'Akademik',
                        ['index', 'category' => 'Akademik'],
                        [
                            'class' => mb_strtolower($category) === 'akademik'
                                ? 'news-chip is-active'
                                : 'news-chip',
                        ]
                    ) ?>

                    <?= Html::a(
                        'Kemahasiswaan',
                        ['index', 'category' => 'Kemahasiswaan'],
                        [
                            'class' => mb_strtolower($category) === 'kemahasiswaan'
                                ? 'news-chip is-active'
                                : 'news-chip',
                        ]
                    ) ?>

                    <?= Html::a(
                        'Pengumuman',
                        ['index', 'category' => 'Pengumuman'],
                        [
                            'class' => mb_strtolower($category) === 'pengumuman'
                                ? 'news-chip is-active'
                                : 'news-chip',
                        ]
                    ) ?>

                </nav>

                <div
                    class="news-sort"
                    aria-label="Urutan berita"
                >
                    <span>Urutkan:</span>

                    <span class="news-sort__current">
                        Terbaru
                    </span>

                    <i
                        class="bi bi-chevron-down"
                        aria-hidden="true"
                    ></i>
                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         DAFTAR BERITA
    ====================================================== -->

    <section
        id="news-list"
        class="news-grid-section"
        aria-label="Daftar berita"
    >

        <div class="container">

            <?= ListView::widget([

                'dataProvider' => $dataProvider,

                'summary' => false,

                'itemOptions' => [
                    'tag' => false,
                ],

                /*
                 * PENTING:
                 * ListView langsung menghasilkan:
                 *
                 * .news-card-grid
                 *    .news-card
                 *    .news-card
                 *    .news-card
                 *    .news-card
                 *    .news-card
                 */

                'options' => [
                    'tag' => 'div',
                    'class' => 'news-card-grid',
                ],

                'itemView' => '_data',

                'viewParams' => [
                    'currentCategory' => $category,
                ],

                'pager' => [

                    'options' => [
                        'class' => 'pagination news-pagination',
                    ],

                    'linkOptions' => [
                        'class' => 'page-link',
                    ],

                    'pageCssClass' => 'page-item',

                    'activePageCssClass' => 'active',

                    'disabledPageCssClass' => 'disabled',

                    'prevPageLabel' =>
                        '<i class="bi bi-chevron-left" aria-hidden="true"></i>',

                    'nextPageLabel' =>
                        '<i class="bi bi-chevron-right" aria-hidden="true"></i>',

                    'prevPageCssClass' => 'page-item',

                    'nextPageCssClass' => 'page-item',

                    'maxButtonCount' => 5,
                ],

            ]) ?>

        </div>

    </section>

</div>


<style>

/* =========================================================
   ROOT
========================================================= */

.jdih-news-page {
    width: 100%;
    margin: 0;
    padding: 0;
    background: #f8f8f4;
    color: #243d35;
}

.jdih-news-page,
.jdih-news-page *,
.jdih-news-page *::before,
.jdih-news-page *::after {
    box-sizing: border-box;
}


/* =========================================================
   CONTAINER
========================================================= */

.jdih-news-page > .news-filter .container,
.jdih-news-page > .news-grid-section .container {
    width: min(100% - 56px, 1200px);
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 0;
    padding-right: 0;
}


/* =========================================================
   HERO / BANNER BERITA
========================================================= */

.jdih-news-page .news-hero {
    position: relative;
    width: 100%;
    min-height: 390px;
    overflow: hidden;
    background: #173f35;
}

.jdih-news-page .news-hero__media {
    position: absolute;
    inset: 0;
    z-index: 0;
}

.jdih-news-page .news-hero__image {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 390px;
    object-fit: cover;
    object-position: center center;
}

.jdih-news-page .news-hero__overlay {
    position: absolute;
    inset: 0;
    z-index: 1;
    background:
        linear-gradient(90deg,
            rgba(12, 60, 43, .93) 0%,
            rgba(12, 60, 43, .78) 42%,
            rgba(12, 60, 43, .36) 72%,
            rgba(12, 60, 43, .18) 100%
        );
}

.jdih-news-page .news-hero__container {
    position: relative;
    z-index: 2;
    width: min(100% - 56px, 1200px);
    min-height: 390px;
    margin: 0 auto;
    display: flex;
    align-items: center;
}

.jdih-news-page .news-hero__content {
    width: min(620px, 100%);
    padding: 62px 0;
}

.jdih-news-page .news-hero__label {
    display: inline-flex;
    align-items: center;
    min-height: 25px;
    padding: 6px 11px;
    border-radius: 4px;
    background: #f5cf43;
    color: #173f35;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 9px;
    font-weight: 800;
    line-height: 1;
    letter-spacing: .04em;
}

.jdih-news-page .news-hero__title {
    margin: 18px 0 14px;
    color: #fff;
    font-family: Georgia, "Times New Roman", serif;
    font-size: clamp(38px, 5vw, 58px);
    font-weight: 700;
    line-height: 1.04;
    letter-spacing: -.025em;
}

.jdih-news-page .news-hero__excerpt {
    width: min(560px, 100%);
    margin: 0 0 24px;
    color: rgba(255, 255, 255, .84);
    font-family: Arial, Helvetica, sans-serif;
    font-size: 14px;
    line-height: 1.7;
}

.jdih-news-page .news-hero__button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    min-height: 40px;
    padding: 10px 16px;
    border-radius: 6px;
    background: #f5cf43;
    color: #173f35 !important;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: 800;
    text-decoration: none !important;
    transition: transform .2s ease, background .2s ease;
}

.jdih-news-page .news-hero__button:hover {
    background: #e9c137;
    color: #173f35 !important;
    transform: translateY(-1px);
}

@media (max-width: 767px) {
    .jdih-news-page .news-hero,
    .jdih-news-page .news-hero__container,
    .jdih-news-page .news-hero__image {
        min-height: 360px;
    }

    .jdih-news-page .news-hero__container {
        width: min(100% - 28px, 680px);
    }

    .jdih-news-page .news-hero__content {
        padding: 48px 0;
    }

    .jdih-news-page .news-hero__title {
        font-size: 34px;
    }

    .jdih-news-page .news-hero__excerpt {
        font-size: 13px;
    }
}

/* =========================================================
   FILTER
========================================================= */

.jdih-news-page .news-filter {
    position: relative;
    z-index: 5;
    width: 100%;
    margin: 0;
    padding: 0;
    background: #fff;
    border-bottom: 1px solid #e3e7e1;
}

.jdih-news-page .news-filter__inner {
    min-height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
}

.jdih-news-page .news-chips {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    min-width: 0;
}

.jdih-news-page .news-chip {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-height: 34px;

    padding: 8px 17px;

    border: 0;
    border-radius: 999px;

    background: #eef0ec;
    color: #4d554f;

    font-family: Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: 700;
    line-height: 1;

    text-decoration: none !important;
    white-space: nowrap;

    transition:
        background .2s ease,
        color .2s ease,
        transform .2s ease;
}

.jdih-news-page .news-chip:hover {
    background: #dfe5df;
    color: #173f35;
    transform: translateY(-1px);
}

.jdih-news-page .news-chip.is-active {
    background: #173f35;
    color: #fff;
}

.jdih-news-page .news-sort {
    display: flex;
    align-items: center;
    gap: 8px;

    flex: 0 0 auto;

    color: #59625c;

    font-family: Arial, Helvetica, sans-serif;
    font-size: 11px;

    white-space: nowrap;
}

.jdih-news-page .news-sort__current {
    color: #293e37;
    font-weight: 600;
}


/* =========================================================
   NEWS SECTION
========================================================= */

.jdih-news-page .news-grid-section {
    width: 100%;
    margin: 0;
    padding: 46px 0 36px;
    background: #f8f8f4;
}


/* =========================================================
   GRID UTAMA
========================================================= */

.jdih-news-page .news-card-grid {
    display: grid !important;

    width: 100% !important;
    max-width: 100% !important;

    margin: 0 !important;
    padding: 0 !important;

    grid-template-columns:
        repeat(3, minmax(0, 1fr)) !important;

    grid-template-rows:
        auto auto !important;

    grid-auto-flow: row !important;

    column-gap: 16px !important;
    row-gap: 16px !important;

    align-items: stretch !important;
}


/* =========================================================
   SEMUA CARD
========================================================= */

.jdih-news-page .news-card {
    position: relative;

    display: flex;
    flex-direction: column;

    width: 100%;
    min-width: 0;
    min-height: 0;

    overflow: hidden;

    border: 1px solid #dfe4dc;
    border-radius: 8px;

    background: #fff;

    box-shadow:
        0 1px 2px rgba(21, 48, 39, .04);
}


/* =========================================================
   POSISI 1 - 2 - 3
========================================================= */

.jdih-news-page .news-card-grid > .news-card:nth-child(1) {
    grid-column: 1 !important;
    grid-row: 1 !important;
}

.jdih-news-page .news-card-grid > .news-card:nth-child(2) {
    grid-column: 2 !important;
    grid-row: 1 !important;
}

.jdih-news-page .news-card-grid > .news-card:nth-child(3) {
    grid-column: 3 !important;
    grid-row: 1 !important;
}


/* =========================================================
   POSISI 4 = FEATURED
========================================================= */

.jdih-news-page .news-card-grid > .news-card:nth-child(4) {
    grid-column: 1 / span 2 !important;
    grid-row: 2 !important;
}


/* =========================================================
   POSISI 5 = SIDE
========================================================= */

.jdih-news-page .news-card-grid > .news-card:nth-child(5) {
    grid-column: 3 !important;
    grid-row: 2 !important;
}


/* =========================================================
   CLASS FEATURED
========================================================= */

.jdih-news-page .news-card--featured {
    display: grid !important;

    grid-template-columns:
        minmax(0, 1fr)
        minmax(0, 1fr) !important;

    grid-template-rows: 1fr !important;

    min-height: 282px !important;

    grid-column: 1 / span 2 !important;
}

.jdih-news-page .news-card--side {
    grid-column: 3 !important;
}


/* =========================================================
   IMAGE
========================================================= */

.jdih-news-page .news-card__image {
    position: relative;

    width: 100%;
    height: 130px;

    flex: 0 0 130px;

    overflow: hidden;

    background: #dce4dd;
}

.jdih-news-page .news-card__image a {
    display: block;

    width: 100%;
    height: 100%;
}

.jdih-news-page .news-card__image-element {
    display: block !important;

    width: 100% !important;
    height: 100% !important;

    max-width: none !important;

    object-fit: cover !important;
    object-position: center center !important;

    transition: transform .35s ease;
}

.jdih-news-page .news-card:hover
.news-card__image-element {
    transform: scale(1.025);
}


/* =========================================================
   FEATURED IMAGE
========================================================= */

.jdih-news-page .news-card--featured
.news-card__image {
    grid-column: 1;
    grid-row: 1;

    width: 100%;
    height: 100% !important;

    min-height: 282px;

    flex: none;
}

.jdih-news-page .news-card--featured
.news-card__image-element {
    object-position: center center !important;
}


/* =========================================================
   BADGE
========================================================= */

.jdih-news-page .news-card__badge {
    position: absolute;

    top: 10px;
    left: 10px;

    z-index: 5;

    display: inline-flex;
    align-items: center;

    min-height: 22px;
    max-width: calc(100% - 20px);

    padding: 5px 9px;

    overflow: hidden;

    border-radius: 3px;

    background: #173f35;
    color: #fff;

    font-family: Arial, Helvetica, sans-serif;
    font-size: 8px;
    font-weight: 800;
    line-height: 1;

    text-transform: uppercase;
    text-overflow: ellipsis;
    white-space: nowrap;
}


/* =========================================================
   BODY
========================================================= */

.jdih-news-page .news-card__body {
    display: flex;

    flex: 1 1 auto;

    min-width: 0;
    min-height: 0;

    flex-direction: column;

    padding: 14px 14px 13px;

    background: #fff;
}

.jdih-news-page .news-card--featured
.news-card__body {
    grid-column: 2;
    grid-row: 1;

    justify-content: center;

    padding: 30px 26px;

    background: #173f35;
    color: #fff;
}


/* =========================================================
   DATE
========================================================= */

.jdih-news-page .news-card__date {
    display: flex;
    align-items: center;
    gap: 6px;

    margin: 0 0 9px;

    color: #69736d;

    font-family: Arial, Helvetica, sans-serif;
    font-size: 9px;
    line-height: 1.3;
}

.jdih-news-page .news-card__date i {
    font-size: 10px;
}


/* =========================================================
   TITLE
========================================================= */

.jdih-news-page .news-card__title {
    margin: 0;
    padding: 0;

    font-family:
        Georgia,
        "Times New Roman",
        serif;

    font-size: 17px;
    font-weight: 700;
    line-height: 1.18;

    letter-spacing: -.01em;
}

.jdih-news-page .news-card__title a {
    color: #24433a !important;

    text-decoration: none !important;
}

.jdih-news-page .news-card__title a:hover {
    color: #173f35 !important;
}


/* =========================================================
   FEATURED TITLE
========================================================= */

.jdih-news-page .news-card--featured
.news-card__title {
    font-size: 23px;
    line-height: 1.13;
}

.jdih-news-page .news-card--featured
.news-card__title a {
    color: #fff !important;
}


/* =========================================================
   EXCERPT
========================================================= */

.jdih-news-page .news-card__excerpt {
    display: -webkit-box;

    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;

    overflow: hidden;

    margin: 10px 0 12px;

    color: #6b726d;

    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    line-height: 1.55;
}

.jdih-news-page .news-card--featured
.news-card__excerpt {
    -webkit-line-clamp: 4;

    margin-top: 14px;

    color: rgba(255,255,255,.78);

    font-size: 11px;
    line-height: 1.6;
}


/* =========================================================
   FOOT CARD
========================================================= */

.jdih-news-page .news-card__foot {
    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 10px;

    width: 100%;

    margin-top: auto;
    padding-top: 9px;

    border-top: 1px solid #edf0ec;
}

.jdih-news-page .news-card__author {
    display: inline-flex;
    align-items: center;

    min-width: 0;

    gap: 6px;

    color: #424b46;

    font-family: Arial, Helvetica, sans-serif;
    font-size: 8px;
    font-weight: 600;
    line-height: 1.3;
}

.jdih-news-page .news-card__author i {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    width: 21px;
    height: 21px;

    flex: 0 0 21px;

    border-radius: 50%;

    background: #e8eeea;
    color: #4c635a;

    font-size: 10px;
}

.jdih-news-page .news-card__detail {
    display: inline-flex;
    align-items: center;

    flex: 0 0 auto;

    gap: 3px;

    color: #173f35 !important;

    font-family: Arial, Helvetica, sans-serif;
    font-size: 9px;
    font-weight: 800;

    text-decoration: none !important;

    white-space: nowrap;
}

.jdih-news-page .news-card__detail:hover {
    color: #b18b00 !important;
}


/* =========================================================
   FEATURED FOOT
========================================================= */

.jdih-news-page .news-card--featured
.news-card__foot {
    border-top-color: rgba(255,255,255,.14);
}

.jdih-news-page .news-card--featured
.news-card__author,
.jdih-news-page .news-card--featured
.news-card__detail {
    color: rgba(255,255,255,.86) !important;
}

.jdih-news-page .news-card--featured
.news-card__author i {
    background: rgba(255,255,255,.14);
    color: #fff;
}


/* =========================================================
   PAGINATION
========================================================= */

.jdih-news-page .news-pagination {
    display: flex !important;

    align-items: center !important;
    justify-content: center !important;

    gap: 7px !important;

    width: 100%;

    margin: 18px 0 0 !important;
    padding: 0;

    list-style: none;
}

.jdih-news-page .news-pagination .page-item {
    margin: 0 !important;
    padding: 0 !important;

    list-style: none !important;
}

.jdih-news-page .news-pagination .page-link {
    display: inline-flex !important;

    align-items: center !important;
    justify-content: center !important;

    width: 34px;
    height: 34px;

    padding: 0 !important;

    border: 1px solid #d8ded8 !important;
    border-radius: 50% !important;

    background: #fff !important;
    color: #34463d !important;

    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;

    text-decoration: none !important;

    box-shadow: none !important;
}

.jdih-news-page .news-pagination
.page-item.active .page-link {
    border-color: #173f35 !important;

    background: #173f35 !important;

    color: #fff !important;
}

.jdih-news-page .news-pagination
.page-item.disabled .page-link {
    opacity: .45;
    pointer-events: none;
}

.jdih-news-page .news-pagination
.page-link:hover {
    border-color: #173f35 !important;
    color: #173f35 !important;
}

.jdih-news-page .news-pagination
.page-item.active .page-link:hover {
    color: #fff !important;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .jdih-news-page
    > .news-filter .container,
    .jdih-news-page
    > .news-grid-section .container {
        width: min(100% - 40px, 900px);
    }

    .jdih-news-page .news-card-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr)) !important;

        grid-template-rows: auto !important;
    }

    .jdih-news-page .news-card-grid
    > .news-card:nth-child(1) {
        grid-column: 1 !important;
        grid-row: auto !important;
    }

    .jdih-news-page .news-card-grid
    > .news-card:nth-child(2) {
        grid-column: 2 !important;
        grid-row: auto !important;
    }

    .jdih-news-page .news-card-grid
    > .news-card:nth-child(3) {
        grid-column: 1 !important;
        grid-row: auto !important;
    }

    .jdih-news-page .news-card-grid
    > .news-card:nth-child(4) {
        grid-column: 1 / span 2 !important;
        grid-row: auto !important;
    }

    .jdih-news-page .news-card-grid
    > .news-card:nth-child(5) {
        grid-column: 2 !important;
        grid-row: auto !important;
    }

    .jdih-news-page .news-card--featured {
        grid-column: 1 / span 2 !important;
    }

    .jdih-news-page .news-card--side {
        grid-column: 2 !important;
    }
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767px) {

    .jdih-news-page
    > .news-filter .container,
    .jdih-news-page
    > .news-grid-section .container {
        width: min(100% - 28px, 680px);
    }

    .jdih-news-page .news-filter__inner {
        align-items: flex-start;

        flex-direction: column;

        gap: 12px;

        padding: 12px 0;
    }

    .jdih-news-page .news-chips {
        width: 100%;
    }

    .jdih-news-page .news-sort {
        width: 100%;
    }

    .jdih-news-page .news-grid-section {
        padding-top: 24px;
        padding-bottom: 28px;
    }

    .jdih-news-page .news-card-grid {
        grid-template-columns: 1fr !important;
        gap: 14px !important;
    }

    .jdih-news-page .news-card-grid
    > .news-card:nth-child(1),
    .jdih-news-page .news-card-grid
    > .news-card:nth-child(2),
    .jdih-news-page .news-card-grid
    > .news-card:nth-child(3),
    .jdih-news-page .news-card-grid
    > .news-card:nth-child(4),
    .jdih-news-page .news-card-grid
    > .news-card:nth-child(5) {
        grid-column: 1 !important;
        grid-row: auto !important;
    }

    .jdih-news-page .news-card--featured,
    .jdih-news-page .news-card--side {
        grid-column: 1 !important;
    }

    .jdih-news-page .news-card--featured {
        display: flex !important;
        min-height: 0 !important;
    }

    .jdih-news-page .news-card--featured
    .news-card__image {
        height: 190px !important;
        min-height: 190px !important;
    }

    .jdih-news-page .news-card--featured
    .news-card__body {
        padding: 20px;
    }

    .jdih-news-page .news-card--featured
    .news-card__title {
        font-size: 21px;
    }
}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .jdih-news-page
    > .news-filter .container,
    .jdih-news-page
    > .news-grid-section .container {
        width: min(100% - 22px, 460px);
    }

    .jdih-news-page .news-chip {
        min-height: 32px;
        padding: 7px 12px;
        font-size: 10px;
    }

    .jdih-news-page .news-card__image {
        height: 150px;
        flex-basis: 150px;
    }

    .jdih-news-page .news-card__body {
        padding: 13px;
    }

    .jdih-news-page .news-card__title {
        font-size: 16px;
    }

    .jdih-news-page .news-card--featured
    .news-card__title {
        font-size: 20px;
    }

    .jdih-news-page .news-card--featured
    .news-card__image {
        height: 170px !important;
        min-height: 170px !important;
    }
}

/* =========================================================
   FINAL JDIH NEWS LAYOUT
   LOCKED VISUAL STRUCTURE
========================================================= */

.jdih-news-page .news-card-grid {
    display: grid !important;

    grid-template-columns:
        repeat(3, minmax(0, 1fr)) !important;

    grid-auto-flow: row !important;

    gap: 16px !important;

    width: 100% !important;

    margin: 0 !important;

    padding: 0 !important;
}


/* =========================================================
   CARD DEFAULT
========================================================= */

.jdih-news-page .news-card {
    min-width: 0 !important;

    width: 100% !important;

    overflow: hidden !important;

    border-radius: 8px !important;

    border: 1px solid #dfe4dc !important;

    background: #fff !important;
}


/* =========================================================
   CARD 1
========================================================= */

.jdih-news-page
.news-card-grid
.news-card[data-news-id="9001"] {

    grid-column: 1 !important;

    grid-row: 1 !important;

}


/* =========================================================
   CARD 2
========================================================= */

.jdih-news-page
.news-card-grid
.news-card[data-news-id="9002"] {

    grid-column: 2 !important;

    grid-row: 1 !important;

}


/* =========================================================
   CARD 3
========================================================= */

.jdih-news-page
.news-card-grid
.news-card[data-news-id="9003"] {

    grid-column: 3 !important;

    grid-row: 1 !important;

}


/* =========================================================
   CARD 4
   FEATURED
   2 KOLOM
========================================================= */

.jdih-news-page
.news-card-grid
.news-card[data-news-id="9004"] {

    grid-column: 1 / span 2 !important;

    grid-row: 2 !important;

    display: grid !important;

    grid-template-columns:
        1fr 1fr !important;

    grid-template-rows:
        1fr !important;

    min-height: 282px !important;

}


/* =========================================================
   CARD 5
   KANAN
========================================================= */

.jdih-news-page
.news-card-grid
.news-card[data-news-id="9005"] {

    grid-column: 3 !important;

    grid-row: 2 !important;

}


/* =========================================================
   NORMAL IMAGE
========================================================= */

.jdih-news-page
.news-card:not(.news-card--featured)
.news-card__image {

    width: 100% !important;

    height: 130px !important;

    min-height: 130px !important;

    overflow: hidden !important;

}


/* =========================================================
   FEATURED IMAGE
========================================================= */

.jdih-news-page
.news-card[data-news-id="9004"]
.news-card__image {

    grid-column: 1 !important;

    grid-row: 1 !important;

    width: 100% !important;

    height: 100% !important;

    min-height: 282px !important;

}


/* =========================================================
   FEATURED BODY
========================================================= */

.jdih-news-page
.news-card[data-news-id="9004"]
.news-card__body {

    grid-column: 2 !important;

    grid-row: 1 !important;

    display: flex !important;

    flex-direction: column !important;

    justify-content: center !important;

    padding: 30px 26px !important;

    background: #173f35 !important;

    color: #fff !important;

}


/* =========================================================
   FEATURED TITLE
========================================================= */

.jdih-news-page
.news-card[data-news-id="9004"]
.news-card__title {

    font-size: 23px !important;

    line-height: 1.13 !important;

}


.jdih-news-page
.news-card[data-news-id="9004"]
.news-card__title a {

    color: #fff !important;

}


/* =========================================================
   FEATURED DATE
========================================================= */

.jdih-news-page
.news-card[data-news-id="9004"]
.news-card__date {

    color: rgba(255,255,255,.72) !important;

}


/* =========================================================
   FEATURED EXCERPT
========================================================= */

.jdih-news-page
.news-card[data-news-id="9004"]
.news-card__excerpt {

    color: rgba(255,255,255,.78) !important;

}


/* =========================================================
   FEATURED FOOT
========================================================= */

.jdih-news-page
.news-card[data-news-id="9004"]
.news-card__foot {

    border-top-color:
        rgba(255,255,255,.14) !important;

}


.jdih-news-page
.news-card[data-news-id="9004"]
.news-card__author,

.jdih-news-page
.news-card[data-news-id="9004"]
.news-card__detail {

    color:
        rgba(255,255,255,.9) !important;

}


/* =========================================================
   ALL CARD IMAGES
========================================================= */

.jdih-news-page
.news-card__image-element {

    display: block !important;

    width: 100% !important;

    height: 100% !important;

    max-width: none !important;

    object-fit: cover !important;

    object-position: center center !important;

}


/* =========================================================
   CARD 5 IMAGE
========================================================= */

.jdih-news-page
.news-card[data-news-id="9005"]
.news-card__image {

    height: 130px !important;

    min-height: 130px !important;

}


/* =========================================================
   DESKTOP HEIGHT
========================================================= */

@media (min-width: 992px) {

    .jdih-news-page
    .news-card-grid {

        grid-template-rows:
            auto 282px !important;

    }

}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .jdih-news-page
    .news-card-grid {

        grid-template-columns:
            repeat(2, minmax(0, 1fr)) !important;

        grid-template-rows:
            auto !important;

    }


    .jdih-news-page
    .news-card[data-news-id="9001"] {

        grid-column: 1 !important;

        grid-row: auto !important;

    }


    .jdih-news-page
    .news-card[data-news-id="9002"] {

        grid-column: 2 !important;

        grid-row: auto !important;

    }


    .jdih-news-page
    .news-card[data-news-id="9003"] {

        grid-column: 1 !important;

        grid-row: auto !important;

    }


    .jdih-news-page
    .news-card[data-news-id="9004"] {

        grid-column: 1 / span 2 !important;

        grid-row: auto !important;

    }


    .jdih-news-page
    .news-card[data-news-id="9005"] {

        grid-column: 2 !important;

        grid-row: auto !important;

    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767px) {

    .jdih-news-page
    .news-card-grid {

        grid-template-columns:
            1fr !important;

        gap: 14px !important;

    }


    .jdih-news-page
    .news-card[data-news-id="9001"],
    .jdih-news-page
    .news-card[data-news-id="9002"],
    .jdih-news-page
    .news-card[data-news-id="9003"],
    .jdih-news-page
    .news-card[data-news-id="9004"],
    .jdih-news-page
    .news-card[data-news-id="9005"] {

        grid-column: 1 !important;

        grid-row: auto !important;

    }


    .jdih-news-page
    .news-card[data-news-id="9004"] {

        display: flex !important;

        flex-direction: column !important;

        min-height: 0 !important;

    }


    .jdih-news-page
    .news-card[data-news-id="9004"]
    .news-card__image {

        width: 100% !important;

        height: 190px !important;

        min-height: 190px !important;

    }


    .jdih-news-page
    .news-card[data-news-id="9004"]
    .news-card__body {

        padding: 20px !important;

    }

}

</style>