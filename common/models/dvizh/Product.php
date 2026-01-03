<?php


namespace common\models\dvizh;

use common\models\TranslatableTrait;
use Yii;

class Product extends \dvizh\shop\models\Product
{
    use TranslatableTrait;
//
//    public function __get($name)
//    {
//        // If attribute is translatable → return translated value
//        if (in_array($name, $this->getTranslatableAttributes())) {
//            return $this->tOrOrig($name);
//        }
//
//        return parent::__get($name);
//    }

    public function getTranslatableAttributes()
    {
        return [
            'name',
            'short_text',
            'text',
        ];
    }

    public function getTranslationWidgets()
    {
        return [
            'name' => 'input',        // simple text input
            'short_text' => 'textarea',
            'text' => 'imperavi',     // full WYSIWYG
        ];
    }

    // convenience getters used by views (so $product->name works unchanged)
    public function getName()
    {
        return $this->tOrOrig('name');
    }

    // convenience getters used by views (so $product->name works unchanged)
    public function getShort_text()
    {
        return $this->tOrOrig('short_text');
    }

    // convenience getters used by views (so $product->name works unchanged)
    public function getText()
    {
        return $this->tOrOrig('text');
    }

    public function getPrice($type = null)
    {
        if($callable = Yii::$app->getModule('shop')->priceCallable) {
            return $callable($this);
        }

        if($price = $this->getPriceModel($type)) {
            return number_format($price->price, 0, '.', ' ');
        }

        return null;
    }
}