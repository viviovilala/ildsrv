<?php

use yii\helpers\Html;
use yii\helpers\Url;

$brandLogo = Url::to('@web/frontend/assets/img/logo-upn.png');

?>

<footer class="jdih-footer" role="contentinfo">
    <div class="container">
        <div class="jdih-footer__grid">
            <div>
                <div class="jdih-footer__brand">
                    <span class="jdih-logo-mark"><img src="<?= Html::encode($brandLogo) ?>" alt="" aria-hidden="true"></span>
                    <span>JDIH UPNVJT</span>
                </div>
                <p>
                    Portal Jaringan Dokumentasi dan Informasi Hukum Universitas Pembangunan Nasional
                    "Veteran" Jawa Timur. Melayani akses terbuka untuk regulasi akademik dan institusi.
                </p>
            </div>

            <div>
                <h3>Kontak Kami</h3>
                <ul class="jdih-footer__list">
                    <li><i class="bi bi-envelope" aria-hidden="true"></i> sekretariat@upnjatim.ac.id</li>
                    <li><i class="bi bi-geo-alt" aria-hidden="true"></i> Surabaya, Jawa Timur</li>
                    <li><i class="bi bi-clock" aria-hidden="true"></i> Senin - Jumat, 08.00 - 16.00 WIB</li>
                </ul>
            </div>

            <div>
                <h3>Tautan Penting</h3>
                <ul class="jdih-footer__list">
                    <li><?= Html::a('JDIHN Nasional', 'https://jdihn.go.id', ['target' => '_blank', 'rel' => 'noopener noreferrer']) ?></li>
                    <li><?= Html::a('UPN Veteran Jatim', 'https://upnjatim.ac.id', ['target' => '_blank', 'rel' => 'noopener noreferrer']) ?></li>
                    <li><?= Html::a('JDIH Pemprov Jatim', '#') ?></li>
                    <li><?= Html::a('Portal Satu Data', '#') ?></li>
                </ul>
            </div>

            <div>
                <h3>Peta Situs</h3>
                <ul class="jdih-footer__list">
                    <li><?= Html::a('Produk Hukum', ['/dokumen/index']) ?></li>
                    <li><?= Html::a('Berita', ['/berita/index']) ?></li>
                    <li><?= Html::a('Informasi Publik', ['/site/kontak']) ?></li>
                    <li><?= Html::a('Tentang', ['/site/about']) ?></li>
                </ul>
            </div>
        </div>

        <div class="jdih-footer__bottom">
            <span>&copy; <?= date('Y') ?> JDIH UPN Veteran Jawa Timur. All Rights Reserved.</span>
            <span>
                <?= Html::a('Privasi', '#') ?>
                &nbsp;&nbsp;
                <?= Html::a('Ketentuan', '#') ?>
                &nbsp;&nbsp;
                <?= Html::a('Kontak', ['/site/kontak']) ?>
            </span>
        </div>
    </div>
</footer>

<?= Html::a('<i class="bi bi-stars" aria-hidden="true"></i> Tanya AI JDIH', '#', [
    'class' => 'jdih-ai-float',
    'aria-label' => 'Tanya AI JDIH',
]) ?>
