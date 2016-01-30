<?php

namespace common\modules\counter\models;

use Yii;

/**
 * This is the model class for table "{{%counter}}".
 *
 * @property integer $id
 * @property string $personal_acc_id
 * @property string $pokazaniya
 * @property string $tariff
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $dept
 */
class Counter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%counter}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['personal_acc_id', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at', 'pokazaniya', 'tariff'], 'integer'],
            [['dept'], 'double'],
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
            'pokazaniya' => 'Показания',
            'tariff' => 'Тариф',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'dept' => 'Задолженность',
        ];
    }
}
