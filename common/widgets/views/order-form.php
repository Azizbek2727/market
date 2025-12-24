<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<?php if(Yii::$app->session->hasFlash('orderError')): ?>
    <?php
    $errors = Yii::$app->session->getFlash('orderError');
    $orderModel->addErrors(unserialize($errors));
    ?>
<?php endif; ?>

<div class="checkout-form">

    <?php $form = ActiveForm::begin([
        'action' => Url::to(['/order/order/create']),
        'options' => ['class' => 'needs-validation', 'novalidate' => true]
    ]); ?>

    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>

    <div class="row row-cols-1 row-cols-sm-2 g-3 g-sm-4 mb-4">

        <!-- Client Name -->
        <div class="col">
            <?= $form->field($orderModel, 'client_name')
                ->textInput(['class' => 'form-control form-control-lg', 'required' => true])
                ->label('Full name <span class="text-danger">*</span>'); ?>
        </div>

        <!-- Phone -->
        <div class="col">
            <?= $form->field($orderModel, 'phone')
                ->textInput(['class' => 'form-control form-control-lg', 'required' => true])
                ->label('Phone <span class="text-danger">*</span>'); ?>
        </div>

        <!-- Email -->
        <div class="col">
            <?= $form->field($orderModel, 'email')
                ->input('email', ['class' => 'form-control form-control-lg'])
                ->label('Email'); ?>
        </div>

        <?php if($shippingTypes): ?>
            <!-- Shipping Type -->
            <div class="col">
                <?= $form->field($orderModel, 'shipping_type_id')->dropDownList(
                    $shippingTypes,
                    ['class' => 'form-select form-select-lg']
                )->label('Delivery method'); ?>
            </div>
        <?php endif; ?>

        <?php if($paymentTypes): ?>
            <!-- Payment Type -->
            <div class="col">
                <?= $form->field($orderModel, 'payment_type_id')->dropDownList(
                    $paymentTypes,
                    ['class' => 'form-select form-select-lg']
                )->label('Payment method'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Custom fields -->
    <?php if($fields = $fieldFind->all()): ?>
        <div class="row g-3 mb-4">
            <?php foreach($fields as $fieldModel): ?>
                <div class="col-12">
                    <?php if($widget = $fieldModel->type->widget): ?>
                        <?= $widget::widget(['form' => $form, 'fieldModel' => $fieldModel]) ?>
                    <?php else: ?>
                        <?= $form->field($fieldValueModel, "value[{$fieldModel->id}]")
                            ->textInput(['required' => $fieldModel->required == 'yes'])
                            ->label($fieldModel->name); ?>
                    <?php endif; ?>

                    <?php if($fieldModel->description): ?>
                        <p class="text-muted small"><?= $fieldModel->description ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Comment -->
    <div class="mb-4">
        <?= $form->field($orderModel, 'comment')->textarea([
            'class' => 'form-control form-control-lg',
            'rows' => 3
        ])->label('Order comment'); ?>
    </div>

    <!-- Buttons -->
    <div>
        <button class="btn btn-lg btn-primary w-100 my-2">
            Place Order
            <i class="ci-chevron-right fs-lg ms-1 me-n1"></i>
        </button>

        <?php if($referrer = Yii::$app->request->referrer): ?>
            <a class="btn btn-lg btn-secondary w-100 my-2" href="<?= Html::encode($referrer) ?>">
                Continue Shopping
            </a>
        <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
