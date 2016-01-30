<?php

namespace frontend\modules\user\controllers;


use common\modules\user\models\User;
use frontend\modules\user\models\LoginForm;
use frontend\modules\user\models\SignupForm;
use yii\helpers\Json;
use yii\helpers\Security;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionLogin()
    {
<<<<<<< HEAD

=======
>>>>>>> 973ddbada339ac5d76742a02c05580fa91223f68
        $model = new LoginForm();

        if (\Yii::$app->user->isGuest) {
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                if ($model->login()) {
                    return $this->redirect('/');

                };
            }

            return $this->render('login', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect('/');

        }
    }

    public function actionRegistration()
    {
        if (\Yii::$app->user->isGuest) {
            $model = new SignupForm();
            if ($model->load(\Yii::$app->request->post())) {
                $user = $model->signup();
                if ($user) {
                    $this->redirect('/');
                }
            }

            return $this->render('registration', [
                'model' => $model
            ]);
        } else {
            return $this->redirect('/');
        }

    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRequestPasswordReset()
    {
        $model = new User();
        $model->scenario = 'requestPasswordResetToken';
        if ($model->load($_POST) && $model->validate()) {
            if ($this->sendPasswordResetEmail($model->phone)) {
                \Yii::$app->getSession()->setFlash('success', 'На ваш номер телефона отправлен новый пароль.');
                //return $this->goHome();
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Ошибка отрпавки СМС уведомления. Свяжитесь с Адмиистрацией сайта.');
            }
        }

        return $this->render('request-password-reset', [
            'model' => $model
        ]);
    }

    public function actionResetPassword($token)
    {
        $model = User::find([
            'password_reset_token' => $token,
            'status' => User::STATUS_ACTIVE,
        ]);

        if (!$model) {
            throw new BadRequestHttpException('Wrong password reset token.');
        }

        $model->scenario = 'resetPassword';
        if ($model->load($_POST) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    private function sendPasswordResetEmail($phone)
    {
        $user = User::find([
            'status' => User::STATUS_ACTIVE,
            'phone' => $phone,
        ])->one();

        if (!$user) {
            return false;
        }

        $user->password_reset_token = Security::generateRandomKey();
        $user->password = User::generatePassword();
        if ($user->save(false)) {
            $result = \Yii::$app->sms->sms_send(preg_replace("/[^0-9]/", '', $user->phone),
                'Ваш новый пароль: '.$user->password, "Kvadro");
            return true;
        }

        return false;
    }

}
