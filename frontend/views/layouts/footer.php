<?php

use yii\helpers\Html;
?>

<style>
/* =========================================================
   JDIH FOOTER — FINAL
   CSS DITEMPATKAN LANGSUNG DI FOOTER AGAR
   TIDAK BENTROK DENGAN CSS GLOBAL
   ========================================================= */

.jdih-footer {
    width: 100% !important;
    max-width: none !important;
    margin: 0 !important;
    padding: 52px 0 0 !important;
    background: #21451a !important;
    color: #d6dfd1 !important;
    display: block !important;
    position: relative !important;
    box-sizing: border-box !important;
}

.jdih-footer *,
.jdih-footer *::before,
.jdih-footer *::after {
    box-sizing: border-box !important;
}


/* =========================================================
   CONTAINER
   ========================================================= */

.jdih-footer > .container {
    width: calc(100% - 80px) !important;
    max-width: 1200px !important;
    margin: 0 auto !important;
    padding: 0 !important;
}


/* =========================================================
   3 KOLOM UTAMA
   ========================================================= */

.jdih-footer__content {
    width: 100% !important;
    max-width: 1200px !important;

    display: grid !important;

    grid-template-columns:
        minmax(0, 1.55fr)
        minmax(180px, 0.75fr)
        minmax(260px, 1fr) !important;

    column-gap: 70px !important;
    row-gap: 0 !important;

    align-items: start !important;
    justify-content: stretch !important;

    margin: 0 !important;
    padding: 0 !important;
}


/* =========================================================
   SEMUA KOLOM
   ========================================================= */

.jdih-footer__col {
    width: auto !important;
    max-width: none !important;
    min-width: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
}


/* =========================================================
   KOLOM 1
   ========================================================= */

.jdih-footer__col--primary {
    grid-column: auto !important;
    grid-row: auto !important;
}


/* =========================================================
   LOGO
   ========================================================= */

.jdih-footer__logo {
    display: flex !important;
    align-items: center !important;
    width: 100% !important;
    margin: 0 0 14px !important;
    padding: 0 !important;
}

.jdih-footer__logo-img {
    display: block !important;
    width: 205px !important;
    max-width: 100% !important;
    height: auto !important;
    max-height: 62px !important;
    object-fit: contain !important;
    object-position: left center !important;
}


/* =========================================================
   DESKRIPSI
   ========================================================= */

.jdih-footer__desc {
    width: 100% !important;
    max-width: 500px !important;

    margin: 0 0 18px !important;
    padding: 0 !important;

    color: #d6dfd1 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 14px !important;
    font-weight: 400 !important;
    line-height: 1.6 !important;
}


/* =========================================================
   SOCIAL MEDIA
   ========================================================= */

.jdih-footer__social {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;

    width: 100% !important;

    gap: 9px !important;
    margin: 0 !important;
    padding: 0 !important;
}

.jdih-footer__social-link {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;

    width: 34px !important;
    height: 34px !important;
    min-width: 34px !important;
    max-width: 34px !important;

    padding: 0 !important;

    border: 1px solid rgba(214, 223, 209, 0.45) !important;
    border-radius: 50% !important;

    background: transparent !important;
    color: #d6dfd1 !important;

    font-size: 15px !important;
    line-height: 1 !important;

    text-decoration: none !important;
    transition: all .2s ease !important;
}

.jdih-footer__social-link:hover {
    background: #f5cf57 !important;
    border-color: #f5cf57 !important;
    color: #21451a !important;
    transform: translateY(-2px) !important;
}


/* =========================================================
   JUDUL KOLOM
   ========================================================= */

.jdih-footer__heading {
    display: block !important;

    margin: 0 0 17px !important;
    padding: 0 !important;

    color: #f5cf57 !important;

    font-family:
        Georgia,
        "Times New Roman",
        serif !important;

    font-size: 22px !important;
    font-weight: 700 !important;
    line-height: 1.25 !important;
}


/* =========================================================
   TAUTAN
   ========================================================= */

.jdih-footer__list {
    display: flex !important;
    flex-direction: column !important;

    gap: 9px !important;

    width: 100% !important;

    margin: 0 !important;
    padding: 0 !important;

    list-style: none !important;
}

.jdih-footer__list li {
    display: block !important;

    width: 100% !important;

    margin: 0 !important;
    padding: 0 !important;
}

.jdih-footer__list a {
    display: inline-block !important;

    margin: 0 !important;
    padding: 0 !important;

    color: #d6dfd1 !important;

    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 14px !important;
    line-height: 1.5 !important;

    text-decoration: none !important;

    transition: color .2s ease !important;
}

.jdih-footer__list a:hover {
    color: #f5cf57 !important;
}


/* =========================================================
   KONTAK
   ========================================================= */

.jdih-footer__contact {
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
}

.jdih-footer__contact-item {
    display: flex !important;
    align-items: flex-start !important;

    width: 100% !important;

    gap: 12px !important;

    margin: 0 0 15px !important;
    padding: 0 !important;

    color: #d6dfd1 !important;

    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 14px !important;
    line-height: 1.55 !important;
}

.jdih-footer__contact-item:last-child {
    margin-bottom: 0 !important;
}

.jdih-footer__contact-item > i {
    display: block !important;

    flex: 0 0 18px !important;

    width: 18px !important;
    min-width: 18px !important;

    margin-top: 2px !important;

    color: #f5cf57 !important;

    font-size: 16px !important;
    line-height: 1 !important;
}

.jdih-footer__contact-item p {
    display: block !important;

    min-width: 0 !important;
    width: auto !important;

    margin: 0 !important;
    padding: 0 !important;

    color: #d6dfd1 !important;

    overflow-wrap: break-word !important;
}

.jdih-footer__contact-item a {
    color: #d6dfd1 !important;
    text-decoration: none !important;
}

.jdih-footer__contact-item a:hover {
    color: #f5cf57 !important;
}


/* =========================================================
   COPYRIGHT
   ========================================================= */

.jdih-footer__bottom {
    display: block !important;

    width: 100% !important;

    margin: 38px 0 0 !important;
    padding: 19px 0 21px !important;

    border-top:
        1px solid rgba(255, 255, 255, 0.14) !important;

    text-align: left !important;
}

.jdih-footer__copyright {
    display: block !important;

    margin: 0 !important;
    padding: 0 !important;

    color: #d6dfd1 !important;

    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 13px !important;
    font-weight: 400 !important;
    line-height: 1.5 !important;

    opacity: .9 !important;
}


/* =========================================================
   AI BUTTON
   ========================================================= */

.jdih-ai-float {
    position: fixed !important;

    right: 28px !important;
    bottom: 22px !important;

    z-index: 9999 !important;

    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;

    gap: 8px !important;

    min-height: 50px !important;

    padding: 0 25px !important;

    border: 0 !important;
    border-radius: 999px !important;

    background: #f5cf57 !important;
    color: #21451a !important;

    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 15px !important;
    font-weight: 700 !important;

    text-decoration: none !important;

    box-shadow:
        0 8px 24px rgba(0, 0, 0, .15) !important;

    transition:
        transform .2s ease,
        box-shadow .2s ease !important;
}

.jdih-ai-float:hover {
    color: #21451a !important;
    text-decoration: none !important;
    transform: translateY(-2px) !important;

    box-shadow:
        0 12px 28px rgba(0, 0, 0, .20) !important;
}

.jdih-ai-float i {
    font-size: 16px !important;
}


/* =========================================================
   TABLET
   ========================================================= */

@media (max-width: 900px) {

    .jdih-footer {
        padding-top: 42px !important;
    }

    .jdih-footer > .container {
        width: calc(100% - 48px) !important;
        max-width: none !important;
    }

    .jdih-footer__content {
        grid-template-columns:
            minmax(0, 1.2fr)
            minmax(170px, .8fr)
            minmax(220px, 1fr) !important;

        column-gap: 35px !important;
    }

    .jdih-footer__logo-img {
        width: 185px !important;
    }

    .jdih-footer__desc {
        max-width: 420px !important;
        font-size: 13px !important;
    }

    .jdih-footer__heading {
        font-size: 20px !important;
    }

    .jdih-footer__list a,
    .jdih-footer__contact-item {
        font-size: 13px !important;
    }
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 700px) {

    .jdih-footer {
        padding-top: 38px !important;
    }

    .jdih-footer > .container {
        width: calc(100% - 36px) !important;
    }

    .jdih-footer__content {
        display: grid !important;

        grid-template-columns: 1fr 1fr !important;

        column-gap: 25px !important;
        row-gap: 32px !important;
    }

    .jdih-footer__col--primary {
        grid-column: 1 / -1 !important;
    }

    .jdih-footer__desc {
        max-width: 600px !important;
    }

    .jdih-footer__bottom {
        margin-top: 30px !important;
    }

    .jdih-ai-float {
        right: 16px !important;
        bottom: 16px !important;
        min-height: 46px !important;
        padding: 0 18px !important;
        font-size: 14px !important;
    }
}


/* =========================================================
   SMALL MOBILE
   ========================================================= */

@media (max-width: 480px) {

    .jdih-footer > .container {
        width: calc(100% - 32px) !important;
    }

    .jdih-footer__content {
        grid-template-columns: 1fr !important;
        row-gap: 28px !important;
    }

    .jdih-footer__col--primary {
        grid-column: auto !important;
    }

    .jdih-footer__logo-img {
        width: 180px !important;
    }

    .jdih-footer__bottom {
        text-align: center !important;
    }

    .jdih-ai-float {
        right: 12px !important;
        bottom: 12px !important;
        padding: 0 16px !important;
    }
}
</style>


<footer class="jdih-footer" role="contentinfo">

    <div class="container">

        <div class="jdih-footer__content">


            <!-- =================================================
                 KOLOM 1 — INFORMASI JDIH
            ================================================== -->

            <div class="jdih-footer__col jdih-footer__col--primary">

                <div class="jdih-footer__logo">

                    <?= Html::img(
                        '@web/images/upnvjt-logo-yellow.png',
                        [
                            'alt' => 'JDIH UPN "Veteran" Jawa Timur',
                            'class' => 'jdih-footer__logo-img',
                        ]
                    ) ?>

                </div>


                <p class="jdih-footer__desc">
                    Portal Jaringan Dokumentasi dan Informasi Hukum UPN
                    "Veteran" Jawa Timur sebagai sarana pelayanan informasi
                    hukum yang terpadu, akurat, dan mudah diakses.
                </p>


                <div class="jdih-footer__social">

                    <?= Html::a(
                        '<i class="bi bi-facebook" aria-hidden="true"></i>',
                        'https://facebook.com',
                        [
                            'class' => 'jdih-footer__social-link',
                            'target' => '_blank',
                            'rel' => 'noopener noreferrer',
                            'aria-label' => 'Facebook',
                        ]
                    ) ?>

                    <?= Html::a(
                        '<i class="bi bi-twitter" aria-hidden="true"></i>',
                        'https://twitter.com',
                        [
                            'class' => 'jdih-footer__social-link',
                            'target' => '_blank',
                            'rel' => 'noopener noreferrer',
                            'aria-label' => 'Twitter',
                        ]
                    ) ?>

                    <?= Html::a(
                        '<i class="bi bi-linkedin" aria-hidden="true"></i>',
                        'https://linkedin.com',
                        [
                            'class' => 'jdih-footer__social-link',
                            'target' => '_blank',
                            'rel' => 'noopener noreferrer',
                            'aria-label' => 'LinkedIn',
                        ]
                    ) ?>

                    <?= Html::a(
                        '<i class="bi bi-youtube" aria-hidden="true"></i>',
                        'https://youtube.com',
                        [
                            'class' => 'jdih-footer__social-link',
                            'target' => '_blank',
                            'rel' => 'noopener noreferrer',
                            'aria-label' => 'YouTube',
                        ]
                    ) ?>

                </div>

            </div>


            <!-- =================================================
                 KOLOM 2 — TAUTAN CEPAT
            ================================================== -->

            <div class="jdih-footer__col">

                <h3 class="jdih-footer__heading">
                    Tautan Cepat
                </h3>

                <ul class="jdih-footer__list">

                    <li>
                        <?= Html::a(
                            'JDIHN',
                            'https://jdihn.go.id',
                            [
                                'target' => '_blank',
                                'rel' => 'noopener noreferrer',
                            ]
                        ) ?>
                    </li>

                    <li>
                        <?= Html::a(
                            'UPN Veteran Jatim',
                            'https://upnjatim.ac.id',
                            [
                                'target' => '_blank',
                                'rel' => 'noopener noreferrer',
                            ]
                        ) ?>
                    </li>

                    <li>
                        <?= Html::a(
                            'Kontak Kami',
                            ['/site/kontak']
                        ) ?>
                    </li>

                    <li>
                        <?= Html::a(
                            'Peta Situs',
                            ['/site/sitemap']
                        ) ?>
                    </li>

                </ul>

            </div>


            <!-- =================================================
                 KOLOM 3 — KONTAK
            ================================================== -->

            <div class="jdih-footer__col">

                <h3 class="jdih-footer__heading">
                    Kontak
                </h3>

                <div class="jdih-footer__contact">

                    <div class="jdih-footer__contact-item">

                        <i
                            class="bi bi-geo-alt"
                            aria-hidden="true"
                        ></i>

                        <p>
                            Jl. Raya Rungkut Madya,<br>
                            Gunung Anyar, Surabaya,<br>
                            Jawa Timur 60294
                        </p>

                    </div>


                    <div class="jdih-footer__contact-item">

                        <i
                            class="bi bi-telephone"
                            aria-hidden="true"
                        ></i>

                        <p>
                            +62 (031) 870 6369
                        </p>

                    </div>


                    <div class="jdih-footer__contact-item">

                        <i
                            class="bi bi-envelope"
                            aria-hidden="true"
                        ></i>

                        <p>

                            <?= Html::a(
                                'humas@upnjatim.ac.id',
                                'mailto:humas@upnjatim.ac.id'
                            ) ?>

                        </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             COPYRIGHT
        ================================================== -->

        <div class="jdih-footer__bottom">

            <p class="jdih-footer__copyright">
                &copy; 2026 JDIH UPN Veteran Jawa Timur.
                All Rights Reserved.
            </p>

        </div>

    </div>

</footer>


<!-- =========================================================
     TANYA AI JDIH
========================================================= -->

<?= Html::a(
    '<i class="bi bi-stars" aria-hidden="true"></i> Tanya AI JDIH',
    ['/site/tanya-ai'],
    [
        'class' => 'jdih-ai-float',
        'aria-label' => 'Tanya AI JDIH',
    ]
) ?>