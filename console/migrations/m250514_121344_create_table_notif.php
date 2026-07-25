<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121344_create_table_notif extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%notif}}',
            [
                'id_notifikasi' => $this->primaryKey(),
                'judul' => $this->string(),
                'keterangan' => $this->string(),
                'waktu' => $this->time(),
                'id_terkait' => $this->string(),
                'url' => $this->string(),
                'status' => $this->integer()->defaultValue(0),
                'notif_to' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%notif}}');
    }
}














