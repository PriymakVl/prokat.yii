<?php

use yii\db\Migration;

class m170904_190538_add_column_equipment_unit_tab_orders extends Migration
{
    public function up()
    {
        //$this->addColumn('orders', 'equipment', 'varchar(100) default null AFTER section');    
        $this->addColumn('orders', 'assembly', 'varchar(100) default null AFTER equipment');    
    }

    public function down()
    {
        echo "m170904_190538_add_column_equipment_unit_tab_orders cannot be reverted.\n";

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
