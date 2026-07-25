<?php

use frontend\models\DataLampiran;
use yii\helpers\Html;

$status = trim((string) ($model->status ?: 'Berlaku'));
$isRevoked = stripos($status, 'cabut') !== false || stripos($status, 'tidak') !== false;
$lampiran = DataLampiran::find()->where(['id_dokumen' => $model->id])->one();
$jenis = $model->bentuk_peraturan ?: $model->jenis_peraturan ?: 'Peraturan Rektor';
$year = $model->tahun_terbit ?: ($model->tanggal_penetapan ? date('Y', strtotime($model->tanggal_penetapan)) : '-');
?>

<article class="catalog-doc-card">
    <div class="catalog-doc-card__icon"><i class="bi bi-file-earmark-text" aria-hidden="true"></i></div>
    <div>
        <div class="catalog-doc-card__meta">
            <span class="catalog-doc-card__status<?= $isRevoked ? ' is-revoked' : '' ?>"><?= Html::encode($status) ?></span>
            <span><?= Html::encode($jenis) ?></span><span>&bull;</span><span><?= Html::encode($year) ?></span>
        </div>
        <h3><?= Html::a(Html::encode($model->judul), ['/dokumen/view', 'id' => $model->id]) ?></h3>
        <p>Nomor <?= Html::encode($model->nomor_peraturan ?: '-') ?> &bull; Tanggal Penetapan: <?= Html::encode($model->tanggal_penetapan ? $model->getTanggal($model->tanggal_penetapan) : '-') ?></p>
    </div>
    <div class="catalog-doc-card__actions">
        <?= $lampiran
            ? Html::a('<i class="bi bi-download" aria-hidden="true"></i> Unduh PDF', ['/dokumen/download', 'id' => $lampiran->dokumen_lampiran, 'docId' => $model->id], ['class' => 'catalog-doc-card__download'])
            : Html::a('<i class="bi bi-download" aria-hidden="true"></i> Unduh PDF', ['/dokumen/view', 'id' => $model->id], ['class' => 'catalog-doc-card__download'])
        ?>
        <?= Html::a('Detail', ['/dokumen/view', 'id' => $model->id], ['class' => 'catalog-doc-card__detail']) ?>
    </div>
</article>
