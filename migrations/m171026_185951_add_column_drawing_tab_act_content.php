<?php

use yii\db\Migration;

class m171026_185951_add_column_drawing_tab_act_content extends Migration
{
    public function up()
    {
        $this->addColumn('order_act_content', 'drawing', 'varchar(100) default null AFTER code');
    }

    public function down()
    {
        echo "m171026_185951_add_column_drawing_tab_act_content cannot be reverted.\n";

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
