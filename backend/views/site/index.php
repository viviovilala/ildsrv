<?php

use backend\models\Peraturan;
use yii\helpers\Html;

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
        <section class="jdih-admin-panel jdih-chart-panel">
            <div class="jdih-panel-title"><h2><i class="fa fa-line-chart"></i> Statistik Pengunjung</h2><div><button>Mingguan</button><button>Bulanan</button></div></div>
            <div class="jdih-bars"><?php foreach ([38,62,48,78,88,66,72] as $i => $height): ?><div><span style="height:<?= $height ?>%"></span><strong><?= ['JAN','FEB','MAR','APR','MEI','JUN','JUL'][$i] ?></strong></div><?php endforeach; ?></div>
        </section>
        <aside class="jdih-admin-side">
            <section class="jdih-survey-card"><h2><i class="fa fa-bar-chart"></i> Survey Kepuasan</h2><h3>4.8/5.0</h3><p>Total responden bulan ini: 124 orang</p><?= Html::a('Lihat Laporan Lengkap', ['survey-kepuasan/index']) ?></section>
            <section class="jdih-collection-card"><h2>Koleksi Digital</h2><p><i class="fa fa-file-pdf-o"></i> <strong>PDF Scan</strong><br>1,842 Files</p><p><i class="fa fa-image"></i> <strong>Infografis</strong><br>215 Files</p><p><i class="fa fa-folder-open-o"></i> <strong>Arsip Lampiran</strong><br>42 Active Bundles</p></section>
            <section class="jdih-system-card"><strong><i class="fa fa-circle"></i> Semua Sistem Optimal</strong></section>
        </aside>
    </div>
</div>
