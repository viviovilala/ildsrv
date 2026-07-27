<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\DataLampiran;

$status = trim((string) ($model->status ?: 'Berlaku'));
$isRevoked = stripos($status, 'cabut') !== false || stripos($status, 'tidak') !== false;
$lampiran = DataLampiran::find()->where(['id_dokumen' => $model->id])->one();
$jenis = $model->bentuk_peraturan ?: $model->jenis_peraturan ?: '-';
$year = $model->tahun_terbit ?: ($model->tanggal_penetapan ? date('Y', strtotime($model->tanggal_penetapan)) : '-');
$tanggal = $model->tanggal_penetapan ? Yii::$app->formatter->asDate($model->tanggal_penetapan, 'dd MMM yyyy') : '-';
?>

<article class="doc-card">
    <div class="doc-card-main">
        <div class="doc-card-meta">
            <span class="doc-card-badge <?= $isRevoked ? 'is-cabut' : 'is-berlaku' ?>"><?= Html::encode($status) ?></span>
            <span><?= Html::encode($jenis) ?></span>
            <span>&bull;</span>
            <span>Tahun <?= Html::encode($year) ?></span>
        </div>
        <h3><?= Html::a(Html::encode($model->judul), ['/dokumen/view', 'id' => $model->id]) ?></h3>
        <div class="doc-card-info">
            <span><i class="bi bi-hash" aria-hidden="true"></i> Nomor <?= Html::encode($model->nomor_peraturan ?: '-') ?></span>
            <span><i class="bi bi-calendar3" aria-hidden="true"></i> <?= Html::encode($tanggal) ?></span>
            <?php if ($model->nama_pengarang && $model->nama_pengarang !== '-'): ?>
                <span><i class="bi bi-person" aria-hidden="true"></i> <?= Html::encode($model->nama_pengarang) ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
        <?php if ($lampiran): ?>
            <?= Html::a('<i class="bi bi-download"></i> Unduh', ['/dokumen/download', 'id' => $lampiran->dokumen_lampiran, 'docId' => $model->id], ['class' => 'doc-card-detail']) ?>
        <?php endif; ?>
        <?= Html::a('Detail <i class="bi bi-arrow-right"></i>', ['/dokumen/view', 'id' => $model->id], ['class' => 'doc-card-detail']) ?>
    </div>
</article>
