<?php
// frontend/controllers/TelegramBotController.php

namespace frontend\controllers;

use yii\web\Controller;
use Yii;

class TelegramBotController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionWebhook()
    {
        $update = json_decode(Yii::$app->request->getRawBody(), true);

        file_put_contents(
            Yii::getAlias('@runtime/telegram.log'),
            print_r($update, true),
            FILE_APPEND
        );

        return ['ok' => true];
    }
}
