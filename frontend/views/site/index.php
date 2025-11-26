<?php

use dvizh\gallery\widgets\Gallery;
use yii\helpers\Url;
use dvizh\shop\models\Category;
use common\widgets\ShowPrice;
use dvizh\filter\widgets\FilterPanel;
use dvizh\field\widgets\Show;
use dvizh\cart\widgets\ElementsList;
use dvizh\cart\widgets\CartInformer;
use dvizh\cart\widgets\ChangeOptions;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\TruncateButton;
use dvizh\cart\widgets\BuyButton;
use dvizh\order\widgets\OrderForm;
use dvizh\promocode\widgets\Enter;
use dvizh\certificate\widgets\CertificateWidget;

/* @var $this yii\web\View */
/* @var $producers \dvizh\shop\models\Producer[] */
/* @var $sliders \common\models\Slider[] */


$this->title = Yii::$app->name;
\frontend\assets\ProductAssets::register($this);
?>
<!-- Page content -->
<main class="content-wrapper">

    <!-- Hero slider -->
    <section class="container pt-4">
        <div class="row">
            <div class="col-lg-9 offset-lg-3">
                <div class="position-relative">
                    <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none-dark rtl-flip" style="background: linear-gradient(90deg, #accbee 0%, #e7f0fd 100%)"></span>
                    <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none d-block-dark rtl-flip" style="background: linear-gradient(90deg, #1b273a 0%, #1f2632 100%)"></span>

                    <div class="row justify-content-center position-relative z-2">
                        <div class="col-xl-5 col-xxl-4 offset-xxl-1 d-flex align-items-center mt-xl-n3">

                            <!-- Text content master slider -->
                            <div class="swiper px-5 pe-xl-0 ps-xxl-0 me-xl-n5" data-swiper='{
                    "spaceBetween": 64,
                    "loop": true,
                    "speed": 400,
                    "controlSlider": "#sliderImages",
                    "autoplay": {
                      "delay": 5500,
                      "disableOnInteraction": false
                    },
                    "scrollbar": {
                      "el": ".swiper-scrollbar"
                    }
                  }'>
                                <div class="swiper-wrapper">
                                    <?php foreach ($sliders as $slider): ?>
                                    <div class="swiper-slide text-center text-xl-start pt-5 py-xl-5">
                                        <p class="text-body"><?= $slider->short_text ?></p>
                                        <h2 class="display-4 pb-2 pb-xl-4"><?= $slider->name ?></h2>
                                        <a class="btn btn-lg btn-primary" href="<?= $slider->url ?>">
                                            Shop now
                                            <i class="ci-arrow-up-right fs-lg ms-2 me-n1"></i>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-9 col-sm-7 col-md-6 col-lg-5 col-xl-7">

                            <!-- Binded images (controlled slider) -->
                            <div class="swiper user-select-none" id="sliderImages" data-swiper='{
                    "allowTouchMove": false,
                    "loop": true,
                    "effect": "fade",
                    "fadeEffect": {
                      "crossFade": true
                    }
                  }'>
                                <div class="swiper-wrapper">
                                    <?php foreach ($sliders as $slider): ?>
                                    <div class="swiper-slide d-flex justify-content-end">
                                        <div class="ratio rtl-flip" style="max-width: 495px; --cz-aspect-ratio: calc(537 / 495 * 100%)">
                                            <img src="<?= $slider->getImage()->getUrl() ?>" alt="Image">
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Scrollbar -->
                    <div class="row justify-content-center" data-bs-theme="dark">
                        <div class="col-xxl-10">
                            <div class="position-relative mx-5 mx-xxl-0">
                                <div class="swiper-scrollbar mb-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Features -->
    <section class="container pt-5 mt-1 mt-sm-3 mt-lg-4">
        <div class="row row-cols-2 row-cols-md-4 g-4">

            <!-- Item -->
            <div class="col">
                <div class="d-flex flex-column flex-xxl-row align-items-center">
                    <div class="d-flex text-dark-emphasis bg-body-tertiary rounded-circle p-4 mb-3 mb-xxl-0">
                        <i class="ci-delivery fs-2 m-xxl-1"></i>
                    </div>
                    <div class="text-center text-xxl-start ps-xxl-3">
                        <h3 class="h6 mb-1">Free Shipping &amp; Returns</h3>
                        <p class="fs-sm mb-0">For all orders over $199.00</p>
                    </div>
                </div>
            </div>

            <!-- Item -->
            <div class="col">
                <div class="d-flex flex-column flex-xxl-row align-items-center">
                    <div class="d-flex text-dark-emphasis bg-body-tertiary rounded-circle p-4 mb-3 mb-xxl-0">
                        <i class="ci-credit-card fs-2 m-xxl-1"></i>
                    </div>
                    <div class="text-center text-xxl-start ps-xxl-3">
                        <h3 class="h6 mb-1">Secure Payment</h3>
                        <p class="fs-sm mb-0">We ensure secure payment</p>
                    </div>
                </div>
            </div>

            <!-- Item -->
            <div class="col">
                <div class="d-flex flex-column flex-xxl-row align-items-center">
                    <div class="d-flex text-dark-emphasis bg-body-tertiary rounded-circle p-4 mb-3 mb-xxl-0">
                        <i class="ci-refresh-cw fs-2 m-xxl-1"></i>
                    </div>
                    <div class="text-center text-xxl-start ps-xxl-3">
                        <h3 class="h6 mb-1">Money Back Guarantee</h3>
                        <p class="fs-sm mb-0">Returning money 30 days</p>
                    </div>
                </div>
            </div>

            <!-- Item -->
            <div class="col">
                <div class="d-flex flex-column flex-xxl-row align-items-center">
                    <div class="d-flex text-dark-emphasis bg-body-tertiary rounded-circle p-4 mb-3 mb-xxl-0">
                        <i class="ci-chat fs-2 m-xxl-1"></i>
                    </div>
                    <div class="text-center text-xxl-start ps-xxl-3">
                        <h3 class="h6 mb-1">24/7 Customer Support</h3>
                        <p class="fs-sm mb-0">Friendly customer support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- New arrivals (List) -->
    <section class="container pt-5 mt-1 mt-sm-2 mt-md-3 mt-lg-4">
        <h2 class="h3 pb-2 pb-sm-3">New arrivals</h2>
        <div class="row">

            <!-- Product list -->
            <div class="col-sm-6 col-lg-4 d-flex flex-column gap-3 pt-4 py-lg-4">

                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $newArrivals,
                    'layout' => "{items}",
                    'itemOptions' => ['tag' => false],
                    'itemView' => function ($model) {

                        // Product image
                        $image = $model->getImage()
                            ? $model->getImage()->getUrl('200x200')
                            : '/cartzilla/assets/img/shop/placeholder.png';

                        // Product URL
                        $url = Url::to(['/product/view', 'id' => $model->id]);

                        // Rating (Cartzilla style)
                        $rating = $model->rating ?? 5;  // replace with your real rating field
                        $ratingIcons = '';
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                                $ratingIcons .= '<i class="ci-star-filled text-warning"></i>';
                            } else {
                                $ratingIcons .= '<i class="ci-star text-body-tertiary opacity-75"></i>';
                            }
                        }

                        $price = ShowPrice::widget(['model' => $model]);

                        return <<<HTML
<div class="position-relative animate-underline d-flex align-items-center ps-xl-3">

    <div class="ratio ratio-1x1 flex-shrink-0" style="width:110px">
        <img src="{$image}" alt="{$model->name}">
    </div>

    <div class="w-100 min-w-0 ps-2 ps-sm-3">

        <div class="d-flex align-items-center gap-2 mb-2">
            <div class="d-flex gap-1 fs-xs">
                {$ratingIcons}
            </div>
            <span class="text-body-tertiary fs-xs">212</span>
        </div>

        <h4 class="mb-2">
            <a class="stretched-link d-block fs-sm fw-medium text-truncate" 
               href="{$url}">
                <span class="animate-target">{$model->name}</span>
            </a>
        </h4>

        <div class="h5 mb-0">{$price}</div>
    </div>
</div>
HTML;
                    }
                ]); ?>

            </div>

        </div>
    </section>


    <!-- Trending products (Grid) -->
    <section class="container pt-5 mt-2 mt-sm-3 mt-lg-4">

        <!-- Heading -->
        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 pb-md-4">
            <h2 class="h3 mb-0">Trending products</h2>
            <div class="nav ms-3">
                <a class="nav-link animate-underline px-0 py-2" href="shop-catalog-electronics.html">
                    <span class="animate-target">View all</span>
                    <i class="ci-chevron-right fs-base ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Product grid -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 pt-4">

            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $trending,
                'layout' => '{items}',
                'itemOptions' => ['class' => 'col'],
                'itemView' => function ($model) {

                    $itemImage = $model->getImage()
                        ? $model->getImage()->getUrl('600x600')
                        : '/cartzilla/assets/img/shop/placeholder.png';

                    $url = Yii::$app->urlManager->createUrl(['/product/view', 'id' => $model->id]);

                    $price = ShowPrice::widget(['model' => $model]);
                    $oldPrice = isset($model->old_price) ? $model->old_price : null;

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
                            'cssClass' => 'product-card-button btn btn-icon btn-secondary animate-slide-end ms-2'
                        ]
                    );

                    $views = 211;

                    return <<<HTML
<div class="product-card animate-underline hover-effect-opacity bg-body rounded">

    <div class="position-relative">
        <div class="position-absolute top-0 end-0 z-2 hover-effect-target opacity-0 mt-3 me-3">
            <div class="d-flex flex-column gap-2">
                <button type="button" class="btn btn-icon btn-secondary animate-pulse d-none d-lg-inline-flex" aria-label="Add to Wishlist">
                    <i class="ci-heart fs-base animate-target"></i>
                </button>
                <button type="button" class="btn btn-icon btn-secondary animate-rotate d-none d-lg-inline-flex" aria-label="Compare">
                    <i class="ci-refresh-cw fs-base animate-target"></i>
                </button>
            </div>
        </div>

        <a class="d-block rounded-top overflow-hidden p-3 p-sm-4" href="{$url}">
            {$badge}
            <div class="ratio" style="--cz-aspect-ratio: calc(240 / 258 * 100%)">
                <img src="{$itemImage}" alt="{$model->name}">
            </div>
        </a>
    </div>

    <div class="w-100 min-w-0 px-1 pb-2 px-sm-3 pb-sm-3">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div class="d-flex gap-1 fs-xs">{$ratingStars}</div>
            <span class="text-body-tertiary fs-xs">({$views})</span>
        </div>

        <h3 class="pb-1 mb-2">
            <a class="d-block fs-sm fw-medium text-truncate" href="{$url}">
                <span class="animate-target">{$model->name}</span>
            </a>
        </h3>

        <div class="d-flex align-items-center justify-content-between">
            <div class="h5 lh-1 mb-0">
                {$price}
            </div>

            {$buyButton}
        </div>
    </div>

    <div class="product-card-details position-absolute top-100 start-0 w-100 bg-body rounded-bottom shadow mt-n2 p-3 pt-1">
        <span class="position-absolute top-0 start-0 w-100 bg-body mt-n2 py-2"></span>
        <ul class="list-unstyled d-flex flex-column gap-2 m-0">
            <li class="d-flex align-items-center">
                <span class="fs-xs">ID:</span>
                <span class="d-block flex-grow-1 border-bottom border-dashed px-1 mt-2 mx-2"></span>
                <span class="text-dark-emphasis fs-xs fw-medium text-end">{$model->id}</span>
            </li>
        </ul>
    </div>

</div>
HTML;
}
            ]); ?>
        </div>
    </section>



    <!-- Brands -->
    <section class="container pt-4 pt-md-5 pb-5 mt-sm-2 mb-2 mb-sm-3 mb-md-4 mb-lg-5">
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3 g-md-4 g-lg-3 g-xl-4">
            <?php foreach ($producers as $producer): ?>
            <div class="col">
                <a class="btn btn-outline-secondary w-100 rounded-4 p-3" href="/">
                    <img src="<?= $producer->getImage()->getUrl() ?>" class="d-none-dark" alt="<?= $producer->name ?>">
                    <img src="<?= $producer->getImage()->getUrl() ?>" class="d-none d-block-dark" alt="<?= $producer->name ?>">
                </a>
            </div>
            <?php endforeach; ?>
            <div class="col">
                <a class="btn btn-outline-secondary w-100 h-100 rounded-4 p-3" href="/">
                    All brands
                    <i class="ci-plus-circle fs-base ms-2"></i>
                </a>
            </div>
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
                            <img src="cartzilla/assets/img/home/electronics/vlog/01.jpg" class="rounded" width="140" alt="Video cover">
                            <div class="ps-3">
                                <div class="fs-xs text-body-secondary lh-sm mb-2">6:16</div>
                                <a class="nav-link fs-sm hover-effect-underline stretched-link p-0" href="#!">5 New Cool Gadgets You Must See on Trendly - Cheap Budget</a>
                            </div>
                        </li>
                        <li class="nav flex-nowrap align-items-center position-relative">
                            <img src="cartzilla/assets/img/home/electronics/vlog/02.jpg" class="rounded" width="140" alt="Video cover">
                            <div class="ps-3">
                                <div class="fs-xs text-body-secondary lh-sm mb-2">10:20</div>
                                <a class="nav-link fs-sm hover-effect-underline stretched-link p-0" href="#!">5 Super Useful Gadgets on Trendly You Must Have in 2023</a>
                            </div>
                        </li>
                        <li class="nav flex-nowrap align-items-center position-relative">
                            <img src="cartzilla/assets/img/home/electronics/vlog/03.jpg" class="rounded" width="140" alt="Video cover">
                            <div class="ps-3">
                                <div class="fs-xs text-body-secondary lh-sm mb-2">8:40</div>
                                <a class="nav-link fs-sm hover-effect-underline stretched-link p-0" href="#!">Top 5 New Amazing Gadgets on Trendly You Must See</a>
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
