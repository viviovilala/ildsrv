<?php

use yii\helpers\Html;
use yii\helpers\Url;

$brandLogo = Url::to('@web/frontend/assets/img/logo-upn.png');
?>

<footer class="jdih-footer" role="contentinfo">
    <div class="container">
        <div class="jdih-footer__grid">
            <div>
                <h2>JDIH UPNVJT</h2>
                <p>Portal Jaringan Dokumentasi dan Informasi Hukum Universitas Pembangunan Nasional "Veteran" Jawa Timur sebagai sarana pelayanan informasi hukum yang terpadu, akurat, dan mudah diakses.</p>
            </div>
            <div>
                <h3>Kontak Kami</h3>
                <p><i class="bi bi-envelope" aria-hidden="true"></i> sekretariat@upnjatim.ac.id</p>
                <p><i class="bi bi-geo-alt" aria-hidden="true"></i> Surabaya, Jawa Timur</p>
            </div>
            <div>
                <h3>Tautan Penting</h3>
                <p><?= Html::a('JDIHN Nasional', 'https://jdihn.go.id', ['target' => '_blank', 'rel' => 'noopener noreferrer']) ?></p>
                <p><?= Html::a('UPN Veteran Jatim', 'https://upnjatim.ac.id', ['target' => '_blank', 'rel' => 'noopener noreferrer']) ?></p>
                <p><?= Html::a('Kontak Kami', ['/site/kontak']) ?></p>
            </div>
            <div>
                <h3>Peta Situs</h3>
                <p><?= Html::a('Produk Hukum', ['/dokumen/peraturan']) ?></p>
                <p><?= Html::a('Berita', ['/berita/index']) ?></p>
                <p><?= Html::a('Tentang', ['/site/about']) ?></p>
            </div>
        </div>
        <div class="jdih-footer__bottom">
            <span>&copy; <?= date('Y') ?> JDIH UPN Veteran Jawa Timur. All Rights Reserved.</span>
            <span><?= Html::a('Privasi', '#') ?> &nbsp; <?= Html::a('Ketentuan', '#') ?> &nbsp; <?= Html::a('Kontak', ['/site/kontak']) ?></span>
        </div>
    </div>
</footer>

<?= Html::a('<i class="bi bi-stars" aria-hidden="true"></i> Tanya AI JDIH', '#', ['class' => 'jdih-ai-float']) ?>
