<?php

    namespace app\modules\reports\models;

    use Yii;

    /**
     * This is the model class for table "report_on_money".
     *
     * @property integer $id
     * @property integer $month
     * @property integer $sum
     * @property string  $comment
     */
    class ReportOnMoney extends \yii\db\ActiveRecord {
        /**
         * @inheritdoc
         */
        public static function tableName() {
            return 'report_on_money';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
            return [
                [['month', 'sum'], 'integer'],
                [['comment'], 'string']
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
            return [
                'id'      => 'ID',
                'month'   => 'Month',
                'sum'     => 'Sum',
                'comment' => 'Comment',
            ];
        }

        public static function getMonth() {
            return [
                1  => 'Январь',
                2  => 'Февраль',
                3  => 'Март',
                4  => 'Апрель',
                5  => 'Май',
                6  => 'Июнь',
                7  => 'Июль',
                8  => 'Август',
                9  => 'Сентябрь',
                10 => 'Октябрь',
                11 => 'Ноябрь',
                12 => 'Декабрь',
            ];
        }
    }
