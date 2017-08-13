<?php

use yii\db\Migration;

class m170812_153758_add_field_delivery_tab_order_content extends Migration
{
    public function up()
    {
        $this->addColumn('orders_content', 'delivery', 'integer(1) AFTER material');
        $this->addColumn('orders_content', 'variant', 'varchar(20) AFTER code');
    }

    public function down()
    {
        echo "m170812_153758_add_field_delivery_tab_order_content cannot be reverted.\n";

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
