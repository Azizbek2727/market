<?php

// frontend/controllers/api/OfflineSaleController.php

namespace frontend\controllers\api;

use common\models\dvizh\Product;
use common\services\OdooSaleService;
use yii\rest\Controller;
use Yii;
use common\models\OfflineSale;
use yii\web\Request;
use yii\web\Response;

class OfflineSaleController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $raw = Yii::$app->request->getRawBody();
        $data = json_decode($raw, true);

        if ($data === null) {
            return ['error' => 'Invalid JSON'];
        }

        $sale = new OfflineSale([
            'telegram_user_id' => $data['telegram_user_id'],
            'product_id'       => $data['product_id'],
            'price'            => $data['price'],
            'quantity'         => $data['quantity'] ?? 1,
            'currency'         => 'UZS',
            'created_at'       => time(),
        ]);

        if (!$sale->save()) {
            return [
                'success' => false,
                'errors' => $sale->errors,
            ];
        }

        // 🔌 Warehouse hook (future)
        try {
            $this->syncSaleToOdoo($sale, $data);
        } catch (\Throwable $e) {
            Yii::error([
                'sale_id' => $sale->id,
                'error'   => $e->getMessage(),
            ], 'app');

            // Sale is still saved locally → OK for offline flow
            return [
                'success' => true,
                'sale_id' => $sale->id,
                'warning' => 'Saved locally, Odoo sync failed',
            ];
        }

        return [
            'success' => true,
            'sale_id' => $sale->id,
            'odoo_order_id' => $sale->odoo_order_id,
        ];
    }

    /**
     * Odoo integration logic
     */
    private function syncSaleToOdoo(OfflineSale $sale, array $data): void
    {
        $odoo = new OdooSaleService();

        // 3️⃣ Create / reuse partner
        // Telegram user = customer
        $partnerId = $odoo->createPartner([
            'name'  => $data['customer_name'] ?? 'Telegram User #' . $sale->telegram_user_id,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
        ]);


        $product = Product::findOne($sale->product_id);

        if (!$product->external_id) {
            throw new \RuntimeException('Product not available in ERP yet');
        }

//        if (!$product || !$product->external_id) {
//            throw new \RuntimeException('Product not synced with Odoo');
//        }

        $odooProductId = (int)$product->external_id;

        // 4️⃣ Create sale order
        $orderId = $odoo->createOrder($partnerId, [
            [
                'product_id' => $odooProductId, // Odoo product ID
                'qty'        => $sale->quantity,
            ],
        ]);

        // 5️⃣ Confirm order
        $odoo->confirmOrder($orderId);

        // 6️⃣ Get picking(s)
        $pickingIds = $odoo->getPickingIds($orderId);

        // 7️⃣ Validate picking(s)
        foreach ($pickingIds as $pickingId) {
            $odoo->validatePicking($pickingId);

            // store first one (usually only one)
            $sale->odoo_picking_id = $pickingId;
        }

        // 8️⃣ Save Odoo references
        $sale->odoo_partner_id = $partnerId;
        $sale->odoo_order_id   = $orderId;
        $sale->odoo_synced     = 1;

        $sale->save(false);
    }
}

