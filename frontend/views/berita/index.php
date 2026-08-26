<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Berita & Informasi';

$category = Yii::$app->request->get('category');

/*
 * =========================================================
 * BERITA UTAMA / HERO
 * =========================================================
 *
 * Gambar:
 * frontend/web/uploads/berita/03-kkn-2026.jpg
 *
 * Jadi file gambar:
 *
 * C:\laragon\www\ildis\frontend\web\uploads\berita\03-kkn-2026.jpg
 */
$featuredImage = Url::to('@web/uploads/berita/03-kkn-2026.jpg');

$featuredTitle = 'UPN Veteran Jatim Berangkatkan Ribuan Mahasiswa KKN 2026, Sasaran Program Pengabdian Domestik Hingga Mancanegara';

$featuredExcerpt = 'UPN Veteran Jatim memberangkatkan ribuan mahasiswa dalam pelaksanaan KKN 2026 dengan sasaran program pengabdian di dalam negeri hingga mancanegara.';

$featuredUrl = ['index'];


/*
 * =========================================================
 * DATA BERITA
 * =========================================================
 *
 * Data utama tetap berasal dari database melalui $dataProvider.
 *
 * Data berikut menjadi informasi referensi untuk memastikan
 * judul dan nama gambar yang digunakan sesuai.
 */
$newsReference = [
    [
        'title' => 'Mahasiswa KKN 21 UPN Veteran Jawa Timur Dorong Pengembangan UMKM Kelurahan Ledok Wetan Bojonegoro Melalui Program Spotlight UMKM',
        'year' => '2026',
        'category' => 'Kemahasiswaan',
        'image' => '01-spotlight-umkm.jpg',
        'slug' => 'mahasiswa-kkn-21-upnvjt-spotlight-umkm-ledok-wetan',
    ],
    [
        'title' => 'Pelaksanaan Program Magang UPN Veteran Jawa Timur Fakultas Hukum di Pengadilan Negeri Jakarta Barat Kelas 1A Khusus',
        'year' => '2024',
        'category' => 'Akademik',
        'image' => '02-magang-fh-jakbar.jpg',
        'slug' => 'program-magang-fh-upnvjt-pengadilan-negeri-jakbar',
    ],
    [
        'title' => 'UPN Veteran Jatim Berangkatkan Ribuan Mahasiswa KKN 2026, Sasaran Program Pengabdian Domestik Hingga Mancanegara',
        'year' => '2026',
        'category' => 'Kemahasiswaan',
        'image' => '03-kkn-2026.jpg',
        'slug' => 'kkn-upnvjt-2026-domestik-mancanegara',
    ],
    [
        'title' => 'Wisuda ke-97 UPN Veteran Jatim, Rektor Tegaskan Lulusan Harus Berkompetensi dan Berintegritas',
        'year' => '2026',
        'category' => 'Akademik',
        'image' => '04-wisuda-ke-97.jpg',
        'slug' => 'wisuda-ke-97-upnvjt-2026',
    ],
    [
        'title' => 'Tim Abdimas UPN Veteran Jatim Dampingi Proses Digitalisasi Manajemen Produksi Halal di UMKM Kedai Jerman',
        'year' => '2026',
        'category' => 'Akademik',
        'image' => '05-abdimas-kedai-jerman.jpg',
        'slug' => 'abdimas-upnvjt-digitalisasi-produksi-halal-kedai-jerman',
    ],
];

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
                'alt' => $featuredTitle,
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
                <?= Html::encode($featuredTitle) ?>
            </h1>

            <p class="news-hero__excerpt">
                <?= Html::encode($featuredExcerpt) ?>
            </p>

            <?= Html::a(
                'Lihat Berita <i class="bi bi-arrow-right" aria-hidden="true"></i>',
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

                <span>Urutkan:</span>

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
     BERITA REFERENSI
========================================================= -->

<section class="news-reference-section">

    <div class="container">

        <div class="news-reference-grid">

            <?php foreach ($newsReference as $news): ?>

                <?php
                $imageUrl = Url::to(
                    '@web/uploads/berita/' . $news['image']
                );
                ?>

                <article class="news-reference-card">

                    <div class="news-reference-card__image">

                        <?= Html::img(
                            $imageUrl,
                            [
                                'alt' => $news['title'],
                                'loading' => 'lazy',
                            ]
                        ) ?>

                    </div>

                    <div class="news-reference-card__body">

                        <div class="news-reference-card__meta">

                            <span class="news-reference-card__category">
                                <?= Html::encode($news['category']) ?>
                            </span>

                            <span class="news-reference-card__year">
                                <?= Html::encode($news['year']) ?>
                            </span>

                        </div>

                        <h2 class="news-reference-card__title">
                            <?= Html::encode($news['title']) ?>
                        </h2>

                        <?= Html::a(
                            'Baca Selengkapnya <i class="bi bi-arrow-right"></i>',
                            [
                                'view',
                                'slug' => $news['slug'],
                            ],
                            [
                                'class' => 'news-reference-card__link',
                            ]
                        ) ?>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<!-- =========================================================
     DAFTAR BERITA DARI DATABASE
========================================================= -->

<section
    id="news-list"
    class="news-grid-section jdih-section"
>

    <div class="container">

        <?= ListView::widget([

            'dataProvider' => $dataProvider,

            'summary' => false,

            'itemOptions' => [
                'tag' => false,
            ],

            'options' => [
                'class' => 'news-card-grid',
            ],

            'itemView' => '_data',

            'viewParams' => [
                'currentCategory' => $category,
            ],

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