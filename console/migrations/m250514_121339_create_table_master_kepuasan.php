<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121339_create_table_master_kepuasan extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%master_kepuasan}}',
            [
                'id' => $this->primaryKey(),
                'keterangan' => $this->string()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%master_kepuasan}}');
    }
}














