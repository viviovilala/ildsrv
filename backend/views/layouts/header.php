<?php

use backend\models\Circulation;
<<<<<<< HEAD
use yii\helpers\Url;
=======
use yii\helpers\Html;
>>>>>>> d1a316e3a76d3b83e0d4b7c9d7be2d1f9f96d4d0

$user = Yii::$app->user->identity;
$pinjam = Circulation::find()->where(['status_peminjaman' => 'Dipinjam'])->count();
$picture = !empty($user->picture) ? \Yii::getAlias('@imageurl') . '/common/dokumen/' . $user->picture : Yii::getAlias('@web') . '/img/user2-160x160.jpg';
?>

<header class="main-header">
<<<<<<< HEAD
  <!-- Logo -->
  <a href="index" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>J</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg admin-brand">
      <?= Html::img(Url::to('@web/assets_b/img/upnvjt-logo-yellow.png'), ['class' => 'admin-brand__logo', 'alt' => 'Logo UPN Veteran Jawa Timur']) ?>
      <span class="admin-brand__text">
        <span class="admin-brand__name">JDIH UPNVJT</span>
        <span class="admin-brand__meta">ADMIN</span>
      </span>
    </span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->

        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            
<?php
$sirkulasi = Circulation::find()->where(['status_peminjaman'=>'Dipinjam']);

$all= $sirkulasi->all();

$pinjam = $sirkulasi->count();

if(!empty($all)){
  $i=0;
  foreach ($all as $data) {
        $timeStart = strtotime($data->tanggal_kembali);
        $timeEnd = strtotime(date('Y-m-d'));
        $terlambat = date("d", $timeEnd) - date("d", $timeStart);
        if ($terlambat>3){
            $i = $i+1;   
      }
  }
  if ($i!== 0){
echo
  '<span class="label label-warning">
            '.$pinjam.'</span>';
}
}
 ?>

          </a>

          <?php
           if (!empty($all)){
          echo'
          <ul class="dropdown-menu">
            
            <li>
              
              <ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> '.$pinjam.' buku dipinjam
                  </a>
=======
    <a href="<?= Yii::$app->homeUrl ?>" class="logo"><span class="logo-mini">J</span><span class="logo-lg">JDIH UPNVJT</span></a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span></a>
        <form class="jdih-admin-search" action="#" method="get"><i class="fa fa-search"></i><input type="search" placeholder="Cari dokumen..."></form>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i><?php if ($pinjam > 0): ?><span class="label label-warning"><?= (int) $pinjam ?></span><?php endif; ?></a></li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= Html::img($picture, ['class' => 'user-image', 'alt' => 'User Image']) ?><span class="hidden-xs"><?= Html::encode($user->username) ?></span></a>
                    <ul class="dropdown-menu">
                        <li class="user-header"><?= Html::img($picture, ['class' => 'img-circle', 'alt' => 'User Image']) ?><p><?= Html::encode($user->username) ?><small><?= Html::encode($user->email ?? '') ?></small></p></li>
                        <li class="user-footer"><div class="pull-left"><?= Html::a('Profile', ['/admin/user/profile', 'id' => $user->id], ['class' => 'btn btn-default btn-flat']) ?></div><div class="pull-right"><?= Html::a('Sign out', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']) ?></div></li>
                    </ul>
>>>>>>> d1a316e3a76d3b83e0d4b7c9d7be2d1f9f96d4d0
                </li>
            </ul>
        </div>
    </nav>
</header>
