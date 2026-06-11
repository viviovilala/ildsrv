<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\DokumenSearch */

$collapseId = 'dokumen-search-collapse';

$hasActiveFilters = false;
foreach ($model->attributes as $value) {
    if ($value !== '' && $value !== null) {
        $hasActiveFilters = true;
        break;
    }
}

$collapseClasses = 'collapse d-lg-block dokumen-search-card__body';
if ($hasActiveFilters) {
    $collapseClasses .= ' show';
}
?>

<div class="col-lg-3 mb-4">
    <div class="side-bar sticky-top dokumen-search-sidebar" style="top: 100px;">
        <div class="card border-0 rounded-4 shadow-sm dokumen-search-card" style="overflow: hidden;">
            <div class="card-header border-0 py-3 dokumen-search-card__header" style="background-color: #f1f5f9;">
                <button
                    class="dokumen-search-toggle d-lg-none w-100 d-flex align-items-center justify-content-between btn btn-link text-decoration-none p-0 border-0 shadow-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#<?= $collapseId ?>"
                    aria-expanded="<?= $hasActiveFilters ? 'true' : 'false' ?>"
                    aria-controls="<?= $collapseId ?>"
                >
                    <span class="dokumen-search-toggle__label">
                        <span class="card-title fw-bold mb-0 d-block" style="color: #1a2752; font-size: 1.1rem;">
                            <i class="bi bi-search me-2"></i> Pencarian
                        </span>
                        <span class="dokumen-search-toggle__hint small text-muted">Ketuk untuk tampilkan filter</span>
                    </span>
                    <i class="bi bi-chevron-down dokumen-search-toggle__icon flex-shrink-0 ms-3" aria-hidden="true"></i>
                </button>
                <h5 class="card-title fw-bold mb-0 d-none d-lg-block" style="color: #1a2752; font-size: 1.1rem;">
                    <i class="bi bi-search me-2"></i> Pencarian
                </h5>
            </div>
            <div id="<?= $collapseId ?>" class="<?= $collapseClasses ?>">
                <div class="card-body p-4 pt-lg-4">
                    <?= $this->render('_search', ['model' => $model]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
