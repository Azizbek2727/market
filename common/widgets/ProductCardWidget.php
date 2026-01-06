<?php
namespace common\widgets;

use yii\base\Widget;

class ProductCardWidget extends Widget
{
    public $model;

    public function run()
    {
        return $this->render('product-card', [
            'model' => $this->model,
        ]);
    }
}
