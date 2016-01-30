<?php

namespace common\modules\user\models;

use common\modules\services\models\Services;
use Yii;

/**
 * This is the model class for table "{{%payment_data}}".
 *
 * @property integer $id
 * @property int $service_id
 * @property int $personal_acc_id
 * @property string $kvit_date
 * @property string $dept_end
 * @property string $dept_begin
 * @property string $paid
 * @property string $enrolled
 */
class PaymentData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kvit_date', 'personal_acc_id', 'service_id'], 'integer'],
            [['dept_end', 'dept_begin', 'paid', 'enrolled'], 'double'],
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
            'service_id' => 'id сервиса',
            'kvit_date' => 'Дата оплаты квитанции',
            'dept_end' => 'Задолженность на конец месяца',
            'dept_begin' => 'Задолженность на начало ',
            'paid' => 'Оплачено',
            'enrolled' => 'Зачислено',
        ];
    }

    public function getService()
    {
        return $this->hasOne(Services::className(), ['id' => 'service_id']);
    }
}
