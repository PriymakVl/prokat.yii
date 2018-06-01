<?php

use yii\db\Migration;

class m180414_184838_modifi_colum_number_tab_drawing_departments extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE drawings_department MODIFY number VARCHAR(50) NOT NULL');
    }

    public function down()
    {
        echo "m180414_184838_modifi_colum_number_tab_drawing_departments cannot be reverted.\n";

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
