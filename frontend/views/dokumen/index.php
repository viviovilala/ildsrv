<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$pageTitle = $pageTitle ?? 'Produk Hukum';
<<<<<<< HEAD
$pageDescription = $pageDescription ?? 'Arsip digital peraturan dan keputusan hukum dalam lingkungan UPN Veteran Jawa Timur.';
$this->title = $pageTitle . ' - JDIH UPNVJT';
=======
$pageDescription = $pageDescription ?? 'Arsip digital peraturan dan keputusan hukum dalam lingkungan UPN Veteran Jawa Timur untuk mendukung transparansi dan tata kelola universitas.';
$this->title = $pageTitle . ' - JDIH UPNVJT';
$this->registerMetaTag(['name' => 'description', 'content' => $pageDescription]);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);

>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
$heroImage = Url::to('@web/images/upnvjt-building.png');
$totalCount = $dataProvider->getTotalCount();
$from = $totalCount > 0 ? $dataProvider->pagination->offset + 1 : 0;
$to = $totalCount > 0 ? min($dataProvider->pagination->offset + $dataProvider->pagination->limit, $totalCount) : 0;
?>

<section class="catalog-page">
    <div class="container catalog-shell">
        <aside class="catalog-rail">
<<<<<<< HEAD
            <div class="catalog-rail__brand"><i class="bi bi-hammer" aria-hidden="true"></i><div><strong>Katalog Hukum</strong><small>JDIH Portal</small></div></div>
            <nav class="catalog-menu">
                <?= Html::a('<i class="bi bi-grid" aria-hidden="true"></i> Dashboard', ['/site/index']) ?>
                <?= Html::a('<i class="bi bi-hammer" aria-hidden="true"></i> Peraturan', ['/dokumen/peraturan'], ['class' => 'is-active']) ?>
                <?= Html::a('<i class="bi bi-bank" aria-hidden="true"></i> Yurisprudensi', ['/dokumen/putusan']) ?>
                <?= Html::a('<i class="bi bi-book" aria-hidden="true"></i> Monografi', ['/dokumen/monografi']) ?>
                <?= Html::a('<i class="bi bi-fingerprint" aria-hidden="true"></i> Koleksi Digital', ['/dokumen/index']) ?>
            </nav>
        </aside>
=======
            <div class="catalog-rail__brand">
                <span class="jdih-logo-mark"><i class="bi bi-hammer" aria-hidden="true"></i></span>
                <div>
                    <strong>Katalog Hukum</strong>
                    <small>JDIH Portal</small>
                </div>
            </div>

            <nav class="catalog-menu" aria-label="Kategori katalog">
                <?= Html::a('<i class="bi bi-grid" aria-hidden="true"></i> Dashboard', ['/site/index'], ['class' => 'catalog-menu__link']) ?>
                <?= Html::a('<i class="bi bi-hammer" aria-hidden="true"></i> Peraturan', ['/dokumen/peraturan'], ['class' => 'catalog-menu__link is-active']) ?>
                <?= Html::a('<i class="bi bi-bank" aria-hidden="true"></i> Yurisprudensi', ['/dokumen/putusan'], ['class' => 'catalog-menu__link']) ?>
                <?= Html::a('<i class="bi bi-book" aria-hidden="true"></i> Monografi', ['/dokumen/monografi'], ['class' => 'catalog-menu__link']) ?>
                <?= Html::a('<i class="bi bi-fingerprint" aria-hidden="true"></i> Koleksi Digital', ['/dokumen/index'], ['class' => 'catalog-menu__link']) ?>
            </nav>

            <div class="catalog-rail__bottom">
                <a href="#"><i class="bi bi-question-circle" aria-hidden="true"></i> Bantuan</a>
                <a href="#"><i class="bi bi-gear" aria-hidden="true"></i> Pengaturan</a>
            </div>
        </aside>

>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
        <main class="catalog-content">
            <div class="catalog-hero" style="background-image: linear-gradient(90deg, rgba(6,78,11,.72), rgba(6,78,11,.34)), url('<?= Html::encode($heroImage) ?>');">
                <span>Beranda > Katalog > Peraturan</span>
                <h1><?= Html::encode($pageTitle) ?></h1>
                <p><?= Html::encode($pageDescription) ?></p>
            </div>
<<<<<<< HEAD
            <div class="catalog-body">
                <form class="catalog-filter" action="<?= Url::to(['/dokumen/index']) ?>" method="get">
                    <h2>Filter</h2>
                    <label>Keyword Search</label>
                    <input type="search" name="DokumenSearch[judul]" placeholder="Judul dokumen">
                    <label>Jenis Peraturan</label>
                    <label class="check"><input type="checkbox" checked> Peraturan Rektor</label>
                    <label class="check"><input type="checkbox"> Keputusan Rektor</label>
                    <label class="check"><input type="checkbox"> Peraturan Senat</label>
                    <label class="check"><input type="checkbox"> Instruksi Rektor</label>
                    <label>Tahun</label>
                    <select name="DokumenSearch[tahun_terbit]"><option value="">Pilih Tahun</option><?php for ($year = (int) date('Y'); $year >= (int) date('Y') - 8; $year--): ?><option value="<?= $year ?>"><?= $year ?></option><?php endfor; ?></select>
                    <button type="submit">Terapkan Filter <i class="bi bi-filter" aria-hidden="true"></i></button>
                </form>
                <section>
                    <div class="catalog-results__bar">
                        <span><?= $totalCount > 0 ? 'Menampilkan ' . number_format($from) . '-' . number_format($to) . ' dari ' . number_format($totalCount) . ' produk hukum' : 'Tidak ada produk hukum ditemukan' ?></span>
                        <span>Urutkan: <strong>Terbaru</strong></span>
=======

            <div class="catalog-body">
                <form class="catalog-filter" action="<?= Url::to(['/dokumen/index']) ?>" method="get">
                    <div class="catalog-filter__head">
                        <h2>Filter</h2>
                        <?= Html::a('Reset', ['/dokumen/index']) ?>
                    </div>

                    <label class="catalog-filter__label">Keyword Search</label>
                    <div class="catalog-filter__search">
                        <i class="bi bi-search" aria-hidden="true"></i>
                        <input type="search" name="DokumenSearch[judul]" placeholder="Judul dokumen">
                    </div>

                    <div class="catalog-tabs" role="tablist" aria-label="Mode pencarian">
                        <button type="button" class="is-active">Keyword Search</button>
                        <button type="button">AI Search</button>
                    </div>

                    <label class="catalog-filter__label">Jenis Peraturan</label>
                    <label class="catalog-check"><input type="checkbox" checked> Peraturan Rektor</label>
                    <label class="catalog-check"><input type="checkbox"> Keputusan Rektor</label>
                    <label class="catalog-check"><input type="checkbox"> Peraturan Senat</label>
                    <label class="catalog-check"><input type="checkbox"> Instruksi Rektor</label>

                    <label class="catalog-filter__label">Tahun</label>
                    <select name="DokumenSearch[tahun_terbit]" class="catalog-select">
                        <option value="">Pilih Tahun</option>
                        <?php for ($year = (int) date('Y'); $year >= (int) date('Y') - 8; $year--): ?>
                            <option value="<?= $year ?>"><?= $year ?></option>
                        <?php endfor; ?>
                    </select>

                    <label class="catalog-filter__label">Status</label>
                    <div class="catalog-status">
                        <button type="button" class="is-active">Semua</button>
                        <button type="button">Berlaku</button>
                        <button type="button">Dicabut</button>
                    </div>

                    <button type="submit" class="catalog-filter__button">Terapkan Filter <i class="bi bi-filter" aria-hidden="true"></i></button>
                </form>

                <section class="catalog-results">
                    <div class="catalog-results__bar">
                        <span>
                            <?= $totalCount > 0
                                ? 'Menampilkan ' . number_format($from) . '-' . number_format($to) . ' dari ' . number_format($totalCount) . ' produk hukum'
                                : 'Tidak ada produk hukum ditemukan'
                            ?>
                        </span>
                        <span>Urutkan: <strong>Terbaru</strong> <i class="bi bi-chevron-down" aria-hidden="true"></i></span>
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
                    </div>
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options' => ['class' => 'catalog-document-list'],
                        'itemOptions' => ['tag' => false],
                        'itemView' => '_data',
                        'summary' => false,
                        'pager' => [
                            'options' => ['class' => 'catalog-pagination pagination'],
                            'pageCssClass' => 'page-item',
                            'linkOptions' => ['class' => 'page-link'],
                            'activePageCssClass' => 'active',
                            'disabledPageCssClass' => 'disabled',
                            'prevPageLabel' => '<i class="bi bi-chevron-left" aria-hidden="true"></i>',
                            'nextPageLabel' => '<i class="bi bi-chevron-right" aria-hidden="true"></i>',
                        ],
                    ]) ?>
                </section>
            </div>
        </main>
    </div>
</section>
<<<<<<< HEAD
=======

<style>
.catalog-page{background:#f8f7f2;min-height:100vh}
.catalog-shell{display:grid;grid-template-columns:280px 1fr;gap:48px;align-items:start}
.catalog-rail{position:sticky;top:72px;min-height:calc(100vh - 72px);padding:36px 0;border-right:1px solid #d8dbd2}
.catalog-rail__brand{display:flex;align-items:center;gap:14px;margin-bottom:38px;color:#1e241c}
.catalog-rail__brand strong{display:block;font-family:Georgia,"Times New Roman",serif;font-size:26px;letter-spacing:0}
.catalog-rail__brand small{color:#6b7168}
.catalog-menu{display:grid;gap:10px;padding-right:18px}
.catalog-menu__link{display:flex;align-items:center;gap:14px;padding:15px 18px;border-radius:8px;color:#4d554b;text-decoration:none;font-weight:800}
.catalog-menu__link:hover,.catalog-menu__link.is-active{background:#2d6727;color:#d7f6d4;text-decoration:none}
.catalog-rail__bottom{position:absolute;left:0;right:18px;bottom:36px;display:grid;gap:20px;padding-top:28px;border-top:1px solid #d8dbd2}
.catalog-rail__bottom a{color:#4d554b;text-decoration:none;font-weight:800}
.catalog-content{padding:28px 0 96px}
.catalog-hero{min-height:300px;border-radius:24px;background-size:cover;background-position:center;display:flex;flex-direction:column;justify-content:center;padding:52px;color:#fff;overflow:hidden}
.catalog-hero span{color:rgba(255,255,255,.78);font-weight:800}
.catalog-hero h1{margin:18px 0 12px;font-family:Georgia,"Times New Roman",serif;font-size:56px;line-height:1;letter-spacing:0}
.catalog-hero p{max-width:780px;margin:0;color:rgba(255,255,255,.88);font-size:17px;line-height:1.65}
.catalog-body{display:grid;grid-template-columns:220px 1fr;gap:28px;margin-top:80px}
.catalog-filter{border:1px solid #d8dbd2;border-radius:14px;background:#fff;padding:24px;height:max-content}
.catalog-filter__head{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px}
.catalog-filter__head h2{margin:0;color:#064e0b;font-family:Georgia,"Times New Roman",serif;font-size:28px;letter-spacing:0}
.catalog-filter__head a{color:#2d6727;font-weight:800;text-decoration:none}
.catalog-filter__label{display:block;margin:20px 0 10px;color:#6b7168;font-size:12px;font-weight:900;letter-spacing:.06em;text-transform:uppercase}
.catalog-filter__search{display:flex;align-items:center;gap:8px;background:#f2f1ec;border-radius:10px;padding:10px 12px}
.catalog-filter__search input{width:100%;border:0;outline:0;background:transparent}
.catalog-tabs{display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-top:12px}
.catalog-tabs button,.catalog-status button{border:1px solid #d8dbd2;background:#fff;border-radius:999px;padding:8px 10px;color:#4d554b;font-weight:800;font-size:12px}
.catalog-tabs button.is-active,.catalog-status button.is-active{background:#064e0b;color:#fff;border-color:#064e0b}
.catalog-check{display:flex;align-items:center;gap:9px;margin-bottom:10px;color:#4d554b;font-weight:700}
.catalog-check input{accent-color:#064e0b}
.catalog-select{width:100%;border:0;background:#f2f1ec;border-radius:10px;padding:12px;color:#4d554b}
.catalog-status{display:flex;flex-wrap:wrap;gap:8px}
.catalog-filter__button{width:100%;margin-top:24px;border:0;border-radius:10px;background:#ffd200;color:#064e0b;font-weight:900;padding:13px}
.catalog-results__bar{display:flex;align-items:center;justify-content:space-between;gap:20px;margin-bottom:28px;color:#6b7168;font-weight:700}
.catalog-document-list{display:grid;gap:18px}
.catalog-doc-card{display:grid;grid-template-columns:72px 1fr auto;gap:24px;align-items:center;padding:26px;border:1px solid #d8dbd2;border-radius:14px;background:#fff;color:#1e241c}
.catalog-doc-card__icon{width:64px;height:64px;border-radius:12px;background:#bdf3bf;color:#064e0b;display:flex;align-items:center;justify-content:center;font-size:30px}
.catalog-doc-card__meta{display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:10px;color:#6b7168;font-size:13px;font-weight:900}
.catalog-doc-card__status{padding:5px 12px;border-radius:999px;background:#bdf3bf;color:#064e0b}
.catalog-doc-card__status.is-revoked{background:#ffd7d7;color:#b51f1f}
.catalog-doc-card h3{margin:0 0 8px;font-family:Georgia,"Times New Roman",serif;font-size:24px;line-height:1.22;letter-spacing:0}
.catalog-doc-card h3 a{color:#1e241c;text-decoration:none}
.catalog-doc-card p{margin:0;color:#6b7168}
.catalog-doc-card__actions{display:grid;gap:10px;min-width:150px}
.catalog-doc-card__download,.catalog-doc-card__detail{display:flex;align-items:center;justify-content:center;gap:8px;border-radius:9px;padding:12px 14px;font-weight:900;text-decoration:none}
.catalog-doc-card__download{background:#064e0b;color:#fff}
.catalog-doc-card__download:hover{color:#fff;text-decoration:none;background:#0b5d1e}
.catalog-doc-card__detail{border:1px solid #d8dbd2;color:#4d554b}
.catalog-doc-card__detail:hover{color:#064e0b;text-decoration:none}
.catalog-pagination{justify-content:center;margin-top:26px;gap:8px}
.catalog-pagination .page-link{border-radius:999px!important;color:#064e0b;border-color:#d8dbd2}
.catalog-pagination .active .page-link{background:#064e0b;border-color:#064e0b;color:#fff}
@media(max-width:991.98px){.catalog-shell{grid-template-columns:1fr}.catalog-rail{position:relative;top:0;min-height:auto;border-right:0;border-bottom:1px solid #d8dbd2}.catalog-rail__bottom{position:static}.catalog-body{grid-template-columns:1fr}.catalog-doc-card{grid-template-columns:1fr}.catalog-doc-card__actions{grid-template-columns:1fr 1fr}}
@media(max-width:575.98px){.catalog-hero{border-radius:0;margin-left:-15px;margin-right:-15px;padding:36px 22px}.catalog-hero h1{font-size:40px}.catalog-results__bar,.catalog-doc-card__actions{grid-template-columns:1fr;display:grid}.catalog-doc-card h3{font-size:21px}}
</style>
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
