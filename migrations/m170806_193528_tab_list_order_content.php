<?php

use yii\db\Migration;

class m170806_193528_tab_list_order_content extends Migration
{
    public function up()
    {
        //$this->execute("CREATE TABLE `order_list_content` (
//  `id` int(11) NOT NULL,
//  `list_id` int(10) NOT NULL,
//  `order_id` int(10) NOT NULL,
//  `status` int(2) NOT NULL
//) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC");
    }

    public function down()
    {
        echo "m170806_193528_tab_list_order_content cannot be reverted.\n";

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
