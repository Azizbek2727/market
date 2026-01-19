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
        $p = Product::find()
            ->where(['available' => 'yes'])
            ->all();

        $products = [];

        foreach ($p as $model) {
            $image = $model->getImage()
                ? $model->getImage()->getUrl('600x600')
                : '/cartzilla/assets/img/shop/placeholder.png';

            $products[] = [
                'id' => $model->id,
                'name' => $model->name,
                'image' => $image,
            ];
        }

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
            'miniApp' => true,
        ]);
    }
}
