<?php
namespace common\widgets;

use pheme\settings\models\Setting;
use yii\helpers\Html;
use yii\helpers\Url;

class ShowPrice extends \dvizh\shop\widgets\ShowPrice
{
    public function run()
    {
        $js = 'dvizh.modificationconstruct.dvizhShopUpdatePriceUrl = "' .Url::toRoute(['/shop/tools/get-modification-by-options']). '";';

        $this->getView()->registerJs($js);

        return Html::tag(
            $this->htmlTag,
            $this->model->getPrice() . (Setting::findOne(['key' => 'currency'])->value ?? ''),
            ['class' => "dvizh-shop-price dvizh-shop-price-{$this->model->id} {$this->cssClass}"]
        );
    }
}