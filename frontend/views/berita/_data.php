<?php

use common\components\LazyImage;
use yii\helpers\Html;
use yii\helpers\Url;

<<<<<<< HEAD
=======
/* @var $model frontend\models\Berita */

>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
$image = $model->image ? '@web/common/dokumen/' . $model->image : '@web/images/upnvjt-building.png';
$excerpt = mb_strimwidth(trim(strip_tags($model->isi)), 0, 135, '...');
?>

<article class="news-card">
    <div class="news-card__image">
<<<<<<< HEAD
        <?= Html::a(LazyImage::img($image, ['alt' => $model->judul]), ['view', 'id' => $model->id]) ?>
        <span class="news-card__badge">Kebijakan</span>
    </div>
    <div class="news-card__body">
        <time class="news-card__date" datetime="<?= Html::encode($model->tanggal) ?>"><i class="bi bi-calendar4"></i> <?= Html::encode($model->tanggal ? $model->getTanggal($model->tanggal) : '-') ?></time>
        <h2><?= Html::a(Html::encode($model->judul), ['view', 'id' => $model->id]) ?></h2>
        <p><?= Html::encode($excerpt) ?></p>
        <div class="news-card__foot"><span><i class="bi bi-person"></i> Admin JDIH</span><?= Html::a('Detail <i class="bi bi-chevron-right"></i>', ['view', 'id' => $model->id]) ?></div>
=======
        <?= Html::a(
            LazyImage::img($image, [
                'alt' => $model->judul,
            ]),
            ['view', 'id' => $model->id]
        ) ?>
        <span class="news-card__badge">Kebijakan</span>
    </div>

    <div class="news-card__body">
        <time class="news-card__date" datetime="<?= Html::encode($model->tanggal) ?>">
            <i class="bi bi-calendar4" aria-hidden="true"></i>
            <?= Html::encode($model->tanggal ? $model->getTanggal($model->tanggal) : '-') ?>
        </time>
        <h2><?= Html::a(Html::encode($model->judul), ['view', 'id' => $model->id]) ?></h2>
        <p><?= Html::encode($excerpt) ?></p>
        <div class="news-card__foot">
            <span class="news-card__author"><i class="bi bi-person" aria-hidden="true"></i> Admin JDIH</span>
            <?= Html::a('Detail <i class="bi bi-chevron-right" aria-hidden="true"></i>', ['view', 'id' => $model->id], ['class' => 'news-card__detail']) ?>
        </div>
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
    </div>
</article>
