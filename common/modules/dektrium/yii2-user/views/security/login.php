<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<!-- Page content -->
<main class="content-wrapper w-100 px-3 ps-lg-5 pe-lg-4 mx-auto" style="max-width: 1920px">
    <div class="d-lg-flex">

        <!-- Login form + Footer -->
        <div class="d-flex flex-column w-100 py-4 mx-auto my-auto me-lg-5" style="max-width: 416px">

            <h1 class="h2"><?= Yii::t('app', 'Welcome back') ?></h1>

            <?php if ($module->enableRegistration): ?>
                <div class="nav fs-sm mb-4">
                    <a class="nav-link text-decoration-underline p-0 ms-2"
                       href="<?= Url::to(['/user/registration/register']) ?>">
                        <?= Yii::t('app', 'Don’t have an account? Sign up!') ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ($module->enableConfirmation): ?>
                <div class="nav fs-sm mb-4">
                    <a class="nav-link text-decoration-underline p-0 ms-2"
                       href="<?= Url::to(['/user/registration/resend']) ?>">
                        <?= Yii::t('user', 'Didn\'t receive confirmation message?') ?>
                    </a>
                </div>
            <?php endif ?>

            <?= Connect::widget([
                'baseAuthUrl' => ['/user/security/auth'],
            ]) ?>

            <!-- Form -->
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => false,
                'validateOnBlur' => false,
                'validateOnType' => false,
                'validateOnChange' => false,
                'options' => [
                    'class' => 'needs-validation'
                ]
            ]); ?>

            <!-- Login -->
            <div class="position-relative mb-4">

                <?php if ($module->debug): ?>

                    <?= $form->field($model, 'login')->dropDownList(
                        LoginForm::loginList(),
                        [
                            'class' => 'form-control form-control-lg',
                            'tabindex' => 1,
                        ]
                    )->label(false); ?>

                <?php else: ?>

                    <?= $form->field($model, 'login')->textInput([
                        'autofocus' => true,
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Email or Username',
                        'tabindex' => 1,
                    ])->label(false); ?>

                <?php endif; ?>

            </div>

            <!-- Password -->
            <div class="mb-4">
                <div class="password-toggle">

                    <?php if ($module->debug): ?>

                        <div class="alert alert-warning">
                            <?= Yii::t('user', 'Password is not necessary because the module is in DEBUG mode.') ?>
                        </div>

                    <?php else: ?>

                        <?= $form->field($model, 'password', [
                            'template' => "{input}\n{error}",
                        ])->passwordInput([
                            'class' => 'form-control form-control-lg',
                            'placeholder' => 'Password',
                            'tabindex' => 2,
                        ])->label(false); ?>

                    <?php endif; ?>

                    <label class="password-toggle-button fs-lg" aria-label="Show/hide password">
                        <input type="checkbox" class="btn-check">
                    </label>
                </div>
            </div>

            <!-- Remember + Forgot -->
            <div class="d-flex align-items-center justify-content-between mb-4">

                <div class="form-check me-2">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'class' => 'form-check-input',
                        'id' => 'remember-30',
                        'tabindex' => 3
                    ])->label(false) ?>
                </div>

                <?php if ($module->enablePasswordRecovery): ?>
                    <div class="nav">
                        <a class="nav-link animate-underline p-0"
                           href="<?= Url::to(['/user/recovery/request']) ?>">
                            <span class="animate-target"><?= Yii::t('app', 'Forgot password?') ?></span>
                        </a>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Submit -->
            <button type="submit"
                    class="btn btn-lg btn-primary w-100"
                    tabindex="4">
                <?= Yii::t('user', 'Sign in') ?>
            </button>

            <?php ActiveForm::end(); ?>
        </div>


        <!-- Cover image visible on screens > 992px wide (lg breakpoint) -->
        <div class="d-none d-lg-block w-100 py-4 ms-auto" style="max-width: 1034px">
            <div class="d-flex flex-column justify-content-end h-100 rounded-5 overflow-hidden">
                <span class="position-absolute top-0 start-0 w-100 h-100 d-none-dark" style="background: linear-gradient(-90deg, #accbee 0%, #e7f0fd 100%)"></span>
                <span class="position-absolute top-0 start-0 w-100 h-100 d-none d-block-dark" style="background: linear-gradient(-90deg, #1b273a 0%, #1f2632 100%)"></span>
                <div class="ratio position-relative z-2" style="--cz-aspect-ratio: calc(1030 / 1032 * 100%)">
                    <img src="/cartzilla/assets/img/account/cover.png" alt="Girl">
                </div>
            </div>
        </div>
    </div>
</main>