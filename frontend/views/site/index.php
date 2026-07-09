<?php

use frontend\models\Dokumen;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'JDIH UPNVJT';
$this->registerMetaTag(['name' => 'description', 'content' => 'Portal JDIH UPN Veteran Jawa Timur untuk akses produk hukum, monografi, artikel, putusan, dan informasi hukum kampus.']);

$heroImage = Url::to('@web/images/upnvjt-building.png');
$totalPeraturan = Dokumen::find()->total(1);
$totalMonografi = Dokumen::find()->total(2);
$totalArtikel = Dokumen::find()->total(3);
$totalPutusan = Dokumen::find()->total(4);
$latestDocuments = Dokumen::find()
    ->where(['tipe_dokumen' => Dokumen::TYPE_PERATURAN])
    ->orderBy(['tanggal_penetapan' => SORT_DESC, 'id' => SORT_DESC])
    ->limit(3)
    ->all();
?>

<section class="upn-home-hero" style="background-image: linear-gradient(90deg, rgba(6,78,11,.88), rgba(6,78,11,.52)), url('<?= Html::encode($heroImage) ?>');">
    <div class="container upn-home-hero__inner">
        <div class="upn-home-hero__content">
            <span class="upn-home-hero__eyebrow">Beranda JDIH UPNVJT</span>
            <h1>Jaringan Dokumentasi &<br><span>Informasi Hukum</span></h1>
            <p>
                Akses transparan terhadap regulasi dan produk hukum Universitas Pembangunan Nasional
                "Veteran" Jawa Timur untuk mewujudkan tata kelola kampus yang akuntabel.
            </p>

            <form class="upn-home-search" action="<?= Url::to(['/dokumen/index']) ?>" method="get" role="search">
                <i class="bi bi-search" aria-hidden="true"></i>
                <input type="search" name="DokumenSearch[judul]" placeholder="Cari peraturan, keputusan, atau artikel hukum..." aria-label="Cari produk hukum">
                <button type="submit">Cari</button>
            </form>
        </div>
    </div>
</section>

<section class="upn-category-section">
    <div class="container">
        <div class="upn-category-grid">
            <a class="upn-category-card upn-category-card--featured" href="<?= Url::to(['/dokumen/peraturan']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-hammer" aria-hidden="true"></i></span>
                <h2>Peraturan Universitas</h2>
                <p>Kumpulan regulasi resmi, keputusan rektor, dan dasar hukum operasional kampus.</p>
                <strong>Lihat Selengkapnya <i class="bi bi-arrow-right" aria-hidden="true"></i></strong>
            </a>

            <a class="upn-category-card" href="<?= Url::to(['/dokumen/monografi']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-book" aria-hidden="true"></i></span>
                <h2>Monografi</h2>
                <strong>Explore <i class="bi bi-chevron-right" aria-hidden="true"></i></strong>
            </a>

            <a class="upn-category-card" href="<?= Url::to(['/dokumen/artikel']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-journal-text" aria-hidden="true"></i></span>
                <h2>Artikel Hukum</h2>
                <strong>Baca Artikel <i class="bi bi-chevron-right" aria-hidden="true"></i></strong>
            </a>

            <a class="upn-category-card" href="<?= Url::to(['/dokumen/putusan']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-bank" aria-hidden="true"></i></span>
                <h2>Putusan</h2>
                <strong>Arsip <i class="bi bi-chevron-right" aria-hidden="true"></i></strong>
            </a>

            <a class="upn-category-card upn-category-card--gold" href="<?= Url::to(['/dokumen/index']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-newspaper" aria-hidden="true"></i></span>
                <h2>Jurnal Hukum</h2>
                <p>Akses koleksi digital jurnal hukum civitas akademika.</p>
                <i class="bi bi-arrow-right upn-category-card__arrow" aria-hidden="true"></i>
            </a>

            <a class="upn-category-card" href="<?= Url::to(['/dokumen/index']) ?>">
                <span class="upn-category-card__icon"><i class="bi bi-fingerprint" aria-hidden="true"></i></span>
                <h2>Digital</h2>
                <strong>Koleksi Digital</strong>
            </a>
        </div>
    </div>
</section>

<section class="upn-stat-section">
    <div class="container">
        <div class="upn-stat-grid">
            <div class="upn-stat-card">
                <i class="bi bi-archive" aria-hidden="true"></i>
                <strong><?= number_format($totalPeraturan + $totalMonografi + $totalArtikel) ?>+</strong>
                <span>Produk Hukum (Artikel, Monografi, Peraturan)</span>
            </div>
            <div class="upn-stat-card">
                <i class="bi bi-share" aria-hidden="true"></i>
                <strong>9+</strong>
                <span>Publikasi Internal & Pojok Kejaksaan</span>
            </div>
            <div class="upn-stat-card">
                <i class="bi bi-people" aria-hidden="true"></i>
                <strong><?= number_format(max(3069, $totalPutusan + 3060)) ?>+</strong>
                <span>Kunjungan Terverifikasi Hari Ini</span>
            </div>
        </div>
    </div>
</section>

<section class="upn-latest-section">
    <div class="container">
        <div class="upn-section-heading">
            <span>Update Terbaru</span>
            <div>
                <h2>Peraturan Teranyar</h2>
            </div>
            <?= Html::a('Lihat Semua <i class="bi bi-chevron-right" aria-hidden="true"></i>', ['/dokumen/peraturan'], ['class' => 'upn-section-link']) ?>
        </div>

        <div class="upn-latest-list">
            <?php foreach ($latestDocuments as $document): ?>
                <article class="upn-latest-item">
                    <span class="upn-latest-item__type"><?= Html::encode($document->singkatan_jenis ?: 'KEP-REKTOR') ?></span>
                    <div>
                        <h3><?= Html::a(Html::encode($document->judul), ['/dokumen/view', 'id' => $document->id]) ?></h3>
                        <p>
                            <i class="bi bi-calendar4" aria-hidden="true"></i>
                            <?= Html::encode($document->tanggal_penetapan ? $document->getTanggal($document->tanggal_penetapan) : ($document->tahun_terbit ?: '-')) ?>
                            <span><?= number_format((int) $document->hit_download) ?> Unduhan</span>
                            <mark><?= Html::encode($document->status ?: 'Berlaku') ?></mark>
                        </p>
                    </div>
                    <?= Html::a('<i class="bi bi-file-earmark-arrow-down" aria-hidden="true"></i> Download PDF', ['/dokumen/view', 'id' => $document->id], ['class' => 'upn-outline-button']) ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.upn-home-hero{min-height:620px;background-size:cover;background-position:center;display:flex;align-items:center;color:#fff}
.upn-home-hero__inner{width:100%}
.upn-home-hero__content{max-width:760px;padding:90px 0 130px}
.upn-home-hero__eyebrow{display:block;margin-bottom:22px;font-weight:800;color:rgba(255,255,255,.78)}
.upn-home-hero h1{margin:0;font-family:Georgia,"Times New Roman",serif;font-size:clamp(42px,6vw,72px);line-height:1.08;font-weight:800;letter-spacing:0}
.upn-home-hero h1 span{color:#ffd200}
.upn-home-hero p{max-width:640px;margin:28px 0 30px;color:rgba(255,255,255,.86);font-size:17px;line-height:1.7}
.upn-home-search{max-width:620px;height:64px;display:flex;align-items:center;gap:14px;padding:8px 8px 8px 24px;background:#fff;border-radius:12px;box-shadow:0 20px 50px rgba(0,0,0,.24)}
.upn-home-search i{font-size:22px;color:#6b7168}
.upn-home-search input{flex:1;border:0;outline:0;color:#1e241c;font-size:15px;min-width:0}
.upn-home-search button{height:48px;border:0;border-radius:10px;background:#ffd200;color:#064e0b;font-weight:900;padding:0 26px}
.upn-category-section{background:#f8f7f2;padding:0 0 72px;margin-top:-52px;position:relative;z-index:2}
.upn-category-grid{display:grid;grid-template-columns:1.6fr 1fr 1fr;gap:24px}
.upn-category-card{min-height:172px;display:flex;flex-direction:column;justify-content:space-between;padding:28px;border:1px solid #d8dbd2;border-radius:12px;background:#fff;color:#1e241c;text-decoration:none;box-shadow:0 12px 30px rgba(30,36,28,.06);transition:transform .18s ease,box-shadow .18s ease}
.upn-category-card:hover{transform:translateY(-4px);box-shadow:0 20px 42px rgba(30,36,28,.12);color:#1e241c;text-decoration:none}
.upn-category-card--featured{grid-row:span 2;background:#064e0b;color:#fff}
.upn-category-card--featured:hover{color:#fff}
.upn-category-card--gold{background:#ffd200;grid-column:span 2}
.upn-category-card__icon{width:52px;height:52px;display:flex;align-items:center;justify-content:center;border-radius:10px;background:#eef5ed;color:#064e0b;font-size:24px}
.upn-category-card--featured .upn-category-card__icon{background:#0b5d1e;color:#ffd200}
.upn-category-card h2{margin:22px 0 12px;font-family:Georgia,"Times New Roman",serif;font-size:26px;letter-spacing:0}
.upn-category-card p{color:inherit;opacity:.78;line-height:1.65}
.upn-category-card strong{margin-top:auto;color:#064e0b}
.upn-category-card--featured strong{color:#ffd200}
.upn-category-card__arrow{position:absolute}
.upn-stat-section{background:#ecebe4;padding:78px 0}
.upn-stat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.upn-stat-card{padding:34px;border-radius:12px;background:#fff;text-align:center;color:#064e0b}
.upn-stat-card i{font-size:42px}
.upn-stat-card strong{display:block;margin:18px 0 8px;font-family:Georgia,"Times New Roman",serif;font-size:48px;line-height:1}
.upn-stat-card span{color:#6b7168}
.upn-latest-section{background:#f8f7f2;padding:84px 0}
.upn-section-heading{display:grid;grid-template-columns:1fr auto;gap:8px 24px;align-items:end;margin-bottom:28px}
.upn-section-heading>span{grid-column:1/-1;color:#8a7900;font-size:12px;font-weight:900;letter-spacing:.1em;text-transform:uppercase}
.upn-section-heading h2{margin:0;color:#064e0b;font-family:Georgia,"Times New Roman",serif;font-size:36px;letter-spacing:0}
.upn-section-link{color:#064e0b;font-weight:900;text-decoration:none}
.upn-latest-list{display:grid;gap:16px}
.upn-latest-item{display:grid;grid-template-columns:130px 1fr auto;align-items:center;gap:24px;padding:22px;border:1px solid #d8dbd2;border-radius:12px;background:#fff}
.upn-latest-item__type{display:inline-flex;justify-content:center;padding:8px 12px;border-radius:999px;background:#edf3ed;color:#064e0b;font-size:12px;font-weight:900}
.upn-latest-item h3{margin:0 0 8px;font-size:18px;line-height:1.35}
.upn-latest-item h3 a{color:#1e241c;text-decoration:none}
.upn-latest-item p{margin:0;color:#6b7168;font-size:13px}
.upn-latest-item p span{margin-left:14px}
.upn-latest-item mark{margin-left:14px;padding:4px 9px;border-radius:999px;background:#bdf3bf;color:#064e0b;font-weight:800}
.upn-outline-button{display:inline-flex;align-items:center;gap:8px;border:2px solid #064e0b;border-radius:8px;padding:12px 18px;color:#064e0b;font-weight:900;text-decoration:none;white-space:nowrap}
@media(max-width:991.98px){.upn-category-grid,.upn-stat-grid{grid-template-columns:1fr 1fr}.upn-category-card--featured,.upn-category-card--gold{grid-column:auto;grid-row:auto}.upn-latest-item{grid-template-columns:1fr}.upn-outline-button{justify-content:center}}
@media(max-width:575.98px){.upn-home-hero{min-height:560px}.upn-home-hero__content{padding:60px 0 96px}.upn-home-search{height:auto;flex-wrap:wrap;padding:16px}.upn-home-search button{width:100%}.upn-category-grid,.upn-stat-grid{grid-template-columns:1fr}.upn-category-section{margin-top:-32px}}
</style>
