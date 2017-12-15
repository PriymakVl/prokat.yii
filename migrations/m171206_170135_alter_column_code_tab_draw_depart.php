<?php

use yii\db\Migration;

class m171206_170135_alter_column_code_tab_draw_depart extends Migration
{
    public function up()
    {
        $this->alterColumn('drawings_department', 'code', 'varchar(50) default null');
    }

    public function down()
    {
        echo "m171206_170135_alter_column_code_tab_draw_depart cannot be reverted.\n";

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
