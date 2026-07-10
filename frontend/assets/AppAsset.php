<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/frontend/assets';
    public $css = [
        ['css/plugins.css', 'appendTimestamp' => true],
        ['search/search.css', 'appendTimestamp' => true],
        'vendor/aos/aos.css',
        'vendor/bootstrap/css/bootstrap.min.css',
        'vendor/bootstrap-icons/bootstrap-icons.css',
        'vendor/boxicons/css/boxicons.min.css',
        'vendor/swiper/swiper-bundle.min.css',
        ['css/lazyload.css', 'appendTimestamp' => true],
<<<<<<< HEAD
        ['css/jdih-upnvjt.css', 'appendTimestamp' => true],
=======
        ['css/jdih-theme.css', 'appendTimestamp' => true],
        ['css/jdih-components.css', 'appendTimestamp' => true],
        ['css/homepage.css', 'appendTimestamp' => true],
        ['css/catalog.css', 'appendTimestamp' => true],
        ['css/document-detail.css', 'appendTimestamp' => true],
        ['css/news.css', 'appendTimestamp' => true],
>>>>>>> 5bef1a2f6a6de30f1f4e8c9f59bd9ee27d536d98
        ['css/style.css', 'appendTimestamp' => true],
        ['css/mobile-menu.css', 'appendTimestamp' => true],
        ['css/a11y.css', 'appendTimestamp' => true],
    ];

    public $js = [
        'vendor/bootstrap/js/bootstrap.bundle.min.js',
        ['js/lazyload.js', 'appendTimestamp' => true],
        'vendor/aos/aos.js',
        'vendor/swiper/swiper-bundle.min.js',
        'vendor/php-email-form/validate.js',
        ['js/main.js', 'appendTimestamp' => true],
        ['js/a11y.js', 'appendTimestamp' => true],
    ];

    public $jsOptions = ['defer' => true];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
