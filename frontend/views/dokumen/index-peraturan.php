<?php
/**
 * View: Produk Hukum - Peraturan
 * Layout dari main.php (header + footer dari layout)
 * Variable dari controller: $searchModel (DokumenSearch), $dataProvider (ActiveDataProvider)
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use frontend\models\DataLampiran;

$this->title = 'Produk Hukum - JDIH UPNVJT';

$totalCount = $dataProvider->getTotalCount();
$from = $totalCount > 0
    ? $dataProvider->pagination->offset + 1
    : 0;

$to = $totalCount > 0
    ? min(
        $dataProvider->pagination->offset + $dataProvider->pagination->limit,
        $totalCount
    )
    : 0;

$jenisList = [
    '' => 'Semua Jenis',
    'UNDANG-UNDANG' => 'Undang-Undang',
    'PERATURAN PEMERINTAH' => 'Peraturan Pemerintah',
    'PERATURAN DAERAH' => 'Peraturan Daerah',
    'PERATURAN REKTOR' => 'Peraturan Rektor',
    'KEPUTUSAN REKTOR' => 'Keputusan Rektor',
    'PERATURAN SENAT' => 'Peraturan Senat',
];

$tahunList = [];

for ($y = (int) date('Y'); $y >= 2000; $y--) {
    $tahunList[$y] = $y;
}

$statusList = [
    '' => 'Semua Status',
    'Berlaku' => 'Berlaku',
    'Tidak Berlaku' => 'Tidak Berlaku',
    'Dicabut' => 'Dicabut',
];

$currentJenis = Yii::$app->request->get('DokumenSearch')['jenis_peraturan'] ?? '';
$currentTahun = Yii::$app->request->get('DokumenSearch')['tahun_terbit'] ?? '';
$currentStatus = Yii::$app->request->get('DokumenSearch')['status'] ?? '';
$currentKeyword = Yii::$app->request->get('DokumenSearch')['judul'] ?? '';

/*
 * Background hero.
 *
 * Pastikan file:
 * frontend/web/images/images1.png
 */
$heroImage = Url::to('@web/images/images1.png');

$this->registerCss('
/* =========================================================
   PRODUK HUKUM — PAGE LAYOUT
   ========================================================= */

.peraturan-hero,
.peraturan-search,
.peraturan-tabs,
.peraturan-content {
    width: min(100% - 48px, 1280px);
    margin-left: auto;
    margin-right: auto;
}

/* =========================================================
   HERO
   ========================================================= */

.peraturan-hero {
    position: relative;
    overflow: hidden;
    min-height: 245px;
    box-sizing: border-box;
    padding: 48px 48px 52px;
    border-radius: 16px;
    color: #fff;
    background-image:
        linear-gradient(
            90deg,
            rgba(20, 66, 18, 0.95) 0%,
            rgba(20, 66, 18, 0.86) 36%,
            rgba(20, 66, 18, 0.64) 72%,
            rgba(20, 66, 18, 0.48) 100%
        ),
        url("' . $heroImage . '");
    background-color: #154212;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
}

.peraturan-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        180deg,
        rgba(0, 0, 0, 0.04),
        rgba(0, 0, 0, 0.16)
    );
    pointer-events: none;
}

.peraturan-hero > * {
    position: relative;
    z-index: 2;
}

.peraturan-hero .breadcrumb {
    margin: 0 0 18px;
    font-size: 13px;
    line-height: 1.5;
    color: rgba(255, 255, 255, 0.78);
}

.peraturan-hero .breadcrumb a {
    color: rgba(255, 255, 255, 0.82);
    text-decoration: none;
}

.peraturan-hero .breadcrumb a:hover {
    color: #fff;
}

.peraturan-hero .breadcrumb .current {
    color: #f5c842;
    font-weight: 700;
}

.peraturan-hero h1 {
    margin: 0 0 12px;
    color: #fff;
    font-family: Georgia, "Times New Roman", serif;
    font-size: clamp(34px, 4vw, 48px);
    font-weight: 900;
    line-height: 1.08;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.16);
}

.peraturan-hero p {
    max-width: 760px;
    margin: 0;
    color: rgba(255, 255, 255, 0.9);
    font-size: 16px;
    line-height: 1.65;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.12);
}

/* =========================================================
   SEARCH
   ========================================================= */

.peraturan-search {
    margin-top: 22px;
}

.peraturan-search form {
    display: flex;
    width: 100%;
    gap: 12px;
    align-items: stretch;
}

.peraturan-search-input {
    display: flex;
    min-width: 0;
    flex: 1 1 auto;
    align-items: center;
    gap: 12px;
    box-sizing: border-box;
    min-height: 58px;
    padding: 0 20px;
    border: 1px solid #e3ded0;
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 2px 10px rgba(31, 42, 31, 0.03);
}

.peraturan-search-input i {
    flex: 0 0 auto;
    color: #8a8f89;
    font-size: 19px;
    line-height: 1;
}

.peraturan-search-input input {
    min-width: 0;
    flex: 1 1 auto;
    height: 56px;
    padding: 0;
    border: 0;
    outline: 0;
    background: transparent;
    color: #1f2a1f;
    font-size: 15px;
}

.peraturan-search-input input::placeholder {
    color: #8a8f89;
}

.peraturan-search-btn {
    flex: 0 0 auto;
    min-width: 102px;
    min-height: 58px;
    padding: 0 26px;
    border: 0;
    border-radius: 18px;
    background: #1e4620;
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    line-height: 1;
    cursor: pointer;
    transition:
        background-color 0.2s ease,
        transform 0.2s ease;
}

.peraturan-search-btn:hover {
    background: #163717;
    transform: translateY(-1px);
}

/* =========================================================
   TABS
   ========================================================= */

.peraturan-tabs {
    display: flex;
    align-items: stretch;
    gap: 4px;
    margin-top: 20px;
    border-bottom: 1px solid #e3ded0;
    overflow-x: auto;
    scrollbar-width: thin;
}

.peraturan-tabs a {
    flex: 0 0 auto;
    padding: 13px 22px 12px;
    border-bottom: 3px solid transparent;
    color: #6b6f6b;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.35;
    text-decoration: none;
    transition:
        color 0.15s ease,
        border-color 0.15s ease,
        background-color 0.15s ease;
}

.peraturan-tabs a.active {
    border-bottom-color: #1e4620;
    color: #1e4620;
    font-weight: 700;
}

.peraturan-tabs a:hover {
    color: #1e4620;
    text-decoration: none;
}

/* =========================================================
   CONTENT
   ========================================================= */

.peraturan-content {
    display: flex;
    align-items: flex-start;
    gap: 28px;
    margin-top: 24px;
    margin-bottom: 56px;
}

/* =========================================================
   FILTER
   ========================================================= */

.peraturan-filter {
    width: 258px;
    flex: 0 0 258px;
    box-sizing: border-box;
    padding: 22px;
    border: 1px solid #e3ded0;
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 3px 14px rgba(31, 42, 31, 0.035);
}

.peraturan-filter h3 {
    margin: 0 0 20px;
    color: #1f2a1f;
    font-family: Georgia, "Times New Roman", serif;
    font-size: 22px;
    font-weight: 700;
    line-height: 1.25;
}

.peraturan-filter-group {
    margin-bottom: 18px;
}

.peraturan-filter-group label.group-title {
    display: block;
    margin-bottom: 8px;
    color: #1f2a1f;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.4;
}

.peraturan-filter select {
    width: 100%;
    min-height: 44px;
    box-sizing: border-box;
    padding: 0 12px;
    border: 1px solid #e3ded0;
    border-radius: 9px;
    outline: 0;
    background: #fff;
    color: #1f2a1f;
    font-size: 13px;
    cursor: pointer;
}

.peraturan-filter select:focus {
    border-color: #8aa18a;
    box-shadow: 0 0 0 3px rgba(30, 70, 32, 0.08);
}

.peraturan-filter-btn {
    width: 100%;
    min-height: 46px;
    margin-top: 6px;
    padding: 0 14px;
    border: 0;
    border-radius: 9px;
    background: #1e4620;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    line-height: 1;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.peraturan-filter-btn:hover {
    background: #163717;
}

/* =========================================================
   RESULTS
   ========================================================= */

.peraturan-results {
    min-width: 0;
    flex: 1 1 auto;
}

.peraturan-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 42px;
    margin-bottom: 12px;
    color: #6b6f6b;
    font-size: 14px;
    line-height: 1.5;
}

.peraturan-toolbar strong {
    color: #1f2a1f;
    font-weight: 700;
}

/* =========================================================
   DOCUMENT CARD
   ========================================================= */

.doc-card {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    box-sizing: border-box;
    width: 100%;
    margin: 0 0 14px;
    padding: 19px 22px;
    border: 1px solid #e3ded0;
    border-radius: 13px;
    background: #fff;
    box-shadow: 0 2px 8px rgba(31, 42, 31, 0.025);
    transition:
        box-shadow 0.18s ease,
        transform 0.18s ease,
        border-color 0.18s ease;
}

.doc-card:hover {
    border-color: #d8d2c3;
    box-shadow: 0 8px 24px rgba(31, 42, 31, 0.07);
    transform: translateY(-1px);
}

.doc-card-main {
    min-width: 0;
    flex: 1 1 auto;
}

.doc-card-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 7px 9px;
    margin-bottom: 8px;
    color: #6b6f6b;
    font-size: 12px;
    line-height: 1.45;
}

.doc-card-badge {
    display: inline-flex;
    align-items: center;
    min-height: 22px;
    padding: 2px 10px;
    border-radius: 999px;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.03em;
    line-height: 1.2;
    text-transform: uppercase;
}

.doc-card-badge.is-berlaku {
    background: #e8f4ea;
    color: #25743a;
}

.doc-card-badge.is-cabut {
    background: #fbe7e7;
    color: #c0392b;
}

.doc-card h3 {
    margin: 0 0 9px;
    color: #1f2a1f;
    font-size: 17px;
    font-weight: 750;
    line-height: 1.42;
}

.doc-card h3 a {
    color: inherit;
    text-decoration: none;
}

.doc-card h3 a:hover {
    color: #1e4620;
    text-decoration: underline;
}

.doc-card-info {
    display: flex;
    flex-wrap: wrap;
    gap: 5px 18px;
    color: #6b6f6b;
    font-size: 13px;
    line-height: 1.5;
}

.doc-card-info span {
    margin-right: 0;
}

.doc-card-detail {
    flex: 0 0 auto;
    align-self: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    min-height: 40px;
    padding: 0 16px;
    border: 1px solid #e3ded0;
    border-radius: 999px;
    background: #f7f4ec;
    color: #1f2a1f;
    font-size: 13px;
    font-weight: 700;
    line-height: 1;
    white-space: nowrap;
    text-decoration: none;
    transition:
        background-color 0.15s ease,
        border-color 0.15s ease;
}

.doc-card-detail:hover {
    border-color: #d7d0c0;
    background: #ebe5d8;
    color: #1f2a1f;
    text-decoration: none;
}

/* =========================================================
   EMPTY STATE
   ========================================================= */

.peraturan-empty {
    box-sizing: border-box;
    padding: 58px 24px;
    border: 1px dashed #dcd5c7;
    border-radius: 13px;
    background: #fff;
    color: #6b6f6b;
    text-align: center;
    line-height: 1.5;
}

.peraturan-empty i {
    color: #c8cbc7 !important;
}

/* =========================================================
   PAGINATION
   ========================================================= */

.peraturan-pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-top: 24px;
}

.peraturan-pagination a,
.peraturan-pagination span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 8px;
    box-sizing: border-box;
    border-radius: 50%;
    color: #1f2a1f;
    font-size: 13px;
    font-weight: 600;
    line-height: 1;
    text-decoration: none;
}

.peraturan-pagination a.active {
    background: #1e4620;
    color: #fff;
}

.peraturan-pagination a:hover:not(.active) {
    background: #e8e3d8;
    text-decoration: none;
}

.peraturan-pagination .nav-arrow {
    border: 1px solid #e3ded0;
}

/* =========================================================
   TABLET
   ========================================================= */

@media (max-width: 1100px) {
    .peraturan-hero,
    .peraturan-search,
    .peraturan-tabs,
    .peraturan-content {
        width: min(100% - 40px, 1280px);
    }

    .peraturan-content {
        gap: 22px;
    }

    .peraturan-filter {
        width: 235px;
        flex-basis: 235px;
    }

    .doc-card {
        padding: 18px 20px;
    }
}

/* =========================================================
   MOBILE / TABLET
   ========================================================= */

@media (max-width: 900px) {
    .peraturan-hero {
        min-height: 235px;
        padding: 38px 30px 44px;
        background-position: center;
    }

    .peraturan-hero h1 {
        font-size: 36px;
    }

    .peraturan-content {
        flex-direction: column;
    }

    .peraturan-filter {
        width: 100%;
        flex-basis: auto;
    }

    .doc-card {
        flex-direction: column;
        gap: 14px;
    }

    .doc-card-detail {
        align-self: flex-start;
    }
}

/* =========================================================
   SMALL MOBILE
   ========================================================= */

@media (max-width: 600px) {
    .peraturan-hero,
    .peraturan-search,
    .peraturan-tabs,
    .peraturan-content {
        width: calc(100% - 28px);
    }

    .peraturan-hero {
        min-height: 220px;
        padding: 30px 22px 36px;
        border-radius: 14px;
    }

    .peraturan-hero .breadcrumb {
        margin-bottom: 14px;
        font-size: 12px;
    }

    .peraturan-hero h1 {
        font-size: 30px;
    }

    .peraturan-hero p {
        font-size: 14px;
        line-height: 1.6;
    }

    .peraturan-search {
        margin-top: 16px;
    }

    .peraturan-search form {
        flex-direction: column;
    }

    .peraturan-search-input {
        min-height: 52px;
        border-radius: 14px;
    }

    .peraturan-search-input input {
        height: 50px;
    }

    .peraturan-search-btn {
        width: 100%;
        min-height: 48px;
        border-radius: 14px;
    }

    .peraturan-tabs {
        margin-top: 16px;
    }

    .peraturan-tabs a {
        padding: 11px 15px;
        font-size: 13px;
    }

    .peraturan-content {
        margin-top: 18px;
        margin-bottom: 42px;
    }

    .peraturan-filter {
        padding: 18px;
        border-radius: 12px;
    }

    .doc-card {
        padding: 16px 17px;
        border-radius: 12px;
    }

    .doc-card h3 {
        font-size: 16px;
        line-height: 1.42;
    }

    .doc-card-info {
        font-size: 12px;
    }

    .doc-card-detail {
        min-height: 38px;
        padding: 0 14px;
    }

    .peraturan-toolbar {
        min-height: 36px;
        font-size: 13px;
    }
}

');
?>

<!-- =========================================================
     HERO
     ========================================================= -->

<section class="peraturan-hero">

    <div class="breadcrumb">

        <a href="<?= Url::to(['/site/index']) ?>">
            Beranda
        </a>

        &nbsp;&gt;&nbsp;

        <span class="current">
            Produk Hukum
        </span>

    </div>

    <h1>
        Produk Hukum
    </h1>

    <p>
        Arsip digital peraturan dan keputusan hukum dalam lingkungan
        UPN Veteran Jawa Timur untuk mendukung transparansi dan
        tata kelola universitas yang baik.
    </p>

</section>


<!-- =========================================================
     SEARCH
     ========================================================= -->

<section class="peraturan-search">

    <form
        action="<?= Url::to(['/dokumen/peraturan']) ?>"
        method="get"
    >

        <div class="peraturan-search-input">

            <i
                class="bi bi-search"
                aria-hidden="true"
            ></i>

            <input
                type="text"
                name="DokumenSearch[judul]"
                placeholder="Cari produk hukum..."
                value="<?= Html::encode($currentKeyword) ?>"
            >

        </div>

        <button
            type="submit"
            class="peraturan-search-btn"
        >
            Cari
        </button>

    </form>

</section>


<!-- =========================================================
     TABS
     ========================================================= -->

<nav class="peraturan-tabs">

    <a
        href="<?= Url::to(['/dokumen/peraturan']) ?>"
        class="active"
    >
        Peraturan
    </a>

    <a href="<?= Url::to(['/dokumen/putusan']) ?>">
        Yurisprudensi
    </a>

    <a href="<?= Url::to(['/dokumen/monografi']) ?>">
        Monografi
    </a>

    <a href="<?= Url::to(['/dokumen/artikel']) ?>">
        Koleksi Digital
    </a>

</nav>


<!-- =========================================================
     CONTENT
     ========================================================= -->

<div class="peraturan-content">


    <!-- =====================================================
         FILTER SIDEBAR
         ===================================================== -->

    <aside class="peraturan-filter">

        <h3>
            Filter
        </h3>

        <form
            action="<?= Url::to(['/dokumen/peraturan']) ?>"
            method="get"
        >


            <!-- JENIS PERATURAN -->

            <div class="peraturan-filter-group">

                <label class="group-title">
                    Jenis Peraturan
                </label>

                <select
                    name="DokumenSearch[jenis_peraturan]"
                >

                    <?php foreach ($jenisList as $val => $label): ?>

                        <option
                            value="<?= Html::encode($val) ?>"
                            <?= $currentJenis === $val ? 'selected' : '' ?>
                        >
                            <?= Html::encode($label) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- TAHUN -->

            <div class="peraturan-filter-group">

                <label class="group-title">
                    Tahun
                </label>

                <select
                    name="DokumenSearch[tahun_terbit]"
                >

                    <option value="">
                        Semua Tahun
                    </option>

                    <?php foreach ($tahunList as $val => $label): ?>

                        <option
                            value="<?= Html::encode($val) ?>"
                            <?= (string)$currentTahun === (string)$val ? 'selected' : '' ?>
                        >
                            <?= Html::encode($label) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- STATUS -->

            <div class="peraturan-filter-group">

                <label class="group-title">
                    Status
                </label>

                <select
                    name="DokumenSearch[status]"
                >

                    <?php foreach ($statusList as $val => $label): ?>

                        <option
                            value="<?= Html::encode($val) ?>"
                            <?= $currentStatus === $val ? 'selected' : '' ?>
                        >
                            <?= Html::encode($label) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- BUTTON -->

            <button
                type="submit"
                class="peraturan-filter-btn"
            >
                Terapkan Filter
            </button>

        </form>

    </aside>


    <!-- =====================================================
         RESULT LIST
         ===================================================== -->

    <section class="peraturan-results">

        <div class="peraturan-toolbar">

            <span>

                Menampilkan

                <strong>
                    <?= number_format($from) ?>-<?= number_format($to) ?>
                </strong>

                dari

                <strong>
                    <?= number_format($totalCount) ?>
                </strong>

                produk hukum

            </span>

        </div>


        <?php if ($totalCount === 0): ?>

            <div class="peraturan-empty">

                <i
                    class="bi bi-inbox"
                    style="
                        font-size:48px;
                        display:block;
                        margin-bottom:16px;
                        color:#ccc;
                    "
                    aria-hidden="true"
                ></i>

                Tidak ada produk hukum ditemukan.

            </div>


        <?php else: ?>

            <?= ListView::widget([

                'dataProvider' => $dataProvider,

                'options' => [
                    'tag' => false
                ],

                'itemOptions' => [
                    'tag' => false
                ],

                'itemView' => '_data-peraturan',

                'summary' => false,

                'pager' => [

                    'options' => [
                        'class' => 'peraturan-pagination'
                    ],

                    'pageCssClass' => '',

                    'linkOptions' => [
                        'class' => ''
                    ],

                    'activePageCssClass' => 'active',

                    'disabledPageCssClass' => 'disabled',

                    'prevPageLabel' =>
                        '<i class="bi bi-chevron-left" aria-hidden="true"></i>',

                    'nextPageLabel' =>
                        '<i class="bi bi-chevron-right" aria-hidden="true"></i>',

                ],

            ]) ?>

        <?php endif; ?>

    </section>

</div>