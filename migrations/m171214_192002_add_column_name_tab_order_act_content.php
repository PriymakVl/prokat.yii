<?php

use yii\db\Migration;

class m171214_192002_add_column_name_tab_order_act_content extends Migration
{
    public function up()
    {
        $this->addColumn('order_act_content', 'name', 'varchar(255) default null AFTER item_id');
    }

    public function down()
    {
        echo "m171214_192002_add_column_name_tab_order_act_content cannot be reverted.\n";

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
