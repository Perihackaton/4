<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
//    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'admin/default',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'backend\modules\admin\AdminModule',
        ],
        'object' => [
            'class' => 'backend\modules\object\ObjectModule',
        ],
        'page' => [
            'class' => 'backend\modules\page\PageModule',
        ],
        'user' => [
            'class' => 'backend\modules\user\UserModule',
        ],
<<<<<<< HEAD
        'api' => [
            'class' => 'backend\modules\api\ApiModule'
        ]
=======
>>>>>>> 973ddbada339ac5d76742a02c05580fa91223f68
    ],
    'components' => [
        'request' => [
            'enableCsrfValidation'=>false,
            'baseUrl' => '/cp', // данный адрес соответсвует с тем адресом который мы задали в .htaccess из общего рута нашего приложения.
            'cookieValidationKey' => 'LlfjlFkjfA39u84th',
        ],
        'user' => [
<<<<<<< HEAD
            'identityClass' => 'backend\modules\admin\models\AdminUsers',
=======
            'identityClass' => 'common\modules\user\models\AdminUser',
>>>>>>> 973ddbada339ac5d76742a02c05580fa91223f68
            'enableAutoLogin' => true,
            'loginUrl' => 'admin/default/login.html'
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
            'errorAction' => 'admin/default/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
<<<<<<< HEAD
            'suffix' => '/',
            'rules'=>[
                'api/login' => 'api/default/login',
                'api/sign_up' => 'api/default/sign_up',
                'api/register_by_code' => 'api/default/register_by_code',
                'api/save_profile' => 'api/default/save_profile',
=======
            'suffix' => '.html',
            'rules'=>[

>>>>>>> 973ddbada339ac5d76742a02c05580fa91223f68
////
//                '<module:\w+>/<action:\w+>'=>'<module>/default/<action>',
//                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
//
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//////
//                'gii'=>'gii/default/index',
//                'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
            ]
        ],
    ],
    'params' => $params,
];
