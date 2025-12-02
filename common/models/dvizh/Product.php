<?php


namespace common\models\dvizh;

use common\models\TranslatableTrait;

class Product extends \dvizh\shop\models\Product
{
    use TranslatableTrait;


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
}