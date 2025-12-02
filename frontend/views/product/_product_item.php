<?php
/** @var $model \dvizh\shop\models\Product */

use yii\helpers\Url;
use dvizh\cart\widgets\BuyButton;
use common\widgets\ShowPrice;

$image = $model->getImage()->getUrl() ?: '/cartzilla/assets/img/shop/electronics/01.png';
$url = Url::to(['/product/view', 'id' => $model->id]);

$price = $model->price;
$oldPrice = $model->getOldPrice();
$discount = $oldPrice ? round(100 - ($price / $oldPrice * 100)) : null;
?>

<div class="product-card animate-underline hover-effect-opacity bg-body rounded">

    <!-- PRODUCT IMAGE -->
    <div class="position-relative">
        <a class="d-block rounded-top overflow-hidden p-3 p-sm-4" href="<?= $url ?>">
            <?php if ($discount): ?>
                <span class="badge bg-danger position-absolute top-0 start-0 mt-2 ms-2 mt-lg-3 ms-lg-3">
                    -<?= $discount ?>%
                </span>
            <?php endif; ?>

            <div class="ratio" style="--cz-aspect-ratio: calc(240 / 258 * 100%)">
                <img src="<?= $image ?>" alt="<?= $model->getName() ?>">
            </div>
        </a>
    </div>

    <!-- PRODUCT TEXT -->
    <div class="w-100 min-w-0 px-1 pb-2 px-sm-3 pb-sm-3">

        <!-- Name -->
        <h3 class="pb-1 mb-2">
            <a class="d-block fs-sm fw-medium text-truncate" href="<?= $url ?>">
                <span class="animate-target"><?= $model->getName() ?></span>
            </a>
        </h3>

        <!-- PRICE & CART -->
        <div class="d-flex align-items-center justify-content-between">
            <div class="h5 lh-1 mb-0">
                <?= ShowPrice::widget(['model' => $model]) ?>
                <?php if ($oldPrice): ?>
                    <del class="text-body-tertiary fs-sm fw-normal">
                        <?= Yii::$app->formatter->asCurrency($oldPrice) ?>
                    </del>
                <?php endif; ?>
            </div>

            <?= BuyButton::widget([
                'model' => $model,
                'cssClass' => 'product-card-button btn btn-icon btn-secondary animate-slide-end ms-2',
                'htmlTag' => 'button',
                'text' => '<i class="ci-shopping-cart fs-base animate-target"></i>',
            ]) ?>
        </div>
    </div>
</div>
