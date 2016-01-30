<?php

namespace backend\modules\api\controllers;

use backend\helpers\GenerateToken;
use common\modules\user\models\User;
use Yii;
use common\modules\page\models\Page;
use common\modules\page\models\search\PageSearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DefaultController extends Controller
{
    public function actionLogin()
    {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $phone = $_POST['login'];
            $password = $_POST['password'];

            $user = User::find()
                ->where('phone = :phone', [':phone' => $phone])
                ->andWhere('password = :password', [':password' => $password])
                ->one();

            if (!empty($user)) {
                $tokenGenerator = new GenerateToken();
                $user->password_reset_token = $tokenGenerator->getToken(128);
                $user->save();

                $result = [
                    'status' => [
                        'code' => 200,
                        'message' => "ОК",
                    ],
                    'data' => [
                        'token' => $user->password_reset_token
                    ],
                ];

            } else {
                $result = [
                    'status' => [
                        'code' => 402,
                        'message' => 'Пользователь не найден'
                    ],
                    'data' => [
                        'token' => "",
                    ]
                ];
            }


        } else {
            $result = [
                'status' => [
                    'code' => 403,
                    'message' => 'Не все обязательные поля заполнены'
                ],
                'data' => [
                    'token' => "",
                ]
            ];
        }


        return Json::encode($result);
    }

    public function actionSignUp()
    {
        if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['fio'])) {
            $user = new User();

            $user->phone = $_POST['login'];
            $user->password = $_POST['password'];
            $user->username = $_POST['fio'];
            $user->registerByPhoneNumber($_POST['login'], $_POST['fio'], $_POST['password']);

            $result = [
                'status' => [
                    'code' => 200,
                    'message' => "ОК",
                ],
                'data' => [
                    'activation_key' => $user->activation_key
                ]
            ];

        } else {
            $result = [
                'status' => [
                    'code' => 403,
                    'message' => 'Не все обязательные поля заполнены'
                ],
                'data' => [
                    'activation_key' => ''
                ]
            ];
        }


        return Json::encode($result);
    }

    public function actionRegisterByCode()
    {
        if (!empty($_POST['login']) && !empty($_POST['code'])) {
            $phone = $_POST['login'];
            $code = $_POST['code'];

            $user = User::find()
                ->where('phone = :phone', [':phone' => $phone])
                ->one();

            if (!empty($user)) {
                if ($user->activation_key == $code) {
                    $tokenGenerator = new GenerateToken();
                    $user->password_reset_token = $tokenGenerator->getToken(128);
                    $user->save();

                    $result = [
                        'status' => [
                            'code' => 200,
                            'message' => "ОК",
                        ],
                        'data' => [
                            'token' => $user->password_reset_token
                        ],
                    ];
                } else {
                    $result = [
                        'status' => [
                            'code' => 401,
                            'message' => 'Код аутентификации неверный'
                        ],
                        'data' => [
                            'token' => "",
                        ]
                    ];
                }

            } else {
                $result = [
                    'status' => [
                        'code' => 402,
                        'message' => 'Пользователь не найден'
                    ],
                    'data' => [
                        'token' => "",
                    ]
                ];
            }


        } else {
            $result = [
                'status' => [
                    'code' => 403,
                    'message' => 'Не все обязательные поля заполнены'
                ],
                'data' => [
                    'token' => "",
                ]
            ];
        }


        return Json::encode($result);
    }

    public function actionSaveProfile()
    {
        var_dump(headers_list());
        if (!empty($_POST['login']) && !empty($_POST['code'])) {
            $phone = $_POST['login'];
            $code = $_POST['code'];

            $user = User::find()
                ->where('phone = :phone', [':phone' => $phone])
                ->one();

            if (!empty($user)) {
                if ($user->activation_key == $code) {
                    $tokenGenerator = new GenerateToken();
                    $user->password_reset_token = $tokenGenerator->getToken(128);
                    $user->save();

                    $result = [
                        'status' => [
                            'code' => 200,
                            'message' => "ОК",
                        ],
                        'data' => [
                            'token' => $user->password_reset_token
                        ],
                    ];
                } else {
                    $result = [
                        'status' => [
                            'code' => 401,
                            'message' => 'Код аутентификации неверный'
                        ],
                        'data' => [
                            'token' => "",
                        ]
                    ];
                }

            } else {
                $result = [
                    'status' => [
                        'code' => 402,
                        'message' => 'Пользователь не найден'
                    ],
                    'data' => [
                        'token' => "",
                    ]
                ];
            }


        } else {
            $result = [
                'status' => [
                    'code' => 403,
                    'message' => 'Не все обязательные поля заполнены'
                ],
                'data' => [
                    'token' => "",
                ]
            ];
        }


        return Json::encode($result);
    }
}
