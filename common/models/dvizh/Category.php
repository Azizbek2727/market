<?php


namespace common\models\dvizh;

use common\models\TranslatableTrait;

class Category extends \dvizh\shop\models\Category
{
    use TranslatableTrait;

    public function getTranslatableAttributes()
    {
        return [
            'name',
            'text',
        ];
    }

    public function getTranslationWidgets()
    {
        return [
            'name' => 'input',        // simple text input
            'text' => 'imperavi',     // full WYSIWYG
        ];
    }

    // convenience getters used by views (so $product->name works unchanged)
    public function getName()
    {
        return $this->tOrOrig('name');
    }


    // convenience getters used by views (so $product->name works unchanged)
    public function getText()
    {
        return $this->tOrOrig('text');
    }
}