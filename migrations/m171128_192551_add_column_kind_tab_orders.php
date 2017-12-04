<?php

use yii\db\Migration;

class m171128_192551_add_column_kind_tab_orders extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'kind', 'varchar(50) default 1 AFTER type');
    }

    public function down()
    {
        echo "m171128_192551_add_column_kind_tab_orders cannot be reverted.\n";

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
