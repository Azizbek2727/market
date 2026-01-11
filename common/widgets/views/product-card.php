<?php

/**
 * @var $this yii\web\View
 * @var $model common\models\dvizh\Product;
 */

use common\widgets\BuyButton;
use common\widgets\ShowPrice;
use dvizh\cart\Cart;
use yii\helpers\Html;
use yii\helpers\Url;

$image = $model->getImage()
    ? $model->getImage()->getUrl('600x600')
    : '/cartzilla/assets/img/shop/placeholder.png';

$url = Yii::$app->urlManager->createUrl(['/product/view', 'id' => $model->id]);

$price = ShowPrice::widget(['model' => $model]);
$oldPrice = $model->getOldprice() != null ? ShowPrice::widget(['model' => $model, 'price' => $model->getOldprice()]) : null;

$discount = null;
if (!empty($oldPrice) && $oldPrice > $price) {
    $discount = round((1 - $price / $oldPrice) * 100);
}

$badge = '';
if (!empty($discount)) {
    $badge = '<span class="badge bg-danger position-absolute top-0 start-0 mt-2 ms-2 mt-lg-3 ms-lg-3">-'
        . $discount . '%</span>';
}

$rating = isset($model->rating) ? intval($model->rating) : 5;
$ratingStars = '';
for ($i = 1; $i <= 5; $i++) {
    if ($i <= $rating) {
        $ratingStars .= '<i class="ci-star-filled text-warning"></i>';
    } else {
        $ratingStars .= '<i class="ci-star text-body-tertiary opacity-75"></i>';
    }
}


$buyButton = BuyButton::widget(
    [
        'model' => $model,
        'htmlTag' => 'button',
        'text' => '<i class="ci-shopping-cart fs-base animate-target"></i>',
        'cssClass' => 'w-100 product-card-button btn btn-icon btn-secondary animate-slide-end'
    ]
);

$element = \dvizh\cart\models\CartElement::findOne(['cart_id' => Yii::$app->cart->cart->id, 'item_id' => $model->getId()]);

$changeCount = \common\widgets\ChangeCount::widget(['model' => $model, 'inputCssClass' => 'w-100']);

Yii::$app->cart->getElements();

$orders = random_int(0, 981); //change later



?>

<div class="col" id="item-<?= $model->getId() ?>">
    <div class="product-card animate-underline hover-effect-opacity bg-body rounded">
        <div class="position-relative">
            <div class="position-absolute top-0 end-0 z-2 hover-effect-target opacity-0 mt-3 me-3">
                <div class="d-flex flex-column gap-2">
                    <button type="button" class="btn btn-icon btn-secondary animate-pulse d-none d-lg-inline-flex" aria-label="Add to Wishlist">
                        <i class="ci-heart fs-base animate-target"></i>
                    </button>
                </div>
            </div>
            <div class="dropdown d-lg-none position-absolute top-0 end-0 z-2 mt-2 me-2">
                <button type="button" class="btn btn-icon btn-sm btn-secondary bg-body" data-bs-toggle="dropdown" aria-expanded="false" aria-label="More actions">
                    <i class="ci-more-vertical fs-lg"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end fs-xs p-2" style="min-width: auto">
                    <li>
                        <a class="dropdown-item" href="#!">
                            <i class="ci-heart fs-sm ms-n1 me-2"></i>
                            Add to Wishlist
                        </a>
                    </li>
                </ul>
            </div>
            <a class="d-block rounded-top overflow-hidden p-3 p-sm-4" href="<?= $url ?>">
                <span class="badge bg-danger position-absolute top-0 start-0 mt-2 ms-2 mt-lg-3 ms-lg-3"><?= $badge ?></span>
                <div class="ratio" style="--cz-aspect-ratio: calc(240 / 258 * 100%)">
                    <img src="<?= $image ?>" alt="VR Glasses">
                </div>
            </a>
        </div>
        <div class="w-100 min-w-0 px-1 pb-2 px-sm-3 pb-sm-3">
            <div class="d-flex align-items-center gap-2 mb-2">
                <div class="d-flex gap-1 fs-xs">
                   <?= $ratingStars ?>
                </div>
                <span class="text-body-tertiary fs-xs"><?= $orders ?></span>
            </div>
            <h3 class="pb-1 mb-2">
                <a class="d-block fs-sm fw-medium text-truncate" href="<?= $url ?>">
                    <span class="animate-target"><?= $model->getName() ?></span>
                </a>
            </h3>
            <div class="d-flex align-items-center justify-content-between">
                <div class="h5 lh-1 mb-0"><?= $price ?> <del class="text-body-tertiary fs-sm fw-normal"><?= $oldPrice ?></del></div>
            </div>
        </div>
        <div class="px-1 pb-2 px-sm-3 pb-sm-3 container align-items-center justify-content-between product-cart-controls">
            <div class="buy-button-wrapper">
                <?= $buyButton ?>
            </div>

            <div class="change-count-wrapper d-none">
                <div class="count-input flex-shrink-0 order-sm-1 d-flex align-items-center gap-2 dvizh-change-count">
                    <button type="button"
                            class="btn btn-icon btn-lg dvizh-arr dvizh-downArr"
                            aria-label="Decrement quantity">
                        <i class="ci-minus"></i>
                    </button>

                    <?= Html::input('number', 'count', $element ? $element->count : 1, [
                        'class' => 'w-100 dvizh-cart-element-before-count form-control form-control-lg',
                        'id' => "counter-".$model->getId(),
                        'data-role' => 'cart-element-count',
                        'data-line-selector' => 'li',
                        'data-id' => $element ? $element->getId() : $model->getId(),
                        'data-href' => Url::toRoute(['/cart/element/update']),
                        'readonly' => true
                    ]) ?>

                    <button type="button"
                            class="btn btn-icon btn-lg dvizh-arr dvizh-upArr"
                            aria-label="Increment quantity">
                        <i class="ci-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>