<?php
namespace common\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class BuyButton extends \dvizh\cart\widgets\BuyButton
{
    public function run()
    {
        if (Yii::$app->user->isGuest) {
            return Html::a(
                $this->text,
                ['/user/security/login'],
                [
                    'class' => $this->cssClass,
                ]
            );
        }

        return parent::run();
    }
}
