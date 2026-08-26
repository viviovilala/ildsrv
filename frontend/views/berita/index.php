<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Berita & Informasi';

$category = Yii::$app->request->get('category');

/*
 * =========================================================
 * HERO BERITA
 * =========================================================
 *
 * File:
 * frontend/web/uploads/berita/hero-rektor-upnvjt.jpg
 *
 * Hero menggunakan gambar khusus, bukan gambar kartu berita.
 */
$featuredImage = Url::to(
    '@web/uploads/berita/hero-rektor-upnvjt.jpg'
);

$featuredTitle = 'Reformasi Regulasi Kampus untuk Digitalisasi Berkelanjutan';

$featuredExcerpt = 'Langkah strategis UPN Veteran Jawa Timur dalam menyinkronkan kebijakan internal dengan standar tata kelola universitas kelas dunia.';

?>

<!-- =========================================================
     HERO BERITA
========================================================= -->

<section class="news-hero">

    <div class="news-hero__media">

        <?= Html::img(
            $featuredImage,
            [
                'class' => 'news-hero__image',
                'alt' => 'UPN Veteran Jawa Timur',
            ]
        ) ?>

    </div>

    <div class="news-hero__overlay"></div>

    <div class="container">

        <div class="news-hero__content">

            <span class="news-hero__label">
                BERITA UTAMA
            </span>

            <h1 class="news-hero__title">
                Reformasi Regulasi
                <br>
                Kampus untuk
                <br>
                Digitalisasi
                <br>
                Berkelanjutan
            </h1>

            <p class="news-hero__excerpt">
                <?= Html::encode($featuredExcerpt) ?>
            </p>

            <?= Html::a(
                'Baca Selengkapnya <i class="bi bi-arrow-right" aria-hidden="true"></i>',
                '#news-list',
                [
                    'class' => 'news-hero__button',
                ]
            ) ?>

        </div>

    </div>

</section>


<!-- =========================================================
     FILTER KATEGORI
========================================================= -->

<section class="news-filter">

    <div class="container">

        <div class="news-filter__inner">

            <div class="news-chips">

                <?= Html::a(
                    'Semua',
                    ['index'],
                    [
                        'class' => empty($category)
                            ? 'news-chip is-active'
                            : 'news-chip',
                    ]
                ) ?>

                <?= Html::a(
                    'Kebijakan',
                    ['index', 'category' => 'Kebijakan'],
                    [
                        'class' => $category === 'Kebijakan'
                            ? 'news-chip is-active'
                            : 'news-chip',
                    ]
                ) ?>

                <?= Html::a(
                    'Akademik',
                    ['index', 'category' => 'Akademik'],
                    [
                        'class' => $category === 'Akademik'
                            ? 'news-chip is-active'
                            : 'news-chip',
                    ]
                ) ?>

                <?= Html::a(
                    'Kemahasiswaan',
                    ['index', 'category' => 'Kemahasiswaan'],
                    [
                        'class' => $category === 'Kemahasiswaan'
                            ? 'news-chip is-active'
                            : 'news-chip',
                    ]
                ) ?>

                <?= Html::a(
                    'Pengumuman',
                    ['index', 'category' => 'Pengumuman'],
                    [
                        'class' => $category === 'Pengumuman'
                            ? 'news-chip is-active'
                            : 'news-chip',
                    ]
                ) ?>

            </div>


            <div class="news-sort">

                <span>
                    Urutkan:
                </span>

                <?= Html::a(
                    'Terbaru',
                    [
                        'index',
                        'category' => $category,
                    ],
                    [
                        'class' => 'news-sort__link',
                    ]
                ) ?>

                <i
                    class="bi bi-chevron-down"
                    aria-hidden="true"
                ></i>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     DAFTAR BERITA
========================================================= -->

<section
    id="news-list"
    class="news-grid-section jdih-section"
>

    <div class="container">

        <?= ListView::widget([

            /*
             * Data berita tetap berasal dari database.
             */
            'dataProvider' => $dataProvider,

            /*
             * Hilangkan:
             * Showing 1-5 of ...
             */
            'summary' => false,

            /*
             * Tidak membuat wrapper tambahan
             * untuk setiap berita.
             */
            'itemOptions' => [
                'tag' => false,
            ],

            /*
             * Container utama kartu berita.
             *
             * CSS akan mengatur:
             *
             * BARIS 1
             * [ berita 1 ] [ berita 2 ] [ berita 3 ]
             *
             * BARIS 2
             * [       berita 4 besar       ] [ berita 5 ]
             */
            'options' => [
                'class' => 'news-card-grid',
            ],

            /*
             * Template kartu berita.
             */
            'itemView' => '_data',

            /*
             * Kategori yang sedang aktif.
             */
            'viewParams' => [
                'currentCategory' => $category,
            ],

            /*
             * Pagination.
             */
            'pager' => [

                'options' => [
                    'class' => 'pagination justify-content-center',
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