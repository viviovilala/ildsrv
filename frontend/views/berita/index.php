<?php

use yii\widgets\ListView;

$this->title = 'Berita & Informasi';
?>

<section class="news-hero">
    <div class="container">
        <span>Berita Utama</span>
        <h1>Reformasi Regulasi<br>Kampus untuk<br>Digitalisasi Berkelanjutan</h1>
        <p>Langkah strategis UPN Veteran Jawa Timur dalam menyinkronkan kebijakan internal dengan standar tata kelola universitas kelas dunia.</p>
        <a href="#news-list">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
    </div>
</section>
<section class="news-filter">
    <div class="container"><div class="news-chips"><button class="is-active" type="button">Semua</button><button type="button">Kebijakan</button><button type="button">Akademik</button><button type="button">Kemahasiswaan</button><button type="button">Pengumuman</button></div></div>
</section>
<section id="news-list" class="news-grid-section jdih-section">
    <div class="container">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'itemOptions' => ['tag' => false],
            'options' => ['class' => 'news-card-grid'],
            'itemView' => '_data',
            'pager' => [
                'options' => ['class' => 'pagination justify-content-center mt-5'],
                'linkOptions' => ['class' => 'page-link'],
                'pageCssClass' => 'page-item',
                'activePageCssClass' => 'active',
                'disabledPageCssClass' => 'disabled',
            ],
        ]) ?>
    </div>
</section>
