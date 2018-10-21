<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'debug'],
    'layout' => 'mainShop',
    'defaultRoute' => 'shop',// default controller
    'controllerNamespace' => 'frontend\controllers',
    'aliases' => [
        '@backend' => 'project-yii/backend/web',
        '@front' => 'frontend/web'
    ],
    /*'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['*'],
        ]
    ],*/
    'components' => [
//        'session' => [
//            'class' => 'yii\web\DbSession',
//        ],
        'view' => [
            'class' => 'yii\web\View',
            'renderers' => [
                'twig' => [
                    'class' => '\yii\twig\ViewRenderer',
                    'cachePath' => '@runtime/Twig/cache',
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => [
                        'html' => ['class' => '\yii\helpers\Html'],
                        'Yii' => ['class' => '\Yii'],
                        'Url' => ['class' => '\yii\helpers\Url'],
                        //'MyClass' => ['class' => '\frontend\models\MyClass'],
                    ],
                    'uses' => ['yii\bootstrap'],
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => false,
//            'baseUrl' => 'frontend/web'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
//            'baseUrl' => '/frontend/web',
//            'defaultRoute' => 'shop/index',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'suffix' => '/',
//            'class' => 'yii\web\UrlManager',
            'rules' => [
                '/' => 'shop/',
//                '<action:(\w+|\w+\-\w+)>' => '(shop|catalog)/<action>',
//                '<controller:\w+>/<id:\d+>' => '<controller>/cart',
                'catalog/<section:[a-z0-9_\-]+>/page/<page:\d+>' => 'catalog/index',
                'catalog/page/<page:\d+>' => 'catalog/index',
                'catalog/<cat:[a-z0-9_\-]+>/<prod:[a-z0-9_\-]+>' => 'catalog/product',
                'catalog/<section:[a-z0-9_\-]+>' => 'catalog/index',
                'shop/search/page/<page:\d+>/<q:\w+>' => 'shop/search',
                'shop/search/<q:\w+>' => 'shop/search',
                '<controller:\w+>/' => '<controller>/index',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:[a-z0-9\-]+>' => '<controller>/<action>',
            ],
        ],
        'subcomponent' => [
            'class' => 'frontend\components\SubClass'
        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => 'admin/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

            ],
        ],
    ],
    'params' => $params,
];