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
        'assets/vendor/drift-zoom/dist/drift-basic.min.css',
        'assets/vendor/simplebar/dist/simplebar.min.css',
        'assets/vendor/choices.js/public/assets/styles/choices.min.css',
    ];
    public $js = [
        'assets/vendor/drift-zoom/dist/Drift.min.js' => View::POS_END,
        'assets/vendor/simplebar/dist/simplebar.min.js' => View::POS_END,
        'assets/vendor/choices.js/public/assets/scripts/choices.min.js' => View::POS_END,
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
