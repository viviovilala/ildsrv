<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121419_create_table_visi_misi extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%visi_misi}}',
            [
                'id' => $this->primaryKey(),
                'visi_misi' => $this->text(),
                'status' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%visi_misi}}');
    }
}














