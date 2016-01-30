<?php

    use yii\db\Schema;
    use yii\db\Migration;

    class m160130_145313_create_tables_for_reports extends Migration {
        public function up() {

            $workTypes = [
                'Работы по обеспечению вывоза бытовых отходов',
                'Работы по содержанию и ремонту конструктивных элементов (несущих конструкций и ненесущих конструкций) многоквартирных домов',
                'Работы (услуги) по управлению многоквартирным домом',
                'Работы по содержанию помещений, входящих в состав общего имущества в многоквартирном доме',
                'Работы по содержанию и ремонту оборудования и систем инженерно-технического обеспечения, входящих в состав общего имущества в многоквартирном доме',
                'Работы по содержанию и ремонту мусоропроводов в многоквартирном доме',
                'Работы по содержанию и ремонту лифта (лифтов) в многоквартирном доме',
                'Работы по обеспечению требований пожарной безопасности',
                'Работы по содержанию и ремонту систем дымоудаления и вентиляции',
                'Работы по содержанию и ремонту систем внутридомового газового оборудования',
                'Обеспечение устранения аварий на внутридомовых инженерных системах в многоквартирном доме',
                'Проведение дератизации и дезинсекции помещений, входящих в состав общего имущества в многоквартирном доме',
                'Работы по содержанию земельного участка с элементами озеленения и благоустройства, иными объектами, предназначенными для обслуживания и эксплуатации многоквартирного дома',
                'Ресурсы на общедомовые нужды'
            ];

            $this->createTable('work_type', [
                'id'   => $this->primaryKey(),
                'name' => $this->string()
            ]);

            foreach ($workTypes as $workType) {
                $this->insert('work_type', [
                    'name' => $workType
                ]);
            }


            $this->createTable('report', [
                'id'        => $this->primaryKey(),
                'work_type' => $this->integer(),
                'date'      => $this->date(),
                'sum'       => $this->integer(),
                'performer' => $this->integer(),
                'comment'   => $this->text()
            ]);

            $this->createTable('report_on_money', [
                'id'      => $this->primaryKey(),
                'month'   => $this->integer(),
                'sum'     => $this->integer(),
                'comment' => $this->text()
            ]);
        }

        public function down() {
            $this->dropTable('work_type');
            $this->dropTable('report');
            $this->dropTable('report_on_money');
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
