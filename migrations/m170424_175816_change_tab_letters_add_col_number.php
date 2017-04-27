<?php

use yii\db\Migration;

class m170424_175816_change_tab_letters_add_col_number extends Migration
{
    public function up()
    {
        $this->addColumn('letters', 'number', 'integer(10) AFTER id');
    }

    public function down()
    {
        echo "m170424_175816_change_tab_letters_add_col_number cannot be reverted.\n";

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
