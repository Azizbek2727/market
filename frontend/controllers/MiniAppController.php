<?php
// frontend/controllers/MiniAppController.php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\dvizh\Product; // dvizh product model

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
}
