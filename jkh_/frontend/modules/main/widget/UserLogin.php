<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 16.08.14
 * Time: 13:41
 */
namespace frontend\modules\main\widget;

use frontend\modules\user\models\LoginForm;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class UserLogin extends Widget
{
    public function run()
    {
        $user = new LoginForm();

        echo $this->render('_user_login_widget', [
            'user' => $user
        ]);
    }
}