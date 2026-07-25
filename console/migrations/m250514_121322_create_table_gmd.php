<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121322_create_table_gmd extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%gmd}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'status' => $this->string(),
                'created_by' => $this->string(),
                'updated_by' => $this->string(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%gmd}}');
    }
}














