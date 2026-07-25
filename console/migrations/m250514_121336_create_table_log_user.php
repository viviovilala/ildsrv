<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121336_create_table_log_user extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%log_user}}',
            [
                'id_log_user' => $this->primaryKey(),
                'email' => $this->string(),
                'date' => $this->date(),
                'waktu' => $this->string(),
                'id_user' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%log_user}}');
    }
}














