<?php

namespace backend\modules\api\controllers;

use backend\helpers\GenerateToken;
use common\modules\services\models\Services;
use common\modules\user\models\PaymentData;
use common\modules\user\models\PersonalAccount;
use common\modules\user\models\PersonalAccountAddress;
use common\modules\user\models\User;
use Faker\Provider\da_DK\Payment;
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
                ->one();

            if (!empty($user)) {
                if ($user->validatePassword($password)) {
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
                            'code' => 407,
                            'message' => 'Неверный пароль'
                        ]
                    ];
                }


            } else {
                $result = [
                    'status' => [
                        'code' => 402,
                        'message' => 'Пользователь не найден'
                    ]
                ];
            }


        } else {
            $result = [
                'status' => [
                    'code' => 403,
                    'message' => 'Не все обязательные поля заполнены'
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

            $activation_key = $user->registerByPhoneNumber($_POST['login'], $_POST['fio'], $_POST['password']);

            if ($activation_key == -1) {
                $result = [
                    'status' => [
                        'code' => 408,
                        'message' => "Пользователь с таким номером телефона уже существует",
                    ]
                ];
            } elseif ($activation_key == -2) {
                    $result = [
                        'status' => [
                            'code' => 405,
                            'message' => 'Введены неверные данные'
                        ]
                    ];
            } else {
                $result = [
                    'status' => [
                        'code' => 200,
                        'message' => "ОК",
                    ],
                    'data' => [
                        'activation_key' => $activation_key
                    ]
                ];
            }

        } else {
            $result = [
                'status' => [
                    'code' => 403,
                    'message' => 'Не все обязательные поля заполнены'
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
                    $user->activated = 1;
                    $tokenGenerator = new GenerateToken();
                    $user->password_reset_token = $tokenGenerator->getToken(128);
                    if ($user->save()) {
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
                                'code' => 405,
                                'message' => 'Введены неверные данные'
                            ]
                        ];
                    }

                } else {
                    $result = [
                        'status' => [
                            'code' => 401,
                            'message' => 'Код аутентификации неверный'
                        ]
                    ];
                }

            } else {
                $result = [
                    'status' => [
                        'code' => 402,
                        'message' => 'Пользователь не найден'
                    ]
                ];
            }


        } else {
            $result = [
                'status' => [
                    'code' => 403,
                    'message' => 'Не все обязательные поля заполнены'
                ]
            ];
        }


        return Json::encode($result);
    }

    public function actionSaveProfile()
    {
        $token = $this->getToken();

        if ($token) {
            $user = User::find()
                ->where('password_reset_token = :token', [':token' => $token])
                ->one();

            if (!empty($user)) {

                if (!empty($_POST['fio'])) {
                    $user->username = $_POST['fio'];
                }

                $address = PersonalAccountAddress::find()
                    ->where('user_id = :user_id', [':user_id' => $user->id])
                    ->one();

                if (empty($address)) {
                    $address = new PersonalAccountAddress();
                    $address->user_id = $user->id;
                }


                if (!empty($_POST['city'])) {
                    $address->city = $_POST['city'];
                }

                if (!empty($_POST['street'])) {
                    $address->street = $_POST['street'];
                }

                if (!empty($_POST['house'])) {
                    $address->house = $_POST['house'];
                }

                if (!empty($_POST['corpse'])) {
                    $address->area = $_POST['corpse'];
                }

                if (!empty($_POST['flat'])) {
                    $address->flat_number = $_POST['flat'];
                }

                if ($user->save() && $address->save()) {
                    $result = [
                        'status' => [
                            'code' => 200,
                            'message' => "ОК",
                        ]
                    ];
                } else {
                    $result = [
                        'status' => [
                            'code' => 405,
                            'message' => "Введены неверные данные",
                        ]
                    ];
                };


            } else {
                $result = [
                    'status' => [
                        'code' => 402,
                        'message' => 'Пользователь не найден'
                    ]
                ];
            }


        } else {
            $result = [
                'status' => [
                    'code' => 400,
                    'message' => 'Значение Token не задано'
                ]
            ];
        }


        return Json::encode($result);
    }

    public function actionGetProfile()
    {
        $token = $this->getToken();

        if ($token) {
            $user = User::find()
                ->where('password_reset_token = :token', [':token' => $token])
                ->one();

            if (!empty($user)) {

                $result = [
                    'status' => [
                        'code' => 200,
                        'message' => "ОК",
                    ],

                    'data' => [
                        'profile' => [
                            'fio' => $user->username,
                            'token' => $user->password_reset_token,
                        ]
                    ],
                ];

                if (!empty($user->address)) {
                    $result['data']['profile']['city'] = empty($user->address->city) ? "" : $user->address->city;
                    $result['data']['profile']['street'] = empty($user->address->street) ? "" : $user->address->street;
                    $result['data']['profile']['house'] = empty($user->address->house) ? "" : $user->address->house;
                    $result['data']['profile']['corpse'] = empty($user->address->area) ? "" : $user->address->area;
                    $result['data']['profile']['flat'] = empty($user->address->flat_number) ? "" : $user->address->flat_number;
                }

                $personal_accs = $user->getPersonalAccounts();
                if ($personal_accs) {
                    foreach ($personal_accs as $index => $personal_acc) {
                        $result['data']['bills'][$index] = [
                            'service_id' => $personal_acc->service_id,
                            'bill' => $personal_acc->value,
                            'dept' => empty($personal_acc->dept) ? 0 : $personal_acc->dept
                        ];
                    }
                }
            } else {
                $result = [
                    'status' => [
                        'code' => 402,
                        'message' => 'Пользователь не найден'
                    ]
                ];
            }
        } else {
            $result = [
                'status' => [
                    'code' => 400,
                    'message' => 'Значение Token не задано'
                ]
            ];
        }

        return Json::encode($result);
    }

    public function actionAddBillForUser()
    {
        $token = $this->getToken();

        if ($token) {
            $user = User::find()
                ->where('password_reset_token = :token', [':token' => $token])
                ->one();

            if (!empty($user)) {
                if (!empty($_POST['bill']) && !empty($_POST['service_id'])) {

                    $service = Services::findOne($_POST['service_id']);

                    if ($service) {
                        $personal_acc = PersonalAccount::find()
                            ->where('service_id = :service_id', [':service_id' => $_POST['service_id']])
                            ->andWhere('user_id = :user_id', [':user_id' => $user->id])
                            ->one();

                        if (!$personal_acc) {
                            $personal_acc = new PersonalAccount();
                            $personal_acc->service_id = $_POST['service_id'];
                            $personal_acc->user_id = $user->id;
                        }

                        $personal_acc->value = $_POST['bill'];
                        if ($personal_acc->save()) {

                            $result = [
                                'status' => [
                                    'code' => 200,
                                    'message' => "ОК",
                                ],
                            ];

                        }  else {
                            $result = [
                                'status' => [
                                    'code' => 405,
                                    'message' => "Введены неверные данные",
                                ]
                            ];
                        };
                    } else {
                        $result = [
                            'status' => [
                                'code' => 406,
                                'message' => 'Услуга не найдена'
                            ]
                        ];
                    }

                } else {
                    $result = [
                        'status' => [
                            'code' => 403,
                            'message' => 'Не все обязательные поля заполнены'
                        ]
                    ];
                }
            } else {
                $result = [
                    'status' => [
                        'code' => 402,
                        'message' => 'Пользователь не найден'
                    ]
                ];
            }
        } else {
            $result = [
                'status' => [
                    'code' => 400,
                    'message' => 'Значение Token не задано'
                ]
            ];
        }

        return Json::encode($result);
    }

    public function actionGetHistoryForService()
    {
        $token = $this->getToken();

        if ($token) {
            $user = User::find()
                ->where('password_reset_token = :token', [':token' => $token])
                ->one();

            if (!empty($user)) {
                if (!empty($_POST['bill']) && !empty($_POST['service_id'])) {

                    $service = Services::find()
                        ->where('id = :id', [':id' => $_POST['service_id']])
                        ->one();


                    if ($service) {
                        $persAcc = PersonalAccount::find()->
                        where('value = :value', [':value' => $_POST['bill']])
                            ->one();

                        if ($persAcc) {
                            $result = [
                                'status' => [
                                    'code' => 200,
                                    'message' => 'ОК',
                                ],
                                'data' => [
                                    'tariff' => $service->tariff,
                                    'tariff_measure' => $service->tariff_measure,
                                    'history' => []
                                ]
                            ];

                            $history = PaymentData::find()
                                ->where('personal_acc_id = :personal_acc_id', [':personal_acc_id' => $persAcc->id])
                                ->andWhere('service_id = :service_id', [':service_id' => $_POST['service_id']])
                                ->all();

                            if ($history) {
                                foreach ($history as $index => $payment) {
                                    $result['data']['history'][$index] = [
                                        'date' => "".$payment->kvit_date,
                                        'dept_end' => $payment->dept_end,
                                        'dept_begin' => $payment->dept_begin,
                                        'enrolled' => $payment->enrolled,
                                        'paid' => $payment->paid,
                                        'bill' => $_POST['bill'],
                                    ];
                                }
                            }

                        } else {
                            $result = [
                                'status' => [
                                    'code' => 409,
                                    'message' => 'Лицевой счет не найден'
                                ]
                            ];
                        }


                    } else {
                        $result = [
                            'status' => [
                                'code' => 406,
                                'message' => 'Услуга не найдена'
                            ]
                        ];
                    }

                } else {
                    $result = [
                        'status' => [
                            'code' => 403,
                            'message' => 'Не все обязательные поля заполнены'
                        ]
                    ];
                }
            } else {
                $result = [
                    'status' => [
                        'code' => 402,
                        'message' => 'Пользователь не найден'
                    ]
                ];
            }
        } else {
            $result = [
                'status' => [
                    'code' => 400,
                    'message' => 'Значение Token не задано'
                ]
            ];
        }

        return Json::encode($result);
    }

    public function getToken()
    {
        $token = false;
        if (!empty(Yii::$app->request->headers['token'])) {
            $token = Yii::$app->request->headers['token'];
        };

        return $token;
    }

}
