<?php
// frontend/controllers/MiniAppController.php

namespace frontend\controllers;

use common\widgets\ProductCardWidget;
use Yii;
use yii\web\Controller;
use common\models\dvizh\Product;
use yii\web\Response;

// dvizh product model

class MiniAppController extends Controller
{
    public $layout = false;

    public function actionIndex()
    {
        $products = Product::find()
            ->where(['available' => 'yes'])
            ->select(['id', 'name',])
            ->asArray()
            ->all();

        return $this->render('index', [
            'products' => $products,
        ]);
    }

    public function actionProductCard($id)
    {
        Yii::$app->response->format = Response::FORMAT_HTML;

        $model = Product::findOne((int)$id);

        if (!$model) {
            return '<div class="alert alert-warning">Product not found</div>';
        }

        return ProductCardWidget::widget([
            'model' => $model,
        ]);
    }
}
