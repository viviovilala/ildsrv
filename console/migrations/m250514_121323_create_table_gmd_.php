<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121323_create_table_gmd_ extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%gmd_}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'status' => $this->string(),
                '_created_by' => $this->string(),
                '_updated_by' => $this->string(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%gmd_}}');
    }
}














