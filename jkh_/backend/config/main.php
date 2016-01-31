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
        'page' => [
            'class' => 'backend\modules\page\PageModule',
        ],
        'user' => [
            'class' => 'backend\modules\user\UserModule',
        ],
        'api' => [
            'class' => 'backend\modules\api\ApiModule'
        ],
        'reports' => [
            'class' => 'backend\modules\reports\Module'
        ]
    ],
    'components' => [
        'request' => [
            'enableCsrfValidation'=>false,
            'baseUrl' => '/cp', // данный адрес соответсвует с тем адресом который мы задали в .htaccess из общего рута нашего приложения.
            'cookieValidationKey' => 'LlfjlFkjfA39u84th',
        ],
        'user' => [
            'identityClass' => 'backend\modules\admin\models\AdminUsers',
            'enableAutoLogin' => true,
            'loginUrl' => 'admin/default/login/'
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
            'suffix' => '/',
            'rules'=>[
                'api/auth' => 'api/default/login',
                'api/register' => 'api/default/sign-up',
                'api/register_by_code' => 'api/default/register-by-code',
                'api/save_profile' => 'api/default/save-profile',
                'api/get_profile' => 'api/default/get-profile',
                'api/add_bill_for_user' => 'api/default/add-bill-for-user',
                'api/get_history_for_service' => 'api/default/get-history-for-service',
//                '<module:\w+>/<action:\w+>'=>'<module>/default/<action>',
//                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
//                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',

//                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//////
//                'gii'=>'gii/default/index',
//                'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
            ]
        ],
    ],
    'params' => $params,
];
