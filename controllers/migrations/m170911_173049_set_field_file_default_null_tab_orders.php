<?php

use yii\db\Migration;

class m170911_173049_set_field_file_default_null_tab_orders extends Migration
{
    public function up()
    {
        $this->alterColumn('orders_content', 'file', 'varchar(50) default null');
    }

    public function down()
    {
        echo "m170911_173049_set_field_file_default_null_tab_orders cannot be reverted.\n";

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
