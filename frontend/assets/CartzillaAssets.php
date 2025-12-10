<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class CartzillaAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/cartzilla/assets/icons/cartzilla-icons.min.css',
        '/cartzilla/assets/vendor/swiper/swiper-bundle.min.css',
    ];
    public $js = [
        '/cartzilla/assets/js/theme-switcher.js',
        '/cartzilla/assets/vendor/swiper/swiper-bundle.min.js',
        '/cartzilla/assets/js/theme.min.js',
    ];
    public $depends = [
        '\frontend\assets\JqueryAsset'
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
