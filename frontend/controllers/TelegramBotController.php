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
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $update = json_decode(Yii::$app->request->getRawBody(), true);

        file_put_contents(
            Yii::getAlias('@runtime/telegram.log'),
            print_r($update, true),
            FILE_APPEND
        );

        return ['ok' => true];
    }
}
