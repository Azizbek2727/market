<?php

use common\widgets\ChangeCount;
use common\widgets\OrderForm;
use dvizh\cart\widgets\BuyButton;
use dvizh\field\widgets\Show;
use dvizh\shop\models\Product;
use frontend\assets\ProductAssets;

/* @var $this yii\web\View */
/* @var $model Product */

ProductAssets::register($this);
\dvizh\cart\assets\WidgetAsset::register($this);
$this->title = Yii::t('frontend', 'Checkout');
?>

<!-- Page content -->
<main class="content-wrapper">
    <div class="container py-5">
        <div class="row pt-1 pt-sm-3 pt-lg-4 pb-2 pb-md-3 pb-lg-4 pb-xl-5">
            <div class="col-lg-8 col-xl-7 mb-5 mb-lg-0">
                <div class="accordion d-flex flex-column gap-5 pe-lg-4 pe-xl-0" id="checkout">

                    <!-- Shipping address form -->
                    <div class="d-flex align-items-start">
                        <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle fs-sm fw-semibold lh-1 flex-shrink-0" style="width: 2rem; height: 2rem; margin-top: -.125rem">2</div>
                        <div class="w-100 ps-3 ps-md-4">
                            <h1 class="h5 mb-md-4"><?= Yii::t('frontend', 'Shipping address') ?></h1>
                            <?= OrderForm::widget() ?>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="d-flex align-items-start">
                        <div class="d-flex align-items-center justify-content-center bg-body-secondary text-body-secondary rounded-circle fs-sm fw-semibold lh-1 flex-shrink-0" style="width: 2rem; height: 2rem; margin-top: -.125rem">3</div>
                        <h2 class="h5 text-body-secondary ps-3 ps-md-4 mb-0"><?= Yii::t('frontend', 'Payment') ?></h2>
                    </div>
                </div>
            </div>


            <!-- Order summary (sticky sidebar) -->
            <aside class="col-lg-4 offset-xl-1" style="margin-top: -100px">
                <div class="position-sticky top-0" style="padding-top: 100px">
                    <div class="bg-body-tertiary rounded-5 p-4 mb-3">
                        <div class="p-sm-2 p-lg-0 p-xl-2">
                            <?php
                            $cart = Yii::$app->cart;
                            $elements = $cart->elements;

                            // Collect preview images (limit 3)
                            $previewImages = [];
                            foreach ($elements as $el) {
                                if (count($previewImages) >= 3) break;
                                $product = $el->getModel();
                                if (isset($product->image) && $product->image) {
                                    $previewImages[] = $product->image->getUrl('100x100');
                                }
                            }

                            // Subtotal (items total)
                            $subtotal = $cart->getCost(false);

                            // Saving logic (optional — change as needed)
                            $saving = 0;

                            // Tax logic (optional)
                            $taxRate = 0.00; // example: 0.12 for 12%
                            $tax = $subtotal * $taxRate;

                            // Shipping logic (can be dynamic later)
                            $shipping = 0;

                            // Estimated total
                            $total = $subtotal - $saving + $tax + $shipping;
                            ?>

                            <div class="border-bottom pb-4 mb-4">

                                <!-- Header -->
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h5 class="mb-0"><?= Yii::t('frontend', 'Order summary') ?></h5>
                                    <div class="nav">
                                        <button type="button" class="nav-link text-decoration-underline p-0" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart" aria-controls="shoppingCart" aria-label="Shopping cart">
                                            <?= Yii::t('frontend', 'Edit') ?>
                                        </button>
                                        <a class="nav-link text-decoration-underline p-0" href="">
                                        </a>
                                    </div>
                                </div>

                                <!-- Preview Images -->
                                <a class="d-flex align-items-center gap-2 text-decoration-none"
                                   href="#orderPreview"
                                   data-bs-toggle="offcanvas">

                                    <?php if (!empty($previewImages)): ?>
                                        <?php foreach ($previewImages as $img): ?>
                                            <div class="ratio ratio-1x1" style="max-width: 64px">
                                                <img src="<?= $img ?>" class="d-block p-1" alt="Product">
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span class="text-body-secondary">
                <?= Yii::t('frontend', 'Cart is empty') ?>
            </span>
                                    <?php endif; ?>

                                    <i class="ci-chevron-right text-body fs-xl p-0 ms-auto"></i>
                                </a>
                            </div>

                            <!-- Summary Values -->
                            <ul class="list-unstyled fs-sm gap-3 mb-0">
                                <li class="d-flex justify-content-between">
                                    <?= Yii::t('frontend', 'Subtotal') ?>:
                                    <span class="text-dark-emphasis fw-medium">
            <?= Yii::$app->formatter->asCurrency($subtotal) ?>
        </span>
                                </li>
                                <?php if ($saving > 0): ?>
                                    <li class="d-flex justify-content-between">
                                        <?= Yii::t('frontend', 'Saving:') ?>
                                        <span class="text-danger fw-medium">-<?= Yii::$app->formatter->asCurrency($saving) ?></span>
                                    </li>
                                <?php endif; ?>
                                <?php if ($tax > 0): ?>
                                    <li class="d-flex justify-content-between">
                                        <?= Yii::t('frontend', 'Tax collected:') ?>
                                        <span class="text-dark-emphasis fw-medium">
                <?= Yii::$app->formatter->asCurrency($tax) ?>
            </span>
                                    </li>
                                <?php endif; ?>
                                <?php if ($shipping > 0): ?>
                                    <li class="d-flex justify-content-between">
                                        <?= Yii::t('frontend', 'Shipping:') ?>
                                        <span class="text-dark-emphasis fw-medium">
                <?= Yii::$app->formatter->asCurrency($shipping) ?>
            </span>
                                    </li>
                                <?php endif; ?>
                            </ul>

                            <div class="border-top pt-4 mt-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fs-sm"><?= Yii::t('frontend', 'Estimated total:') ?></span>
                                    <span class="h5 mb-0">
            <?= Yii::$app->formatter->asCurrency($total) ?>
        </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>
