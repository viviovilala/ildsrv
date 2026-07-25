<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121337_create_table_lokasi extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%lokasi}}',
            [
                'id' => $this->primaryKey(),
                'code' => $this->string(100),
                'name' => $this->string(),
                '_created_by' => $this->string(),
                '_updated_by' => $this->string(),
                '_created_time' => $this->dateTime(),
                '_updated_time' => $this->dateTime(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%lokasi}}');
    }
}














