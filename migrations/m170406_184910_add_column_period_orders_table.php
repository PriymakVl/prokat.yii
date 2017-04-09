<?php

use yii\db\Migration;

class m170406_184910_add_column_period_orders_table extends Migration
{
    public function up()
    {
        	
        $this->addColumn('orders', 'period', 'integer');
    }

    public function down()
    {
        echo "m170406_184910_add_column_period_orders_table cannot be reverted.\n";

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
