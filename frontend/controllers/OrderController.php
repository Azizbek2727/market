<?php


namespace frontend\controllers;


use app\models\Transactions;
use dvizh\order\events\OrderEvent;
use dvizh\order\models\FieldValue;
use dvizh\order\models\Order;
use dvizh\order\models\Payment;
use app\models\Octo;
use Yii;

class OrderController extends \dvizh\order\controllers\OrderController
{
    public function actionCreate()
    {
        $model = new Order(['scenario' => 'customer']);

        if ($model->load(yii::$app->request->post())) {
            $model->date = date('Y-m-d');
            $model->time = date('H:i:s');
            $model->timestamp = time();
            $model->status = $this->module->defaultStatus;
            $model->payment = 'no';
            $model->user_id = yii::$app->user->id;

            if($model->save()) {
                if($adminNotificationEmail = yii::$app->getModule('order')->adminNotificationEmail) {
                    $sender = yii::$app->getModule('order')->mail
                        ->compose('admin_notification', ['model' => $model])
                        ->setTo($adminNotificationEmail)
                        ->setFrom(yii::$app->getModule('order')->robotEmail)
                        ->setSubject(Yii::t('order', 'New order')." #{$model->id} ({$model->client_name})")
                        ->send();
                }

                $module = $this->module;
                $orderEvent = new OrderEvent(['model' => $model]);
                $this->module->trigger($module::EVENT_ORDER_CREATE, $orderEvent);

                if($fieldValues = yii::$app->request->post('FieldValue')['value'] ?? false) {
                    foreach($fieldValues as $field_id => $fieldValue) {
                        $fieldValueModel = new FieldValue;
                        $fieldValueModel->value = $fieldValue;
                        $fieldValueModel->order_id = $model->id;
                        $fieldValueModel->field_id = $field_id;
                        $fieldValueModel->save();
                    }
                }

                if($paymentType = $model->paymentType) {
                    $payment = new Payment;
                    $payment->order_id = $model->id;
                    $payment->payment_type_id = $paymentType->id;
                    $payment->date = date('Y-m-d H:i:s');
                    $payment->amount = $model->getCost();
                    $payment->description = yii::t('order', 'Order #'.$model->id);
                    $payment->user_id = yii::$app->user->id;
                    $payment->ip = yii::$app->getRequest()->getUserIP();
                    $payment->save();

                    if($widget = $paymentType->widget) {
                        return $widget::widget([
                            'autoSend' => true,
                            'orderModel' => $model,
                            'description' => yii::t('order', 'Order #'.$model->id),
                        ]);
                    }
                }

                return $this->redirect([yii::$app->getModule('order')->successUrl, 'id' => $model->id, 'payment' => $model->payment_type_id]);
            } else {
                yii::$app->session->setFlash('orderError', yii::t('order', serialize($model->getErrors())));

                return $this->redirect(yii::$app->request->referrer);
            }
        } else {
            yii::$app->session->setFlash('orderError', yii::t('order', 'Error (check required fields)'));
            return $this->redirect(yii::$app->request->referrer);
        }
    }

    public function actionInitPayment($order_id){
        $octo = new Octo();
        $order = Order::findOne($order_id);
            $request = $octo->PreparePayment($order);
            if($request['status']){
                return $this->redirect($request['url']);
            }else{
                Yii::$app->session->setFlash('error', $request['message']);
                return $this->goHome();
            }
        }

    }

    public function actionAcceptPayment($user_id, $transaction_id){
        $user = User::findOne($user_id);
        $transaction = Transactions::findOne(["transaction_id" => $transaction_id]);

        Yii::error(['acceptRequest' => $this->request->getRawBody()]);

        return $this->goHome();
    }

    public function actionNotifyPayment(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $octo = new Octo();
        $octo->sendTelegram($this->request->getRawBody());
        $post = Json::decode($this->request->getRawBody());

        Yii::info($this->request->getRawBody(), 'app');

        if($post){
            $transaction = Transactions::findOne(["transaction_id" => $post['shop_transaction_id']]);
            if(!$transaction) return false;

            $transaction->status = $post['status'] ?? null;
            $transaction->signature = $post['signature'] ?? null;
            $transaction->hash_key = $post['hash_key'] ?? null;
            $transaction->total_sum = $post['total_sum'] ?? null;
            $transaction->transfer_sum = $post['transfer_sum'] ?? null;
            $transaction->refunded_sum = $post['refunded_sum'] ?? null;
            $transaction->card_country = $post['card_country'] ?? null;
            $transaction->maskedPan = $post['maskedPan'] ?? null;
            $transaction->rrn = $post['rrn'] ?? null;
            $transaction->payed_time = $post['payed_time'] ?? null;
            $transaction->card_type = $post['card_type'] ?? null;
            $transaction->is_physical_card = $post['is_physical_card'] ?? null;
            $transaction->save();
        }

        return true;
    }
}