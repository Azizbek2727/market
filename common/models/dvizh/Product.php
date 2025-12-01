<?php


namespace common\models\dvizh;

use common\models\TranslatableTrait;

class Product extends \dvizh\shop\models\Product
{
    use TranslatableTrait;


    public function getTranslatableAttributes()
    {
        return ['name'];
    }

    // convenience getters used by views (so $product->name works unchanged)
    public function getName()
    {
        return $this->tOrOrig('name');
    }
}