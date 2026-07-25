<?php

namespace console\migrations;

use yii\db\Migration;
use yii\db\Query;

class M260716115003SeedPcounterDefaults extends Migration
{
    public function safeUp()
    {
        $table = '{{%pcounter_save}}';
        if ($this->db->getTableSchema($table, true) === null) {
            return;
        }

        foreach ([
            'day_time' => 0,
            'counter' => 0,
            'yesterday' => 0,
            'max_count' => 0,
            'max_time' => 0,
        ] as $name => $value) {
            $exists = (new Query())
                ->from($table)
                ->where(['save_name' => $name])
                ->exists($this->db);

            if (!$exists) {
                $this->insert($table, ['save_name' => $name, 'save_value' => $value]);
            }
        }

        $this->createIndex('uq_pcounter_save_name', $table, 'save_name', true);
    }

    public function safeDown()
    {
        $this->dropIndex('uq_pcounter_save_name', '{{%pcounter_save}}');
    }
}