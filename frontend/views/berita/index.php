<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel frontend\models\search\BeritaSearch */

$this->title = 'Berita & Artikel Hukum';
$this->registerMetaTag(['name' => 'description', 'content' => 'Berita dan artikel hukum terbaru - informasi terkini seputar dunia hukum Indonesia di ILDIS.']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
?>

<div class="berita-index-wrapper" style="background-color: #f8fafc; min-height: 100vh; padding-top: 100px;">
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar (Search) -->
            <div class="col-lg-3 mb-4">
                <div class="side-bar sticky-top" style="top: 120px;">
                    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
                        <div class="card-header border-0 py-3" style="background-color: #f1f5f9;">
                            <h5 class="card-title fw-bold mb-0 text-dark-blue small text-uppercase tracking-wider">
                                <i class="ti-search mr-2"></i> Cari Berita
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <?= $this->render('_search', ['model' => $searchModel]); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News List -->
            <div class="col-lg-9">
                <header class="berita-page-header mb-4 d-flex flex-wrap justify-content-between align-items-end gap-3">
                    <div>
                        <span class="berita-page-header__eyebrow">Informasi Terkini</span>
                        <h1 class="berita-page-header__title mb-0"><?= Html::encode($this->title) ?></h1>
                    </div>
                    <p class="berita-page-header__count mb-0">
                        <?= number_format($dataProvider->getTotalCount()) ?> berita ditemukan
                    </p>
                </header>

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => false,
                    'itemOptions' => ['tag' => false],
                    'options' => ['class' => 'news-list'],
                    'itemView' => '_data',
                    'pager' => [
                        'options' => ['class' => 'pagination justify-content-center mt-5'],
                        'linkOptions' => ['class' => 'page-link border-0 shadow-sm rounded-3 mx-1'],
                        'pageCssClass' => 'page-item',
                        'activePageCssClass' => 'active',
                        'disabledPageCssClass' => 'disabled',
                        'prevPageLabel' => '<i class="ti-arrow-left"></i>',
                        'nextPageLabel' => '<i class="ti-arrow-right"></i>',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

<style>
.text-dark-blue { color: #1a2752; }
.tracking-wider { letter-spacing: 0.05em; }

.news-list-card {
    transition: transform 0.25s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.25s ease;
    border: 1px solid #f1f5f9 !important;
}

.news-item .news-list-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(26, 39, 82, 0.08) !important;
}

.news-image-wrapper {
    min-height: 200px;
    overflow: hidden;
}

.news-list-card__image {
    object-fit: cover;
    transition: transform 0.45s cubic-bezier(0.25, 1, 0.5, 1);
}

.news-item .news-list-card:hover .news-list-card__image {
    transform: scale(1.04);
}

.news-list-card__date {
    display: block;
    font-size: 0.8125rem;
    font-weight: 500;
    color: #64748b;
    margin-bottom: 0.625rem;
    letter-spacing: 0.01em;
}

.news-list-card__title {
    font-size: clamp(1.0625rem, 2vw, 1.25rem);
    font-weight: 650;
    line-height: 1.35;
    letter-spacing: -0.015em;
    margin: 0 0 0.875rem;
}

.news-list-card__title a {
    color: #1a2752;
    text-decoration: none;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.2s ease;
}

.news-list-card__title a:hover {
    color: #274685;
}

.news-list-card__excerpt {
    font-size: 0.9375rem;
    line-height: 1.65;
    color: #64748b;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-list-card__footer {
    padding-top: 1rem;
    border-top: 1px solid #f1f5f9;
}

.news-read-more {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: #1a2752;
    text-decoration: none;
    transition: gap 0.25s cubic-bezier(0.25, 1, 0.5, 1), color 0.2s ease;
}

.news-read-more:hover {
    color: #274685;
    text-decoration: none;
    gap: 0.6rem;
}

.news-read-more__icon {
    font-size: 0.8em;
    transition: transform 0.25s cubic-bezier(0.25, 1, 0.5, 1);
}

.news-read-more:hover .news-read-more__icon {
    transform: translateX(3px);
}

.berita-page-header__eyebrow {
    display: block;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #64748b;
    margin-bottom: 0.375rem;
}

.berita-page-header__title {
    font-size: clamp(1.5rem, 3vw, 1.875rem);
    font-weight: 700;
    color: #1a2752;
    letter-spacing: -0.02em;
    line-height: 1.2;
}

.berita-page-header__count {
    font-size: 0.875rem;
    font-weight: 500;
    color: #64748b;
    letter-spacing: 0.01em;
}

.pagination .page-item.active .page-link {
    background-color: #1a2752;
    border-color: #1a2752;
}
.pagination .page-link {
    color: #475569;
    padding: 10px 16px;
}
.pagination .page-link:hover {
    color: #1a2752;
}
</style>
