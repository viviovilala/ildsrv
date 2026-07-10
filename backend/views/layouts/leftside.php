<?php

use yii\helpers\Html;

$brandLogo = Yii::getAlias('@web') . '/assets_b/img/logo-upn.png';
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="jdih-sidebar-brand"><img src="<?= Html::encode($brandLogo) ?>" alt="JDIH UPNVJT"><div><strong>JDIH UPNVJT</strong><small>Admin Portal</small></div></div>
        <div class="jdih-sidebar-section">Main Navigation</div>
        <ul class="sidebar-menu jdih-sidebar-menu">
            <li class="active"><?= Html::a('<i class="fa fa-th-large"></i> <span>Dashboard</span>', ['/site/index']) ?></li>
            <li><?= Html::a('<i class="fa fa-gavel"></i> <span>Dokumen Hukum</span>', ['/peraturan/index']) ?></li>
            <li><?= Html::a('<i class="fa fa-shield"></i> <span>Verifikasi</span>', ['/catatan-verifikasi/index']) ?></li>
            <li><?= Html::a('<i class="fa fa-exchange"></i> <span>Sirkulasi</span>', ['/circulation/index']) ?></li>
            <li><?= Html::a('<i class="fa fa-newspaper-o"></i> <span>Berita</span>', ['/berita/index']) ?></li>
            <li><?= Html::a('<i class="fa fa-file-text-o"></i> <span>Laporan</span>', ['/laporan/index']) ?></li>
            <li><?= Html::a('<i class="fa fa-database"></i> <span>Master Data</span>', ['/tipe-dokumen/index']) ?></li>
            <li><?= Html::a('<i class="fa fa-lock"></i> <span>Akses Kontrol</span>', ['/admin/assignment/index']) ?></li>
        </ul>
        <ul class="sidebar-menu jdih-sidebar-menu jdih-sidebar-menu--bottom">
            <li><?= Html::a('<i class="fa fa-line-chart"></i> <span>Statistik Pengunjung</span>', ['/visitor-report/index']) ?></li>
            <li><?= Html::a('<i class="fa fa-bar-chart"></i> <span>Survey Kepuasan</span>', ['/survey-kepuasan/index']) ?></li>
            <li><?= Html::a('<i class="fa fa-sign-out"></i> <span>Keluar</span>', ['/site/logout'], ['data-method' => 'post']) ?></li>
        </ul>
    </section>
</aside>
