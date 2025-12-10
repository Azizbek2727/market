<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $model \dvizh\cart\interfaces\CartElement */
/** @var $name string */
/** @var $cost string */
/** @var $showCountArrows bool */
/** @var $options array */
/** @var $controllerActions array */

// Product model behind cart item
$product = $model->getModel();

// Image
$image = $product->getImage();
$imgUrl = $image ? $image->getUrl('110x110') : '/cartzilla/assets/img/placeholder.png';

// Product URL
$productUrl = Url::to(['/product/view', 'id' => $product->id]);

// Delete URL
$deleteUrl = Url::toRoute([$controllerActions['delete'], 'id' => $model->getId()]);
?>

<div class="d-flex align-items-center dvizh-cart-row" data-id="<?= $model->getId() ?>">

    <!-- Left: Product Image -->
    <a class="flex-shrink-0" href="<?= $productUrl ?>">
        <img src="<?= $imgUrl ?>" width="110" alt="<?= Html::encode($name) ?>">
    </a>

    <!-- Right: Title, price, qty, delete -->
    <div class="w-100 min-w-0 ps-2 ps-sm-3">

        <!-- Product name -->
        <h5 class="d-flex animate-underline mb-2">
            <a class="d-block fs-sm fw-medium text-truncate animate-target"
               href="<?= $productUrl ?>">
                <?= Html::encode($name) ?>
            </a>
        </h5>

        <!-- Price -->
        <div class="h6 pb-1 mb-2">
            <?= $cost ?>
        </div>

        <div class="d-flex align-items-center justify-content-between">

            <!-- Quantity -->
            <div class="count-input rounded-2">
                <button type="button"
                        class="btn btn-icon btn-sm dvizh-arr dvizh-downArr"
                        aria-label="Decrement quantity">
                    <i class="ci-minus"></i>
                </button>

                <?= Html::input('number', 'count', $model->count, [
                    'class' => 'form-control form-control-sm dvizh-cart-element-count',
                    'data-role' => 'cart-element-count',
                    'data-line-selector' => 'li',
                    'data-id' => $model->getId(),
                    'data-href' => Url::toRoute($controllerActions['update']),
                    'readonly' => true
                ]) ?>

                <button type="button"
                        class="btn btn-icon btn-sm dvizh-arr dvizh-upArr"
                        aria-label="Increment quantity">
                    <i class="ci-plus"></i>
                </button>
            </div>

            <!-- Delete -->
            <button type="button"
                    class="btn-close fs-sm dvizh-delete-button"
                    data-role="cart-delete-button"
                    data-id="<?= $model->getId() ?>"
                    data-url="<?= $deleteUrl ?>"
                    data-line-selector=".cart-item"
                    aria-label="Remove from cart">
            </button>

        </div>

    </div>

</div>