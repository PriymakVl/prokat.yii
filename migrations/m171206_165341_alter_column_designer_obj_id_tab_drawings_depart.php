<?php

use yii\db\Migration;

class m171206_165341_alter_column_designer_obj_id_tab_drawings_depart extends Migration
{
    public function up()
    {
        $this->alterColumn('drawings_department', 'obj_id', 'int(11) default null');
        $this->alterColumn('drawings_department', 'designer', 'varchar(50) default null');
    }

    public function down()
    {
        echo "m171206_165341_alter_column_designer_obj_id_tab_drawings_depart cannot be reverted.\n";

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
