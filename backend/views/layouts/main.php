<?php
$dir = 'assets/';
array_map('unlink', glob("{$dir}*.*"));

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
//use app\assets\AppAsset;
use backend\assets_b\AdminLteAsset;
use backend\assets_b\AppAsset as BackendAppAsset;

//AppAsset::register($this);
$asset      = AdminLteAsset::register($this);
BackendAppAsset::register($this);
$baseUrl    = $asset->baseUrl;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-red sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <?= $this->render('header.php', ['baserUrl' => $baseUrl, 'title'=>Yii::$app->name]) ?>
    <?= $this->render('leftside.php', ['baserUrl' => $baseUrl]) ?>
    <?= $this->render('content.php', ['content' => $content]) ?>
    <?= $this->render('footer.php', ['baserUrl' => $baseUrl]) ?>
    <?= $this->render('rightside.php', ['baserUrl' => $baseUrl]) ?>
</div>

<div id="admin-splash" class="admin-splash" role="status" aria-live="polite">
    <div class="admin-splash__panel">
        <?= Html::img(Url::to('@web/assets_b/img/upnvjt-logo-yellow.png'), ['class' => 'admin-splash__logo', 'alt' => 'Logo UPN Veteran Jawa Timur']) ?>
        <h2 class="admin-splash__title">JDIH UPNVJT</h2>
        <p class="admin-splash__subtitle">ADMIN PORTAL</p>
    </div>
</div>

<!--footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?//= date('Y') ?></p>

        <p class="pull-right"><?//= Yii::powered() ?></p>
    </div>
</footer-->

<?php $this->endBody() ?>
<script>
  (function () {
    var splash = document.getElementById('admin-splash');
    if (!splash) {
      return;
    }
    var splashKey = 'jdih-upnvjt-admin-splash-shown';
    if (window.sessionStorage && window.sessionStorage.getItem(splashKey)) {
      splash.classList.add('is-hidden');
      return;
    }
    window.addEventListener('load', function () {
      window.setTimeout(function () {
        splash.classList.add('is-hidden');
        if (window.sessionStorage) {
          window.sessionStorage.setItem(splashKey, '1');
        }
      }, 420);
    });
  }());
</script>
</body>
</html>
<?php $this->endPage() ?>
