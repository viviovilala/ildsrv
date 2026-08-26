<?php

use common\components\LazyImage;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Berita */
/* @var $model2 frontend\models\search\BeritaSearch */

$this->title = $model->judul;

/*
 * =========================================================
 * SEO
 * =========================================================
 */

$currentUrl = Url::current([], true);

$desc = !empty($model->isi)
    ? trim(strip_tags($model->isi))
    : $model->judul;

$desc = mb_strimwidth($desc, 0, 160, '...');

$this->registerMetaTag([
    'name' => 'description',
    'content' => $desc,
]);

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $this->title,
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $desc,
]);

$this->registerMetaTag([
    'property' => 'og:type',
    'content' => 'article',
]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => $currentUrl,
]);

$this->registerMetaTag([
    'name' => 'twitter:card',
    'content' => 'summary_large_image',
]);

$this->registerMetaTag([
    'name' => 'twitter:title',
    'content' => $this->title,
]);

$this->registerMetaTag([
    'name' => 'twitter:description',
    'content' => $desc,
]);


/*
 * =========================================================
 * GAMBAR BERITA
 * =========================================================
 *
 * Semua gambar berita baru berada di:
 *
 * frontend/web/uploads/berita/
 *
 * Jika field image hanya menyimpan nama file:
 *
 * 01-spotlight-umkm.jpg
 * 02-magang-fh-jakbar.jpg
 * 03-kkn-2026.jpg
 * 04-wisuda-ke-97.jpg
 * 05-abdimas-kedai-jerman.jpg
 *
 */

$newsImage = null;

if (!empty($model->image)) {

    /*
     * Jika database sudah menyimpan path uploads/berita/
     */
    if (
        strpos($model->image, 'uploads/berita/') === 0
        || strpos($model->image, '/uploads/berita/') === 0
    ) {
        $newsImage = '/' . ltrim($model->image, '/');
    } else {

        /*
         * Normalisasi agar database cukup menyimpan
         * nama file saja.
         */
        $newsImage = Url::to(
            '@web/uploads/berita/' . basename($model->image)
        );
    }
}


/*
 * =========================================================
 * BREADCRUMB
 * =========================================================
 */

$this->params['breadcrumbs'][] = [
    'label' => 'Berita',
    'url' => ['index'],
];

$this->params['breadcrumbs'][] = Html::encode($this->title);

?>

<div class="berita-view">

    <div class="container">

        <!-- =================================================
             BREADCRUMB
        ================================================== -->

        <nav
            class="berita-view__breadcrumb"
            aria-label="Breadcrumb"
        >

            <?= Html::a(
                'Berita',
                ['index'],
                [
                    'class' => 'berita-view__breadcrumb-link',
                ]
            ) ?>

            <i
                class="bi bi-chevron-right"
                aria-hidden="true"
            ></i>

            <span>
                <?= Html::encode($model->judul) ?>
            </span>

        </nav>


        <!-- =================================================
             LAYOUT
        ================================================== -->

        <div class="berita-view__layout">

            <!-- =============================================
                 ARTIKEL
            ============================================== -->

            <main class="berita-view__main">

                <article class="berita-article">

                    <?php if ($newsImage): ?>

                        <div class="berita-article__hero">

                            <?= LazyImage::img(
                                $newsImage,
                                [
                                    'class' => 'berita-article__hero-image',
                                    'alt' => $model->judul,
                                ],
                                false
                            ) ?>

                        </div>

                    <?php endif; ?>


                    <div class="berita-article__body">

                        <!-- CATEGORY -->

                        <div class="berita-article__meta">

                            <span class="berita-article__category">
                                BERITA UPNVJT
                            </span>

                            <?php if (!empty($model->tanggal)): ?>

                                <time
                                    class="berita-article__date"
                                    datetime="<?= Html::encode($model->tanggal) ?>"
                                >
                                    <i
                                        class="bi bi-calendar3"
                                        aria-hidden="true"
                                    ></i>

                                    <?= \common\components\DateHelper::formatIndonesian(
                                        $model->tanggal
                                    ) ?>

                                </time>

                            <?php endif; ?>

                        </div>


                        <!-- TITLE -->

                        <h1 class="berita-article__title">

                            <?= Html::encode($model->judul) ?>

                        </h1>


                        <!-- CONTENT -->

                        <div class="berita-article__content">

                            <?= $model->isi ?>

                        </div>


                        <!-- FOOTER -->

                        <div class="berita-article__footer">

                            <?= Html::a(
                                '<i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke daftar berita',
                                ['index'],
                                [
                                    'class' => 'berita-article__back',
                                ]
                            ) ?>

                        </div>

                    </div>

                </article>

            </main>


            <!-- =============================================
                 SIDEBAR
            ============================================== -->

            <aside class="berita-view__sidebar">

                <?= $this->render(
                    '_sidebar',
                    [
                        'searchModel' => $model2,
                    ]
                ) ?>

            </aside>

        </div>

    </div>

</div>


<?= $this->render('_berita-shared-styles') ?>


<style>

/* =========================================================
   DETAIL BERITA
========================================================= */

.berita-view {
    background: #f7f8f5;
    min-height: 100vh;
    padding: 42px 0 80px;
}

.berita-view .container {
    width: min(100% - 40px, 1240px);
    margin: 0 auto;
}


/* =========================================================
   BREADCRUMB
========================================================= */

.berita-view__breadcrumb {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 28px;

    font-size: 14px;
    line-height: 1.5;
    color: #7a8179;
}

.berita-view__breadcrumb-link {
    color: #21451a;
    font-weight: 600;
    text-decoration: none;
}

.berita-view__breadcrumb-link:hover {
    color: #173511;
    text-decoration: underline;
}

.berita-view__breadcrumb i {
    font-size: 11px;
    color: #a4aaa1;
}


/* =========================================================
   MAIN LAYOUT
========================================================= */

.berita-view__layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 320px;
    gap: 32px;
    align-items: start;
}


/* =========================================================
   ARTICLE
========================================================= */

.berita-article {
    background: #ffffff;
    border: 1px solid #e3e8df;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(26, 49, 24, 0.06);
}

.berita-article__hero {
    width: 100%;
    aspect-ratio: 16 / 8.5;
    min-height: 320px;
    overflow: hidden;
    background: #e8ece6;
}

.berita-article__hero-image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}


.berita-article__body {
    padding: 34px 38px 32px;
}


/* =========================================================
   META
========================================================= */

.berita-article__meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
    margin-bottom: 18px;
}

.berita-article__category {
    display: inline-flex;
    align-items: center;

    padding: 6px 12px;

    border-radius: 999px;

    background: #edf4e9;
    color: #21451a;

    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.08em;
}

.berita-article__date {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    color: #788178;

    font-size: 14px;
}

.berita-article__date i {
    color: #c49b27;
}


/* =========================================================
   TITLE
========================================================= */

.berita-article__title {
    max-width: 900px;

    margin: 0 0 26px;

    color: #173511;

    font-family:
        Georgia,
        "Times New Roman",
        serif;

    font-size: clamp(30px, 3.2vw, 46px);
    font-weight: 700;
    line-height: 1.16;
    letter-spacing: -0.025em;

    overflow-wrap: anywhere;
}


/* =========================================================
   CONTENT
========================================================= */

.berita-article__content {
    max-width: 850px;

    color: #3d463d;

    font-size: 16px;
    line-height: 1.8;
}

.berita-article__content p {
    margin: 0 0 20px;
}

.berita-article__content p:last-child {
    margin-bottom: 0;
}

.berita-article__content h2,
.berita-article__content h3 {
    margin-top: 32px;
    margin-bottom: 14px;

    color: #21451a;

    font-family:
        Georgia,
        "Times New Roman",
        serif;

    line-height: 1.3;
}

.berita-article__content img {
    display: block;
    max-width: 100%;
    height: auto;

    margin: 24px auto;

    border-radius: 10px;
}

.berita-article__content a {
    color: #21451a;
    font-weight: 600;
}

.berita-article__content a:hover {
    color: #b38b1e;
}


/* =========================================================
   ARTICLE FOOTER
========================================================= */

.berita-article__footer {
    margin-top: 34px;
    padding-top: 22px;

    border-top: 1px solid #e5e9e2;
}

.berita-article__back {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    color: #21451a;

    font-size: 14px;
    font-weight: 700;

    text-decoration: none;
}

.berita-article__back:hover {
    color: #b38b1e;
}


/* =========================================================
   SIDEBAR
========================================================= */

.berita-view__sidebar {
    min-width: 0;
}

.berita-view__sidebar .berita-sidebar {
    position: sticky;
    top: 110px;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .berita-view {
        padding-top: 32px;
    }

    .berita-view__layout {
        grid-template-columns: 1fr;
        gap: 28px;
    }

    .berita-view__sidebar {
        order: 2;
    }

    .berita-view__sidebar .berita-sidebar {
        position: static;
    }

    .berita-article__hero {
        min-height: 280px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767px) {

    .berita-view {
        padding: 24px 0 56px;
    }

    .berita-view .container {
        width: min(100% - 28px, 1240px);
    }

    .berita-view__breadcrumb {
        margin-bottom: 20px;
        font-size: 13px;
    }

    .berita-article {
        border-radius: 12px;
    }

    .berita-article__hero {
        aspect-ratio: 16 / 10;
        min-height: 0;
    }

    .berita-article__body {
        padding: 24px 20px;
    }

    .berita-article__title {
        font-size: clamp(28px, 8vw, 34px);
        line-height: 1.18;
        margin-bottom: 22px;
    }

    .berita-article__content {
        font-size: 15px;
        line-height: 1.75;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .berita-view .container {
        width: min(100% - 20px, 1240px);
    }

    .berita-article__body {
        padding: 20px 16px;
    }

    .berita-article__meta {
        gap: 9px;
    }

    .berita-article__title {
        font-size: 27px;
    }

    .berita-article__content {
        font-size: 15px;
    }

}

</style>