<?php

use backend\models\Circulation;
use yii\helpers\Html;

$user = Yii::$app->user->identity;
$pinjam = Circulation::find()->where(['status_peminjaman' => 'Dipinjam'])->count();
$picture = !empty($user->picture) ? \Yii::getAlias('@imageurl') . '/common/dokumen/' . $user->picture : Yii::getAlias('@web') . '/img/user2-160x160.jpg';
?>

<header class="main-header">
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
                </li>
            </ul>
        </div>
    </nav>
</header>
