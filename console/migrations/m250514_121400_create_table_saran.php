<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121400_create_table_saran extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%saran}}',
            [
                'id' => $this->primaryKey(),
                'nama' => $this->string(),
                'email' => $this->string(),
                'saran' => $this->string(),
                'tanggal' => $this->date(),
                'status' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%saran}}');
    }
}














