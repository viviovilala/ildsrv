<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121350_create_table_peraturan_terkait extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%peraturan_terkait}}',
            [
                'id' => $this->primaryKey(),
                'id_dokumen' => $this->integer(),
                'peraturan_terkait' => $this->string(),
                'status_perter' => $this->string(),
                'catatan_perter' => $this->string(),
                'integrasi' => $this->integer(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'urutan' => $this->integer(),
                '_created_by' => $this->string(),
                '_updated_by' => $this->string(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%peraturan_terkait}}');
    }
}














