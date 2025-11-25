<?php


namespace app\models;


use common\models\User;
use dvizh\order\Order;
use pheme\settings\models\Setting;
use PhpOffice\PhpSpreadsheet\Settings;
use yii\httpclient\Client;
use Yii;
use yii\base\Security;
use yii\web\Request;
use yii\web\Response;

class Octo
{
    private $shop_id;
    private $secret;
    private $url;


    public function PreparePayment(Order $order){
        $this->shop_id = Setting::findOne(['key' => 'octoMerchatId'])->value;
        $this->secret = Setting::findOne(['key' => 'octoSecret'])->value;
        $this->url = Setting::findOne(['key' => 'octoUrl'])->value;

        $transaction_id = (new \yii\base\Security)->generateRandomString(24);

//        $user_data = [
//            'user_id' => $user->id,
//            'phone' => $user->phone,
//            'email' => $user->email,
//        ];
        $paymethods = [
            ['method' => 'uzcard'],
            ['method' => 'humo'],
//            ['method' => 'bank_card']
        ];
        $body = [
            'octo_shop_id' => $this->shop_id,
            'octo_secret' => $this->secret,
            'shop_transaction_id' => $transaction_id,
            'auto_capture' => true,
            'init_time' => date('Y-m-d H:m:s', time()),
            'test' => true,
            'user_data' => $user_data,
            'total_sum' => $order->cost,
            'currency' => /*$product->currency*/ 'UZS',
            'description' => 'TEST PAYMENT',
            'payment_methods' => $paymethods,
            'return_url' => \yii\helpers\Url::toRoute(['/site/accept-payment', 'user_id' => $user->id, 'transaction_id' => $transaction_id], 'https'),
            'notify_url' => \yii\helpers\Url::toRoute(['/site/notify-payment'], 'https'),
            'language' => 'en',
            'ttl' => 15
        ];

        $transaction = new Transactions();
        $transaction->transaction_id = $transaction_id;
        $transaction->order_id = $order->id;
        $transaction->sum = $body['total_sum'];
        $transaction->currency = $body['currency'];
        $transaction->created_at = time();
        $transaction->created_by = $user->id;

        $transaction->save();


        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl("$this->url/prepare_payment")
            ->setFormat(Response::FORMAT_JSON)
            ->setData($body)
            ->send();

        if($response->isOk and $response->data['error'] == 0){
            $data = $response->data['data'];
            $transaction->octo_uuid = $data['octo_payment_UUID'];
            $transaction->sum = $data['total_sum'];
            $transaction->refunded_sum = $data['refunded_sum'];
            $transaction->status = $data['status'];
            $transaction->save();
            return ['status' => true, 'url' => $data['octo_pay_url']];
        }else{
            $data = $response->data;
            return ['status' => false, 'message' => $data['errMessage'] ?? 'error'];
        }
    }


    public function sendTelegram($message)
    {
        // Telegram bot API endpoint
        $apiEndpoint = 'https://api.telegram.org/bot' . Yii::$app->params['telegramBotToken'] . '/sendMessage';

        // Chat ID of the Telegram group
//        $chatId = -1001839426706;
        $chatId = 448080789;
        $devId = 448080789;

        // Create a HTTP client instance
        $httpClient = new Client();

        try {
            // Prepare the request parameters
            $description = date('d-m-Y H:i') . ' холатига';
            $parameters = [
                'chat_id' => $chatId,
                'caption' => $description,
                'text' => $message,
            ];

            // Prepare the Telegram request
            $telegramRequest = $httpClient->createRequest()
                ->setMethod('POST')
                ->setUrl($apiEndpoint)
                ->setData($parameters);

            // Send the request to Telegram Bot API
            $response = $httpClient->send($telegramRequest);


            // Check the response
            if ($response->isOk) {
                return true;
            } else {
                return false;
            }

        } catch (\Exception $e) {

            $text = 'An error occurred while sending the Excel file: ' . $e->getMessage() . PHP_EOL;
            $text .= 'File: ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;

            // Send error message to devId
            $devApiEndpoint = 'https://api.telegram.org/bot' . Yii::$app->params['telegramBotToken'] . '/sendMessage';
            $devParameters = [
                'chat_id' => $devId,
                'text' => $text,
            ];
            $devTelegramRequest = $httpClient->createRequest()
                ->setMethod('POST')
                ->setUrl($devApiEndpoint)
                ->setData($devParameters);
            $httpClient->send($devTelegramRequest);
        }
    }
}