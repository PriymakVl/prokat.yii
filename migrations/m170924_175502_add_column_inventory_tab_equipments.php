<?php

use yii\db\Migration;

class m170924_175502_add_column_inventory_tab_equipments extends Migration
{
    public function up()
    {
        $this->addColumn('equipments', 'inventory', 'varchar(50) default null AFTER alias');
    }

    public function down()
    {
        echo "m170924_175502_add_column_inventory_tab_equipments cannot be reverted.\n";

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
