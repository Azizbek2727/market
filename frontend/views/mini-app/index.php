<!-- frontend/views/mini-app/index.php -->

<?php

use frontend\assets\CartzillaAssets;
use yii\helpers\Html;

\frontend\assets\JqueryAsset::register($this);
CartzillaAssets::register($this);
\dvizh\cart\assets\WidgetAsset::register($this);
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

    <script src="https://telegram.org/js/telegram-web-app.js"></script>

    <!-- Bootstrap + Theme styles -->
    <link rel="preload" href="/cartzilla/assets/css/theme.min.css" as="style">
    <link rel="preload" href="/cartzilla/assets/css/theme.rtl.min.css" as="style">
    <link rel="stylesheet" href="/cartzilla/assets/css/theme.min.css" id="theme-styles">
</head>
<!-- Body -->
<body>
<?php $this->beginBody() ?>

<div class="container py-3">

    <!-- Header -->
    <div class="text-center mb-4">
        <h5 class="fw-bold mb-1">Offline Sale</h5>
        <p class="text-muted fs-sm mb-0">
            Record an offline product sale
        </p>
    </div>

    <!-- Product -->
    <div class="mb-3">
        <label class="form-label fw-medium">Product</label>
        <select id="product" class="form-select">
            <?php foreach ($products as $p): ?>
                <option value="<?= $p['id'] ?>">
                    <?= htmlspecialchars($p['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Price -->
    <div class="mb-3">
        <label class="form-label fw-medium">Sale price</label>
        <input
                id="price"
                type="number"
                class="form-control"
                placeholder="Enter price"
                inputmode="numeric"
        >
    </div>

    <!-- Quantity -->
    <div class="mb-4">
        <label class="form-label fw-medium">Quantity</label>
        <input
                id="qty"
                type="number"
                class="form-control"
                value="1"
                min="1"
        >
    </div>

    <!-- Save button -->
    <button
            type="button"
            class="btn btn-primary btn-lg w-100"
            onclick="saveSale()"
    >
        Save sale
    </button>
</div>

<script>
    const tg = window.Telegram.WebApp;
    tg.expand();

    function saveSale() {
        const price = document.getElementById('price').value;

        if (!price || Number(price) <= 0) {
            tg.showPopup({
                title: 'Validation error',
                message: 'Please enter a valid price',
                buttons: [{type: 'ok'}]
            });
            return;
        }

        fetch('/api/offline-sale/create', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                telegram_user_id: tg.initDataUnsafe.user.id,
                product_id: document.getElementById('product').value,
                price: price,
                quantity: document.getElementById('qty').value,
            })
        })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    tg.showPopup({
                        title: 'Saved',
                        message: 'Sale recorded successfully',
                        buttons: [{type: 'ok'}]
                    });

                    // reset form
                    document.getElementById('price').value = '';
                    document.getElementById('qty').value = 1;
                } else {
                    tg.showPopup({
                        title: 'Error',
                        message: res.error || 'Failed to save sale',
                        buttons: [{type: 'ok'}]
                    });
                }
            })
            .catch(() => {
                tg.showPopup({
                    title: 'Network error',
                    message: 'Please try again',
                    buttons: [{type: 'ok'}]
                });
            });
    }
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>