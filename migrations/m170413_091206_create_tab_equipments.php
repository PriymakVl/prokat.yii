<?php

use yii\db\Migration;

class m170413_091206_create_tab_equipments extends Migration
{
    public function up()
    {
        $this->createTable('equipments', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'alias' => $this->string(),
            'parent_id' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    public function down()
    {
        echo "m170413_091206_create_tab_equipments cannot be reverted.\n";

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
