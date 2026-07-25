<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121357_create_table_reservasi extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%reservasi}}',
            [
                'id' => $this->primaryKey(),
                'member_id' => $this->string(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%reservasi}}');
    }
}














