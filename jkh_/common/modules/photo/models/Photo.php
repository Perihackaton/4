<?php

namespace common\modules\photo\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%photo}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $src
 * @property string $title
 * @property integer $object_id
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_id'], 'integer'],
            [['title', 'name', 'src'], 'string', 'max' => 512],
            [['name'], 'image', 'extensions' => 'jpg, gif, jpeg, png', 'skipOnEmpty' => true, 'maxFiles' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Подпись',
            'name' => 'Название',
            'src' => 'Путь к файлу',
            'object_id' => 'ID объекта',
        ];
    }
}
