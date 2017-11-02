<?php

use yii\db\Migration;

class m171102_191454_add_column_customer_tab_order_act_content extends Migration
{
    public function up()
    {
        $this->addColumn('order_act_content', 'customer', 'varchar(100) default null AFTER price');
    }

    public function down()
    {
        echo "m171102_191454_add_column_customer_tab_order_act_content cannot be reverted.\n";

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
