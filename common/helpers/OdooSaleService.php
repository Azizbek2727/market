<?php

namespace common\services;

use yii\httpclient\Client;
use Yii;

class OdooSaleService
{
    private Client $client;
    private string $db; //ODOO DB

    public function __construct()
    {
        $this->client = new Client([
            'baseUrl' => 'https://odoo.tools.csms.uz/json/2',
            'transport' => 'yii\httpclient\CurlTransport',
            'requestConfig' => [
                'timeout' => 30,
            ],
        ]);

        $this->db = 'wms-test';
    }

    private function request(string $endpoint, array $data): array
    {
        $response = $this->client->post(
            $endpoint,
            $data,
            [
                'Authorization' => 'Bearer ' . Yii::$app->params['odooToken'],
                'Odoo-Database' => $this->db,
                'Content-Type' => 'application/json',
            ]
        )->send();

        if (!$response->isOk) {
            throw new \RuntimeException(
                "Odoo API error ({$endpoint}): {$response->statusCode}"
            );
        }

        return $response->data['result'] ?? $response->data;
    }

    public function getProduct(int $productId): array
    {
        return $this->request(
            'product.product/read',
            [
                'ids' => [$productId],
                'fields' => [
                    'id',
                    'name',
                    'list_price',
                    'qty_available',
                    'barcode',
                    'weight',
                ],
            ]
        );
    }

    public function createOrder(int $partnerId, array $items): int
    {
        $orderLines = [];

        foreach ($items as $item) {
            $orderLines[] = [
                0,
                0,
                [
                    'product_id' => $item['product_id'],
                    'product_uom_qty' => $item['qty'],
                ],
            ];
        }

        return $this->request(
            'sale.order/create',
            [
                'values' => [
                    'partner_id' => $partnerId,
                    'order_line' => $orderLines,
                ],
            ]
        );
    }

    public function confirmOrder(int $orderId): bool
    {
        $this->request(
            'sale.order/action_confirm',
            [
                'ids' => [$orderId],
            ]
        );

        return true;
    }

    public function getDeliveryIds(int $orderId): array
    {
        $result = $this->request(
            'sale.order/read',
            [
                'ids' => [$orderId],
                'fields' => ['picking_ids'],
            ]
        );

        return $result[0]['picking_ids'] ?? [];
    }

    public function confirmDelivery(int $pickingId): bool
    {
        $this->request(
            'stock.picking/button_validate',
            [
                'ids' => [$pickingId],
            ]
        );

        return true;
    }

}
?>
