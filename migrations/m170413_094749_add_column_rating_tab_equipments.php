<?php

use yii\db\Migration;

class m170413_094749_add_column_rating_tab_equipments extends Migration
{
    public function up()
    {
        $this->addColumn('equipments', 'rating', 'int(10)');
    }

    public function down()
    {
        echo "m170413_094749_add_column_rating_tab_equipments cannot be reverted.\n";

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
