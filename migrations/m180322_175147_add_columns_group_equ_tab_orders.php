<?php

use yii\db\Migration;

class m180322_175147_add_columns_group_equ_tab_orders extends Migration
{
    public function up()
    {
        //$this->addColumn('orders', 'group', 'integer(5) default null AFTER unit');
//        $this->addColumn('orders', 'subgroup', 'integer(5) default null AFTER group');
//        $this->addColumn('orders', 'group_unit', 'integer(5) default null AFTER subgroup');
    }

    public function down()
    {
        echo "m180322_175147_add_columns_group_equ_tab_orders cannot be reverted.\n";

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
