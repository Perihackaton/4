<?php

namespace app\modules\reports\models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property integer $id
 * @property integer $work_type
 * @property string $date
 * @property integer $sum
 * @property integer $performer
 * @property string $comment
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment'], 'string'],
            [['date'], 'safe'],
            [['sum', 'performer', 'work_type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'date' => 'Date',
            'sum' => 'Sum',
            'performer' => 'Performer',
            'comment' => 'Comment',
        ];
    }
}
