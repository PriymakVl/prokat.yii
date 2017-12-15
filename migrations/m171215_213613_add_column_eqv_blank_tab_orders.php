<?php

use yii\db\Migration;

class m171215_213613_add_column_eqv_blank_tab_orders extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'equ_blank', 'varchar(255) default null AFTER unit');
        $this->addColumn('orders', 'unit_blank', 'varchar(255) default null AFTER equ_blank');
    }

    public function down()
    {
        echo "m171215_213613_add_column_eqv_blank_tab_orders cannot be reverted.\n";

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
