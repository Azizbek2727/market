<?php

namespace common\widgets;

use yii\base\Widget;
use common\widgets\ProductCardWidget;

class ProductGridWidget extends Widget
{
    public $dataProvider;

    public $gridClass =
        'row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 pt-4';

    public function run()
    {
        $html = '<div class="' . $this->gridClass . '">';

        foreach ($this->dataProvider->getModels() as $model) {
            $html .= ProductCardWidget::widget(['model' => $model]);
        }

        $html .= '</div>';

        return $html;
    }
}
