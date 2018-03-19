<?php

use yii\db\Migration;

class m180105_185747_add_column_year_tab_draw_depart extends Migration
{
    public function up()
    {
        $this->addColumn('drawings_department', 'year', 'integer(4) AFTER date');
    }

    public function down()
    {
        echo "m180105_185747_add_column_year_tab_draw_depart cannot be reverted.\n";

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
