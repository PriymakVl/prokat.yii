<?php

use yii\db\Migration;

class m171111_161115_add_column_analog_tab_objects extends Migration
{
    public function up()
    {
        $this->addColumn('objects', 'analog', 'varchar(100) default null AFTER material');
    }

    public function down()
    {
        echo "m171111_161115_add_column_analog_tab_objects cannot be reverted.\n";

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
