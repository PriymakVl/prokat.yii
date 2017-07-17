<?php

use yii\db\Migration;

class m170715_085223_add_field_order_name_tab_objects extends Migration
{
    public function up()
    {
        $this->addColumn('objects', 'order_name', 'varchar(255) AFTER rus');
    }

    public function down()
    {
        echo "m170715_085223_add_field_order_name_tab_objects cannot be reverted.\n";

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
