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
| PEMETAAN GAMBAR BERDASARKAN ID
|--------------------------------------------------------------------------
|
| NAMA FILE AKTUAL DI DALAM CONTAINER:
|
| /var/www/frontend/web/uploads/berita/
|
| 01-kkn-upnvjt.jpg.jpeg
| 02-kknt-mbkm.jpg.jpeg
| 04-kkn-internasional.jpg.jpeg
| 05-wisuda-upnvjt.jpg.jpeg
| 06-kkn-tematik.jpg.jpeg
| hero-rektor-upnvjt.jpg.png
|
|--------------------------------------------------------------------------
*/

$newsImagesById = [

    9001 => '01-kkn-upnvjt.jpg.jpeg',

    9002 => '02-kknt-mbkm.jpg.jpeg',

    9003 => '04-kkn-internasional.jpg.jpeg',

    9004 => '05-wisuda-upnvjt.jpg.jpeg',

    9005 => '06-kkn-tematik.jpg.jpeg',

    9006 => 'hero-rektor-upnvjt.jpg.png',

];


/*
|--------------------------------------------------------------------------
| PEMETAAN GAMBAR BERDASARKAN JUDUL
|--------------------------------------------------------------------------
|
| Ini menjadi fallback apabila ID berita berbeda.
|
|--------------------------------------------------------------------------
*/

$newsImagesByTitle = [

    'Mahasiswa KKN UPN Veteran Jawa Timur Dorong Pengembangan Potensi Masyarakat'
        => '01-kkn-upnvjt.jpg.jpeg',

    'KKNT MBKM UPN Veteran Jawa Timur Perkuat Kontribusi Mahasiswa di Masyarakat'
        => '02-kknt-mbkm.jpg.jpeg',

    'UPN Veteran Jawa Timur Dorong Program KKN Internasional untuk Memperluas Pengalaman Mahasiswa'
        => '04-kkn-internasional.jpg.jpeg',

    'Wisuda UPN Veteran Jawa Timur, Rektor Tekankan Kompetensi dan Integritas Lulusan'
        => '05-wisuda-upnvjt.jpg.jpeg',

    'KKN Tematik UPN Veteran Jawa Timur Hadirkan Program Pengabdian Berkelanjutan'
        => '06-kkn-tematik.jpg.jpeg',

];


/*
|--------------------------------------------------------------------------
| KATEGORI BERDASARKAN ID
|--------------------------------------------------------------------------
*/

$newsCategoriesById = [

    9001 => 'Kemahasiswaan',

    9002 => 'Akademik',

    9003 => 'Kemahasiswaan',

    9004 => 'Akademik',

    9005 => 'Kemahasiswaan',

    9006 => 'Pengumuman',

];


/*
|--------------------------------------------------------------------------
| KATEGORI BERDASARKAN JUDUL
|--------------------------------------------------------------------------
*/

$newsCategoriesByTitle = [

    'Mahasiswa KKN UPN Veteran Jawa Timur Dorong Pengembangan Potensi Masyarakat'
        => 'Kemahasiswaan',

    'KKNT MBKM UPN Veteran Jawa Timur Perkuat Kontribusi Mahasiswa di Masyarakat'
        => 'Akademik',

    'UPN Veteran Jawa Timur Dorong Program KKN Internasional untuk Memperluas Pengalaman Mahasiswa'
        => 'Kemahasiswaan',

    'Wisuda UPN Veteran Jawa Timur, Rektor Tekankan Kompetensi dan Integritas Lulusan'
        => 'Akademik',

    'KKN Tematik UPN Veteran Jawa Timur Hadirkan Program Pengabdian Berkelanjutan'
        => 'Kemahasiswaan',

];


/*
|--------------------------------------------------------------------------
| PENULIS
|--------------------------------------------------------------------------
*/

$author = 'UPN Veteran Jawa Timur';


/*
|--------------------------------------------------------------------------
| TENTUKAN NAMA FILE GAMBAR
|--------------------------------------------------------------------------
|
| Prioritas:
|
| 1. ID berita
| 2. Judul berita
| 3. Gambar database
| 4. Fallback
|
|--------------------------------------------------------------------------
*/

$imageFilename = null;


/*
|--------------------------------------------------------------------------
| 1. CARI BERDASARKAN ID
|--------------------------------------------------------------------------
*/

if (isset($newsImagesById[$newsId])) {

    $imageFilename = $newsImagesById[$newsId];

}


/*
|--------------------------------------------------------------------------
| 2. JIKA BELUM KETEMU, CARI BERDASARKAN JUDUL
|--------------------------------------------------------------------------
*/

if (
    empty($imageFilename)
    &&
    isset($newsImagesByTitle[$judul])
) {

    $imageFilename = $newsImagesByTitle[$judul];

}


/*
|--------------------------------------------------------------------------
| 3. TENTUKAN URL GAMBAR
|--------------------------------------------------------------------------
|
| Untuk gambar dummy:
|
| /uploads/berita/nama-file
|
| Untuk gambar database lama:
|
| /common/dokumen/nama-file
|
|--------------------------------------------------------------------------
*/

$imageUrl = Url::to(
    '@web/images/upnvjt-building.png'
);


/*
|--------------------------------------------------------------------------
| CEK GAMBAR DUMMY
|--------------------------------------------------------------------------
*/

if (!empty($imageFilename)) {

    $dummyImagePath = Yii::getAlias(
        '@webroot/uploads/berita/' . $imageFilename
    );


    /*
     * Pastikan file benar-benar ada.
     */

    if (is_file($dummyImagePath)) {

        $imageUrl = Url::to(
            '@web/uploads/berita/' . $imageFilename
        );

    }

}


/*
|--------------------------------------------------------------------------
| 4. FALLBACK KE GAMBAR DATABASE
|--------------------------------------------------------------------------
|
| Hanya digunakan apabila gambar dummy tidak ditemukan.
|
|--------------------------------------------------------------------------
*/

if (
    $imageUrl === Url::to('@web/images/upnvjt-building.png')
    &&
    !empty($model->image)
) {

    $databaseFilename = basename(
        (string) $model->image
    );


    $databaseImagePath = Yii::getAlias(
        '@web/common/dokumen/' . $databaseFilename
    );


    if (is_file($databaseImagePath)) {

        $imageUrl = Url::to(
            '@web/common/dokumen/' . $databaseFilename
        );

    }

}


/*
|--------------------------------------------------------------------------
| KATEGORI
|--------------------------------------------------------------------------
*/

$category = 'Berita';


if (isset($newsCategoriesById[$newsId])) {

    $category = $newsCategoriesById[$newsId];

} elseif (isset($newsCategoriesByTitle[$judul])) {

    $category = $newsCategoriesByTitle[$judul];

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
| URL ini sudah berhasil digunakan untuk detail dummy.
|
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

    $date = $model->getTanggal(
        $model->tanggal
    );

}


/*
|--------------------------------------------------------------------------
| POSISI CARD
|--------------------------------------------------------------------------
|
| 9001 = card 1
| 9002 = card 2
| 9003 = card 3
| 9004 = FEATURED
| 9005 = SIDE
|
| Layout TIDAK DIUBAH.
|
|--------------------------------------------------------------------------
*/

$cardClass = 'news-card';


if ($newsId === 9004) {

    $cardClass .= ' news-card--featured';

}


if ($newsId === 9005) {

    $cardClass .= ' news-card--side';

}

?>


<article
    class="<?= Html::encode($cardClass) ?>"
    data-news-id="<?= $newsId ?>"
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
                            : 'Berita UPN Veteran Jawa Timur',

                    /*
                     * Card pertama langsung dimuat.
                     * Card lainnya tetap lazy-load.
                     */

                    'loading' =>
                        $newsId === 9001
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
                            : 'Berita UPN Veteran Jawa Timur'
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
                        : 'Berita UPN Veteran Jawa Timur'

                ),

                $detailUrl,

                [

                    'title' => $judul,

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