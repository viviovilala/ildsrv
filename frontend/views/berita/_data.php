<?php

use common\components\LazyImage;
use yii\helpers\Html;

/*
 * =========================================================
 * DATA BERITA
 * =========================================================
 *
 * File gambar berada di:
 *
 * frontend/web/uploads/berita/
 *
 * 01-spotlight-umkm.jpg
 * 02-magang-fh-jakbar.jpg
 * 03-kkn-2026.jpg
 * 04-wisuda-ke-97.jpg
 * 05-abdimas-kedai-jerman.jpg
 */


/*
 * =========================================================
 * PEMETAAN BERITA
 * =========================================================
 *
 * Pemetaan berdasarkan judul berita.
 * Jika gambar di database belum sesuai, halaman tetap
 * menggunakan gambar yang sudah ditentukan di sini.
 */

$newsData = [

    'Mahasiswa KKN 21 UPN Veteran Jawa Timur Dorong Pengembangan UMKM Kelurahan Ledok Wetan Bojonegoro Melalui Program Spotlight UMKM' => [
        'image' => '01-spotlight-umkm.jpg',
        'category' => 'Kemahasiswaan',
        'author' => 'Admin JDIH',
    ],

    'Pelaksanaan Program Magang UPN Veteran Jawa Timur Fakultas Hukum di Pengadilan Negeri Jakarta Barat Kelas 1A Khusus' => [
        'image' => '02-magang-fh-jakbar.jpg',
        'category' => 'Akademik',
        'author' => 'Admin JDIH',
    ],

    'UPN Veteran Jatim Berangkatkan Ribuan Mahasiswa KKN 2026, Sasaran Program Pengabdian Domestik Hingga Mancanegara' => [
        'image' => '03-kkn-2026.jpg',
        'category' => 'Kemahasiswaan',
        'author' => 'Admin JDIH',
    ],

    'Wisuda ke-97 UPN Veteran Jatim, Rektor Tegaskan Lulusan Harus Berkompetensi dan Berintegritas' => [
        'image' => '04-wisuda-ke-97.jpg',
        'category' => 'Akademik',
        'author' => 'Admin JDIH',
    ],

    'Tim Abdimas UPN Veteran Jatim Dampingi Proses Digitalisasi Manajemen Produksi Halal di UMKM Kedai Jerman' => [
        'image' => '05-abdimas-kedai-jerman.jpg',
        'category' => 'Akademik',
        'author' => 'Admin JDIH',
    ],

];


/*
 * =========================================================
 * AMBIL DATA BERITA
 * =========================================================
 */

$judul = trim((string) $model->judul);

$currentNews = $newsData[$judul] ?? null;


/*
 * =========================================================
 * GAMBAR
 * =========================================================
 *
 * Jika judul ditemukan di pemetaan di atas,
 * gunakan gambar yang sudah ditentukan.
 *
 * Jika belum ditemukan, gunakan gambar dari database.
 */

if ($currentNews && !empty($currentNews['image'])) {

    $image = '@web/uploads/berita/' . $currentNews['image'];

} elseif (!empty($model->image)) {

    $image = '@web/common/dokumen/' . $model->image;

} else {

    $image = '@web/images/upnvjt-building.png';
}


/*
 * =========================================================
 * KATEGORI
 * =========================================================
 */

$category = $currentNews['category'] ?? 'Berita';


/*
 * =========================================================
 * PENULIS
 * =========================================================
 */

$author = $currentNews['author'] ?? 'Admin JDIH';


/*
 * =========================================================
 * RINGKASAN BERITA
 * =========================================================
 */

$isi = trim(strip_tags((string) $model->isi));

$excerpt = mb_strimwidth(
    $isi,
    0,
    135,
    '...'
);


/*
 * =========================================================
 * URL DETAIL
 * =========================================================
 */

$detailUrl = [
    'view',
    'id' => $model->id,
];


/*
 * =========================================================
 * POSISI KARTU
 * =========================================================
 *
 * ListView mengirimkan $index.
 *
 * Urutan:
 *
 * 0 = berita pertama
 * 1 = berita kedua
 * 2 = berita ketiga
 * 3 = berita keempat → FEATURED
 * 4 = berita kelima
 *
 * Ini mengikuti layout pada desain yang kamu kirim.
 */

$cardClass = 'news-card';

if (isset($index)) {

    if ($index === 3) {

        $cardClass .= ' news-card--featured';

    } elseif ($index === 4) {

        $cardClass .= ' news-card--side';

    }

}


/*
 * =========================================================
 * TANGGAL
 * =========================================================
 */

$date = !empty($model->tanggal)
    ? $model->getTanggal($model->tanggal)
    : '-';

?>

<article class="<?= Html::encode($cardClass) ?>">

    <!-- =====================================================
         GAMBAR
    ====================================================== -->

    <div class="news-card__image">

        <?= Html::a(

            LazyImage::img(
                $image,
                [
                    'alt' => $judul,
                    'loading' => 'lazy',
                ]
            ),

            $detailUrl

        ) ?>


        <!-- KATEGORI -->

        <span class="news-card__badge">
            <?= Html::encode($category) ?>
        </span>

    </div>


    <!-- =====================================================
         ISI KARTU
    ====================================================== -->

    <div class="news-card__body">


        <!-- TANGGAL -->

        <time
            class="news-card__date"
            datetime="<?= Html::encode($model->tanggal) ?>"
        >

            <i
                class="bi bi-calendar4"
                aria-hidden="true"
            ></i>

            <?= Html::encode($date) ?>

        </time>


        <!-- JUDUL -->

        <h2>

            <?= Html::a(
                Html::encode($judul),
                $detailUrl
            ) ?>

        </h2>


        <!-- RINGKASAN -->

        <?php if ($excerpt !== ''): ?>

            <p>
                <?= Html::encode($excerpt) ?>
            </p>

        <?php endif; ?>


        <!-- =================================================
             FOOTER KARTU
        ================================================== -->

        <div class="news-card__foot">

            <span>

                <i
                    class="bi bi-person"
                    aria-hidden="true"
                ></i>

                <?= Html::encode($author) ?>

            </span>


            <?= Html::a(
                'Detail <i class="bi bi-chevron-right" aria-hidden="true"></i>',
                $detailUrl
            ) ?>

        </div>

    </div>

</article>