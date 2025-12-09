<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'Админка',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'as backend' => 'dektrium\user\filters\BackendFilter',
            'admins' => [
                'administrator', 'hello'
            ],
            'enableUnconfirmedLogin' => true,
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'shop' => [
            'class' => 'dvizh\shop\Module',
            'controllerMap' => [
                // if you want to override only some controllers
                'product' => 'backend\controllers\ProductController',
                'category' => 'backend\controllers\CategoryController'
            ],
//            'controllerNamespace' => 'backend\controllers',
        ],
    ],
    'components' => [
        'fileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '/frontend/web/images/source',
            'filesystem'=> function() {
                $adapter = new \League\Flysystem\Adapter\Local(dirname(dirname(__DIR__)).'/frontend/web/images/source');
                return new League\Flysystem\Filesystem($adapter);
            },
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => 'en',
                    'enableCaching' => false,
                    'sourceMessageTable' => '{{i18n_source}}',
                    'messageTable' => '{{i18n_message}}',
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
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user',
                    '@dvizh/shop/views' => '@backend/views/dvizh/shop',
                ],
            ],
        ],
        'request' => [
//            'baseUrl' => '/backend/web',
            'csrfParam' => '_csrf-backend',
        ],
        'session' => [
            'name' => 'backend-sess',
            'cookieParams' => [
                'httpOnly' => true,
//                'path'     => '/backend/web',
            ],
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'identityCookie' => [
                'name'     => '_backendIdentity',
//                'path'     => '/backend/web',
                'httpOnly' => true,
            ],
            'loginUrl' => ['/user/security/login'],
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
    'params' => $params,
];
