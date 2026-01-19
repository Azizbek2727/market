<?php
// frontend/controllers/TelegramBotController.php

namespace frontend\controllers;

use yii\base\Response;
use yii\web\Controller;
use Yii;

class TelegramBotController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionWebhook()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $update = json_decode(Yii::$app->request->getRawBody(), true);

        if (!$update) {
            return ['ok' => true];
        }

        // Handle /start command
        if (isset($update['message']['text']) && $update['message']['text'] === '/start') {
            $chatId = $update['message']['chat']['id'];

            $this->sendStartMessage($chatId);
        }

        // Always respond 200 OK
        return ['ok' => true];
    }

    private function sendStartMessage($chatId)
    {
        $botToken = Yii::$app->params['telegramBotToken'];

        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";

        $payload = [
            'chat_id' => $chatId,
            'text' => "📒 *Sales Journal*\n\nTap the button below to record an offline sale.",
            'parse_mode' => 'Markdown',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Open Sales Journal',
                            'web_app' => [
                                'url' => 'https://trendlly.uz/mini-app'
                            ]
                        ]
                    ]
                ]
            ])
        ];

        $this->postJson($url, $payload);
    }

    private function postJson($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($data),
        ]);
        curl_exec($ch);
        curl_close($ch);
    }
}
