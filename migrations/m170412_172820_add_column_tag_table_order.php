<?php

use yii\db\Migration;

class m170412_172820_add_column_tag_table_order extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'tag', 'varchar(100)');
    }

    public function down()
    {
        echo "m170412_172820_add_column_tag_table_order cannot be reverted.\n";

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
