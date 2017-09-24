<?php

use yii\db\Migration;

class m170923_155208_add_column_material_add_tab_content_orders extends Migration
{
    public function up()
    {
        $this->addColumn('orders_content', 'material_add', 'varchar(200) default null AFTER material');
    }

    public function down()
    {
        echo "m170923_155208_add_column_material_add_tab_content_orders cannot be reverted.\n";

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
