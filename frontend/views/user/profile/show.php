<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use frontend\assets\ProductAssets;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \dektrium\user\models\Profile $profile
 */

$this->title = empty($profile->name) ? Html::encode($profile->user->username) : Html::encode($profile->name);
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- Page content -->
<main class="content-wrapper">
    <div class="container py-5 mt-n2 mt-sm-0">
        <div class="row pt-md-2 pt-lg-3 pb-sm-2 pb-md-3 pb-lg-4 pb-xl-5">


            <!-- Sidebar navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
            <aside class="col-lg-3">
                <div class="offcanvas-lg offcanvas-start pe-lg-0 pe-xl-4" id="accountSidebar">

                    <!-- Header -->
                    <div class="offcanvas-header d-lg-block py-3 p-lg-0">
                        <div class="d-flex align-items-center">
                            <div class="h5 d-flex justify-content-center align-items-center flex-shrink-0 text-primary bg-primary-subtle lh-1 rounded-circle mb-0" style="width: 3rem; height: 3rem">S</div>
                            <div class="min-w-0 ps-3">
                                <h5 class="h6 mb-1"><?= $profile->user->username ?></h5>
                            </div>
                        </div>
                        <div class="nav flex-nowrap text-nowrap min-w-0">
                            <i class="glyphicon glyphicon-time text-muted"></i> <?= Yii::t('user', 'Joined on {0, date}', $profile->user->created_at) ?>
                        </div>
                        <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#accountSidebar" aria-label="Close"></button>
                    </div>

                    <!-- Body (Navigation) -->
                    <div class="offcanvas-body d-block pt-2 pt-lg-4 pb-lg-0">
                        <nav class="list-group list-group-borderless">
                            <a class="list-group-item list-group-item-action d-flex align-items-center" href="/">
                                <i class="ci-shopping-bag fs-base opacity-75 me-2"></i>
                                <?= Yii::t('frontend', 'Orders') ?>
                                <span class="badge bg-primary rounded-pill ms-auto">0</span>
                            </a>
                        </nav>
                        <h6 class="pt-4 ps-2 ms-1"><?= Yii::t('frontend', 'Manage account') ?></h6>
                        <nav class="list-group list-group-borderless">
                            <a class="list-group-item list-group-item-action d-flex align-items-center pe-none active" href="/">
                                <i class="ci-user fs-base opacity-75 me-2"></i>
                                <?= Yii::t('frontend', 'Personal info') ?>
                            </a>
                        </nav>
                        <h6 class="pt-4 ps-2 ms-1"><?= Yii::t('frontend', 'Customer service') ?></h6>
                        <nav class="list-group list-group-borderless">
                            <a class="list-group-item list-group-item-action d-flex align-items-center" href="/">
                                <i class="ci-help-circle fs-base opacity-75 me-2"></i>
                                <?= Yii::t('frontend', 'Help center') ?>
                            </a>
                            <a class="list-group-item list-group-item-action d-flex align-items-center" href="/">
                                <i class="ci-info fs-base opacity-75 me-2"></i>
                                <?= Yii::t('frontend', 'Terms and conditions') ?>
                            </a>
                        </nav>
                        <nav class="list-group list-group-borderless pt-3">
                            <form id="logout-form"
                                  action="<?= Url::to(['/user/security/logout']) ?>"
                                  method="post"
                                  style="display:none;">
                                <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                                       value="<?= Yii::$app->request->csrfToken ?>">
                            </form>


                            <a class="list-group-item list-group-item-action d-flex align-items-center"
                               href="#"
                               onclick="document.getElementById('logout-form').submit(); return false;">
                                <i class="ci-log-out fs-base opacity-75 me-2"></i>
                                <?= Yii::t('frontend', 'Log out') ?>
                            </a>
                        </nav>
                    </div>
                </div>
            </aside>


            <!-- Personal info content -->
            <div class="col-lg-9">
                <div class="ps-lg-3 ps-xl-0">

                    <!-- Page title -->
                    <h1 class="h2 mb-1 mb-sm-2"><?= Yii::t('frontend', 'Personal info') ?></h1>

                    <!-- Basic info -->
                    <div class="border-bottom py-4">
                        <div class="nav flex-nowrap align-items-center justify-content-between pb-1 mb-3">
                            <h2 class="h6 mb-0"><?= Yii::t('frontend', 'Basic info') ?></h2>
                            <a class="nav-link hiding-collapse-toggle text-decoration-underline p-0 collapsed" href=".basic-info" data-bs-toggle="collapse" aria-expanded="false" aria-controls="basicInfoPreview basicInfoEdit"><?= Yii::t('frontend', 'Edit') ?></a>
                        </div>
                        <div class="collapse basic-info show" id="basicInfoPreview">
                            <ul class="list-unstyled fs-sm m-0">
                                <li><?= $profile->user->username ?></li>
                                <li><?= Yii::$app->params['availableLanguages'][Yii::$app->language] ?></li>
                            </ul>
                        </div>
                        <div class="collapse basic-info" id="basicInfoEdit">
                            <form class="row g-3 g-sm-4 needs-validation" novalidate>
                                <div class="col-sm-6">
                                    <label for="fn" class="form-label"><?= Yii::t('frontend', 'First name') ?></label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="fn" value="Susan" required>
                                        <div class="invalid-feedback"><?= Yii::t('frontend', 'Please enter your first name!') ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="ln" class="form-label"><?= Yii::t('frontend', 'Last name') ?></label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="ln" value="Gardner" required>
                                        <div class="invalid-feedback"><?= Yii::t('frontend', 'Please enter your last name!') ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="birthdate" class="form-label"><?= Yii::t('frontend', 'Date of birth') ?></label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control form-icon-end" id="birthdate" data-datepicker='{
                          "dateFormat": "F j, Y",
                          "defaultDate": "May 15, 1996"
                        }' placeholder="Choose date">
                                        <i class="ci-calendar position-absolute top-50 end-0 translate-middle-y me-3"></i>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label"><?= Yii::t('frontend', 'Language') ?></label>
                                    <select class="form-select" data-select='{
                        "placeholderValue": "Select language",
                        "choices": [
                          {
                            "value": "",
                            "label": "Select language",
                            "placeholder": true
                          },
                          {
                            "value": "English",
                            "label": "<div class=\"d-flex align-items-center\"><img src=\"/cartzilla/assets/img/flags/en-us.png\" class=\"flex-shrink-0 me-2\" width=\"20\" alt=\"English\"> English</div>",
                            "selected": true
                          },
                          {
                            "value": "Français",
                            "label": "<div class=\"d-flex align-items-center\"><img src=\"/cartzilla/assets/img/flags/fr.png\" class=\"flex-shrink-0 me-2\" width=\"20\" alt=\"Français\"> Français</div>"
                          },
                          {
                            "value": "Deutsch",
                            "label": "<div class=\"d-flex align-items-center\"><img src=\"/cartzilla/assets/img/flags/de.png\" class=\"flex-shrink-0 me-2\" width=\"20\" alt=\"Deutsch\"> Deutsch</div>"
                          },
                          {
                            "value": "Italiano",
                            "label": "<div class=\"d-flex align-items-center\"><img src=\"/cartzilla/assets/img/flags/it.png\" class=\"flex-shrink-0 me-2\" width=\"20\" alt=\"Italiano\"> Italiano</div>"
                          }
                        ]
                      }' data-select-template="true"></select>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex gap-3 pt-2 pt-sm-0">
                                        <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Save changes') ?></button>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target=".basic-info" aria-expanded="true" aria-controls="basicInfoPreview basicInfoEdit"><?= Yii::t('app', 'Close') ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="border-bottom py-4">
                        <div class="nav flex-nowrap align-items-center justify-content-between pb-1 mb-3">
                            <div class="d-flex align-items-center gap-3 me-4">
                                <h2 class="h6 mb-0"><?= Yii::t('frontend', 'Contact') ?></h2>
                            </div>
                            <a class="nav-link hiding-collapse-toggle text-decoration-underline p-0 collapsed" href=".contact-info" data-bs-toggle="collapse" aria-expanded="false" aria-controls="contactInfoPreview contactInfoEdit"><?= Yii::t('frontend', 'Edit') ?></a>
                        </div>
                        <div class="collapse contact-info show" id="contactInfoPreview">
                            <ul class="list-unstyled fs-sm m-0">
                                <li class="mb-1"><?= $profile->public_email ?></li>
                                <li><?= $profile->user->phone ?? $profile->public_email ?? $profile->user->email ?> <?php if($profile->user->confirmed_at != null) : ?> <span class="text-success ms-1">Verified</span> <?php endif;?> </li>
                            </ul>
                        </div>
                        <div class="collapse contact-info" id="contactInfoEdit">
                            <form class="row g-3 g-sm-4 needs-validation" novalidate>
                                <div class="col-sm-6">
                                    <label for="email" class="form-label"><?= Yii::t('frontend', 'Email address') ?></label>
                                    <div class="position-relative">
                                        <input type="email" class="form-control" id="email" value="susan.gardner@email.com" required>
                                        <div class="invalid-feedback"><?= Yii::t('frontend', 'Please enter a valid email address!') ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="phone" class="form-label"><?= Yii::t('frontend', 'Phone number') ?></label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="phone" data-input-format='{"numericOnly": true, "delimiters": ["+1 (", ")", " "], "blocks": [0, 3, 0, 3, 2, 2]}' placeholder="+1 (___) ___ __ __" value="+1 (805) 348 95 72" required>
                                        <div class="invalid-feedback"><?= Yii::t('frontend', 'Please enter your phone number!') ?></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex gap-3 pt-2 pt-sm-0">
                                        <button type="submit" class="btn btn-primary"><?= Yii::t('frontend', 'Save changes') ?></button>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target=".contact-info" aria-expanded="true" aria-controls="contactInfoPreview contactInfoEdit"><?= Yii::t('frontend','Close') ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="border-bottom py-4">
                        <div class="nav flex-nowrap align-items-center justify-content-between pb-1 mb-3">
                            <div class="d-flex align-items-center gap-3 me-4">
                                <h2 class="h6 mb-0"><?= Yii::t('frontend', 'Password') ?></h2>
                            </div>
                            <a class="nav-link hiding-collapse-toggle text-decoration-underline p-0 collapsed" href=".password-change" data-bs-toggle="collapse" aria-expanded="false" aria-controls="passChangePreview passChangeEdit"><?= Yii::t('frontend', 'Edit') ?></a>
                        </div>
                        <div class="collapse password-change show" id="passChangePreview">
                            <ul class="list-unstyled fs-sm m-0">
                                <li>**************</li>
                            </ul>
                        </div>
                        <div class="collapse password-change" id="passChangeEdit">
                            <form class="row g-3 g-sm-4 needs-validation" novalidate>
                                <div class="col-sm-6">
                                    <label for="current-password" class="form-label"><?= Yii::t('frontend', 'Current password') ?></label>
                                    <div class="password-toggle">
                                        <input type="password" class="form-control" id="current-password" placeholder="Enter your current password" required>
                                        <label class="password-toggle-button" aria-label="Show/hide password">
                                            <input type="checkbox" class="btn-check">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="new-password" class="form-label"><?= Yii::t('frontend', 'New password') ?></label>
                                    <div class="password-toggle">
                                        <input type="password" class="form-control" id="new-password" placeholder="Create new password" required>
                                        <label class="password-toggle-button" aria-label="Show/hide password">
                                            <input type="checkbox" class="btn-check">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex gap-3 pt-2 pt-sm-0">
                                        <button type="submit" class="btn btn-primary"><?= Yii::t('frontend', 'Save changes') ?></button>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target=".password-change" aria-expanded="true" aria-controls="passChangePreview passChangeEdit"><?= Yii::t('frontend', 'Close') ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete account -->
                    <div class="pt-3 mt-2 mt-sm-3">
                        <h2 class="h6"><?= Yii::t('frontend', 'Delete account') ?></h2>
                        <p class="fs-sm"><?= Yii::t('frontend', 'When you delete your account, your public profile will be deactivated immediately. If you change your mind before the 14 days are up, sign in with your email and password, and we\'ll send you a link to reactivate your account.') ?></p>
                        <a class="text-danger fs-sm fw-medium" href="#!"><?= Yii::t('frontend', 'Delete account') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
