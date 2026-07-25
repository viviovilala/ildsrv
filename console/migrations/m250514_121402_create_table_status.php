<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121402_create_table_status extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%status}}',
            [
                'id' => $this->primaryKey(),
                'status' => $this->string(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%status}}');
    }
}














