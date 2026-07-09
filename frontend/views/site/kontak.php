<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Kontak';
$heroImage = Url::to('@web/images/upnvjt-building.png');
?>

<section class="jdih-page">
    <div class="jdih-page-hero" style="background-image: linear-gradient(90deg, rgba(6,78,11,.86), rgba(6,78,11,.48)), url('<?= Html::encode($heroImage) ?>');">
        <div class="container">
            <span class="jdih-page-hero__eyebrow">Kontak JDIH</span>
            <h1>Hubungi JDIH UPN Veteran Jawa Timur</h1>
            <p>Layanan informasi hukum kampus untuk civitas akademika, unit kerja, dan masyarakat.</p>
        </div>
    </div>

    <div class="jdih-page-body">
        <div class="container">
            <div class="jdih-contact-grid">
                <section class="jdih-page-card jdih-page-card--padded">
                    <div class="jdih-content">
                        <h2>Informasi Layanan</h2>
                        <p>
                            Tim JDIH UPNVJT melayani kebutuhan akses regulasi, dokumen hukum,
                            informasi kebijakan universitas, dan bantuan penelusuran katalog hukum.
                        </p>
                    </div>

                    <ul class="jdih-contact-list">
                        <li>
                            <i class="bi bi-geo-alt" aria-hidden="true"></i>
                            <div><strong>Kantor</strong><span>Lt. 3 Gedung Rektorat, Kampus Gunung Anyar, UPN Veteran Jawa Timur, Surabaya</span></div>
                        </li>
                        <li>
                            <i class="bi bi-envelope" aria-hidden="true"></i>
                            <div><strong>Email</strong><span>sekretariat@upnjatim.ac.id</span></div>
                        </li>
                        <li>
                            <i class="bi bi-clock" aria-hidden="true"></i>
                            <div><strong>Jam Layanan</strong><span>Senin - Jumat, 08.00 - 16.00 WIB</span></div>
                        </li>
                    </ul>
                </section>

                <section class="jdih-page-card jdih-page-card--padded">
                    <div class="jdih-content">
                        <h2>Kirim Pesan</h2>
                        <p>Form ini masih berupa antarmuka frontend. Integrasi pengiriman pesan dapat mengikuti alur backend yang sudah tersedia.</p>
                    </div>

                    <form class="jdih-contact-form" action="#" method="post">
                        <input type="text" name="name" placeholder="Nama lengkap" aria-label="Nama lengkap">
                        <input type="email" name="email" placeholder="Email" aria-label="Email">
                        <input type="text" name="subject" placeholder="Subjek pesan" aria-label="Subjek pesan">
                        <textarea name="message" rows="6" placeholder="Tulis pesan Anda" aria-label="Pesan"></textarea>
                        <button type="submit">Kirim Pesan <i class="bi bi-send" aria-hidden="true"></i></button>
                    </form>
                </section>
            </div>
        </div>
    </div>
</section>
