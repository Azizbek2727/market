<?php


namespace frontend\controllers;


use app\models\Transactions;
use dvizh\order\events\OrderEvent;
use dvizh\order\models\FieldValue;
use dvizh\order\models\Order;
use dvizh\order\models\Payment;
use app\models\Octo;
use Yii;
use yii\helpers\Json;

class OrderController extends \dvizh\order\controllers\OrderController
{
    public function actionCreate()
    {
        $model = new Order(['scenario' => 'customer']);
        $octo = new Octo();

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

                $request = $octo->PreparePayment($model);
                if($request['status']){
                    return $this->redirect($request['url']);
                }
            } else {
                yii::$app->session->setFlash('orderError', yii::t('order', serialize($model->getErrors())));

                return $this->redirect(yii::$app->request->referrer);
            }
        } else {
            yii::$app->session->setFlash('orderError', yii::t('order', 'Error (check required fields)'));
            return $this->redirect(yii::$app->request->referrer);
        }
    }
}