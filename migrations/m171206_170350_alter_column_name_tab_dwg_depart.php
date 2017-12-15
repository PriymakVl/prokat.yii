<?php

use yii\db\Migration;

class m171206_170350_alter_column_name_tab_dwg_depart extends Migration
{
    public function up()
    {
        $this->alterColumn('drawings_department', 'name', 'varchar(50) default null');
    }

    public function down()
    {
        echo "m171206_170350_alter_column_name_tab_dwg_depart cannot be reverted.\n";

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
