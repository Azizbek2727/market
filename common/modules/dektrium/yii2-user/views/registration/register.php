<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page content -->
<main class="content-wrapper w-100 px-3 ps-lg-5 pe-lg-4 mx-auto" style="max-width: 1920px">
    <div class="d-lg-flex">

        <!-- Login form + Footer -->
        <div class="d-flex flex-column w-100 py-4 mx-auto my-auto me-lg-5" style="max-width: 416px">

            <!-- Title -->
            <h1 class="h2 mt-auto"><?= Html::encode($this->title) ?></h1>

            <!-- Already have account -->
            <div class="nav fs-sm mb-3 mb-lg-4">
                <?= Yii::t('user', 'I already have an account') ?>
                <a class="nav-link text-decoration-underline p-0 ms-2"
                   href="<?= Url::to(['/user/security/login']) ?>">
                    <?= Yii::t('user', 'Sign in') ?>
                </a>
            </div>

            <!-- Optional benefit section (hidden for now) -->
            <div class="nav fs-sm mb-4 d-lg-none">
                <span class="me-2"><?= Yii::t('app', 'Uncertain about creating an account?') ?></span>
                <a class="nav-link text-decoration-underline p-0"
                   href="#benefits"
                   data-bs-toggle="offcanvas"
                   aria-controls="benefits">
                    <?= Yii::t('app', 'Explore the Benefits') ?>
                </a>
            </div>

            <?php $form = ActiveForm::begin([
                'id' => 'registration-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => false,
                'options' => ['class' => 'needs-validation'],
            ]); ?>

            <!-- Email -->
            <div class="position-relative mb-4">
                <?= $form->field($model, 'email', [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                    'inputOptions' => [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => '',
                        'required' => true
                    ],
                ]) ?>
            </div>

            <!-- Username -->
            <div class="position-relative mb-4">
                <?= $form->field($model, 'username', [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                    'inputOptions' => [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => '',
                        'required' => true
                    ],
                ]) ?>
            </div>

            <!-- Password -->
            <?php if (!$module->enableGeneratingPassword): ?>
                <div class="mb-4">
                    <label class="form-label"><?= Yii::t('user', 'Password') ?></label>
                    <div class="password-toggle">
                        <?= $form->field($model, 'password', [
                            'template' => "{input}\n{error}",
                        ])->passwordInput([
                            'class' => 'form-control form-control-lg',
                            'placeholder' => Yii::t('user', 'Minimum 8 characters'),
                            'minlength' => 8,
                            'required' => true
                        ])->label(false) ?>

                        <label class="password-toggle-button fs-lg" aria-label="Show/hide password">
                            <input type="checkbox" class="btn-check">
                        </label>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Extra checkboxes -->
            <div class="d-flex flex-column gap-2 mb-4">

                <!-- Privacy Policy (optional real validation) -->
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="privacy" required>
                    <label for="privacy" class="form-check-label">
                        <?= Yii::t('app', 'I have read and accept the') ?> <a class="text-dark-emphasis" href="/Trenddly_Confidentiality_Policy.pdf"><?= Yii::t('app', 'Privacy Policy') ?></a>
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-lg btn-primary w-100">
                <?= Yii::t('user', 'Create an account') ?>
                <i class="ci-chevron-right fs-lg ms-1 me-n1"></i>
            </button>

            <?php ActiveForm::end(); ?>

        </div>

        <!-- Benefits section that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
        <div class="offcanvas-lg offcanvas-end w-100 py-lg-4 ms-auto" id="benefits" style="max-width: 1034px">
            <div class="offcanvas-header justify-content-end position-relative z-2 p-3">
                <button type="button" class="btn btn-icon btn-outline-dark text-dark border-dark bg-transparent rounded-circle d-none-dark" data-bs-dismiss="offcanvas" data-bs-target="#benefits" aria-label="Close">
                    <i class="ci-close fs-lg"></i>
                </button>
                <button type="button" class="btn btn-icon btn-outline-dark text-light border-light bg-transparent rounded-circle d-none d-inline-flex-dark" data-bs-dismiss="offcanvas" data-bs-target="#benefits" aria-label="Close">
                    <i class="ci-close fs-lg"></i>
                </button>
            </div>
            <div class="position-absolute top-0 start-0 w-100 h-100 d-lg-none">
                <span class="position-absolute top-0 start-0 w-100 h-100 d-none-dark" style="background: linear-gradient(-90deg, #accbee 0%, #e7f0fd 100%)"></span>
                <span class="position-absolute top-0 start-0 w-100 h-100 d-none d-block-dark" style="background: linear-gradient(-90deg, #1b273a 0%, #1f2632 100%)"></span>
            </div>
            <div class="offcanvas-body position-relative z-2 d-lg-flex flex-column align-items-center justify-content-center h-100 pt-2 px-3 p-lg-0">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-none d-lg-block">
                    <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none-dark" style="background: linear-gradient(-90deg, #accbee 0%, #e7f0fd 100%)"></span>
                    <span class="position-absolute top-0 start-0 w-100 h-100 rounded-5 d-none d-block-dark" style="background: linear-gradient(-90deg, #1b273a 0%, #1f2632 100%)"></span>
                </div>
                <div class="position-relative z-2 w-100 text-center px-md-2 p-lg-5">
                    <h2 class="h4 pb-3"><?= Yii::t('app', 'Trendly account benefits') ?></h2>
                    <div class="mx-auto" style="max-width: 790px">
                        <div class="row row-cols-1 row-cols-sm-2 g-3 g-md-4 g-lg-3 g-xl-4">
                            <div class="col">
                                <div class="card h-100 bg-transparent border-0">
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-25 border border-white border-opacity-50 rounded-4 d-none-dark"></span>
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--cz-bg-opacity: .05"></span>
                                    <div class="card-body position-relative z-2">
                                        <div class="d-inline-flex position-relative text-info p-3">
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                                            <i class="ci-mail position-relative z-2 fs-4 m-1"></i>
                                        </div>
                                        <h3 class="h6 pt-2 my-2"><?= Yii::t('app', 'Subscribe to your favorite products') ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100 bg-transparent border-0">
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-25 border border-white border-opacity-50 rounded-4 d-none-dark"></span>
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--cz-bg-opacity: .05"></span>
                                    <div class="card-body position-relative z-2">
                                        <div class="d-inline-flex position-relative text-info p-3">
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                                            <i class="ci-settings position-relative z-2 fs-4 m-1"></i>
                                        </div>
                                        <h3 class="h6 pt-2 my-2"><?= Yii::t('app', 'View and manage your orders and wishlist') ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100 bg-transparent border-0">
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-25 border border-white border-opacity-50 rounded-4 d-none-dark"></span>
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--cz-bg-opacity: .05"></span>
                                    <div class="card-body position-relative z-2">
                                        <div class="d-inline-flex position-relative text-info p-3">
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                                            <i class="ci-gift position-relative z-2 fs-4 m-1"></i>
                                        </div>
                                        <h3 class="h6 pt-2 my-2"><?= Yii::t('app', 'Earn rewards for future purchases') ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100 bg-transparent border-0">
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-25 border border-white border-opacity-50 rounded-4 d-none-dark"></span>
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--cz-bg-opacity: .05"></span>
                                    <div class="card-body position-relative z-2">
                                        <div class="d-inline-flex position-relative text-info p-3">
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                                            <i class="ci-percent position-relative z-2 fs-4 m-1"></i>
                                        </div>
                                        <h3 class="h6 pt-2 my-2"><?= Yii::t('app', 'Receive exclusive offers and discounts') ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100 bg-transparent border-0">
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-25 border border-white border-opacity-50 rounded-4 d-none-dark"></span>
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--cz-bg-opacity: .05"></span>
                                    <div class="card-body position-relative z-2">
                                        <div class="d-inline-flex position-relative text-info p-3">
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                                            <i class="ci-heart position-relative z-2 fs-4 m-1"></i>
                                        </div>
                                        <h3 class="h6 pt-2 my-2"><?= Yii::t('app', 'Create multiple wishlists') ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100 bg-transparent border-0">
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-25 border border-white border-opacity-50 rounded-4 d-none-dark"></span>
                                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--cz-bg-opacity: .05"></span>
                                    <div class="card-body position-relative z-2">
                                        <div class="d-inline-flex position-relative text-info p-3">
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                                            <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                                            <i class="ci-pie-chart position-relative z-2 fs-4 m-1"></i>
                                        </div>
                                        <h3 class="h6 pt-2 my-2"><?= Yii::t('app', 'Pay for purchases by installments') ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
