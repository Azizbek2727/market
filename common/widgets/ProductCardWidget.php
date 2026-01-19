<?php
namespace common\widgets;

use yii\base\Widget;

class ProductCardWidget extends Widget
{
    public $model;
    public $miniApp = false;

    public function run()
    {
        if($this->miniApp){
            return $this->render('product-card-mini-app', [
                'model' => $this->model,
            ]);
        }
        return $this->render('product-card', [
            'model' => $this->model,
        ]);
    }
}
