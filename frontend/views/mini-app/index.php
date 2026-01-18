<!-- frontend/views/mini-app/index.php -->

<script src="https://telegram.org/js/telegram-web-app.js"></script>

<h3>Offline Sale</h3>

<select id="product">
    <?php foreach ($products as $p): ?>
        <option value="<?= $p['id'] ?>">
            <?= htmlspecialchars($p['name']) ?>
        </option>
    <?php endforeach; ?>
</select>

<input id="price" type="number" placeholder="Sale price">
<input id="qty" type="number" value="1" min="1">

<button onclick="saveSale()">Save Sale</button>

<script>
    const tg = window.Telegram.WebApp;
    tg.expand();

    const tg = window.Telegram?.WebApp ?? {};

    const telegramUserId =
        tg.initDataUnsafe?.user?.id ?? 999999999;

    function saveSale() {
        fetch('/api/offline-sale/create', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                telegram_user_id: tg.initDataUnsafe.user.id,
                product_id: document.getElementById('product').value,
                price: document.getElementById('price').value,
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
                } else {
                    alert('Error');
                }
            });
    }
</script>
