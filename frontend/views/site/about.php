<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Tentang JDIH UPNVJT';
$heroImage = Url::to('@web/images/upnvjt-building.png');
?>

<section class="jdih-page">
    <div class="jdih-page-hero" style="background-image: linear-gradient(90deg, rgba(6,78,11,.86), rgba(6,78,11,.48)), url('<?= Html::encode($heroImage) ?>');">
        <div class="container">
            <span class="jdih-page-hero__eyebrow">Tentang Portal</span>
            <h1>Jaringan Dokumentasi dan Informasi Hukum UPNVJT</h1>
            <p>Portal hukum digital untuk mendukung transparansi, akuntabilitas, dan tata kelola universitas yang modern.</p>
        </div>
    </div>

    <div class="jdih-page-body">
        <div class="container">
            <article class="jdih-page-card jdih-page-card--padded jdih-content">
                <h2>Peran JDIH UPNVJT</h2>
                <p>
                    JDIH UPN Veteran Jawa Timur menyediakan akses terpadu terhadap produk hukum,
                    regulasi akademik, keputusan, referensi hukum, berita, dan informasi kelembagaan.
                    Sistem ini dirancang untuk memudahkan penelusuran dokumen hukum secara cepat,
                    rapi, dan dapat dipertanggungjawabkan.
                </p>
                <p>
                    Redesign frontend ini menempatkan kebutuhan pengguna sebagai pusat pengalaman:
                    pencarian lebih menonjol, katalog lebih mudah dipindai, detail dokumen lebih
                    informatif, dan halaman berita terasa modern tanpa mengubah logic aplikasi.
                </p>

                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <h3>Transparan</h3>
                        <p>Akses publik terhadap dokumen hukum kampus yang tertata.</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h3>Akademik</h3>
                        <p>Mendukung riset, pembelajaran, dan tata kelola pendidikan tinggi.</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h3>Digital</h3>
                        <p>Disiapkan untuk fitur AI Search, OCR, dan ringkasan dokumen.</p>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
