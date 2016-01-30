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
 * @property string $dept
 * @property integer $service_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
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
            [['value', 'created_at', 'updated_at', 'service_id'], 'required'],
            [['value', 'service_id', 'user_id'], 'integer'],
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
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'service_id' => 'id сервиса',
            'user_id' => 'id пользователя'
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ]
            ]
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
