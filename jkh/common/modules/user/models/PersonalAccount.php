<?php

namespace common\modules\user\models;

use Yii;

/**
 * This is the model class for table "{{%personal_acc}}".
 *
 * @property integer $id
 * @property string $value
 * @property string $fine
 * @property string $counter
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
            [['counter', 'value', 'created_at', 'updated_at'], 'required'],
            [['counter', 'fine', 'value'], 'integer'],
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
            'fine' => 'Пеня',
            'counter' => 'Наличие счетчика',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }
}
