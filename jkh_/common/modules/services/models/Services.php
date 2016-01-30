<?php

namespace common\modules\services\models;

use Yii;

/**
 * This is the model class for table "{{%services}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $counter
 * @property double $tariff
 * @property string $tariff_measure
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%services}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => '512'],
            [['counter'], 'integer'],
            [['tariff'], 'double'],
            [['tariff_measure'], 'string', 'max' => '128'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'counter' => 'Наличие счетчика',
            'tariff' => 'Тариф',
            'tariff_measure' => 'Единица измерения тарифа'
        ];
    }
}
