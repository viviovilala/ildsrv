<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121351_create_table_pola_eksemplar extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%pola_eksemplar}}',
            [
                'id' => $this->primaryKey(),
                'pattern' => $this->string(100)->notNull(),
                'prefix' => $this->string(100)->notNull(),
                'suffix' => $this->string(100)->notNull(),
                'length' => $this->string(100)->notNull(),
                'status' => $this->string()->notNull(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%pola_eksemplar}}');
    }
}














