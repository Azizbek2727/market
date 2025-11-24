<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class ProductAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/cartzilla/assets/vendor/drift-zoom/dist/drift-basic.min.css',
        '/cartzilla/assets/vendor/simplebar/dist/simplebar.min.css',
        '/cartzilla/assets/vendor/choices.js/public/assets/styles/choices.min.css',
    ];
    public $js = [
//        '/cartzilla/assets/vendor/drift-zoom/dist/Drift.min.js',
//        '/cartzilla/assets/vendor/simplebar/dist/simplebar.min.js',
//        '/cartzilla/assets/vendor/choices.js/public/assets/scripts/choices.min.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
