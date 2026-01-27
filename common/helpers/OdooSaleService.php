<?php

namespace common\helpers;

use yii\httpclient\Client;
use yii\httpclient\CurlTransport;

class OdooSaleService
{
    private Client $client;
    private string $db = 'wms-test';

    public function __construct()
    {
        $this->client = new Client([
            'baseUrl' => 'https://odoo.tools.csms.uz/json/2',
        ]);
    }

    private function post(string $endpoint, array $data): array
    {
        $response = $this->client
            ->post($endpoint, $data)
            ->setFormat(\yii\httpclient\Client::FORMAT_JSON)
            ->addHeaders(
            [
                'Authorization' => 'Bearer ' . \Yii::$app->params['odooToken'],
                'Odoo-Database' => $this->db,
                'Content-Type' => 'application/json',
            ])
            ->send();

        if (!$response->isOk) {
            throw new \RuntimeException(
                "Odoo API error {$endpoint}: {$response->statusCode}"
            );
        }

        return $response->data['result'] ?? $response->data;
    }

    public function createPartner(array $data): int
    {
        $result = $this->post(
            'res.partner/create',
            [
                'vals_list' => [[
                    'name' => $data['name'],
                    'email' => $data['email'] ?? null,
                    'phone' => $data['phone'] ?? null,
                    'customer_rank' => 1,
                ]],
            ]
        );

        // Odoo returns array of created IDs
        return (int)$result[0];
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

        $result = $this->post(
            'sale.order/create',
            [
                'vals_list' => [[
                    'partner_id' => $partnerId,
                    'order_line' => $orderLines,
                ]],
            ]
        );

        return (int)$result[0];
    }

    public function confirmOrder(int $orderId): void
    {
        $this->post(
            'sale.order/action_confirm',
            [
                'ids' => [$orderId],
            ]
        );
    }

    public function getPickingIds(int $orderId): array
    {
        $result = $this->post(
            'sale.order/read',
            [
                'ids' => [$orderId],
                'fields' => ['picking_ids'],
            ]
        );

        return $result[0]['picking_ids'] ?? [];
    }

    public function validatePicking(int $pickingId): void
    {
        $this->post(
            'stock.picking/button_validate',
            [
                'ids' => [$pickingId],
            ]
        );
    }
}