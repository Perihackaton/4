<?php

    use yii\db\Schema;
    use yii\db\Migration;

    class m160130_161053_add_test_reports extends Migration {
        public function up() {

            for ($i = 1; $i < 13; $i++) {
                $this->insert('report_on_money', [
                    'month'   => $i,
                    'sum'     => 10000 + $i * 1000,
                    'comment' => 'Комментарий'
                ]);
            }

            for ($i = 1; $i < 25; $i++) {
                $this->insert('report', [
                    'work_type' => rand(1, 14),
                    'date'      => date('Y-m-d'),
                    'sum'       => 1000 * $i,
                    'performer' => rand(1, 25),
                    'comment'   => 'Комментарий'
                ]);
            }
        }

        public function down() {
            $this->truncateTable('report_on_money');
            $this->truncateTable('report');
        }

        /*
        // Use safeUp/safeDown to run migration code within a transaction
        public function safeUp()
        {
        }

        public function safeDown()
        {
        }
        */
    }
