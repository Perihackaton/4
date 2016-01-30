<?php

namespace common\modules\counter\models;

use Yii;

/**
 * This is the model class for table "{{%counter_history}}".
 *
 * @property integer $id
 * @property string $counter_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $dept_month_beginning
 * @property string $dept_month_end
 * @property integer $payment
 */
class CounterHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%counter_history}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['counter_id', 'created_at', 'updated_at', 'dept_month_beginning', 'dept_month_end', 'payment'], 'required'],
            [['created_at', 'updated_at', 'counter_id', 'tariff'], 'integer'],
            [['dept_month_beginning', 'dept_month_end', 'payment'], 'double'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'counter_id' => 'id счетчика',
            'dept_month_beginning' => 'Задолженность в начале месяца',
            'dept_month_end' => 'Задолженность в конце места',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'payment' => 'Оплаченная сумма',
        ];
    }
}
