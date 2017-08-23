<?php

use yii\db\Migration;

class m170821_185036_tab_create_drawings_works extends Migration
{
    public function up()
    {
        $this->createTable('drawings_works', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'obj_id' => 'int(11) not null',
            'parent_id' => 'int(11) not null',
            'code' => 'varchar(50) not null',
            'name' => 'varchar(255)',
            'number' => 'int(3) not null',
            'sheet' => 'int(2) not null',
            'file' => 'varchar(50)',
            'date' => 'varchar(50) not null',
            'note' => 'text',
            'status' => 'int(2) NOT NULL default 1',
        ]);
    }

    public function down()
    {
        echo "m170821_185036_tab_create_drawings_works cannot be reverted.\n";

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
