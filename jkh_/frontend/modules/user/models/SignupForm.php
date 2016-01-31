<?php
namespace frontend\modules\user\models;

use common\modules\user\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $phone;
    public $username;
    public $password;
    public $password_repeat;
    public $address_index;
    public $address_city;
    public $address_area;
    public $address_house;
    public $address_building;
    public $address_flat_number;
    public $address_street;
    public $email;
    public $_user = false;
    public $rememberMe = 1;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'password', 'password_repeat', 'username'], 'required'],
            [['password', 'password_repeat'], 'string', 'min' => 8, 'max' => 32],
            [['phone'], 'string'],
            [['address_index', 'address_house', 'address_flat_number'], 'integer'],
            [['email', 'address_city', 'address_area', 'address_building', 'address_street', 'username'], 'string'],
            ['email', 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'operator' => '==', 'on' => 'changePassword'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone' => 'Моб. номер телефона',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
            'address_index' => 'Индекс',
            'address_city' => 'Город',
            'address_area' => 'Район',
            'address_street' => 'Улица',
            'address_building' => 'Строение/Корпус',
            'address_house' => 'Дом',
            'address_flat_number' => 'Квартира',
            'email' => 'E-mail',
            'username' => 'ФИО',

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            return User::registerByPhoneNumber($this->phone, $this->username, $this->password, $this->email);
        }

        return null;
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByProperties(['phone' => $this->phone]);
        }

        return $this->_user;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }
}
