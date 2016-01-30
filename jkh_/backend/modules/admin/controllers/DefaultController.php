<?php

namespace backend\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\modules\admin\models;

class DefaultController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'index', 'error'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'error'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'logout', 'error'],
//                        'roles' => ['@']
                        'matchCallback' => function ($rule, $action) {
                            if ($action != 'logout') {
                                $model = models\AdminUsers::findIdentity(Yii::$app->user->getId());
                                if (!empty($model)) {
                                    return true; // Администратор
                                }
                            }
                            return false;
                        }
                    ]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//        ];
//    }

    public function actionError()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/site/error');
        }
        else
            return $this->render('error',[
                'name' => 'Not Found (#404)',
                'message' => 'Страница не найдена'
            ]);
    }
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new \backend\modules\admin\models\LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect(['/admin/default/index']);
        } else {
            return $this->renderPartial('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
