<?php

use frontend\models\DataLampiran;
use frontend\models\DataStatus;
use frontend\models\DokumenTerkait;
use frontend\models\PeraturanTerkait;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->judul ?: 'Detail Produk Hukum';
$lampiran = DataLampiran::find()->where(['id_dokumen' => $model->id])->one();
$relatedRules = PeraturanTerkait::find()->where(['id_dokumen' => $model->id])->limit(3)->all();
$relatedDocs = DokumenTerkait::find()->where(['id_dokumen' => $model->id])->limit(3)->all();
$statusHistory = DataStatus::find()->where(['id_dokumen' => $model->id])->limit(3)->all();
$documentUrl = $lampiran ? Url::to(['/dokumen/download', 'id' => $lampiran->dokumen_lampiran, 'docId' => $model->id]) : null;
$status = $model->status ?: 'Masih Berlaku';
?>

<section class="document-detail-page">
    <div class="container document-detail-shell">
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
                    <?= Html::a('<i class="bi bi-share" aria-hidden="true"></i> Bagikan Dokumen', '#', ['class' => 'document-secondary-action']) ?>
                    <?= Html::a('<i class="bi bi-magic" aria-hidden="true"></i> Lihat Ringkasan AI', '#', ['class' => 'document-ai-action']) ?>
                </div>
            </div>
            <div class="document-detail-grid">
                <section class="document-viewer">
                    <div class="document-viewer__toolbar">
                        <button type="button"><i class="bi bi-zoom-in"></i></button><button type="button"><i class="bi bi-zoom-out"></i></button><span>Halaman 1 dari 42</span><button type="button"><i class="bi bi-printer"></i></button><button type="button"><i class="bi bi-fullscreen"></i></button>
                    </div>
                    <div class="document-page-preview">
                        <article>
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
                <aside class="document-side">
                    <section class="document-info-card">
                        <h2><i class="bi bi-info-circle"></i> Informasi Detail</h2>
                        <dl>
                            <div><dt>Nomor Dokumen</dt><dd><?= Html::encode($model->nomor_peraturan ?: '-') ?></dd></div>
                            <div><dt>Tahun</dt><dd><?= Html::encode($model->tahun_terbit ?: '-') ?></dd></div>
                            <div><dt>Tgl Pengesahan</dt><dd><?= Html::encode($model->tanggal_penetapan ? $model->getTanggal($model->tanggal_penetapan) : '-') ?></dd></div>
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
                            <?php endif; ?>
                        </ol>
                    </section>
                </aside>
            </div>
        </main>
    </div>
</section>
