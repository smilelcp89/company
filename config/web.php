<?php

$params = require __DIR__ . '/params.php';

$config = [
    'id'           => 'basic',
    'basePath'     => dirname(__DIR__),
    'bootstrap'    => ['log'],
    'defaultRoute' => 'index/index',
    'components'   => [
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'uXttyweo34ewoopUWds13fg',
            //'enableCsrfValidation' => true,
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        /*'user'         => [
        'identityClass'   => 'app\models\User',
        'enableAutoLogin' => true,
        ],*/
        'errorHandler' => [
            'errorAction' => 'public/error',
        ],
        'mailer'       => [
            'class'            => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db'           => require __DIR__ . '/db.php',
        'urlManager'   => require __DIR__ . '/url.php',
    ],
    'params'       => $params,
    'modules'      => [
        'admin' => [
            'class' => 'app\modules\admin\adminModule',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class'      => 'yii\gii\Module',
        'allowedIPs' => ['192.168.109.*', '127.0.0.1'], // 按需调整这里
    ];
}

return $config;
