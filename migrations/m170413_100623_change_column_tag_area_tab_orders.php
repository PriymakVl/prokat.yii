<?php

use yii\db\Migration;

class m170413_100623_change_column_tag_area_tab_orders extends Migration
{
    public function up()
    {
         $this->addColumn('orders', 'area', 'varchar(100) AFTER issuer');
    }

    public function down()
    {
        $this->dropColumn('orders', 'tag', 'varchar(100)');
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
