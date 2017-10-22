<?php

use yii\db\Migration;

class m171004_195322_add_column_material_tab_objects extends Migration
{
    public function up()
    {
        $this->addColumn('objects', 'material', 'varchar(50) default null AFTER weight');
    }

    public function down()
    {
        echo "m171004_195322_add_column_material_tab_objects cannot be reverted.\n";

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
