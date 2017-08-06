<?php

use yii\db\Migration;

class m170806_141814_drawing_department_add_column_file_2 extends Migration
{
    public function up()
    {
         $this->addColumn('drawings_department', 'file_cdw', 'varchar(100) AFTER file');
    }

    public function down()
    {
        echo "m170806_141814_drawing_department_add_column_file_2 cannot be reverted.\n";

        return false;
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
