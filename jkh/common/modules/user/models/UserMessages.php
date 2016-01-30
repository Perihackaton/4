<?php

namespace common\modules\user\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "t_kg_user_messages".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $message
 * @property string $date
 * @property integer $approved
 */
class UserMessages extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_user_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'required'],
            [['date', 'approved'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Сообщение',
            'user_id' => 'user_id',
            'date' => 'Дата',
            'approved' => 'Подтвержден'
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date'],
                ]
            ]
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
