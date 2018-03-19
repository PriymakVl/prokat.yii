<?php

use yii\db\Migration;

class m180111_195529_add_column_customer_tab_order_act extends Migration
{
    public function up()
    {
        $this->addColumn('order_act', 'customer', 'varchar(255) default null AFTER number');
    }

    public function down()
    {
        echo "m180111_195529_add_column_customer_tab_order_act cannot be reverted.\n";

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
