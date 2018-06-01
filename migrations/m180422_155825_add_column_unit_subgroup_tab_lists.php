<?php

use yii\db\Migration;

class m180422_155825_add_column_unit_subgroup_tab_lists extends Migration
{
    public function up()
    {
        $this->addColumn('lists', 'unit_subgroup', 'varchar(100) AFTER subgroup');
    }

    public function down()
    {
        echo "m180422_155825_add_column_unit_subgroup_tab_lists cannot be reverted.\n";

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
