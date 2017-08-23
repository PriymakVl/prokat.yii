<?php

use yii\db\Migration;

class m170821_182840_create_tab_drawings_department extends Migration
{
    public function up()
    {
         $this->createTable('drawings_department', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'obj_id' => 'int(11) not null',
            'parent_id' => 'int(11) not null',
            'code' => 'varchar(50) not null',
            'number' => 'int(3) not null',
            'file' => 'varchar(50)',
            'date' => 'varchar(50) not null',
            'note' => 'text',
            'status' => 'int(2) NOT NULL default 1',
        ]);
    }

    public function down()
    {
        echo "m170821_182840_create_tab_drawings_department cannot be reverted.\n";

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
