<?php

use common\widgets\Alert;
use common\widgets\ElementsList;
use yii\helpers\Html;
use frontend\assets\CartzillaAssets;

/* @var $this \yii\web\View */
/* @var $content string */

CartzillaAssets::register($this);
\dvizh\cart\assets\WidgetAsset::register($this);
$tree = \dvizh\shop\models\Category::buildTree();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" data-bs-theme="light" data-pwa="true">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">

    <!-- SEO Meta Tags -->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="Trendly">
    <meta name="keywords" content="online shop, e-commerce, online store, market, cart, checkout, light and dark mode, gallery, slider, mobile, pwa">
    <meta name="author" content="A. Toshpo'latov">

    <!-- Webmanifest + Favicon / App icons -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="manifest" href="/cartzilla/manifest.json">
    <link rel="icon" type="image/png" href="/cartzilla/assets/app-icons/icon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="/cartzilla/assets/app-icons/icon-180x180.png">

    <!-- Preloaded local web font (Inter) -->
    <link rel="preload" href="/cartzilla/assets/fonts/inter-variable-latin.woff2" as="font" type="font/woff2" crossorigin>

    <!-- Font icons -->
    <link rel="preload" href="/cartzilla/assets/icons/cartzilla-icons.woff2" as="font" type="font/woff2" crossorigin>

    <?php $this->head() ?>

    <!-- Bootstrap + Theme styles -->
    <link rel="preload" href="/cartzilla/assets/css/theme.min.css" as="style">
    <link rel="preload" href="/cartzilla/assets/css/theme.rtl.min.css" as="style">
    <link rel="stylesheet" href="/cartzilla/assets/css/theme.min.css" id="theme-styles">
</head>
<!-- Body -->
<body>
<?php $this->beginBody() ?>

<!-- Shopping cart offcanvas -->
<div class="offcanvas offcanvas-end pb-sm-2 px-sm-2" id="shoppingCart" tabindex="-1" aria-labelledby="shoppingCartLabel" style="width: 500px">
    <!-- Items -->
    <div class="offcanvas-body d-flex flex-column gap-4 pt-2">
        <?= ElementsList::widget(); ?>
    </div>

    <!-- Footer -->
    <div class="offcanvas-header flex-column align-items-start">
        <div class="d-flex align-items-center justify-content-between w-100 mb-3 mb-md-4">
            <span class="text-light-emphasis">Subtotal:</span>
            <span class="h6 mb-0 dvizh-cart-price"><?= Yii::$app->cart->getCostFormatted() ?></span>
        </div>
        <div class="d-flex w-100 gap-3">
            <a class="btn btn-lg btn-primary w-100" href="<?= \yii\helpers\Url::to(['/site/checkout']) ?>">Checkout</a>
        </div>
    </div>
</div>


<!-- Navigation bar (Page header) -->
<header class="navbar navbar-expand-lg navbar-dark bg-dark d-block z-fixed p-0" data-sticky-navbar='{"offset": 500}'>
    <div class="container d-block py-1 py-lg-3" data-bs-theme="dark">
        <div class="navbar-stuck-hide pt-1"></div>
        <div class="row flex-nowrap align-items-center g-0">
            <div class="col col-lg-3 d-flex align-items-center">

                <!-- Mobile offcanvas menu toggler (Hamburger) -->
                <button type="button" class="navbar-toggler me-4 me-lg-0" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar brand (Logo) -->
                <a href="/" class="navbar-brand me-0">
              <span class="d-none d-sm-flex flex-shrink-0 text-primary me-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"><path d="M36 18.01c0 8.097-5.355 14.949-12.705 17.2a18.12 18.12 0 0 1-5.315.79C9.622 36 2.608 30.313.573 22.611.257 21.407.059 20.162 0 18.879v-1.758c.02-.395.059-.79.099-1.185.099-.908.277-1.817.514-2.686C2.687 5.628 9.682 0 18 0c5.572 0 10.551 2.528 13.871 6.517 1.502 1.797 2.648 3.91 3.359 6.201.494 1.659.771 3.436.771 5.292z" fill="currentColor"/><g fill="#fff"><path d="M17.466 21.624c-.514 0-.988-.316-1.146-.829-.198-.632.138-1.303.771-1.501l7.666-2.469-1.205-8.254-13.317 4.621a1.19 1.19 0 0 1-1.521-.75 1.19 1.19 0 0 1 .751-1.521l13.89-4.818c.553-.197 1.166-.138 1.64.158a1.82 1.82 0 0 1 .85 1.284l1.344 9.183c.138.987-.494 1.994-1.482 2.33l-7.864 2.528-.375.04zm7.31.138c-.178-.632-.85-1.007-1.482-.81l-5.177 1.58c-2.331.79-3.28.02-3.418-.099l-6.56-8.412a4.25 4.25 0 0 0-4.406-1.758l-3.122.987c-.237.889-.415 1.777-.514 2.686l4.228-1.363a1.84 1.84 0 0 1 1.857.81l6.659 8.551c.751.948 2.015 1.323 3.359 1.323.909 0 1.857-.178 2.687-.474l5.078-1.54c.632-.178 1.008-.829.81-1.481z"/><use href="#czlogo"/><use href="#czlogo" x="8.516" y="-2.172"/></g><defs><path id="czlogo" d="M18.689 28.654a1.94 1.94 0 0 1-1.936 1.935 1.94 1.94 0 0 1-1.936-1.935 1.94 1.94 0 0 1 1.936-1.935 1.94 1.94 0 0 1 1.936 1.935z"/></defs></svg>
              </span>
                    Trendly
                </a>
            </div>
            <div class="col col-lg-9 d-flex align-items-center justify-content-end">

                <!-- Search visible on screens > 991px wide (lg breakpoint) -->
                <div class="position-relative flex-fill d-none d-lg-block pe-4 pe-xl-5">
                    <i class="ci-search position-absolute top-50 translate-middle-y d-flex fs-lg text-white ms-3"></i>
                    <input type="search" class="form-control form-control-lg form-icon-start border-white rounded-pill" placeholder="Search the products">
                </div>

                <!-- Button group -->
                <div class="d-flex align-items-center">

                    <!-- Navbar stuck nav toggler -->
                    <button type="button" class="navbar-toggler d-none navbar-stuck-show me-3" data-bs-toggle="collapse" data-bs-target="#stuckNav" aria-controls="stuckNav" aria-expanded="false" aria-label="Toggle navigation in navbar stuck state">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Theme switcher (light/dark/auto) -->
                    <div class="dropdown">
                        <button type="button" class="theme-switcher btn btn-icon btn-lg btn-outline-secondary fs-lg border-0 rounded-circle animate-scale" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Toggle theme (light)">
                  <span class="theme-icon-active d-flex animate-target">
                    <i class="ci-sun"></i>
                  </span>
                        </button>
                        <ul class="dropdown-menu" style="--cz-dropdown-min-width: 9rem">
                            <li>
                                <button type="button" class="dropdown-item active" data-bs-theme-value="light" aria-pressed="true">
                      <span class="theme-icon d-flex fs-base me-2">
                        <i class="ci-sun"></i>
                      </span>
                                    <span class="theme-label">Light</span>
                                    <i class="item-active-indicator ci-check ms-auto"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item" data-bs-theme-value="dark" aria-pressed="false">
                      <span class="theme-icon d-flex fs-base me-2">
                        <i class="ci-moon"></i>
                      </span>
                                    <span class="theme-label">Dark</span>
                                    <i class="item-active-indicator ci-check ms-auto"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item" data-bs-theme-value="auto" aria-pressed="false">
                      <span class="theme-icon d-flex fs-base me-2">
                        <i class="ci-auto"></i>
                      </span>
                                    <span class="theme-label">Auto</span>
                                    <i class="item-active-indicator ci-check ms-auto"></i>
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Search toggle button visible on screens < 992px wide (lg breakpoint) -->
                    <button type="button" class="btn btn-icon btn-lg fs-xl btn-outline-secondary border-0 rounded-circle animate-shake d-lg-none" data-bs-toggle="collapse" data-bs-target="#searchBar" aria-expanded="false" aria-controls="searchBar" aria-label="Toggle search bar">
                        <i class="ci-search animate-target"></i>
                    </button>

                    <!-- Account button visible on screens > 768px wide (md breakpoint) -->
                    <a class="btn btn-icon btn-lg fs-lg btn-outline-secondary border-0 rounded-circle animate-shake d-none d-md-inline-flex" href="<?= \yii\helpers\Url::to(['/user/login']) ?>">
                        <i class="ci-user animate-target"></i>
                        <span class="visually-hidden">Account</span>
                    </a>

                    <!-- Wishlist button visible on screens > 768px wide (md breakpoint) -->
                    <a class="btn btn-icon btn-lg fs-lg btn-outline-secondary border-0 rounded-circle animate-pulse d-none d-md-inline-flex" href="/">
                        <i class="ci-heart animate-target"></i>
                        <span class="visually-hidden">Wishlist</span>
                    </a>

                    <!-- Cart button -->
                    <button type="button" class="btn btn-icon btn-lg btn-secondary position-relative rounded-circle ms-2" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart" aria-controls="shoppingCart" aria-label="Shopping cart">

                        <?php if (Yii::$app->cart->getCount() > 0): ?>
                        <span class="position-absolute top-0 start-100 mt-n1 ms-n3 badge text-bg-success border border-3 border-dark rounded-pill dvizh-cart-count" style="--cz-badge-padding-y: .25em; --cz-badge-padding-x: .42em">
                            <?= Yii::$app->cart->getCount() ?>
                        </span>
                        <?php endif; ?>

                        <span class="position-absolute top-0 start-0 d-flex align-items-center justify-content-center w-100 h-100 rounded-circle animate-slide-end fs-lg">
                  <i class="ci-shopping-cart animate-target ms-n1"></i>
                </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="navbar-stuck-hide pb-1"></div>
    </div>

    <!-- Search visible on screens < 992px wide (lg breakpoint). It is hidden inside collapse by default -->
    <div class="collapse position-absolute top-100 z-2 w-100 bg-dark d-lg-none" id="searchBar">
        <div class="container position-relative my-3" data-bs-theme="dark">
            <i class="ci-search position-absolute top-50 translate-middle-y d-flex fs-lg text-white ms-3"></i>
            <input type="search" class="form-control form-icon-start border-white rounded-pill" placeholder="Search the products" data-autofocus="collapse">
        </div>
    </div>

    <!-- Main navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
    <div class="collapse navbar-stuck-hide" id="stuckNav">
        <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1" aria-labelledby="navbarNavLabel">
            <div class="offcanvas-header py-3">
                <h5 class="offcanvas-title" id="navbarNavLabel">Browse Trendly</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body py-3 py-lg-0">
                <div class="container px-0 px-lg-3">
                    <div class="row">

                        <!-- Categories mega menu -->
                        <div class="col-lg-3">
                            <div class="navbar-nav">
                                <div class="dropdown w-100">

                                    <!-- Buttton visible on screens > 991px wide (lg breakpoint) -->
                                    <div class="cursor-pointer d-none d-lg-block" data-bs-toggle="dropdown" data-bs-trigger="hover" data-bs-theme="dark">
                                        <a class="position-absolute top-0 start-0 w-100 h-100" href="shop-categories-electronics.html">
                                            <span class="visually-hidden">Categories</span>
                                        </a>
                                        <button type="button" class="btn btn-lg btn-secondary dropdown-toggle w-100 rounded-bottom-0 justify-content-start pe-none">
                                            <i class="ci-grid fs-lg"></i>
                                            <span class="ms-2 me-auto">Categories</span>
                                        </button>
                                    </div>

                                    <!-- Buttton visible on screens < 992px wide (lg breakpoint) -->
                                    <button type="button" class="btn btn-lg btn-secondary dropdown-toggle w-100 justify-content-start d-lg-none mb-2" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                        <i class="ci-grid fs-lg"></i>
                                        <span class="ms-2 me-auto">Categories</span>
                                    </button>

                                    <!-- Mega menu -->
                                    <ul class="dropdown-menu <?= Yii::$app->controller->action->id == 'index'? 'dropdown-menu-static' : '' ?>  w-100 rounded-top-0 rounded-bottom-4 py-1 p-lg-1" style="--cz-dropdown-spacer: 0; --cz-dropdown-item-padding-y: .625rem; --cz-dropdown-item-spacer: 0">
                                        <li class="d-lg-none pt-2">
                                            <a class="dropdown-item fw-medium" href="shop-categories-electronics.html">
                                                <i class="ci-grid fs-xl opacity-60 pe-1 me-2"></i>
                                                All Categories
                                                <i class="ci-chevron-right fs-base ms-auto me-n1"></i>
                                            </a>
                                        </li>
                                        <?php $i = 0; foreach ($tree as $parent): $i++?>
                                            <?php $groups = $parent['childs'] ?? []; ?>

                                            <li class="dropend position-static">

                                                <!-- Level 1 parent -->
                                                <div class="position-relative rounded <?= $i == 1 ? 'pt-2 pb-1 px-lg-2' : 'pb-1 px-lg-2' ?> "
                                                     data-bs-toggle="dropdown" data-bs-trigger="hover">

                                                    <a class="dropdown-item fw-medium stretched-link d-none d-lg-flex"
                                                       href="/product/index?category=<?= $parent['id'] ?>">
                                                        <i class="ci-grid fs-xl opacity-60 pe-1 me-2"></i>
                                                        <span class="text-truncate"><?= Html::encode($parent['name']) ?></span>
                                                        <i class="ci-chevron-right fs-base ms-auto me-n1"></i>
                                                    </a>

                                                    <div class="dropdown-item fw-medium text-wrap stretched-link d-lg-none">
                                                        <i class="ci-grid fs-xl opacity-60 pe-1 me-2"></i>
                                                        <?= Html::encode($parent['name']) ?>
                                                        <i class="ci-chevron-down fs-base ms-auto me-n1"></i>
                                                    </div>
                                                </div>


                                                <!-- Mega panel -->
                                                <div class="dropdown-menu rounded-4 p-4"
                                                     style="top:1rem;height:calc(100% - .1875rem);--cz-dropdown-spacer:.3125rem;animation:none;">
                                                    <div class="d-flex flex-column flex-lg-row h-100 gap-4">

                                                        <!-- LEFT: each direct child is a COLUMN -->
                                                        <?php foreach ($groups as $group): ?>
                                                            <?php $children = $group['childs'] ?? []; ?>

                                                            <div style="min-width:194px">
                                                                <!-- Level 2 (group) -->
                                                                <div class="d-flex w-100">
                                                                    <a class="animate-underline animate-target d-inline h6 text-dark-emphasis text-decoration-none text-truncate"
                                                                       href="/product/index?category=<?= $group['id'] ?>">
                                                                        <?= Html::encode($group['name']) ?>
                                                                    </a>
                                                                </div>

                                                                <!-- Level 3 (actual items) -->
                                                                <ul class="nav flex-column gap-2 mt-n2">
                                                                    <?php foreach ($children as $child): ?>
                                                                        <li class="d-flex w-100 pt-1">
                                                                            <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0"
                                                                               href="/product/index?category=<?= $child['id'] ?>">
                                                                                <?= Html::encode($child['name']) ?>
                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            </div>

                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>

                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Navbar nav -->
                        <div class="col-lg-9 d-lg-flex pt-3 pt-lg-0 ps-lg-0">
                            <ul class="navbar-nav position-relative">
                                <li class="nav-item dropdown me-lg-n1 me-xl-0">
                                    <a class="nav-link dropdown-toggle active" aria-current="page" href="#" role="button" data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">Home</a>
                                </li>
                                <li class="nav-item dropdown position-static me-lg-n1 me-xl-0">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">Shop</a>
                                </li>
                                <li class="nav-item dropdown me-lg-n1 me-xl-0">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-trigger="hover" data-bs-auto-close="outside" aria-expanded="false">Account</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropend">
                                            <a class="dropdown-item dropdown-toggle" href="#!" role="button" data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">Auth Pages</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="account-signin.html">Sign In</a></li>
                                                <li><a class="dropdown-item" href="account-signup.html">Sign Up</a></li>
                                                <li><a class="dropdown-item" href="account-password-recovery.html">Password Recovery</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown me-lg-n1 me-xl-0">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-trigger="hover" data-bs-auto-close="outside" aria-expanded="false">Pages</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="terms-and-conditions.html">Terms &amp; Conditions</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <hr class="d-lg-none my-3">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown me-lg-n2 me-xl-n1">
                                    <a class="nav-link dropdown-toggle fs-sm px-3" href="#!" role="button" data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">Eng</a>
                                    <ul class="dropdown-menu fs-sm" style="--cz-dropdown-min-width: 7.5rem; --cz-dropdown-spacer: .25rem">
                                        <li><a class="dropdown-item" href="#!">Français</a></li>
                                        <li><a class="dropdown-item" href="#!">Deutsch</a></li>
                                        <li><a class="dropdown-item" href="#!">Italiano</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-header border-top px-0 py-3 mt-3 d-md-none">
                <div class="nav nav-justified w-100">
                    <a class="nav-link border-end" href="<?= \yii\helpers\Url::to(['/site/login']) ?>">
                        <i class="ci-user fs-lg opacity-60 me-2"></i>
                        Account
                    </a>
                    <a class="nav-link" href="">
                        <i class="ci-heart fs-lg opacity-60 me-2"></i>
                        Wishlist
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>

<?php echo Alert::widget(); ?>
<?= $content ?>


<!-- Page footer -->
<footer class="footer position-relative bg-dark">
    <span class="position-absolute top-0 start-0 w-100 h-100 bg-body d-none d-block-dark"></span>
    <div class="container position-relative z-1 pt-sm-2 pt-md-3 pt-lg-4" data-bs-theme="dark">

        <!-- Columns with links that are turned into accordion on screens < 500px wide (sm breakpoint) -->
        <div class="accordion py-5" id="footerLinks">
            <div class="row">
                <div class="col-md-4 d-sm-flex flex-md-column align-items-center align-items-md-start pb-3 mb-sm-4">
                    <h4 class="mb-sm-0 mb-md-4 me-4">
                        <a class="text-dark-emphasis text-decoration-none" href="/">Trendly</a>
                    </h4>
                    <p class="text-body fs-sm text-sm-end text-md-start mb-sm-0 mb-md-3 ms-0 ms-sm-auto ms-md-0 me-4">Got questions? Contact us 24/7</p>
                    <div class="dropdown" style="max-width: 250px">
                        <button type="button" class="btn btn-light dropdown-toggle justify-content-between w-100 d-none-dark" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Help and consultation
                        </button>
                        <button type="button" class="btn btn-secondary dropdown-toggle justify-content-between w-100 d-none d-flex-dark" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Help and consultation
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#!">Help center &amp; FAQ</a></li>
                            <li><a class="dropdown-item" href="#!">Support chat</a></li>
                            <li><a class="dropdown-item" href="#!">Open support ticket</a></li>
                            <li><a class="dropdown-item" href="#!">Call center</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row row-cols-1 row-cols-sm-3 gx-3 gx-md-4">
                        <div class="accordion-item col border-0">
                            <h6 class="accordion-header" id="companyHeading">
                                <span class="text-dark-emphasis d-none d-sm-block">Company</span>
                                <button type="button" class="accordion-button collapsed py-3 d-sm-none" data-bs-toggle="collapse" data-bs-target="#companyLinks" aria-expanded="false" aria-controls="companyLinks">Company</button>
                            </h6>
                            <div class="accordion-collapse collapse d-sm-block" id="companyLinks" aria-labelledby="companyHeading" data-bs-parent="#footerLinks">
                                <ul class="nav flex-column gap-2 pt-sm-3 pb-3 mt-n1 mb-1">
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">About company</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Our team</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Careers</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Contact us</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">News</a>
                                    </li>
                                </ul>
                            </div>
                            <hr class="d-sm-none my-0">
                        </div>
                        <div class="accordion-item col border-0">
                            <h6 class="accordion-header" id="accountHeading">
                                <span class="text-dark-emphasis d-none d-sm-block">Account</span>
                                <button type="button" class="accordion-button collapsed py-3 d-sm-none" data-bs-toggle="collapse" data-bs-target="#accountLinks" aria-expanded="false" aria-controls="accountLinks">Account</button>
                            </h6>
                            <div class="accordion-collapse collapse d-sm-block" id="accountLinks" aria-labelledby="accountHeading" data-bs-parent="#footerLinks">
                                <ul class="nav flex-column gap-2 pt-sm-3 pb-3 mt-n1 mb-1">
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Your account</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Shipping rates &amp; policies</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Refunds &amp; replacements</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Delivery info</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Order tracking</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Taxes &amp; fees</a>
                                    </li>
                                </ul>
                            </div>
                            <hr class="d-sm-none my-0">
                        </div>
                        <div class="accordion-item col border-0">
                            <h6 class="accordion-header" id="customerHeading">
                                <span class="text-dark-emphasis d-none d-sm-block">Customer service</span>
                                <button type="button" class="accordion-button collapsed py-3 d-sm-none" data-bs-toggle="collapse" data-bs-target="#customerLinks" aria-expanded="false" aria-controls="customerLinks">Customer service</button>
                            </h6>
                            <div class="accordion-collapse collapse d-sm-block" id="customerLinks" aria-labelledby="customerHeading" data-bs-parent="#footerLinks">
                                <ul class="nav flex-column gap-2 pt-sm-3 pb-3 mt-n1 mb-1">
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Payment methods</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Money back guarantee</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Product returns</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Support center</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Shipping</a>
                                    </li>
                                    <li class="d-flex w-100 pt-1">
                                        <a class="nav-link animate-underline animate-target d-inline fw-normal text-truncate p-0" href="#!">Terms &amp; conditions</a>
                                    </li>
                                </ul>
                            </div>
                            <hr class="d-sm-none my-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category / tag links -->
        <div class="d-flex flex-column gap-3 pb-3 pb-md-4 pb-lg-5 mt-n2 mt-sm-n4 mt-lg-0 mb-4">
            <ul class="nav align-items-center text-body-tertiary gap-2">
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Computers</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Smartphones</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">TV, Video</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Speakers</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Cameras</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Printers</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Video Games</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Headphones</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Wearable</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">HDD/SSD</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Smart Home</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Apple Devices</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Tablets</a>
                </li>
            </ul>
            <ul class="nav align-items-center text-body-tertiary gap-2">
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Monitors</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Scanners</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Servers</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Heating and Cooling</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">E-readers</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Data Storage</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Networking</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Power Strips</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Plugs and Outlets</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Detectors and Sensors</a>
                </li>
                <li class="px-1">/</li>
                <li class="animate-underline">
                    <a class="nav-link fw-normal p-0 animate-target" href="#!">Accessories</a>
                </li>
            </ul>
        </div>

        <!-- Copyright + Payment methods -->
        <div class="d-md-flex align-items-center border-top py-4">
            <div class="d-flex gap-2 gap-sm-3 justify-content-center ms-md-auto mb-4 mb-md-0 order-md-2">
                <div>
                    <img src="/cartzilla/assets/img/payment-methods/visa-dark-mode.svg" alt="Visa">
                </div>
                <div>
                    <img src="/cartzilla/assets/img/payment-methods/mastercard.svg" alt="Mastercard">
                </div>
                <div>
                    <img src="/cartzilla/assets/img/payment-methods/paypal-dark-mode.svg" alt="PayPal">
                </div>
                <div>
                    <img src="/cartzilla/assets/img/payment-methods/google-pay-dark-mode.svg" alt="Google Pay">
                </div>
                <div>
                    <img src="/cartzilla/assets/img/payment-methods/apple-pay-dark-mode.svg" alt="Apple Pay">
                </div>
            </div>
            <p class="text-body fs-xs text-center text-md-start mb-0 me-4 order-md-1">&copy; All rights reserved. Made by <span class="animate-underline"><a class="animate-target text-dark-emphasis fw-medium text-decoration-none" href="https://coderthemes.com/" target="_blank" rel="noreferrer">Coderthemes</a></span></p>
        </div>
    </div>
</footer>


<!-- Back to top button -->
<div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4">
    <a class="btn-scroll-top btn btn-sm bg-body border-0 rounded-pill shadow animate-slide-end" href="#top">
        Top
        <i class="ci-arrow-right fs-base ms-1 me-n1 animate-target"></i>
        <span class="position-absolute top-0 start-0 w-100 h-100 border rounded-pill z-0"></span>
        <svg class="position-absolute top-0 start-0 w-100 h-100 z-1" viewBox="0 0 62 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x=".75" y=".75" width="60.5" height="30.5" rx="15.25" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"/>
        </svg>
    </a>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
