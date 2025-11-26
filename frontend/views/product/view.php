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
$this->title = $model->name;
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
    <h1 class="h3 container mb-4"><?= $model->name ?></h1>


    <!-- Nav links + Reviews -->
    <section class="container pb-2 pb-lg-4">
        <div class="d-flex align-items-center border-bottom">
            <ul class="nav nav-underline flex-nowrap gap-4">
                <li class="nav-item me-sm-2">
                    <a class="nav-link pe-none active" href="#!">General info</a>
                </li>
                <li class="nav-item me-sm-2">
                    <a class="nav-link" href="shop-product-details-electronics.html">Product details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shop-product-reviews-electronics.html">Reviews (68)</a>
                </li>
            </ul>
            <a class="d-none d-md-flex align-items-center gap-2 text-decoration-none ms-auto mb-1" href="#reviews">
                <div class="d-flex gap-1 fs-sm">
                    <i class="ci-star-filled text-warning"></i>
                    <i class="ci-star-filled text-warning"></i>
                    <i class="ci-star-filled text-warning"></i>
                    <i class="ci-star-filled text-warning"></i>
                    <i class="ci-star-half text-warning"></i>
                </div>
                <span class="text-body-tertiary fs-xs">68 reviews</span>
            </a>
        </div>
    </section>


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

                        <!-- Model -->
                        <div class="pb-3 mb-2 mb-lg-3">
                            <label class="form-label fw-semibold pb-1 mb-2">Model</label>
                            <div class="d-flex flex-wrap gap-2">
                                <input type="radio" class="btn-check" name="model-options" id="gb-64">
                                <label for="gb-64" class="btn btn-sm btn-outline-secondary">64 GB</label>
                                <input type="radio" class="btn-check" name="model-options" id="gb-128" checked>
                                <label for="gb-128" class="btn btn-sm btn-outline-secondary">128 GB</label>
                                <input type="radio" class="btn-check" name="model-options" id="gb-256">
                                <label for="gb-256" class="btn btn-sm btn-outline-secondary">256 GB</label>
                                <input type="radio" class="btn-check" name="model-options" id="gb-512">
                                <label for="gb-512" class="btn btn-sm btn-outline-secondary">512 GB</label>
                            </div>
                        </div>

                        <!-- Color -->
                        <div class="pb-3 mb-2 mb-lg-3">
                            <label class="form-label fw-semibold pb-1 mb-2">Color: <span class="text-body fw-normal" id="colorOption">Gray blue</span></label>
                            <div class="d-flex flex-wrap gap-2" data-binded-label="#colorOption">
                                <input type="radio" class="btn-check" name="color-options" id="color-1" checked>
                                <label for="color-1" class="btn btn-color fs-xl" data-label="Gray blue" style="color: #5a7aa1">
                                    <span class="visually-hidden">Gray blue</span>
                                </label>
                                <input type="radio" class="btn-check" name="color-options" id="color-2">
                                <label for="color-2" class="btn btn-color fs-xl" data-label="Pink" style="color: #ee7976">
                                    <span class="visually-hidden">Pink</span>
                                </label>
                                <input type="radio" class="btn-check" name="color-options" id="color-3">
                                <label for="color-3" class="btn btn-color fs-xl" data-label="Light blue" style="color: #9acbf1">
                                    <span class="visually-hidden">Light blue</span>
                                </label>
                                <input type="radio" class="btn-check" name="color-options" id="color-4">
                                <label for="color-4" class="btn btn-color fs-xl" data-label="Green" style="color: #8cd1ab">
                                    <span class="visually-hidden">Green</span>
                                </label>
                            </div>
                        </div>

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

                            <button type="button" class="btn btn-icon btn-lg btn-secondary animate-rotate order-sm-4 order-md-3 order-lg-4" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-sm" data-bs-title="Compare" aria-label="Compare">
                                <i class="ci-refresh-cw fs-lg animate-target"></i>
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

                        <!-- Features -->
                        <div class="d-flex flex-wrap gap-3 gap-xl-4 pb-4 pb-lg-5 mb-2 mb-lg-0 mb-xl-2">
                            <div class="d-flex align-items-center fs-sm">
                                <svg class="text-warning me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"><path d="M1.333 9.667H7.5V16h-5c-.64 0-1.167-.527-1.167-1.167V9.667zm13.334 0v5.167c0 .64-.527 1.167-1.167 1.167h-5V9.667h6.167zM0 5.833V7.5c0 .64.527 1.167 1.167 1.167h.167H7.5v-1-3H1.167C.527 4.667 0 5.193 0 5.833zm14.833-1.166H8.5v3 1h6.167.167C15.473 8.667 16 8.14 16 7.5V5.833c0-.64-.527-1.167-1.167-1.167z"/><path d="M8 5.363a.5.5 0 0 1-.495-.573C7.752 3.123 9.054-.03 12.219-.03c1.807.001 2.447.977 2.447 1.813 0 1.486-2.069 3.58-6.667 3.58zM12.219.971c-2.388 0-3.295 2.27-3.595 3.377 1.884-.088 3.072-.565 3.756-.971.949-.563 1.287-1.193 1.287-1.595 0-.599-.747-.811-1.447-.811z"/><path d="M8.001 5.363c-4.598 0-6.667-2.094-6.667-3.58 0-.836.641-1.812 2.448-1.812 3.165 0 4.467 3.153 4.713 4.819a.5.5 0 0 1-.495.573zM3.782.971c-.7 0-1.448.213-1.448.812 0 .851 1.489 2.403 5.042 2.566C7.076 3.241 6.169.971 3.782.971z"/></svg>
                                <div class="text-body-emphasis text-nowrap"><span class="fw-semibold">+32</span> bonuses</div>
                            </div>
                            <div class="d-flex align-items-center fs-sm">
                                <svg class="text-primary me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"><path d="M15.264 8.001l.702-1.831a.5.5 0 0 0-.152-.568l-1.522-1.234-.308-1.937a.5.5 0 0 0-.416-.415l-1.937-.308L10.399.185a.5.5 0 0 0-.567-.152L8 .736 6.169.034a.5.5 0 0 0-.567.152L4.368 1.709l-1.937.308a.5.5 0 0 0-.415.415l-.308 1.937L.185 5.603a.5.5 0 0 0-.152.567l.702 1.831-.702 1.831a.5.5 0 0 0 .152.567l1.523 1.233.308 1.937a.5.5 0 0 0 .415.416l1.937.308 1.234 1.522c.137.17.366.23.568.152L8 15.265l1.831.702a.5.5 0 0 0 .568-.153l1.233-1.522 1.937-.308a.5.5 0 0 0 .416-.416l.308-1.937 1.522-1.233a.5.5 0 0 0 .152-.567l-.702-1.831z" fill="currentColor"/><path d="M6.5 7.001a1.5 1.5 0 1 1 0-3 1.5 1.5 0 1 1 0 3zm0-2a.5.5 0 1 0 0 1 .5.5 0 1 0 0-1zM9.5 12a1.5 1.5 0 1 1 0-3 1.5 1.5 0 1 1 0 3zm0-2a.5.5 0 1 0 0 1 .5.5 0 1 0 0-1zm-4 2c-.101 0-.202-.03-.29-.093a.5.5 0 0 1-.116-.698l5-7a.5.5 0 1 1 .814.581l-5 7A.5.5 0 0 1 5.5 12z" fill="white"/></svg>
                                <div class="text-body-emphasis text-nowrap">Interest-free loan</div>
                            </div>
                            <div class="d-flex align-items-center fs-sm">
                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"><path class="text-success" d="M7.42169 1.15662C3.3228 1.15662 0 4.47941 0 8.5783C0 12.6772 3.3228 16 7.42169 16C11.5206 16 14.8434 12.6772 14.8434 8.5783H7.42169V1.15662Z" fill="currentColor"/><path class="text-info" d="M8.57812 0V7.42169H15.9998C15.9998 3.3228 12.677 0 8.57812 0Z" fill="currentColor"/><defs><rect width="16" height="16" fill="white"/></defs></svg>
                                <div class="text-body-emphasis text-nowrap">Pay by installments</div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping options -->
                    <div class="d-flex align-items-center pb-2">
                        <h3 class="h6 mb-0">Shipping options</h3>
                        <a class="btn btn-sm btn-secondary ms-auto" href="#!">
                            <i class="ci-map-pin fs-sm ms-n1 me-1"></i>
                            Find local store
                        </a>
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

                    <!-- Warranty + Payment info accordion -->
                    <div class="accordion" id="infoAccordion">
                        <div class="accordion-item border-top">
                            <h3 class="accordion-header" id="headingWarranty">
                                <button type="button" class="accordion-button animate-underline collapsed" data-bs-toggle="collapse" data-bs-target="#warranty" aria-expanded="false" aria-controls="warranty">
                                    <span class="animate-target me-2">Warranty information</span>
                                </button>
                            </h3>
                            <div class="accordion-collapse collapse" id="warranty" aria-labelledby="headingWarranty" data-bs-parent="#infoAccordion">
                                <div class="accordion-body">
                                    <div class="alert d-flex alert-info mb-3" role="alert">
                                        <i class="ci-check-shield fs-xl mt-1 me-2"></i>
                                        <div class="fs-sm"><span class="fw-semibold">Warranty:</span> 12 months of official manufacturer's warranty. Exchange/return of the product within 14 days.</div>
                                    </div>
                                    <p class="mb-0">Explore the details of our <a class="fw-medium" href="#!">product warranties here</a>, including duration, coverage, and any additional protection plans available. We prioritize your satisfaction, and our warranty information is designed to keep you informed and confident in your purchase.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingPayment">
                                <button type="button" class="accordion-button animate-underline collapsed" data-bs-toggle="collapse" data-bs-target="#payment" aria-expanded="false" aria-controls="payment">
                                    <span class="animate-target me-2">Payment and credit</span>
                                </button>
                            </h3>
                            <div class="accordion-collapse collapse" id="payment" aria-labelledby="headingPayment" data-bs-parent="#infoAccordion">
                                <div class="accordion-body">Experience hassle-free transactions with our <a class="fw-medium" href="#!">flexible payment options</a> and credit facilities. Learn more about the various payment methods accepted, installment plans, and any exclusive credit offers available to make your shopping experience seamless.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Sticky product preview + Add to cart CTA -->
    <section class="sticky-product-banner sticky-top d-md-none" data-sticky-element>
        <div class="sticky-product-banner-inner pt-5">
            <div class="bg-body border-bottom border-light border-opacity-10 shadow pt-4 pb-2">
                <div class="container d-flex align-items-center">
                    <div class="d-flex align-items-center min-w-0 ms-n2 me-3">
                        <div class="ratio ratio-1x1 flex-shrink-0" style="width: 50px">
                            <img src="/cartzilla/assets/img/shop/electronics/thumbs/10.png" alt="iPhone 14">
                        </div>
                        <div class="w-100 min-w-0 ps-2">
                            <h4 class="fs-sm fw-medium text-truncate mb-1">Apple iPhone 14 Plus 128GB Blue</h4>
                            <div class="h6 mb-0">$940.00</div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 ms-auto">
                        <button type="button" class="btn btn-icon btn-secondary animate-pulse" aria-label="Add to Wishlist">
                            <i class="ci-heart fs-base animate-target"></i>
                        </button>
                        <button type="button" class="btn btn-primary animate-slide-end d-none d-sm-inline-flex">
                            <i class="ci-shopping-cart fs-base animate-target ms-n1 me-2"></i>
                            Add to cart
                        </button>
                        <button type="button" class="btn btn-icon btn-primary animate-slide-end d-sm-none" aria-label="Add to Cart">
                            <i class="ci-shopping-cart fs-lg animate-target"></i>
                        </button>
                    </div>
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
                <h3 class="h6">General specs</h3>
                <ul class="list-unstyled d-flex flex-column gap-3 fs-sm pb-3 m-0 mb-2 mb-sm-3">
                    <li class="d-flex align-items-center position-relative pe-4">
                        <span>Model:</span>
                        <span class="d-block flex-grow-1 border-bottom border-dashed px-1 mt-2 mx-2"></span>
                        <span class="text-dark-emphasis fw-medium text-end">iPhone 14 Plus</span>
                    </li>
                    <li class="d-flex align-items-center position-relative pe-4">
                        <span>Manufacturer:</span>
                        <span class="d-block flex-grow-1 border-bottom border-dashed px-1 mt-2 mx-2"></span>
                        <span class="text-dark-emphasis fw-medium text-end">Apple Inc.</span>
                    </li>
                    <li class="d-flex align-items-center position-relative pe-4">
                        <span>Finish:</span>
                        <span class="d-block flex-grow-1 border-bottom border-dashed px-1 mt-2 mx-2"></span>
                        <span class="text-dark-emphasis fw-medium text-end">Ceramic, Glass, Aluminium</span>
                        <i class="ci-info fs-base text-body-tertiary position-absolute top-50 end-0 translate-middle-y" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-custom-class="popover-sm" data-bs-content="Ceramic shield front, Glass back and Aluminium design"></i>
                    </li>
                    <li class="d-flex align-items-center position-relative pe-4">
                        <span>Capacity:</span>
                        <span class="d-block flex-grow-1 border-bottom border-dashed px-1 mt-2 mx-2"></span>
                        <span class="text-dark-emphasis fw-medium text-end">128GB</span>
                    </li>
                    <li class="d-flex align-items-center position-relative pe-4">
                        <span>Chip:</span>
                        <span class="d-block flex-grow-1 border-bottom border-dashed px-1 mt-2 mx-2"></span>
                        <span class="text-dark-emphasis fw-medium text-end">A15 Bionic chip</span>
                    </li>
                </ul>
                <h3 class="h6">Display</h3>
                <ul class="list-unstyled d-flex flex-column gap-3 fs-sm pb-1 m-0 mb-2 mb-sm-3">
                    <li class="d-flex align-items-center position-relative pe-4">
                        <span>Diagonal:</span>
                        <span class="d-block flex-grow-1 border-bottom border-dashed px-1 mt-2 mx-2"></span>
                        <span class="text-dark-emphasis fw-medium text-end">6.1"</span>
                    </li>
                    <li class="d-flex align-items-center position-relative pe-4">
                        <span>Screen type:</span>
                        <span class="d-block flex-grow-1 border-bottom border-dashed px-1 mt-2 mx-2"></span>
                        <span class="text-dark-emphasis fw-medium text-end">Super Retina XDR</span>
                        <i class="ci-info fs-base text-body-tertiary position-absolute top-50 end-0 translate-middle-y" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-custom-class="popover-sm" data-bs-content="HDR display, True Tone, Wide color (P3), Haptic Touch, 800 nits brightness"></i>
                    </li>
                    <li class="d-flex align-items-center position-relative pe-4">
                        <span>Resolution:</span>
                        <span class="d-block flex-grow-1 border-bottom border-dashed px-1 mt-2 mx-2"></span>
                        <span class="text-dark-emphasis fw-medium text-end">2778x1284px at 458ppi</span>
                    </li>
                    <li class="d-flex align-items-center position-relative pe-4">
                        <span>Refresh rate:</span>
                        <span class="d-block flex-grow-1 border-bottom border-dashed px-1 mt-2 mx-2"></span>
                        <span class="text-dark-emphasis fw-medium text-end">120 Hz</span>
                    </li>
                </ul>
                <div class="nav">
                    <a class="nav-link text-primary animate-underline px-0" href="shop-product-details-electronics.html">
                        <span class="animate-target">See all product details</span>
                        <i class="ci-chevron-right fs-base ms-1"></i>
                    </a>
                </div>


                <!-- Reviews -->
                <div class="d-flex align-items-center pt-5 mb-4 mt-2 mt-md-3 mt-lg-4" id="reviews" style="scroll-margin-top: 80px">
                    <h2 class="h3 mb-0">Reviews</h2>
                    <button type="button" class="btn btn-secondary ms-auto" data-bs-toggle="modal" data-bs-target="#reviewForm">
                        <i class="ci-edit-3 fs-base ms-n1 me-2"></i>
                        Leave a review
                    </button>
                </div>

                <!-- Reviews stats -->
                <div class="row g-4 pb-3">
                    <div class="col-sm-4">

                        <!-- Overall rating card -->
                        <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-body-tertiary rounded p-4">
                            <div class="h1 pb-2 mb-1">4.1</div>
                            <div class="hstack justify-content-center gap-1 fs-sm mb-2">
                                <i class="ci-star-filled text-warning"></i>
                                <i class="ci-star-filled text-warning"></i>
                                <i class="ci-star-filled text-warning"></i>
                                <i class="ci-star-filled text-warning"></i>
                                <i class="ci-star text-body-tertiary opacity-60"></i>
                            </div>
                            <div class="fs-sm">68 reviews</div>
                        </div>
                    </div>
                    <div class="col-sm-8">

                        <!-- Rating breakdown by quantity -->
                        <div class="vstack gap-3">

                            <!-- 5 stars -->
                            <div class="hstack gap-2">
                                <div class="hstack fs-sm gap-1">
                                    5<i class="ci-star-filled text-warning"></i>
                                </div>
                                <div class="progress w-100" role="progressbar" aria-label="Five stars" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                                    <div class="progress-bar bg-warning rounded-pill" style="width: 54%"></div>
                                </div>
                                <div class="fs-sm text-nowrap text-end" style="width: 40px;">37</div>
                            </div>

                            <!-- 4 stars -->
                            <div class="hstack gap-2">
                                <div class="hstack fs-sm gap-1">
                                    4<i class="ci-star-filled text-warning"></i>
                                </div>
                                <div class="progress w-100" role="progressbar" aria-label="Four stars" aria-valuenow="23.5" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                                    <div class="progress-bar bg-warning rounded-pill" style="width: 23.5%"></div>
                                </div>
                                <div class="fs-sm text-nowrap text-end" style="width: 40px;">16</div>
                            </div>

                            <!-- 3 stars -->
                            <div class="hstack gap-2">
                                <div class="hstack fs-sm gap-1">
                                    3<i class="ci-star-filled text-warning"></i>
                                </div>
                                <div class="progress w-100" role="progressbar" aria-label="Three stars" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                                    <div class="progress-bar bg-warning rounded-pill" style="width: 13%"></div>
                                </div>
                                <div class="fs-sm text-nowrap text-end" style="width: 40px;">9</div>
                            </div>

                            <!-- 2 stars -->
                            <div class="hstack gap-2">
                                <div class="hstack fs-sm gap-1">
                                    2<i class="ci-star-filled text-warning"></i>
                                </div>
                                <div class="progress w-100" role="progressbar" aria-label="Two stars" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                                    <div class="progress-bar bg-warning rounded-pill" style="width: 6%"></div>
                                </div>
                                <div class="fs-sm text-nowrap text-end" style="width: 40px;">4</div>
                            </div>

                            <!-- 1 star -->
                            <div class="hstack gap-2">
                                <div class="hstack fs-sm gap-1">
                                    1<i class="ci-star-filled text-warning"></i>
                                </div>
                                <div class="progress w-100" role="progressbar" aria-label="One star" aria-valuenow="3.5" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
                                    <div class="progress-bar bg-warning rounded-pill" style="width: 3.5%"></div>
                                </div>
                                <div class="fs-sm text-nowrap text-end" style="width: 40px;">3</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review -->
                <div class="border-bottom py-3 mb-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-nowrap me-3">
                            <span class="h6 mb-0">Rafael Marquez</span>
                            <i class="ci-check-circle text-success align-middle ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-sm" data-bs-title="Verified customer"></i>
                        </div>
                        <span class="text-body-secondary fs-sm ms-auto">June 28, 2024</span>
                    </div>
                    <div class="d-flex gap-1 fs-sm pb-2 mb-1">
                        <i class="ci-star-filled text-warning"></i>
                        <i class="ci-star-filled text-warning"></i>
                        <i class="ci-star-filled text-warning"></i>
                        <i class="ci-star-filled text-warning"></i>
                        <i class="ci-star-filled text-warning"></i>
                    </div>
                    <ul class="list-inline gap-2 pb-2 mb-1">
                        <li class="fs-sm me-4"><span class="text-dark-emphasis fw-medium">Color:</span> Blue</li>
                        <li class="fs-sm"><span class="text-dark-emphasis fw-medium">Model:</span> 128GB</li>
                    </ul>
                    <p class="fs-sm">The phone has a new A15 Bionic chip, which makes it lightning-fast and responsive. The camera system has also been upgraded, and it now includes a 12-megapixel ultra-wide lens and a 12-megapixel wide lens.</p>
                    <ul class="list-unstyled fs-sm pb-2 mb-1">
                        <li><span class="text-dark-emphasis fw-medium">Pros:</span> Powerful A15 Bionic chip, improved camera</li>
                        <li><span class="text-dark-emphasis fw-medium">Cons:</span> High price tag</li>
                    </ul>
                    <div class="nav align-items-center">
                        <button type="button" class="nav-link animate-underline px-0">
                            <i class="ci-corner-down-right fs-base ms-1 me-1"></i>
                            <span class="animate-target">Reply</span>
                        </button>
                        <button type="button" class="nav-link text-body-secondary animate-scale px-0 ms-auto me-n1">
                            <i class="ci-thumbs-up fs-base animate-target me-1"></i>
                            0
                        </button>
                        <hr class="vr my-2 mx-3">
                        <button type="button" class="nav-link text-body-secondary animate-scale px-0 ms-n1">
                            <i class="ci-thumbs-down fs-base animate-target me-1"></i>
                            0
                        </button>
                    </div>
                </div>

                <!-- Review -->
                <div class="border-bottom py-3 mb-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-nowrap me-3">
                            <span class="h6 mb-0">Daniel Adams</span>
                        </div>
                        <span class="text-body-secondary fs-sm ms-auto">May 15, 2024</span>
                    </div>
                    <div class="d-flex gap-1 fs-sm pb-2 mb-1">
                        <i class="ci-star-filled text-warning"></i>
                        <i class="ci-star-filled text-warning"></i>
                        <i class="ci-star-filled text-warning"></i>
                        <i class="ci-star-filled text-warning"></i>
                        <i class="ci-star text-body-tertiary opacity-75"></i>
                    </div>
                    <ul class="list-inline gap-2 pb-2 mb-1">
                        <li class="fs-sm me-4"><span class="text-dark-emphasis fw-medium">Color:</span> Blue</li>
                        <li class="fs-sm"><span class="text-dark-emphasis fw-medium">Model:</span> 128GB</li>
                    </ul>
                    <p class="fs-sm">The phone has a new A15 Bionic chip, which makes it lightning-fast and responsive. The camera system has also been upgraded, and it now includes a 12-megapixel ultra-wide lens and a 12-megapixel wide lens.</p>
                    <ul class="list-unstyled fs-sm pb-2 mb-1">
                        <li><span class="text-dark-emphasis fw-medium">Pros:</span> Powerful A15 Bionic chip, improved camera</li>
                        <li><span class="text-dark-emphasis fw-medium">Cons:</span> High price tag</li>
                    </ul>
                    <div class="nav align-items-center">
                        <button type="button" class="nav-link animate-underline px-0">
                            <i class="ci-corner-down-right fs-base ms-1 me-1"></i>
                            <span class="animate-target">Reply</span>
                        </button>
                        <button type="button" class="nav-link text-body-secondary animate-scale px-0 ms-auto me-n1">
                            <i class="ci-thumbs-up text-success fs-base animate-target me-1"></i>
                            18
                        </button>
                        <hr class="vr my-2 mx-3">
                        <button type="button" class="nav-link text-body-secondary animate-scale px-0 ms-n1">
                            <i class="ci-thumbs-down text-danger fs-base animate-target me-1"></i>
                            2
                        </button>
                    </div>
                </div>

                <div class="nav">
                    <a class="nav-link text-primary animate-underline px-0" href="shop-product-reviews-electronics.html">
                        <span class="animate-target">See all reviews</span>
                        <i class="ci-chevron-right fs-base ms-1"></i>
                    </a>
                </div>
            </div>


            <!-- Sticky product preview visible on screens > 991px wide (lg breakpoint) -->
            <aside class="col-md-5 col-xl-4 offset-xl-1 d-none d-md-block" style="margin-top: -100px">
                <div class="position-sticky top-0 ps-3 ps-lg-4 ps-xl-0" style="padding-top: 100px">
                    <div class="border rounded p-3 p-lg-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="ratio ratio-1x1 flex-shrink-0" style="width: 110px">
                                <img src="/cartzilla/assets/img/shop/electronics/thumbs/10.png" width="110" alt="iPhone 14">
                            </div>
                            <div class="w-100 min-w-0 ps-2 ps-sm-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div class="d-flex gap-1 fs-xs">
                                        <i class="ci-star-filled text-warning"></i>
                                        <i class="ci-star-filled text-warning"></i>
                                        <i class="ci-star-filled text-warning"></i>
                                        <i class="ci-star-filled text-warning"></i>
                                        <i class="ci-star text-body-tertiary opacity-75"></i>
                                    </div>
                                    <span class="text-body-tertiary fs-xs">68</span>
                                </div>
                                <h4 class="fs-sm fw-medium mb-2">Apple iPhone 14 Plus 128GB Blue</h4>
                                <div class="h5 mb-0">$940.00</div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 gap-lg-3">
                            <button type="button" class="btn btn-primary w-100 animate-slide-end">
                                <i class="ci-shopping-cart fs-base animate-target ms-n1 me-2"></i>
                                Add to cart
                            </button>
                            <button type="button" class="btn btn-icon btn-secondary animate-pulse" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-sm" data-bs-title="Add to Wishlist" aria-label="Add to Wishlist">
                                <i class="ci-heart fs-base animate-target"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-secondary animate-rotate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-sm" data-bs-title="Compare" aria-label="Compare">
                                <i class="ci-refresh-cw fs-base animate-target"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </section>


    <!-- Subscription form + Vlog -->
    <section class="bg-body-tertiary py-5">
        <div class="container pt-sm-2 pt-md-3 pt-lg-4 pt-xl-5">
            <div class="row">
                <div class="col-md-6 col-lg-5 mb-5 mb-md-0">
                    <h2 class="h4 mb-2">Sign up to our newsletter</h2>
                    <p class="text-body pb-2 pb-ms-3">Receive our latest updates about our products &amp; promotions</p>
                    <form class="d-flex needs-validation pb-1 pb-sm-2 pb-md-3 pb-lg-0 mb-4 mb-lg-5" novalidate>
                        <div class="position-relative w-100 me-2">
                            <input type="email" class="form-control form-control-lg" placeholder="Your email" required>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary">Subscribe</button>
                    </form>
                    <div class="d-flex gap-3">
                        <a class="btn btn-icon btn-secondary rounded-circle" href="#!" aria-label="Instagram">
                            <i class="ci-instagram fs-base"></i>
                        </a>
                        <a class="btn btn-icon btn-secondary rounded-circle" href="#!" aria-label="Facebook">
                            <i class="ci-facebook fs-base"></i>
                        </a>
                        <a class="btn btn-icon btn-secondary rounded-circle" href="#!" aria-label="YouTube">
                            <i class="ci-youtube fs-base"></i>
                        </a>
                        <a class="btn btn-icon btn-secondary rounded-circle" href="#!" aria-label="Telegram">
                            <i class="ci-telegram fs-base"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2">
                    <ul class="list-unstyled d-flex flex-column gap-4 ps-md-4 ps-lg-0 mb-3">
                        <li class="nav flex-nowrap align-items-center position-relative">
                            <img src="/cartzilla/assets/img/home/electronics/vlog/01.jpg" class="rounded" width="140" alt="Video cover">
                            <div class="ps-3">
                                <div class="fs-xs text-body-secondary lh-sm mb-2">6:16</div>
                                <a class="nav-link fs-sm hover-effect-underline stretched-link p-0" href="#!">5 New Cool Gadgets You Must See on Cartzilla - Cheap Budget</a>
                            </div>
                        </li>
                        <li class="nav flex-nowrap align-items-center position-relative">
                            <img src="/cartzilla/assets/img/home/electronics/vlog/02.jpg" class="rounded" width="140" alt="Video cover">
                            <div class="ps-3">
                                <div class="fs-xs text-body-secondary lh-sm mb-2">10:20</div>
                                <a class="nav-link fs-sm hover-effect-underline stretched-link p-0" href="#!">5 Super Useful Gadgets on Cartzilla You Must Have in 2023</a>
                            </div>
                        </li>
                        <li class="nav flex-nowrap align-items-center position-relative">
                            <img src="/cartzilla/assets/img/home/electronics/vlog/03.jpg" class="rounded" width="140" alt="Video cover">
                            <div class="ps-3">
                                <div class="fs-xs text-body-secondary lh-sm mb-2">8:40</div>
                                <a class="nav-link fs-sm hover-effect-underline stretched-link p-0" href="#!">Top 5 New Amazing Gadgets on Cartzilla You Must See</a>
                            </div>
                        </li>
                    </ul>
                    <div class="nav ps-md-4 ps-lg-0">
                        <a class="btn nav-link animate-underline text-decoration-none px-0" href="#!">
                            <span class="animate-target">View all</span>
                            <i class="ci-chevron-right fs-base ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
