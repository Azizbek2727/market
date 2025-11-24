<?php


namespace common\widgets;

use yii\helpers\Html;
use yii\helpers\Url;

class ChangeCount extends \dvizh\cart\widgets\ChangeCount
{
    public $model = NULL;
    public $lineSelector = 'li'; //Селектор материнского элемента, где выводится элемент
    public $downArr = '⟨';
    public $upArr = '⟩';
    public $cssClass = 'dvizh-change-count';
    public $defaultValue = 1;
    public $showArrows = true;
    public $actionUpdateUrl = '/cart/element/update';
    public $customView = false; // for example '@frontend/views/custom/changeCountLayout'

    public function init()
    {
        parent::init();

        \dvizh\cart\assets\WidgetAsset::register($this->getView());

        return true;
    }

    public function run()
    {
        if($this->showArrows) {
            $downArr = Html::a($this->downArr, '#', ['class' => 'dvizh-arr dvizh-downArr']);
            $upArr = Html::a($this->upArr, '#', ['class' => 'dvizh-arr dvizh-upArr']);
        } else {
            $downArr = $upArr = '';
        }

        if(!$this->model instanceof \dvizh\cart\interfaces\CartElement) {
            $input = Html::activeTextInput($this->model, 'count', [
                'type' => 'number',
                'class' => 'dvizh-cart-element-count',
                'data-role' => 'cart-element-count',
                'data-line-selector' => $this->lineSelector,
                'data-id' => $this->model->getId(),
                'data-href' => Url::toRoute($this->actionUpdateUrl),
            ]);
        } else {
            $input = Html::input('number', 'count', $this->defaultValue, [
                'class' => 'dvizh-cart-element-before-count form-control form-control-lg',
                'value' => 1, 'min'  => 1,
                'data-line-selector' => $this->lineSelector,
                'data-id' => $this->model->getCartId(),
            ]);
        }

        if ($this->customView) {
            return $this->render($this->customView, [
                'model' => $this->model,
                'defaultValue' => $this->defaultValue,
            ]);
        } else {
            return Html::tag(
                'div',

                // Decrement button
                Html::button(
                    Html::tag('i', '', ['class' => 'ci-minus']),
                    [
                        'type'        => 'button',
                        'class'       => 'btn btn-icon btn-lg dvizh-arr dvizh-downArr',
                        'data-decrement' => true,
                        'aria-label' => 'Decrement quantity'
                    ]
                ).

                // Input field
                $input .

                // Increment button
                Html::button(
                    Html::tag('i', '', ['class' => 'ci-plus']),
                    [
                        'type'        => 'button',
                        'class'       => 'btn btn-icon btn-lg dvizh-arr dvizh-upArr',
                        'data-increment' => true,
                        'aria-label' => 'Increment quantity'
                    ]
                ),

                [
                    'class' => 'count-input flex-shrink-0 order-sm-1 d-flex align-items-center gap-2 dvizh-change-count'
                ]
            );

        }
    }
}