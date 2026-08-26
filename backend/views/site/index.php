<?php

use backend\models\Peraturan;
use yii\helpers\Html;

/* @var $visitorTrend array */
/* @var $surveyAggregate array */
/* @var $recentDocuments array */

$this->title = Yii::t('app', 'Dashboard');
$totalPeraturan = Peraturan::find()->where(['tipe_dokumen' => 1])->count();
$totalMonografi = Peraturan::find()->where(['tipe_dokumen' => 2])->count();
$totalArtikel = Peraturan::find()->where(['tipe_dokumen' => 3])->count();
$totalPutusan = Peraturan::find()->where(['tipe_dokumen' => 4])->count();
?>

<div class="jdih-dashboard">
    <div class="jdih-dashboard__head"><div><h1>Dashboard Overview</h1><p>Selamat datang kembali, Admin JDIH.</p></div><div><strong>Home</strong> / Dashboard</div></div>
    <div class="jdih-stat-grid-admin">
        <article class="jdih-stat-box is-blue"><div><strong><?= number_format($totalPeraturan) ?></strong><span>Peraturan</span></div><i class="fa fa-shield"></i><?= Html::a('More info <i class="fa fa-arrow-circle-o-right"></i>', ['peraturan/index']) ?></article>
        <article class="jdih-stat-box is-green"><div><strong><?= number_format($totalMonografi) ?></strong><span>Monografi</span></div><i class="fa fa-book"></i><?= Html::a('More info <i class="fa fa-arrow-circle-o-right"></i>', ['monografi/index']) ?></article>
        <article class="jdih-stat-box is-orange"><div><strong><?= number_format($totalArtikel) ?></strong><span>Artikel</span></div><i class="fa fa-newspaper-o"></i><?= Html::a('More info <i class="fa fa-arrow-circle-o-right"></i>', ['artikel/index']) ?></article>
        <article class="jdih-stat-box is-red"><div><strong><?= number_format($totalPutusan) ?></strong><span>Putusan</span></div><i class="fa fa-balance-scale"></i><?= Html::a('More info <i class="fa fa-arrow-circle-o-right"></i>', ['putusan/index']) ?></article>
    </div>
    <div class="jdih-admin-grid">
        <div class="jdih-admin-main">
        <section class="jdih-admin-panel jdih-chart-panel">
            <div class="jdih-panel-title"><h2><i class="fa fa-line-chart"></i> Statistik Pengunjung</h2><div><button>Mingguan</button><button>Bulanan</button></div></div>
            <div class="jdih-bars"><?php foreach ($visitorTrend as $point): ?><div><span style="height:<?= $point['unique_visits'] > 0 ? min(100, max(8, $point['unique_visits'])) : 0 ?>%" title="<?= Html::encode($point['unique_visits']) ?> kunjungan unik"></span><strong><?= Html::encode($point['label']) ?></strong></div><?php endforeach; ?></div>
        </section>
        <section class="jdih-admin-panel jdih-verification-panel">
            <div class="jdih-panel-title"><h2><i class="fa fa-check-square-o"></i> Verifikasi Terbaru</h2><a href="<?= Html::encode(\yii\helpers\Url::to(['/catatan-verifikasi/index'])) ?>">Lihat semua</a></div>
            <div class="jdih-verification-head"><strong>JUDUL DOKUMEN</strong><strong>TANGGAL</strong><strong>STATUS</strong><strong>AKSI</strong></div>
            <?php foreach ($recentDocuments as $document): ?>
                <div class="jdih-verification-row"><strong><?= Html::encode($document['judul']) ?></strong><span><?= Html::encode($document['created_at'] ? date('d M Y', strtotime($document['created_at'])) : '-') ?></span><em><?= Html::encode($document['status_terakhir'] ?: 'PENDING') ?></em><?= Html::a('Verifikasi', ['/catatan-verifikasi/create', 'id' => $document['id']]) ?></div>
            <?php endforeach; ?>
        </section>
        </div>
        <aside class="jdih-admin-side">
            <section class="jdih-survey-card"><h2><i class="fa fa-bar-chart"></i> Survey Kepuasan</h2><h3><?= Html::encode(number_format($surveyAggregate['average'], 2)) ?>/5.0</h3><p>Total responden: <?= Html::encode($surveyAggregate['total']) ?> orang</p><?= Html::a('Lihat Laporan Lengkap', ['survey-kepuasan/index']) ?></section>
            <section class="jdih-collection-card"><h2>Koleksi Digital</h2><div><i class="fa fa-file-text-o"></i><span><strong>PDF Scan</strong><small>1.842 Files</small></span></div><div><i class="fa fa-picture-o"></i><span><strong>Infografis</strong><small>215 Files</small></span></div><div><i class="fa fa-folder-open-o"></i><span><strong>Arsip Lampiran</strong><small>42 Active Bundles</small></span></div></section>
            <section class="jdih-system-card"><strong><i class="fa fa-circle"></i> Sistem Optimal</strong></section>
        </aside>
    </div>
</div>
