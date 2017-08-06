<?php

use yii\db\Migration;

class m170803_183405_add_field_weight_orders extends Migration
{
    public function up()
    {
        $this->addColumn('orders', 'weight', 'varchar(50) AFTER period');
    }

    public function down()
    {
        echo "m170803_183405_add_field_weight_orders cannot be reverted.\n";

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
