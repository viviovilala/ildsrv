<?php

use yii\helpers\Html;
use yii\helpers\Url;


/*
|--------------------------------------------------------------------------
| DATA BERITA
|--------------------------------------------------------------------------
*/

$judul = trim((string) $model->judul);
$newsId = (int) $model->id;


/*
|--------------------------------------------------------------------------
| INDEX KARTU
|--------------------------------------------------------------------------
|
| ListView Yii mengirimkan $index dengan urutan:
|
| 0 = berita 1
| 1 = berita 2
| 2 = berita 3
| 3 = berita 4 / FEATURED
| 4 = berita 5 / SIDE
| 5 = berita 6
|
| Untuk dummy, GAMBAR mengikuti urutan kartu.
| Ini sengaja tidak menggunakan ID database karena ID
| dapat berbeda dengan urutan dummy.
|--------------------------------------------------------------------------
*/

$cardIndex = isset($index)
    ? (int) $index
    : 0;


/*
|--------------------------------------------------------------------------
| PEMETAAN GAMBAR BERDASARKAN URUTAN KARTU
|--------------------------------------------------------------------------
|
| File AKTUAL di dalam Docker:
|
| /var/www/frontend/web/uploads/berita/
|
|--------------------------------------------------------------------------
*/

$newsImagesByIndex = [

    0 => '01-kkn-upnvjt.jpg.jpeg',

    1 => '02-kknt-mbkm.jpg.jpeg',

    2 => '04-kkn-internasional.jpg.jpeg',

    3 => '05-wisuda-upnvjt.jpg.jpeg',

    4 => '06-kkn-tematik.jpg.jpeg',

    5 => 'hero-rektor-upnvjt.jpg.png',

];


/*
|--------------------------------------------------------------------------
| PEMETAAN KATEGORI BERDASARKAN URUTAN
|--------------------------------------------------------------------------
*/

$newsCategoriesByIndex = [

    0 => 'Kemahasiswaan',

    1 => 'Akademik',

    2 => 'Kemahasiswaan',

    3 => 'Akademik',

    4 => 'Kemahasiswaan',

    5 => 'Pengumuman',

];


/*
|--------------------------------------------------------------------------
| JUDUL FALLBACK
|--------------------------------------------------------------------------
*/

$defaultTitle = 'Berita UPN Veteran Jawa Timur';


/*
|--------------------------------------------------------------------------
| PENULIS
|--------------------------------------------------------------------------
*/

$author = 'UPN Veteran Jawa Timur';


/*
|--------------------------------------------------------------------------
| GAMBAR
|--------------------------------------------------------------------------
|
| DEFAULT:
| gambar gedung UPN.
|
| Kemudian diganti dengan gambar sesuai posisi kartu.
|--------------------------------------------------------------------------
*/

$imageUrl = Url::to(
    '@web/images/upnvjt-building.png'
);


/*
|--------------------------------------------------------------------------
| CARI GAMBAR BERDASARKAN INDEX
|--------------------------------------------------------------------------
*/

if (isset($newsImagesByIndex[$cardIndex])) {

    $imageFilename =
        $newsImagesByIndex[$cardIndex];


    /*
     * Path fisik di dalam container.
     */

    $imagePath = Yii::getAlias(
        '@webroot/uploads/berita/' .
        $imageFilename
    );


    /*
     * Pastikan file memang ada.
     */

    if (is_file($imagePath)) {

        $imageUrl = Url::to(
            '@web/uploads/berita/' .
            $imageFilename
        );

    }

}


/*
|--------------------------------------------------------------------------
| CACHE BUSTER
|--------------------------------------------------------------------------
|
| Supaya browser tidak mempertahankan gambar lama
| setelah file gambar diganti.
|--------------------------------------------------------------------------
*/

if (isset($imagePath) && is_file($imagePath)) {

    $imageVersion =
        (string) filemtime($imagePath);

    $imageUrl .=
        '?v=' .
        $imageVersion;

}


/*
|--------------------------------------------------------------------------
| KATEGORI
|--------------------------------------------------------------------------
*/

$category = 'Berita';


if (isset($newsCategoriesByIndex[$cardIndex])) {

    $category =
        $newsCategoriesByIndex[$cardIndex];

}


/*
|--------------------------------------------------------------------------
| RINGKASAN BERITA
|--------------------------------------------------------------------------
*/

$isi = trim(
    strip_tags(
        (string) $model->isi
    )
);


$excerpt = mb_strimwidth(
    $isi,
    0,
    145,
    '...'
);


/*
|--------------------------------------------------------------------------
| URL DETAIL
|--------------------------------------------------------------------------
|
| JANGAN DIUBAH.
|
| URL ini sudah berhasil.
|--------------------------------------------------------------------------
*/

$detailUrl = [

    'index',

    'view' => $model->id,

];


/*
|--------------------------------------------------------------------------
| TANGGAL
|--------------------------------------------------------------------------
*/

$date = '-';


if (!empty($model->tanggal)) {

    $date =
        $model->getTanggal(
            $model->tanggal
        );

}


/*
|--------------------------------------------------------------------------
| POSISI CARD
|--------------------------------------------------------------------------
|
| Layout yang sudah benar:
|
| Card 1 = normal
| Card 2 = normal
| Card 3 = normal
| Card 4 = FEATURED
| Card 5 = SIDE
|
| Tetap menggunakan ID seperti sebelumnya agar
| layout yang sudah benar tidak berubah.
|--------------------------------------------------------------------------
*/

$cardClass = 'news-card';


if ($newsId === 9004) {

    $cardClass .=
        ' news-card--featured';

}


if ($newsId === 9005) {

    $cardClass .=
        ' news-card--side';

}

?>


<article
    class="<?= Html::encode($cardClass) ?>"
    data-news-id="<?= $newsId ?>"
    data-news-index="<?= $cardIndex ?>"
>


    <!-- =====================================================
         GAMBAR
    ====================================================== -->

    <div class="news-card__image">

        <?= Html::a(

            Html::img(

                $imageUrl,

                [

                    'class' =>
                        'news-card__image-element',

                    'alt' =>
                        $judul !== ''
                            ? $judul
                            : $defaultTitle,

                    /*
                     * Card pertama langsung dimuat.
                     */

                    'loading' =>
                        $cardIndex === 0
                            ? 'eager'
                            : 'lazy',

                    'decoding' =>
                        'async',

                ]

            ),

            $detailUrl,

            [

                'aria-label' =>
                    'Buka berita: ' .
                    (
                        $judul !== ''
                            ? $judul
                            : $defaultTitle
                    ),

            ]

        ) ?>


        <!-- =================================================
             BADGE
        ================================================== -->

        <span class="news-card__badge">

            <?= Html::encode($category) ?>

        </span>

    </div>


    <!-- =====================================================
         BODY
    ====================================================== -->

    <div class="news-card__body">


        <!-- =================================================
             TANGGAL
        ================================================== -->

        <time
            class="news-card__date"
            datetime="<?= Html::encode((string) $model->tanggal) ?>"
        >

            <i
                class="bi bi-calendar4"
                aria-hidden="true"
            ></i>

            <?= Html::encode($date) ?>

        </time>


        <!-- =================================================
             JUDUL
        ================================================== -->

        <h2 class="news-card__title">

            <?= Html::a(

                Html::encode(

                    $judul !== ''
                        ? $judul
                        : $defaultTitle

                ),

                $detailUrl,

                [

                    'title' =>
                        $judul !== ''
                            ? $judul
                            : $defaultTitle,

                ]

            ) ?>

        </h2>


        <!-- =================================================
             RINGKASAN
        ================================================== -->

        <?php if ($excerpt !== ''): ?>

            <p class="news-card__excerpt">

                <?= Html::encode($excerpt) ?>

            </p>

        <?php endif; ?>


        <!-- =================================================
             FOOTER CARD
        ================================================== -->

        <div class="news-card__foot">


            <!-- PENULIS -->

            <span class="news-card__author">

                <i
                    class="bi bi-person"
                    aria-hidden="true"
                ></i>

                <?= Html::encode($author) ?>

            </span>


            <!-- DETAIL -->

            <?= Html::a(

                'Detail <i class="bi bi-chevron-right" aria-hidden="true"></i>',

                $detailUrl,

                [

                    'class' =>
                        'news-card__detail',

                ]

            ) ?>

        </div>

    </div>

</article>