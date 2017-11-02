<?php

use yii\db\Migration;

class m171102_192618_add_column_tab_order_act_content extends Migration
{
    public function up()
    {
        $this->addColumn('order_act_content', 'month_receipt', 'integer(2) default null AFTER customer');
        $this->addColumn('order_act_content', 'month_instal', 'integer(2) default null AFTER month_receipt');
        $this->addColumn('order_act_content', 'year_receipt', 'integer(4) default null AFTER month_instal');
        $this->addColumn('order_act_content', 'year_instal', 'integer(4) default null AFTER year_receipt');
    }

    public function down()
    {
        echo "m171102_192618_add_column_tab_order_act_content cannot be reverted.\n";

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
