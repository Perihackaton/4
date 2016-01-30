<?php

    namespace app\modules\reports\models;

    use Yii;

    /**
     * This is the model class for table "work_type".
     *
     * @property integer $id
     * @property string  $name
     */
    class WorkType extends \yii\db\ActiveRecord {
        /**
         * @inheritdoc
         */
        public static function tableName() {
            return 'work_type';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
            return [
                [['name'], 'string', 'max' => 255]
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
            return [
                'id'   => 'ID',
                'name' => 'Name',
            ];
        }

        public static function getAllWorkTypes() {
            /** @var self[] $workTypes */
            $workTypes = self::find()->all();

            $R = [];
            foreach ($workTypes as $w) {
                $R[ $w->id ] = $w->name;
            }
            return $R;
        }
    }
