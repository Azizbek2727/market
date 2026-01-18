<?php

// frontend/controllers/api/OfflineSaleController.php

namespace frontend\controllers\api;

use yii\rest\Controller;
use Yii;
use common\models\OfflineSale;

class OfflineSaleController extends Controller
{
    public function actionCreate()
    {
        $data = Yii::$app->request->post();

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
        // Yii::$app->queue->push(new SendSaleToWarehouseJob($sale->id));

        return [
            'success' => true,
            'sale_id' => $sale->id,
        ];
    }
}

