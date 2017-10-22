<?php

use yii\db\Migration;

class m170909_150954_alter_column_weight_null_tab_orders_content extends Migration
{
    public function up()
    {
        $this->alterColumn('orders_content', 'weight', 'varchar(50) default null');
    }

    public function down()
    {
        echo "m170909_150954_alter_column_weight_null_tab_orders_content cannot be reverted.\n";

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
