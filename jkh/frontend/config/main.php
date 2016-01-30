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
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'main/default',
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
        ],
        'main' => [
            'class' => 'frontend\modules\main\MainModule',
        ],
<<<<<<< HEAD
=======
        'object' => [
            'class' => 'frontend\modules\object\ObjectModule'
        ],
>>>>>>> 973ddbada339ac5d76742a02c05580fa91223f68
        'user' => [
            'class' => 'frontend\modules\user\UserModule'
        ]
        // ...
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'rules'=>[
                'show-info' => 'object/default/index',
                'get-cat-items' => 'main/default/get-cat-items',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                '<module:\w+>/<action:\w+>'=>'<module>/default/<action>',
            ]
        ],
    ],
    'params' => $params,
];
