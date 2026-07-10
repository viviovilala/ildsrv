<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$pageTitle = $pageTitle ?? 'Produk Hukum';
$pageDescription = $pageDescription ?? 'Arsip digital peraturan dan keputusan hukum dalam lingkungan UPN Veteran Jawa Timur.';
$this->title = $pageTitle . ' - JDIH UPNVJT';
$heroImage = Url::to('@web/images/upnvjt-building.png');
$totalCount = $dataProvider->getTotalCount();
$from = $totalCount > 0 ? $dataProvider->pagination->offset + 1 : 0;
$to = $totalCount > 0 ? min($dataProvider->pagination->offset + $dataProvider->pagination->limit, $totalCount) : 0;
?>

<section class="catalog-page">
    <div class="container catalog-shell">
        <aside class="catalog-rail">
            <div class="catalog-rail__brand"><i class="bi bi-hammer" aria-hidden="true"></i><div><strong>Katalog Hukum</strong><small>JDIH Portal</small></div></div>
            <nav class="catalog-menu">
                <?= Html::a('<i class="bi bi-grid" aria-hidden="true"></i> Dashboard', ['/site/index']) ?>
                <?= Html::a('<i class="bi bi-hammer" aria-hidden="true"></i> Peraturan', ['/dokumen/peraturan'], ['class' => 'is-active']) ?>
                <?= Html::a('<i class="bi bi-bank" aria-hidden="true"></i> Yurisprudensi', ['/dokumen/putusan']) ?>
                <?= Html::a('<i class="bi bi-book" aria-hidden="true"></i> Monografi', ['/dokumen/monografi']) ?>
                <?= Html::a('<i class="bi bi-fingerprint" aria-hidden="true"></i> Koleksi Digital', ['/dokumen/index']) ?>
            </nav>
        </aside>
        <main class="catalog-content">
            <div class="catalog-hero" style="background-image: linear-gradient(90deg, rgba(6,78,11,.72), rgba(6,78,11,.34)), url('<?= Html::encode($heroImage) ?>');">
                <span>Beranda > Katalog > Peraturan</span>
                <h1><?= Html::encode($pageTitle) ?></h1>
                <p><?= Html::encode($pageDescription) ?></p>
            </div>
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
                    </div>
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options' => ['class' => 'catalog-document-list'],
                        'itemOptions' => ['tag' => false],
                        'itemView' => '_data',
                        'summary' => false,
                        'pager' => require __DIR__ . '/_pager.php',
                    ]) ?>
                </section>
            </div>
        </main>
    </div>
</section>
