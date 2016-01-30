<?php

namespace common\modules\user\models;

use Yii;

/**
 * This is the model class for table "{{%personal_acc_address}}".
 *
 * @property integer $id
 * @property int $personal_acc_id
 * @property int $addr_index
 * @property string $city
 * @property string $street
 * @property string $area
 * @property string $house
 * @property string $building
 * @property int $flat_number
 * @property int $user_id
 */
class PersonalAccountAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%personal_acc_address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['personal_acc_id', 'addr_index', 'flat_number', 'user_id'], 'integer'],
            [['city', 'street', 'area'], 'string', 'max' => 512],
            [['house', 'building'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'personal_acc_id' => 'id лицевого счета',
            'addr_index' => 'Индекс',
            'flat_number' => 'Квартира',
            'user_id' => 'id пользователя',
            'city' => 'Город',
            'street' => 'Улица',
            'area' => 'Район',
            'house' => 'Дом',
            'building' => 'Корпус/строение'
        ];
    }
}
