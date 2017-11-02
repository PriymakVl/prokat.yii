<?php

use yii\db\Migration;

class m171024_191732_add_column_file_cdw_tab_dwg_department extends Migration
{
    public function up()
    {
        $this->addColumn('drawings_department', 'file_cdw', 'varchar(100) default null AFTER file');
    }

    public function down()
    {
        echo "m171024_191732_add_column_file_cdw_tab_dwg_department cannot be reverted.\n";

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
