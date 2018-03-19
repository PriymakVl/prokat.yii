<?php

use yii\db\Migration;

class m171216_184344_add_column_obj_id_tab_inventories extends Migration
{
    public function up()
    {
        $this->addColumn('inventories', 'obj_id', 'integer(11) default null AFTER category');
    }

    public function down()
    {
        echo "m171216_184344_add_column_obj_id_tab_inventories cannot be reverted.\n";

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
