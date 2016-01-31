<?php

namespace common\modules\user\models;

use common\modules\services\models\Services;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%personal_acc}}".
 *
 * @property integer $id
 * @property string $value
 * @property double $dept
 * @property integer $service_id
 * @property integer $user_id
 */
class PersonalAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%personal_acc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'service_id'], 'required'],
            [['service_id', 'user_id'], 'integer'],
            [['value'], 'string', 'max' => 256],
            [['dept'], 'double']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Значение',
            'dept' => 'Задолженность',
            'service_id' => 'id сервиса',
            'user_id' => 'id пользователя'
        ];
    }

    public function getAddress()
    {
        return $this->hasOne(PersonalAccountAddress::className(), ['personal_acc_id' => 'id']);
    }

    public function getService()
    {
        return $this->hasOne(Services::className(), ['id' => 'service_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
