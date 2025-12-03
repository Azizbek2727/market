<?php

use common\widgets\ChangeCount;
use dvizh\cart\widgets\BuyButton;
use dvizh\field\widgets\Show;
use dvizh\shop\models\Product;
use frontend\assets\ProductAssets;

/* @var $this yii\web\View */
/* @var $model Product */

ProductAssets::register($this);
\dvizh\cart\assets\WidgetAsset::register($this);
$this->title = $model->getName();
?>

<!-- Page content -->
<main class="content-wrapper">

    <!-- Breadcrumb -->
    <nav class="container pt-3 my-3 my-md-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product page</li>
        </ol>
    </nav>


    <!-- Page title -->
    <h1 class="h3 container mb-4"><?= $model->getName() ?></h1>


    <!-- Gallery + Product options -->
    <section class="container pb-5 mb-1 mb-sm-2 mb-md-3 mb-lg-4 mb-xl-5">
        <div class="row">

            <!-- Product gallery -->
            <div class="col-md-6">
                <!-- Preview (Large image) -->
                <div class="swiper" data-swiper='{
              "loop": true,
              "navigation": {
                "prevEl": ".btn-prev",
                "nextEl": ".btn-next"
              },
              "thumbs": {
                "swiper": "#thumbs"
              }
            }'>
                    <div class="swiper-wrapper">
                        <?php foreach ($model->getImages() as $image): ?>
                        <div class="swiper-slide">
                            <div class="ratio ratio-1x1">
                                <img src="<?= $image->url ?>" data-zoom="<?= $image->url ?>" data-zoom-options='{
                      "paneSelector": "#zoomPane",
                      "inlinePane": 768,
                      "hoverDelay": 500,
                      "touchDisable": true
                    }' alt="Preview">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Prev button -->
                    <div class="position-absolute top-50 start-0 z-2 translate-middle-y ms-sm-2 ms-lg-3">
                        <button type="button" class="btn btn-prev btn-icon btn-outline-secondary bg-body rounded-circle animate-slide-start" aria-label="Prev">
                            <i class="ci-chevron-left fs-lg animate-target"></i>
                        </button>
                    </div>

                    <!-- Next button -->
                    <div class="position-absolute top-50 end-0 z-2 translate-middle-y me-sm-2 me-lg-3">
                        <button type="button" class="btn btn-next btn-icon btn-outline-secondary bg-body rounded-circle animate-slide-end" aria-label="Next">
                            <i class="ci-chevron-right fs-lg animate-target"></i>
                        </button>
                    </div>
                </div>

                <!-- Thumbnails -->
                <div class="swiper swiper-load swiper-thumbs pt-2 mt-1" id="thumbs" data-swiper='{
              "loop": true,
              "spaceBetween": 12,
              "slidesPerView": 3,
              "watchSlidesProgress": true,
              "breakpoints": {
                "340": {
                  "slidesPerView": 4
                },
                "500": {
                  "slidesPerView": 5
                },
                "600": {
                  "slidesPerView": 6
                },
                "768": {
                  "slidesPerView": 4
                },
                "992": {
                  "slidesPerView": 5
                },
                "1200": {
                  "slidesPerView": 6
                }
              }
            }'>
                    <div class="swiper-wrapper">
                        <?php foreach ($model->getImages() as $image): ?>
                        <div class="swiper-slide swiper-thumb">
                            <div class="ratio ratio-1x1" style="max-width: 94px">
                                <img src="<?= $image->url ?>" class="swiper-thumb-img" alt="Thumbnail">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>


            <!-- Product options -->
            <div class="col-md-6 col-xl-5 offset-xl-1 pt-4">
                <div class="ps-md-4 ps-xl-0">
                    <div class="position-relative" id="zoomPane">

                        <!-- Price -->
                        <div class="d-flex flex-wrap align-items-center mb-3">
                            <div class="h4 mb-0 me-3"><?= \common\widgets\ShowPrice::widget(['model' => $model]) ?></div>
                            <div class="d-flex align-items-center text-success fs-sm ms-auto">
                                <i class="ci-check-circle fs-base me-2"></i>
                                Available to order
                            </div>
                        </div>

                        <!-- Count + Buttons -->
                        <div class="d-flex flex-wrap flex-sm-nowrap flex-md-wrap flex-lg-nowrap gap-3 gap-lg-2 gap-xl-3 mb-4">
                            <?= ChangeCount::widget(['model' => $model]) ?>

                            <button type="button" class="btn btn-icon btn-lg btn-secondary animate-pulse order-sm-3 order-md-2 order-lg-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-sm" data-bs-title="Add to Wishlist" aria-label="Add to Wishlist">
                                <i class="ci-heart fs-lg animate-target"></i>
                            </button>

                            <?= BuyButton::widget(
                                [
                                    'model' => $model,
                                    'htmlTag' => 'button',
                                    'text' => '<i class="ci-shopping-cart fs-lg animate-target ms-n1 me-2"></i> Add to cart',
                                    'cssClass' => 'btn btn-lg btn-primary w-100 animate-slide-end order-sm-2 order-md-4 order-lg-2'
                                ]
                            );?>
                        </div>
                    </div>

                    <!-- Shipping options -->
                    <div class="d-flex align-items-center pb-2">
                        <h3 class="h6 mb-0">Shipping options</h3>
                    </div>
                    <table class="table table-borderless fs-sm mb-2">
                        <tbody>
                        <?php foreach (\dvizh\order\models\ShippingType::find()->all() as $type): ?>
                        <tr>
                            <td class="py-2 ps-0"><?= $type->name ?></td>
                            <td class="py-2">Today</td>
                            <td class="text-body-emphasis fw-semibold text-end py-2 pe-0"><?= $type->cost == 0.00 ? 'Free' : $type->cost; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>


    <!-- Product details and Reviews shared container -->
    <section class="container pb-5 mb-2 mb-md-3 mb-lg-4 mb-xl-5">
        <div class="row">
            <div class="col-md-7">

                <!-- Product details -->
                <h2 class="h3 pb-2 pb-md-3">Product details</h2>
                <?= $model->getText(); ?>

            </div>

        </div>
    </section>
</main>
