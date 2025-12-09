<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'dektrium\rbac\Bootstrap',],
    'language' => 'en',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
//            'class' => 'common\modules\dektrium\yii2-user\Module',
            'controllerMap' => [
                'profile' => 'frontend\controllers\user\ProfileController',
            ],
//            'viewPath' => '@frontend/views/user', // <— THIS is the fix
        ],
        'order' => [
            'class' => 'dvizh\order\Module',
            'controllerNamespace' => 'frontend\controllers',
            'successUrl' => '/site/thanks', //Страница, куда попадает пользователь после успешного заказа
            //'adminNotificationEmail' => 'test@yandex.ru', //Мыло для отправки заказов
            'as use_certificate' => '\common\aspects\UseCertificate',
            'as order_filling' => '\common\aspects\OrderFilling',
        ],
    ],
    'container' => [
        'singletons' => [
            \dvizh\cart\widgets\ElementsList::class => \common\widgets\ElementsList::class,
            \dvizh\cart\widgets\BuyButton::class => \common\widgets\BuyButton::class
        ],
    ],

    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'language/<lang:\w+>' => 'language/switch',
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@frontend/views/user',
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => 'en',
                    'enableCaching' => false,
                    'sourceMessageTable' => '{{%i18n_source}}',
                    'messageTable' => '{{%i18n_message}}',
                ],
                'app*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => 'en',
                    'enableCaching' => false,
                    'sourceMessageTable' => '{{%i18n_source}}',
                    'messageTable' => '{{%i18n_message}}',
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => false,
                'yii\bootstrap\BootstrapAsset' => false,
                'yii\bootstrap\BootstrapPluginAsset' => false,
                'yii\web\YiiAsset' => false,
            ],
        ],
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'identityCookie' => [
                'name'     => '_frontendIdentity',
                'path'     => '/',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            'name' => 'FRONTENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'on beforeRequest' => function () {
        if (Yii::$app->session->has('lang')) {
            Yii::$app->language = Yii::$app->session->get('lang');
        }
    },
    'params' => $params,
];
