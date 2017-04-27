<?php

use yii\db\Migration;

class m170413_074428_add_column_state_tab_orders extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'state', 'int(4)');
    }

    public function down()
    {
        echo "m170413_074428_add_column_state_tab_orders cannot be reverted.\n";

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
