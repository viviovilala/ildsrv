<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121347_create_table_peminjaman extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%peminjaman}}',
            [
                'id' => $this->primaryKey(),
                'member_id' => $this->string(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%peminjaman}}');
    }
}














