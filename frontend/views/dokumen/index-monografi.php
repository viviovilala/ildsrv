<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Monografi Hukum - JDIH UPNVJT';
$totalCount = $dataProvider->getTotalCount();
$from = $totalCount > 0 ? $dataProvider->pagination->offset + 1 : 0;
$to = $totalCount > 0 ? min($dataProvider->pagination->offset + $dataProvider->pagination->limit, $totalCount) : 0;

$jenisList = ['' => 'Semua Jenis', 'BUKU HUKUM' => 'Buku Hukum', 'MAJALAH HUKUM' => 'Majalah Hukum', 'JURNAL HUKUM' => 'Jurnal Hukum'];
$tahunList = []; for ($y = (int) date('Y'); $y >= 2000; $y--) { $tahunList[$y] = $y; }
$statusList = ['' => 'Semua Status', 'Berlaku' => 'Berlaku', 'Tidak Berlaku' => 'Tidak Berlaku'];
$currentJenis = Yii::$app->request->get('DokumenSearch')['jenis_peraturan'] ?? '';
$currentTahun = Yii::$app->request->get('DokumenSearch')['tahun_terbit'] ?? '';
$currentStatus = Yii::$app->request->get('DokumenSearch')['status'] ?? '';
$currentKeyword = Yii::$app->request->get('DokumenSearch')['judul'] ?? '';

$this->registerCss('
.peraturan-hero{background:#154212;border-radius:16px;padding:48px;color:#fff;max-width:1280px;margin:0 auto}
.peraturan-hero .breadcrumb{font-size:13px;color:rgba(255,255,255,.75);margin-bottom:16px}
.peraturan-hero .breadcrumb a{color:rgba(255,255,255,.75)}.peraturan-hero .breadcrumb .current{color:#d4a94a;font-weight:600}
.peraturan-hero h1{font-family:Georgia,serif;font-size:40px;margin:0 0 8px;font-weight:900}
.peraturan-hero p{font-size:15px;color:rgba(255,255,255,.82);margin:0;max-width:600px}
.peraturan-search{display:flex;gap:12px;max-width:1280px;margin:24px auto 0}
.peraturan-search-input{flex:1;display:flex;align-items:center;gap:10px;background:#fff;border:1px solid #e3ded0;border-radius:24px;padding:12px 20px}
.peraturan-search-input i{color:#999;font-size:18px}
.peraturan-search-input input{flex:1;border:none;outline:none;font-size:15px;background:transparent}
.peraturan-search-btn{background:#1e4620;color:#fff;border:none;border-radius:24px;padding:0 28px;font-size:15px;font-weight:600;cursor:pointer}
.peraturan-tabs{display:flex;gap:0;max-width:1280px;margin:24px auto 0;border-bottom:1px solid #e3ded0;font-size:14px}
.peraturan-tabs a{padding:12px 24px;color:#6b6f6b;border-bottom:2px solid transparent;transition:all .15s ease}
.peraturan-tabs a.active{color:#1e4620;font-weight:700;border-bottom-color:#1e4620}
.peraturan-tabs a:hover{color:#1e4620;text-decoration:none}
.peraturan-content{display:flex;gap:32px;max-width:1280px;margin:28px auto 60px;align-items:flex-start}
.peraturan-filter{width:250px;flex-shrink:0;background:#fff;border:1px solid #e3ded0;border-radius:12px;padding:24px}
.peraturan-filter h3{font-family:Georgia,serif;font-size:20px;margin:0 0 20px;color:#1f2a1f}
.peraturan-filter-group{margin-bottom:20px}
.peraturan-filter-group label.group-title{display:block;font-weight:600;font-size:13px;margin-bottom:8px;color:#1f2a1f}
.peraturan-filter select{width:100%;padding:10px 12px;border:1px solid #e3ded0;border-radius:8px;font-size:13px;background:#fff;color:#1f2a1f}
.peraturan-filter-btn{width:100%;background:#1e4620;color:#fff;border:none;border-radius:8px;padding:12px;font-size:14px;font-weight:600;cursor:pointer;margin-top:8px}
.peraturan-results{flex:1}
.peraturan-toolbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;font-size:14px;color:#6b6f6b}
.peraturan-toolbar strong{color:#1f2a1f}
.doc-card{background:#fff;border:1px solid #e3ded0;border-radius:10px;padding:20px 24px;margin-bottom:16px;display:flex;justify-content:space-between;align-items:flex-start;gap:16px;transition:box-shadow .15s ease}
.doc-card:hover{box-shadow:0 8px 24px rgba(31,42,31,.08)}
.doc-card-main{flex:1}
.doc-card-meta{display:flex;align-items:center;gap:8px;margin-bottom:8px;font-size:12px;color:#6b6f6b}
.doc-card-badge{display:inline-block;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.03em}
.doc-card-badge.is-berlaku{background:#e6f4ea;color:#1e7a34}
.doc-card-badge.is-cabut{background:#fbe7e7;color:#c0392b}
.doc-card h3{font-size:17px;font-weight:700;margin:0 0 8px;line-height:1.4}
.doc-card h3 a{color:#1f2a1f}.doc-card h3 a:hover{color:#1e4620;text-decoration:underline}
.doc-card-info{font-size:13px;color:#6b6f6b}
.doc-card-info span{margin-right:16px}
.doc-card-detail{align-self:center;display:inline-flex;align-items:center;gap:4px;background:#f7f4ec;border:1px solid #e3ded0;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:600;color:#1f2a1f;white-space:nowrap;transition:background .15s ease}
.doc-card-detail:hover{background:#e3ded0;text-decoration:none;color:#1f2a1f}
.peraturan-empty{text-align:center;padding:60px 20px;color:#6b6f6b;background:#fff;border:1px dashed #e3ded0;border-radius:10px}
.peraturan-pagination{display:flex;justify-content:center;align-items:center;gap:6px;margin-top:28px}
.peraturan-pagination a,.peraturan-pagination span{display:inline-flex;align-items:center;justify-content:center;min-width:36px;height:36px;border-radius:50%;font-size:14px;color:#1f2a1f}
.peraturan-pagination a.active{background:#1e4620;color:#fff}
.peraturan-pagination a:hover:not(.active){background:#e3ded0}
@media(max-width:900px){.peraturan-content{flex-direction:column}.peraturan-filter{width:100%}.peraturan-hero{padding:28px 24px 36px}.peraturan-hero h1{font-size:28px}.doc-card{flex-direction:column}}
');
?>

<section class="peraturan-hero">
    <div class="breadcrumb"><a href="<?= Url::to(['/site/index']) ?>">Beranda</a> &nbsp;&gt;&nbsp;<span class="current">Monografi</span></div>
    <h1>Monografi Hukum</h1>
    <p>Koleksi buku, majalah, dan jurnal hukum dalam lingkungan UPN Veteran Jawa Timur.</p>
</section>

<section class="peraturan-search">
    <form action="<?= Url::to(['/dokumen/monografi']) ?>" method="get" style="display:flex;gap:12px;width:100%;">
        <div class="peraturan-search-input">
            <i class="bi bi-search" aria-hidden="true"></i>
            <input type="text" name="DokumenSearch[judul]" placeholder="Cari monografi..." value="<?= Html::encode($currentKeyword) ?>">
        </div>
        <button type="submit" class="peraturan-search-btn">Cari</button>
    </form>
</section>

<nav class="peraturan-tabs">
    <a href="<?= Url::to(['/dokumen/peraturan']) ?>">Peraturan</a>
    <a href="<?= Url::to(['/dokumen/putusan']) ?>">Yurisprudensi</a>
    <a href="<?= Url::to(['/dokumen/monografi']) ?>" class="active">Monografi</a>
    <a href="<?= Url::to(['/dokumen/artikel']) ?>">Koleksi Digital</a>
</nav>

<div class="peraturan-content">
    <aside class="peraturan-filter">
        <h3>Filter</h3>
        <form action="<?= Url::to(['/dokumen/monografi']) ?>" method="get">
            <div class="peraturan-filter-group">
                <label class="group-title">Jenis Monografi</label>
                <select name="DokumenSearch[jenis_peraturan]">
                    <?php foreach ($jenisList as $val => $label): ?>
                        <option value="<?= Html::encode($val) ?>" <?= $currentJenis === $val ? 'selected' : '' ?>><?= Html::encode($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="peraturan-filter-group">
                <label class="group-title">Tahun</label>
                <select name="DokumenSearch[tahun_terbit]">
                    <option value="">Semua Tahun</option>
                    <?php foreach ($tahunList as $val => $label): ?>
                        <option value="<?= Html::encode($val) ?>" <?= (string)$currentTahun === (string)$val ? 'selected' : '' ?>><?= Html::encode($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="peraturan-filter-group">
                <label class="group-title">Status</label>
                <select name="DokumenSearch[status]">
                    <?php foreach ($statusList as $val => $label): ?>
                        <option value="<?= Html::encode($val) ?>" <?= $currentStatus === $val ? 'selected' : '' ?>><?= Html::encode($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="peraturan-filter-btn">Terapkan Filter</button>
        </form>
    </aside>

    <section class="peraturan-results">
        <div class="peraturan-toolbar">
            <span>Menampilkan <strong><?= number_format($from) ?>-<?= number_format($to) ?></strong> dari <strong><?= number_format($totalCount) ?></strong> monografi</span>
        </div>
        <?php if ($totalCount === 0): ?>
            <div class="peraturan-empty">
                <i class="bi bi-inbox" style="font-size:48px;display:block;margin-bottom:16px;color:#ccc;" aria-hidden="true"></i>
                Tidak ada monografi ditemukan.
            </div>
        <?php else: ?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['tag' => false],
                'itemOptions' => ['tag' => false],
                'itemView' => '_data-peraturan',
                'summary' => false,
                'pager' => ['options' => ['class' => 'peraturan-pagination'], 'activePageCssClass' => 'active', 'disabledPageCssClass' => 'disabled', 'prevPageLabel' => '<i class="bi bi-chevron-left"></i>', 'nextPageLabel' => '<i class="bi bi-chevron-right"></i>'],
            ]) ?>
        <?php endif; ?>
    </section>
</div>
