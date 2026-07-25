<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121254_create_table_agenda extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%agenda}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'lokasi' => $this->string(),
                'date' => $this->date(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%agenda}}');
    }
}














