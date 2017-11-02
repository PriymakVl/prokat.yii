<?php

use yii\db\Migration;

class m171026_190434_add_column_price_tab_order_act_content extends Migration
{
    public function up()
    {
        $this->addColumn('order_act_content', 'price', 'varchar(50) default null AFTER weight');
    }

    public function down()
    {
        echo "m171026_190434_add_column_price_tab_order_act_content cannot be reverted.\n";

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
