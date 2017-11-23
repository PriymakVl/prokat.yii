<?php

use yii\db\Migration;

class m171123_195709_add_column_order_num_tab_order_act extends Migration
{
    public function up()
    {
        $this->addColumn('order_act', 'order_num', 'varchar(50) default null AFTER order_id');
    }

    public function down()
    {
        echo "m171123_195709_add_column_order_num_tab_order_act cannot be reverted.\n";

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
