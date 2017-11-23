<?php

use yii\db\Migration;

class m171105_120149_add_columns_department_designer_tab_drawings_works extends Migration
{
    public function up()
    {
        $this->addColumn('drawings_works', 'department', 'varchar(50) default null AFTER number');
        $this->addColumn('drawings_works', 'designer', 'varchar(50) default null AFTER department');
    }

    public function down()
    {
        echo "m171105_120149_add_columns_department_designer_tab_drawings_works cannot be reverted.\n";

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
