<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121338_create_table_makna_logo extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%makna_logo}}',
            [
                'id' => $this->primaryKey(),
                'image' => $this->text(),
                'isi' => $this->text(),
                'status' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%makna_logo}}');
    }
}














