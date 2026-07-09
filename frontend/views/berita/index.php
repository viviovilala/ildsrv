<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel frontend\models\search\BeritaSearch */

$this->title = 'Berita & Informasi';
$this->registerMetaTag(['name' => 'description', 'content' => 'Berita dan informasi hukum terbaru JDIH UPN Veteran Jawa Timur.']);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow']);
?>

<section class="news-hero">
    <div class="container">
        <span>Berita Utama</span>
        <h1>Reformasi Regulasi<br>Kampus untuk<br>Digitalisasi<br>Berkelanjutan</h1>
        <p>Langkah strategis UPN Veteran Jawa Timur dalam menyinkronkan kebijakan internal dengan standar tata kelola universitas kelas dunia.</p>
        <?= Html::a('Baca Selengkapnya <i class="bi bi-arrow-right" aria-hidden="true"></i>', '#news-list', ['class' => 'news-hero__button']) ?>
    </div>
</section>

<section class="news-filter-bar">
    <div class="container">
        <div class="news-filter-bar__inner">
            <div class="news-chips">
                <button type="button" class="is-active">Semua</button>
                <button type="button">Kebijakan</button>
                <button type="button">Akademik</button>
                <button type="button">Kemahasiswaan</button>
                <button type="button">Pengumuman</button>
            </div>
            <div class="news-sort">Urutkan: <strong>Terbaru</strong> <i class="bi bi-chevron-down" aria-hidden="true"></i></div>
        </div>
    </div>
</section>

<section id="news-list" class="news-grid-section">
    <div class="container">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'itemOptions' => ['tag' => false],
            'options' => ['class' => 'news-card-grid'],
            'itemView' => '_data',
            'pager' => [
                'options' => ['class' => 'catalog-pagination pagination'],
                'pageCssClass' => 'page-item',
                'linkOptions' => ['class' => 'page-link'],
                'activePageCssClass' => 'active',
                'disabledPageCssClass' => 'disabled',
                'prevPageLabel' => '<i class="bi bi-chevron-left" aria-hidden="true"></i>',
                'nextPageLabel' => '<i class="bi bi-chevron-right" aria-hidden="true"></i>',
            ],
        ]) ?>
    </div>
</section>

<style>
.news-hero{background:#104d49;color:#fff;padding:86px 0 96px}
.news-hero span{display:inline-flex;margin-bottom:24px;border-radius:999px;background:#ffd200;color:#064e0b;padding:8px 18px;font-size:12px;font-weight:900;text-transform:uppercase;letter-spacing:.06em}
.news-hero h1{margin:0;font-family:Georgia,"Times New Roman",serif;font-size:clamp(44px,6vw,72px);line-height:1.06;letter-spacing:0}
.news-hero p{max-width:650px;margin:34px 0;color:rgba(255,255,255,.78);font-size:17px;line-height:1.7}
.news-hero__button{display:inline-flex;align-items:center;gap:10px;border-radius:8px;background:#ffd200;color:#064e0b;padding:16px 28px;font-weight:900;text-decoration:none}.news-hero__button:hover{color:#064e0b;text-decoration:none}
.news-filter-bar{background:#f8f7f2;border-bottom:1px solid #d8dbd2}
.news-filter-bar__inner{min-height:86px;display:flex;align-items:center;justify-content:space-between;gap:24px}
.news-chips{display:flex;flex-wrap:wrap;gap:14px}.news-chips button{border:0;border-radius:999px;background:#e8e8e2;color:#6b7168;padding:12px 24px;font-weight:900}.news-chips button.is-active{background:#104d49;color:#fff}
.news-sort{color:#6b7168;font-weight:800}.news-sort strong{margin-left:18px;color:#4d554b}
.news-grid-section{background:#f8f7f2;padding:78px 0}
.news-card-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.news-card{min-height:100%;border-radius:12px;background:#fff;border:1px solid #d8dbd2;overflow:hidden;box-shadow:0 14px 34px rgba(30,36,28,.06)}
.news-card__image{height:220px;background:#d8dbd2;position:relative;overflow:hidden}.news-card__image img{width:100%;height:100%;object-fit:cover}.news-card__badge{position:absolute;left:18px;top:18px;border-radius:4px;background:#104d49;color:#fff;padding:7px 12px;font-size:11px;font-weight:900;text-transform:uppercase}
.news-card__body{padding:24px}.news-card__date{display:flex;align-items:center;gap:8px;color:#6b7168;font-size:13px;margin-bottom:14px}.news-card h2{margin:0 0 14px;font-family:Georgia,"Times New Roman",serif;font-size:26px;line-height:1.22;letter-spacing:0}.news-card h2 a{color:#104d49;text-decoration:none}
.news-card p{color:#6b7168;line-height:1.65;margin:0 0 24px}.news-card__foot{display:flex;align-items:center;justify-content:space-between;gap:18px}.news-card__author{display:flex;align-items:center;gap:10px;color:#4d554b;font-weight:800}.news-card__author i{width:30px;height:30px;border-radius:50%;background:#e8e8e2;display:flex;align-items:center;justify-content:center}.news-card__detail{color:#104d49;font-weight:900;text-decoration:none}
@media(max-width:991.98px){.news-card-grid{grid-template-columns:repeat(2,1fr)}.news-filter-bar__inner{align-items:flex-start;flex-direction:column;padding:22px 0}}
@media(max-width:575.98px){.news-hero{padding:62px 0}.news-card-grid{grid-template-columns:1fr}.news-hero h1{font-size:40px}}
</style>
