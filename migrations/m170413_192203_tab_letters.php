<?php

use yii\db\Migration;

class m170413_192203_tab_letters extends Migration
{
    public function up()
    {
        $this->createTable('letters', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'title' => $this->string(),
            'subject' => $this->text(),
            'text' => $this->text(),
            'to' => $this->integer(),
            'copy' => $this->string(),
            'from' => $this->string(),
            'issuer' => $this->integer(),
            'executor'  => $this->integer(),
            'date' => $this->string(),
            'state' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    public function down()
    {
        echo "m170413_192203_tab_letters cannot be reverted.\n";

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
