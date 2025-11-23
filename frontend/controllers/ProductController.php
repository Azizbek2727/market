<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use dvizh\shop\models\Product;

class ProductController extends Controller
{
    /**
     * Shows a single product page.
     *
     * /product/123
     * /product?slug=iphone-15
     */
    public function actionView($id = null, $slug = null)
    {
        if ($id !== null) {
            $model = Product::findOne($id);
        } elseif ($slug !== null) {
            $model = Product::find()->where(['slug' => $slug])->one();
        } else {
            throw new NotFoundHttpException('Product not found.');
        }

        if (!$model) {
            throw new NotFoundHttpException('Product not found.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
