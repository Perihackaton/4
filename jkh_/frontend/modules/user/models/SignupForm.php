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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'password', 'password_repeat', 'username'], 'required'],
            [['phone'],  'filter', 'filter' => 'trim', 'skipOnArray' => true],
            [['phone'], 'unique', 'targetClass' => 'common\modules\user\models\User', 'message' => 'Пользователь с таким номером моб. телефона уже имеется зарегистрирован.'],
            [['password', 'password_repeat'], 'string', 'min' => 8, 'max' => 32],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'operator' => '=='],
            [['phone'], 'string', 'min' => 16],
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
}
