<?php

use yii\db\Migration;

class m170813_171508_add_field_dimensions_tab_orders_content extends Migration
{
    public function up()
    {
        $this->addColumn('orders_content', 'dimensions', 'varchar(255) AFTER weight');
    }

    public function down()
    {
        echo "m170813_171508_add_field_dimensions_tab_orders_content cannot be reverted.\n";

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
