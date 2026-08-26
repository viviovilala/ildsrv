<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);

$siteName = 'JDIH UPNVJT';

/*
 * =========================================================
 * URL & BRAND
 * =========================================================
 */

$canonicalUrl = Url::canonical();

$brandLogo = Url::to(
    '@web/images/upnvjt-logo-yellow.png'
);

$splashBackground = Url::to(
    '@web/images/hero-bg.png'
);


/*
 * =========================================================
 * META DESCRIPTION
 * =========================================================
 */

if (empty($this->params['description'])) {

    $this->registerMetaTag([
        'name' => 'description',
        'content' =>
            'Jaringan Dokumentasi dan Informasi Hukum UPN Veteran Jawa Timur. Portal informasi hukum, peraturan, monografi, putusan, artikel, dan berita hukum.'
    ]);

} else {

    $this->registerMetaTag([
        'name' => 'description',
        'content' => $this->params['description']
    ]);

}

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="<?= Yii::$app->charset ?>">

    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    >

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <?= Html::csrfMetaTags() ?>

    <title>
        <?= Html::encode($this->title) ?>
        -
        <?= Html::encode($siteName) ?>
    </title>

    <link
        rel="canonical"
        href="<?= Html::encode($canonicalUrl) ?>"
    >

    <?php if (!empty($this->params['structuredData'])): ?>

        <script type="application/ld+json">
            <?= json_encode(
                $this->params['structuredData'],
                JSON_UNESCAPED_UNICODE |
                JSON_UNESCAPED_SLASHES |
                JSON_HEX_TAG |
                JSON_HEX_AMP |
                JSON_HEX_APOS |
                JSON_HEX_QUOT
            ) ?>
        </script>

    <?php endif; ?>


    <?php $this->head() ?>


    <!-- =====================================================
         FAVICON
    ====================================================== -->

    <link
        href="<?= Url::to('@web/images/favicon.png') ?>"
        rel="icon"
    >

    <link
        href="<?= Url::to('@web/images/apple-touch-icon.png') ?>"
        rel="apple-touch-icon"
    >


    <!-- =====================================================
         GOOGLE FONT
    ====================================================== -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- =====================================================
         FOOTER CSS
    ====================================================== -->

    <link
        rel="stylesheet"
        href="<?= Url::to('@web/css/footer.css') ?>?v=20260827"
    >

</head>


<body>

<?php $this->beginBody() ?>


<!-- =========================================================
     SKIP LINK
========================================================= -->

<a
    class="visually-hidden-focusable skip-link"
    href="#main-content"
>
    Lewati ke konten
</a>


<!-- =========================================================
     HEADER
========================================================= -->

<header class="jdih-public-header">

    <div class="container jdih-public-header__inner">


        <!-- BRAND -->

        <?= Html::a(

            Html::img(
                $brandLogo,
                [
                    'alt' =>
                        'JDIH UPN Veteran Jawa Timur',
                ]
            ),

            ['/site/index'],

            [
                'class' =>
                    'jdih-brand',
            ]

        ) ?>


        <!-- =================================================
             NAVIGATION
        ================================================== -->

        <nav
            class="jdih-public-nav"
            aria-label="Navigasi utama"
        >

            <?= Html::a(
                'Beranda',
                ['/site/index'],
                [
                    'class' =>
                        (
                            Yii::$app->controller->id === 'site'
                            &&
                            Yii::$app->controller->action->id === 'index'
                        )
                            ? 'active'
                            : ''
                ]
            ) ?>


            <?= Html::a(
                'Produk Hukum',
                ['/dokumen/peraturan'],
                [
                    'class' =>
                        Yii::$app->controller->id === 'dokumen'
                            ? 'active'
                            : ''
                ]
            ) ?>


            <?= Html::a(
                'Berita',
                ['/berita/index'],
                [
                    'class' =>
                        Yii::$app->controller->id === 'berita'
                            ? 'active'
                            : ''
                ]
            ) ?>


            <?= Html::a(
                'Informasi',
                ['/site/kontak'],
                [
                    'class' =>
                        (
                            Yii::$app->controller->id === 'site'
                            &&
                            Yii::$app->controller->action->id === 'kontak'
                        )
                            ? 'active'
                            : ''
                ]
            ) ?>


            <?= Html::a(
                'Tentang',
                ['/site/about'],
                [
                    'class' =>
                        (
                            Yii::$app->controller->id === 'site'
                            &&
                            Yii::$app->controller->action->id === 'about'
                        )
                            ? 'active'
                            : ''
                ]
            ) ?>

        </nav>


        <!-- =================================================
             SEARCH
        ================================================== -->

        <form
            class="jdih-header-search"
            action="<?= Url::to(['/dokumen/index']) ?>"
            method="get"
            role="search"
        >

            <i
                class="bi bi-search"
                aria-hidden="true"
            ></i>

            <input
                name="DokumenSearch[judul]"
                type="search"
                placeholder="Cari dokumen..."
                aria-label="Cari dokumen"
                autocomplete="off"
            >

        </form>


        <!-- LOGIN -->

        <?= Html::a(
            'Masuk',
            ['/site/login'],
            [
                'class' =>
                    'jdih-login-link'
            ]
        ) ?>

    </div>

</header>


<!-- =========================================================
     MOBILE NAVIGATION
========================================================= -->

<div
    id="mobile-nav"
    class="mobile-nav"
    aria-hidden="true"
>

    <div
        class="mobile-nav-backdrop"
        aria-hidden="true"
    ></div>


    <aside
        class="mobile-nav-drawer"
        role="dialog"
        aria-modal="false"
        aria-label="Menu navigasi"
    >


        <!-- MOBILE HEADER -->

        <div class="mobile-nav-header">

            <div class="mobile-nav-header__brand">

                <a
                    href="<?= Url::to(['/']) ?>"
                    class="mobile-nav-header__logo-link"
                >

                    <?= Html::img(
                        $brandLogo,
                        [
                            'class' =>
                                'mobile-nav-header__logo',

                            'alt' =>
                                'Logo UPN Veteran Jawa Timur',
                        ]
                    ) ?>

                </a>

                <span class="mobile-nav-header__title">
                    Menu
                </span>

            </div>


            <button
                type="button"
                class="mobile-nav-close"
                aria-label="Tutup menu"
            >

                <i
                    class="bi bi-x-lg"
                    aria-hidden="true"
                ></i>

            </button>

        </div>


        <!-- MOBILE SEARCH -->

        <form
            class="mobile-nav-search"
            action="<?= Url::to(['/dokumen/index']) ?>"
            method="get"
            role="search"
        >

            <i
                class="bi bi-search mobile-nav-search__icon"
                aria-hidden="true"
            ></i>

            <input
                type="search"
                name="DokumenSearch[judul]"
                class="mobile-nav-search__input"
                placeholder="Cari dokumen..."
                autocomplete="off"
                aria-label="Cari dokumen"
            >

        </form>


        <!-- MOBILE MENU -->

        <div class="mobile-nav-body">

            <?= $this->render('menu.php') ?>

        </div>

    </aside>

</div>


<!-- =========================================================
     MAIN CONTENT
========================================================= -->

<main
    id="main-content"
    role="main"
>

    <?= Alert::widget() ?>

    <?= $content ?>

</main>


<!-- =========================================================
     FOOTER
========================================================= -->

<?= $this->render('footer.php') ?>


<!-- =========================================================
     ACCESSIBILITY WIDGET
========================================================= -->

<div
    id="a11y-widget"
    class="a11y-widget"
    aria-label="Widget aksesibilitas"
>


    <button
        type="button"
        id="a11y-widget-toggle"
        class="a11y-widget__toggle"
        aria-expanded="false"
        aria-controls="a11y-widget-panel"
        aria-label="Buka menu aksesibilitas"
        title="Menu aksesibilitas"
    >

        <i
            class="bi bi-universal-access-circle"
            aria-hidden="true"
        ></i>

    </button>


    <div
        id="a11y-widget-panel"
        class="a11y-widget__panel"
        hidden
        role="region"
        aria-label="Menu aksesibilitas"
    >


        <!-- HEADER -->

        <div class="a11y-widget__header">

            <h2 class="a11y-widget__title">
                Aksesibilitas
            </h2>

            <button
                type="button"
                id="a11y-widget-close"
                class="a11y-widget__close"
                aria-label="Tutup menu aksesibilitas"
            >

                <i
                    class="bi bi-x-lg"
                    aria-hidden="true"
                ></i>

            </button>

        </div>


        <!-- MENU -->

        <ul class="a11y-widget__menu">


            <li class="a11y-widget__item">

                <button
                    type="button"
                    class="a11y-widget__action"
                    data-a11y-action="font-increase"
                >

                    <i
                        class="bi bi-zoom-in"
                        aria-hidden="true"
                    ></i>

                    <span>
                        Perbesar teks
                    </span>

                </button>

            </li>


            <li class="a11y-widget__item">

                <button
                    type="button"
                    class="a11y-widget__action"
                    data-a11y-action="font-decrease"
                >

                    <i
                        class="bi bi-zoom-out"
                        aria-hidden="true"
                    ></i>

                    <span>
                        Perkecil teks
                    </span>

                </button>

            </li>


            <li
                class="a11y-widget__divider"
                aria-hidden="true"
            ></li>


            <li class="a11y-widget__item">

                <button
                    type="button"
                    class="a11y-widget__action"
                    data-a11y-action="a11y-high-contrast"
                >

                    <i
                        class="bi bi-circle-half"
                        aria-hidden="true"
                    ></i>

                    <span>
                        Kontras tinggi
                    </span>

                </button>

            </li>


            <li class="a11y-widget__item">

                <button
                    type="button"
                    class="a11y-widget__action"
                    data-a11y-action="a11y-grayscale"
                >

                    <i
                        class="bi bi-palette"
                        aria-hidden="true"
                    ></i>

                    <span>
                        Mode abu-abu
                    </span>

                </button>

            </li>


            <li class="a11y-widget__item">

                <button
                    type="button"
                    class="a11y-widget__action"
                    data-a11y-action="a11y-highlight-links"
                >

                    <i
                        class="bi bi-link-45deg"
                        aria-hidden="true"
                    ></i>

                    <span>
                        Sorot tautan
                    </span>

                </button>

            </li>


            <li class="a11y-widget__item">

                <button
                    type="button"
                    class="a11y-widget__action"
                    data-a11y-action="a11y-readable-font"
                >

                    <i
                        class="bi bi-type"
                        aria-hidden="true"
                    ></i>

                    <span>
                        Font mudah dibaca
                    </span>

                </button>

            </li>


            <li
                class="a11y-widget__divider"
                aria-hidden="true"
            ></li>


            <li class="a11y-widget__item">

                <button
                    type="button"
                    class="a11y-widget__action"
                    data-a11y-action="read-aloud"
                >

                    <i
                        class="bi bi-volume-up"
                        aria-hidden="true"
                    ></i>

                    <span>
                        Baca layar
                    </span>

                </button>

            </li>


            <li class="a11y-widget__item">

                <button
                    type="button"
                    class="a11y-widget__action"
                    data-a11y-action="stop-read"
                >

                    <i
                        class="bi bi-stop-circle"
                        aria-hidden="true"
                    ></i>

                    <span>
                        Hentikan bacaan
                    </span>

                </button>

            </li>


            <li
                class="a11y-widget__divider"
                aria-hidden="true"
            ></li>


            <li class="a11y-widget__item">

                <button
                    type="button"
                    class="a11y-widget__action"
                    data-a11y-action="reset"
                >

                    <i
                        class="bi bi-arrow-counterclockwise"
                        aria-hidden="true"
                    ></i>

                    <span>
                        Atur ulang
                    </span>

                </button>

            </li>

        </ul>

    </div>

</div>


<!-- =========================================================
     SPLASH SCREEN
========================================================= -->

<div
    id="jdih-splash"
    class="jdih-splash"
    role="status"
    aria-live="polite"
    style="
        background-image:
        linear-gradient(
            rgba(0, 63, 10, 0.86),
            rgba(0, 63, 10, 0.78)
        ),
        url('<?= Html::encode($splashBackground) ?>');
    "
>


    <div class="jdih-splash__panel">

        <?= Html::img(
            $brandLogo,
            [
                'class' =>
                    'jdih-splash__logo',

                'alt' =>
                    'Logo UPN Veteran Jawa Timur',
            ]
        ) ?>


        <p class="jdih-splash__subtitle">
            JDIH UPNVJT
        </p>


        <h2 class="jdih-splash__title">
            Portal Informasi Hukum
        </h2>


        <span
            class="jdih-splash__loader"
            aria-hidden="true"
        ></span>

    </div>

</div>


<!-- =========================================================
     BACK TO TOP
========================================================= -->

<a
    href="#"
    class="back-to-top"
    aria-label="Kembali ke atas"
>

    <i
        class="bi bi-chevron-up"
        aria-hidden="true"
    ></i>

</a>


<!-- =========================================================
     PAGE JAVASCRIPT
========================================================= -->

<?php $this->endBody() ?>


<!-- =========================================================
     SPLASH SCRIPT
========================================================= -->

<script>

(function () {

    var splash =
        document.getElementById('jdih-splash');

    if (!splash) {
        return;
    }


    var splashKey =
        'jdih-upnvjt-splash-shown';


    /*
     * Jangan tampilkan splash berulang
     * dalam satu session.
     */

    try {

        if (
            window.sessionStorage &&
            window.sessionStorage.getItem(splashKey)
        ) {

            splash.classList.add('is-hidden');

            return;

        }

    } catch (error) {

        /*
         * Jika sessionStorage diblokir browser,
         * splash tetap berjalan normal.
         */

    }


    window.addEventListener(
        'load',
        function () {

            window.setTimeout(
                function () {

                    splash.classList.add(
                        'is-hidden'
                    );


                    try {

                        if (window.sessionStorage) {

                            window.sessionStorage.setItem(
                                splashKey,
                                '1'
                            );

                        }

                    } catch (error) {

                        /*
                         * Tidak perlu melakukan apa-apa.
                         */

                    }

                },
                520
            );

        }
    );

}());

</script>


</body>

</html>

<?php $this->endPage() ?>