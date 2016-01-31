<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 16.08.14
 * Time: 13:41
 */
namespace frontend\modules\main\widget;

use frontend\modules\user\models\SignupForm;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class UserRegister extends Widget
{
    public function run()
    {
        $user = new SignupForm();

        echo $this->render('_user_register_widget', [
            'user' => $user
        ]);
    }
}