<?php

use yii\web\Request;

//$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
//$baseUrl = str_replace('/backend/web', '', $baseUrl);

return [
    'aliases' => [
        //'@backend' => __dir__ . '',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
//        'urlManagerFrontend' => require(dirname(dirname(__DIR__)) . '/frontend/config/main.php'),
//        'urlManagerBackend' => require(dirname(dirname(__DIR__)) . '/backend/config/main.php'),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
