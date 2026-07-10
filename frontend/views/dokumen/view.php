<?php

use frontend\models\DataLampiran;
use frontend\models\DataStatus;
use frontend\models\DokumenTerkait;
use frontend\models\PeraturanTerkait;
use yii\helpers\Html;
use yii\helpers\Url;

<<<<<<< HEAD
$this->title = $model->judul ?: 'Detail Produk Hukum';
=======
/* @var $this yii\web\View */
/* @var $model frontend\models\Dokumen */

$this->title = $model->judul ?: 'Detail Produk Hukum';
$desc = mb_strimwidth(strip_tags($model->abstrak ?: $model->judul), 0, 160, '...');
$this->registerMetaTag(['name' => 'description', 'content' => $desc]);

>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
$lampiran = DataLampiran::find()->where(['id_dokumen' => $model->id])->one();
$relatedRules = PeraturanTerkait::find()->where(['id_dokumen' => $model->id])->limit(3)->all();
$relatedDocs = DokumenTerkait::find()->where(['id_dokumen' => $model->id])->limit(3)->all();
$statusHistory = DataStatus::find()->where(['id_dokumen' => $model->id])->limit(3)->all();
$documentUrl = $lampiran ? Url::to(['/dokumen/download', 'id' => $lampiran->dokumen_lampiran, 'docId' => $model->id]) : null;
$status = $model->status ?: 'Masih Berlaku';
?>

<section class="document-detail-page">
    <div class="container document-detail-shell">
<<<<<<< HEAD
        <aside class="catalog-rail">
            <div class="catalog-rail__brand"><i class="bi bi-hammer" aria-hidden="true"></i><div><strong>Katalog Hukum</strong><small>JDIH Portal</small></div></div>
            <nav class="catalog-menu">
                <?= Html::a('<i class="bi bi-grid" aria-hidden="true"></i> Dashboard', ['/site/index']) ?>
                <?= Html::a('<i class="bi bi-hammer" aria-hidden="true"></i> Peraturan', ['/dokumen/peraturan'], ['class' => 'is-active']) ?>
                <?= Html::a('<i class="bi bi-bank" aria-hidden="true"></i> Yurisprudensi', ['/dokumen/putusan']) ?>
                <?= Html::a('<i class="bi bi-book" aria-hidden="true"></i> Monografi', ['/dokumen/monografi']) ?>
            </nav>
        </aside>
        <main class="document-detail-main">
            <div class="document-detail-hero">
                <div>
                    <p><?= Html::a('Beranda', ['/site/index']) ?> > <?= Html::a('Peraturan', ['/dokumen/peraturan']) ?> > <?= Html::encode($model->singkatan_jenis ?: 'Produk Hukum') ?></p>
                    <h1><?= Html::encode($model->judul) ?></h1>
                    <div class="catalog-doc-card__meta"><span class="catalog-doc-card__status"><?= Html::encode($status) ?></span><span><?= Html::encode($model->bentuk_peraturan ?: 'Rektorat') ?></span><span><?= Html::encode($model->bidang_hukum ?: 'Saintek') ?></span></div>
                </div>
                <div class="document-actions-card">
                    <?php if ($documentUrl): ?><?= Html::a('<i class="bi bi-download" aria-hidden="true"></i> Unduh Salinan Resmi', $documentUrl, ['class' => 'document-primary-action']) ?><?php endif; ?>
=======
        <aside class="catalog-rail document-detail-rail">
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
        </aside>

        <main class="document-detail-main">
            <div class="document-breadcrumb">
                <?= Html::a('Beranda', ['/site/index']) ?> <span>></span>
                <?= Html::a('Peraturan', ['/dokumen/peraturan']) ?> <span>></span>
                <strong><?= Html::encode($model->singkatan_jenis ?: 'Produk Hukum') ?></strong>
            </div>

            <div class="document-detail-hero">
                <div>
                    <h1><?= Html::encode($model->judul) ?></h1>
                    <div class="document-tags">
                        <span><i class="bi bi-check-circle-fill" aria-hidden="true"></i> <?= Html::encode($status) ?></span>
                        <span><?= Html::encode($model->bentuk_peraturan ?: 'Rektorat') ?></span>
                        <span><?= Html::encode($model->bidang_hukum ?: 'Saintek') ?></span>
                    </div>
                </div>

                <div class="document-actions-card">
                    <?php if ($documentUrl): ?>
                        <?= Html::a('<i class="bi bi-download" aria-hidden="true"></i> Unduh Salinan Resmi', $documentUrl, ['class' => 'document-primary-action']) ?>
                    <?php else: ?>
                        <button type="button" class="document-primary-action" disabled><i class="bi bi-download" aria-hidden="true"></i> Salinan Belum Tersedia</button>
                    <?php endif; ?>
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
                    <?= Html::a('<i class="bi bi-share" aria-hidden="true"></i> Bagikan Dokumen', '#', ['class' => 'document-secondary-action']) ?>
                    <?= Html::a('<i class="bi bi-magic" aria-hidden="true"></i> Lihat Ringkasan AI', '#', ['class' => 'document-ai-action']) ?>
                </div>
            </div>
<<<<<<< HEAD
            <div class="document-detail-grid">
                <section class="document-viewer">
                    <div class="document-viewer__toolbar">
                        <button type="button"><i class="bi bi-zoom-in"></i></button><button type="button"><i class="bi bi-zoom-out"></i></button><span>Halaman 1 dari 42</span><button type="button"><i class="bi bi-printer"></i></button><button type="button"><i class="bi bi-fullscreen"></i></button>
                    </div>
                    <div class="document-page-preview">
                        <article>
=======

            <div class="document-detail-grid">
                <section class="document-viewer">
                    <div class="document-viewer__toolbar">
                        <button type="button" title="Perbesar"><i class="bi bi-zoom-in" aria-hidden="true"></i></button>
                        <button type="button" title="Perkecil"><i class="bi bi-zoom-out" aria-hidden="true"></i></button>
                        <span>Halaman 1 dari 42</span>
                        <button type="button" title="Cetak"><i class="bi bi-printer" aria-hidden="true"></i></button>
                        <button type="button" title="Fullscreen"><i class="bi bi-fullscreen" aria-hidden="true"></i></button>
                    </div>
                    <div class="document-page-preview">
                        <article>
                            <div class="document-page-seal"><i class="bi bi-bank2" aria-hidden="true"></i></div>
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
                            <h2><?= Html::encode($model->bentuk_peraturan ?: 'PERATURAN REKTOR') ?></h2>
                            <h3>UNIVERSITAS PEMBANGUNAN NASIONAL "VETERAN" JAWA TIMUR</h3>
                            <strong>Nomor <?= Html::encode($model->nomor_peraturan ?: '-') ?></strong>
                            <hr>
                            <p>TENTANG</p>
                            <h4><?= Html::encode($model->judul) ?></h4>
                            <em>Menimbang:</em>
                            <p>Bahwa untuk menjamin kepastian hukum dalam penyelenggaraan pendidikan dan tata kelola universitas...</p>
                        </article>
                    </div>
                </section>
<<<<<<< HEAD
                <aside class="document-side">
                    <section class="document-info-card">
                        <h2><i class="bi bi-info-circle"></i> Informasi Detail</h2>
=======

                <aside class="document-side">
                    <section class="document-info-card">
                        <h2><i class="bi bi-info-circle" aria-hidden="true"></i> Informasi Detail</h2>
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
                        <dl>
                            <div><dt>Nomor Dokumen</dt><dd><?= Html::encode($model->nomor_peraturan ?: '-') ?></dd></div>
                            <div><dt>Tahun</dt><dd><?= Html::encode($model->tahun_terbit ?: '-') ?></dd></div>
                            <div><dt>Tgl Pengesahan</dt><dd><?= Html::encode($model->tanggal_penetapan ? $model->getTanggal($model->tanggal_penetapan) : '-') ?></dd></div>
<<<<<<< HEAD
                            <div><dt>Status</dt><dd><?= Html::encode($status) ?></dd></div>
                            <div><dt>Abstraksi</dt><dd><?= $model->abstrak ? Html::a('Lihat Ringkasan', ['/dokumen/download', 'id' => $model->abstrak]) : Html::a('Lihat Ringkasan AI', '#') ?></dd></div>
                        </dl>
                    </section>
                    <section class="document-related-card">
                        <h2>Produk Hukum Terkait</h2>
                        <?php foreach ($relatedRules as $related): ?><p><?= Html::a(Html::encode($related->getJudul($related->peraturan_terkait)), ['/dokumen/view', 'id' => $related->peraturan_terkait]) ?></p><?php endforeach; ?>
                        <?php foreach ($relatedDocs as $relatedDoc): ?><p><?= Html::encode($relatedDoc->document_terkait) ?></p><?php endforeach; ?>
                        <?php if (!$relatedRules && !$relatedDocs): ?><p>Belum ada produk hukum terkait.</p><?php endif; ?>
                    </section>
                    <section class="document-history-card">
                        <h2>Riwayat Perubahan</h2>
                        <ol>
                            <?php if ($statusHistory): foreach ($statusHistory as $history): ?><li><strong><?= Html::encode($model->tahun_terbit ?: date('Y')) ?></strong><span><?= Html::encode($history->status_peraturan ?: 'Pembaruan status dokumen') ?></span></li><?php endforeach; else: ?>
                            <li><strong><?= Html::encode($model->tahun_terbit ?: date('Y')) ?> - Terbaru</strong><span>Pengesahan dokumen</span></li>
=======
                            <div><dt>Status</dt><dd class="is-valid"><i class="bi bi-patch-check-fill" aria-hidden="true"></i> <?= Html::encode($status) ?></dd></div>
                            <div><dt>Abstraksi</dt><dd><?= $model->abstrak ? Html::a('Lihat Ringkasan', ['/dokumen/download', 'id' => $model->abstrak]) : Html::a('Lihat Ringkasan AI', '#') ?></dd></div>
                        </dl>
                    </section>

                    <section class="document-related-card">
                        <h2><i class="bi bi-link-45deg" aria-hidden="true"></i> Produk Hukum Terkait</h2>
                        <?php if ($relatedRules || $relatedDocs): ?>
                            <?php foreach ($relatedRules as $related): ?>
                                <article>
                                    <strong><?= Html::a(Html::encode($related->getJudul($related->peraturan_terkait)), ['/dokumen/view', 'id' => $related->peraturan_terkait]) ?></strong>
                                    <span><?= Html::encode($related->status_perter ?: 'Terkait dengan dokumen ini') ?></span>
                                </article>
                            <?php endforeach; ?>
                            <?php foreach ($relatedDocs as $relatedDoc): ?>
                                <article>
                                    <strong><?= Html::encode($relatedDoc->document_terkait) ?></strong>
                                    <span>Lampiran terkait</span>
                                </article>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Belum ada produk hukum terkait.</p>
                        <?php endif; ?>
                        <?= Html::a('Lihat Semua Kaitan', ['/dokumen/index'], ['class' => 'document-related-card__link']) ?>
                    </section>

                    <section class="document-history-card">
                        <h2><i class="bi bi-clock-history" aria-hidden="true"></i> Riwayat Perubahan</h2>
                        <ol>
                            <?php if ($statusHistory): ?>
                                <?php foreach ($statusHistory as $index => $history): ?>
                                    <li class="<?= $index === 0 ? 'is-current' : '' ?>">
                                        <strong><?= Html::encode($model->tahun_terbit ?: date('Y')) ?></strong>
                                        <span><?= Html::encode($history->status_peraturan ?: 'Pembaruan status dokumen') ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="is-current"><strong><?= Html::encode($model->tahun_terbit ?: date('Y')) ?> - Terbaru</strong><span>Pengesahan dokumen</span></li>
                                <li><strong><?= Html::encode(((int) ($model->tahun_terbit ?: date('Y'))) - 1) ?></strong><span>Revisi standar akademik</span></li>
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
                            <?php endif; ?>
                        </ol>
                    </section>
                </aside>
            </div>
        </main>
    </div>
</section>
<<<<<<< HEAD
=======

<style>
.document-detail-page{background:#f8f7f2;min-height:100vh}
.document-detail-shell{display:grid;grid-template-columns:280px 1fr;gap:48px}
.document-detail-rail{padding-top:36px}
.document-detail-main{padding:28px 0 96px}
.document-breadcrumb{margin:0 0 28px;color:#6b7168;font-weight:700}
.document-breadcrumb a{color:#6b7168;text-decoration:none}.document-breadcrumb span{margin:0 8px}.document-breadcrumb strong{color:#064e0b}
.document-detail-hero{display:grid;grid-template-columns:1fr 320px;gap:32px;align-items:start;margin-bottom:72px}
.document-detail-hero h1{margin:0;color:#064e0b;font-family:Georgia,"Times New Roman",serif;font-size:clamp(40px,5vw,66px);line-height:1.12;letter-spacing:0}
.document-tags{display:flex;flex-wrap:wrap;gap:14px;margin-top:28px}.document-tags span{padding:9px 18px;border-radius:999px;background:#e9ebe5;color:#6b7168;font-weight:800}.document-tags span:first-child{background:#2d6727;color:#fff}
.document-actions-card{display:grid;gap:12px;padding:26px;border:1px solid #d8dbd2;border-radius:14px;background:#fff;box-shadow:0 12px 28px rgba(30,36,28,.06)}
.document-primary-action,.document-secondary-action,.document-ai-action{display:flex;justify-content:center;align-items:center;gap:10px;border-radius:8px;padding:15px 16px;font-weight:900;text-decoration:none;border:2px solid #064e0b}
.document-primary-action{background:#064e0b;color:#fff}.document-primary-action:hover{color:#fff;text-decoration:none;background:#0b5d1e}
.document-secondary-action{background:#fff;color:#064e0b}.document-secondary-action:hover{color:#064e0b;text-decoration:none}
.document-ai-action{border-color:#ffd200;background:#ffd200;color:#064e0b}.document-ai-action:hover{color:#064e0b;text-decoration:none}
.document-detail-grid{display:grid;grid-template-columns:minmax(0,1fr) 330px;gap:32px;align-items:start}
.document-viewer{border:1px solid #d8dbd2;border-radius:14px;overflow:hidden;background:#fff;box-shadow:0 18px 42px rgba(30,36,28,.1)}
.document-viewer__toolbar{height:68px;display:flex;align-items:center;gap:22px;padding:0 24px;background:#f2f1ec;border-bottom:1px solid #d8dbd2}.document-viewer__toolbar button{border:0;background:transparent;font-size:20px;color:#1e241c}.document-viewer__toolbar span{margin-right:auto;font-weight:900;color:#4d554b}
.document-page-preview{min-height:720px;padding:40px;background:#cfd3cf;display:flex;justify-content:center;align-items:flex-start}
.document-page-preview article{width:min(100%,620px);min-height:640px;background:#fff;padding:90px 70px;text-align:center;box-shadow:0 14px 28px rgba(0,0,0,.18);color:#1e241c}.document-page-preview h2,.document-page-preview h3,.document-page-preview h4{letter-spacing:.08em;line-height:1.5}.document-page-preview hr{width:90px;border-top:3px solid #064e0b}.document-page-seal{width:92px;height:64px;margin:0 auto 48px;background:#e9ebe5;color:#064e0b;display:flex;align-items:center;justify-content:center;font-size:34px}
.document-side{display:grid;gap:28px}.document-info-card,.document-related-card{padding:26px;border:1px solid #d8dbd2;border-radius:14px;background:#fff}.document-info-card h2,.document-related-card h2{margin:0 0 22px;color:#064e0b;font-family:Georgia,"Times New Roman",serif;font-size:26px;letter-spacing:0}
.document-info-card dl{margin:0}.document-info-card dl div{display:grid;grid-template-columns:1fr 1.2fr;gap:18px;padding:16px 0;border-bottom:1px solid #d8dbd2}.document-info-card dt{color:#6b7168;font-weight:700}.document-info-card dd{margin:0;text-align:right;color:#1e241c;font-weight:900}.document-info-card dd.is-valid{color:#064e0b}
.document-related-card article{padding:14px 0}.document-related-card article+article{border-top:1px solid #edf0e9}.document-related-card strong,.document-related-card a{display:block;color:#1e241c;text-decoration:none}.document-related-card span,.document-related-card p{color:#6b7168}.document-related-card__link{display:block;margin-top:18px;color:#064e0b;font-weight:900;text-decoration:none}
.document-history-card{padding:28px;border-radius:14px;background:#064e0b;color:#fff;overflow:hidden}.document-history-card h2{margin:0 0 22px;color:#fff;font-family:Georgia,"Times New Roman",serif;font-size:28px;letter-spacing:0}.document-history-card ol{margin:0;padding-left:24px}.document-history-card li{padding:0 0 20px;color:rgba(255,255,255,.55)}.document-history-card li.is-current{color:#ffd200}.document-history-card strong{display:block;color:#fff}.document-history-card span{color:rgba(255,255,255,.74)}
@media(max-width:991.98px){.document-detail-shell,.document-detail-hero,.document-detail-grid{grid-template-columns:1fr}.document-detail-rail{display:none}.document-actions-card{max-width:none}.document-side{grid-template-columns:1fr 1fr}.document-history-card{grid-column:1/-1}}
@media(max-width:575.98px){.document-side{grid-template-columns:1fr}.document-page-preview{min-height:520px;padding:22px}.document-page-preview article{min-height:480px;padding:50px 26px}.document-info-card dl div{grid-template-columns:1fr}.document-info-card dd{text-align:left}}
</style>
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
