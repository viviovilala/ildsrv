<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Tanya AI JDIH';
?>

<section class="jdih-section">
    <div class="container">
        <div class="contact-banner" style="border-radius: 24px;">
            <div class="container">
                <span class="jdih-eyebrow">AI JDIH</span>
                <h1>Tanya AI JDIH</h1>
                <p>
                    Fitur AI untuk tanya jawab dokumen hukum masih dalam tahap integrasi.
                    Halaman ini disiapkan sebagai pintu masuk menuju layanan AI JDIH agar tombol tidak lagi menjadi dead link.
                </p>
                <p>
                    Service AI terpisah sudah disiapkan di repository <strong>ai-service</strong>, tetapi belum dihubungkan penuh ke frontend production.
                </p>
                <p>
                    <?= Html::a('Kembali ke Beranda', ['/site/index'], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('Lihat Produk Hukum', ['/dokumen/peraturan'], ['class' => 'btn btn-outline-success', 'style' => 'margin-left:12px;']) ?>
                </p>
            </div>
        </div>
    </div>
</section>