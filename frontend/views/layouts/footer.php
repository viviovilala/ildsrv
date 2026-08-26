<?php

use yii\helpers\Html;
?>

<footer class="jdih-footer" role="contentinfo">
    <div class="container">

        <div class="jdih-footer__content">

            <!-- KOLOM 1 — INFORMASI JDIH -->
            <div class="jdih-footer__col jdih-footer__col--primary">

                <div class="jdih-footer__logo">
                    <?= Html::img('@web/images/upnvjt-logo-yellow.png', [
                        'alt' => 'JDIH UPN Veteran Jawa Timur',
                        'class' => 'jdih-footer__logo-img',
                    ]) ?>
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


            <!-- KOLOM 2 — TAUTAN CEPAT -->
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


            <!-- KOLOM 3 — KONTAK -->
            <div class="jdih-footer__col">

                <h3 class="jdih-footer__heading">
                    Kontak
                </h3>

                <div class="jdih-footer__contact">

                    <div class="jdih-footer__contact-item">
                        <i class="bi bi-geo-alt" aria-hidden="true"></i>

                        <p>
                            Jl. Raya Rungkut Madya,
                            Gunung Anyar, Surabaya,
                            Jawa Timur 60294
                        </p>
                    </div>

                    <div class="jdih-footer__contact-item">
                        <i class="bi bi-telephone" aria-hidden="true"></i>

                        <p>
                            +62 (031) 870 6369
                        </p>
                    </div>

                    <div class="jdih-footer__contact-item">
                        <i class="bi bi-envelope" aria-hidden="true"></i>

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


        <!-- COPYRIGHT -->
        <div class="jdih-footer__bottom">

            <p class="jdih-footer__copyright">
                &copy; <?= date('Y') ?>
                JDIH UPN Veteran Jawa Timur.
                All Rights Reserved.
            </p>

        </div>

    </div>
</footer>


<!-- FLOATING AI BUTTON -->
<?= Html::a(
    '<i class="bi bi-stars" aria-hidden="true"></i> Tanya AI JDIH',
    ['/site/tanya-ai'],
    [
        'class' => 'jdih-ai-float',
        'aria-label' => 'Tanya AI JDIH',
    ]
) ?>