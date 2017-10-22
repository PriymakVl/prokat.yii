<?php

use yii\db\Migration;

class m170919_165326_add_column_inventary_tab_orders extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'inventory', 'varchar(255) default null AFTER unit');
    }

    public function down()
    {
        echo "m170919_165326_add_column_inventary_tab_orders cannot be reverted.\n";

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
