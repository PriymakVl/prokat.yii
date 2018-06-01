<?php

use yii\db\Migration;

class m180422_160022_add_column_group_tab_lists extends Migration
{
    public function up()
    {
        $this->addColumn('lists', 'group', 'varchar(100) AFTER name');
    }

    public function down()
    {
        echo "m180422_160022_add_column_group_tab_lists cannot be reverted.\n";

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
