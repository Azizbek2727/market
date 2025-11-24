<?php


namespace common\widgets;

use yii\helpers\Html;
use yii\helpers\Url;

class ChangeCount extends \dvizh\cart\widgets\ChangeCount
{
    public $model;
    public $lineSelector = 'li';
    public $defaultValue = 1;
    public $actionUpdateUrl = '/cart/element/update';

    public function run()
    {
        $value = $this->model->getCount();
        $id = $this->model->getId();

        return Html::tag('div',
            // --- decrement ---
            Html::button(
                Html::tag('i', '', ['class' => 'ci-minus']),
                [
                    'type' => 'button',
                    'class' => 'btn btn-icon btn-lg cz-qty-decrease',
                    'aria-label' => 'Decrement quantity',
                    'data-role' => 'cart-qty-minus'
                ]
            ).

            // --- input ---
            Html::input('number', 'count', $value, [
                'class' => 'form-control form-control-lg cz-qty-input dvizh-cart-element-count',
                'data-role' => 'cart-element-count',
                'data-line-selector' => $this->lineSelector,
                'data-id' => $id,
                'data-href' => Url::to($this->actionUpdateUrl),
                'min' => 1
            ]).

            // --- increment ---
            Html::button(
                Html::tag('i', '', ['class' => 'ci-plus']),
                [
                    'type' => 'button',
                    'class' => 'btn btn-icon btn-lg cz-qty-increase',
                    'aria-label' => 'Increment quantity',
                    'data-role' => 'cart-qty-plus'
                ]
            ),

            [
                'class' => 'cz-qty d-flex align-items-center gap-2',
                'data-line-selector' => $this->lineSelector,
                'data-id' => $id,
            ]
        );
    }
}