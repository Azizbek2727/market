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
        'cartzilla/assets/icons/cartzilla-icons.min.css',
        'cartzilla/assets/vendor/swiper/swiper-bundle.min.css',
    ];
    public $js = [
        'cartzilla/assets/js/theme-switcher.js' => View::POS_HEAD,
        'cartzilla/assets/vendor/swiper/swiper-bundle.min.js' => View::POS_END,
        'cartzilla/assets/js/theme.min.js' => View::POS_END,
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
