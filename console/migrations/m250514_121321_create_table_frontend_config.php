<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121321_create_table_frontend_config extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%frontend_config}}',
            [
                'id' => $this->primaryKey(),
                'nama_konfig' => $this->string()->notNull(),
                'isi_konfig' => $this->text(),
                'default' => $this->text(),
                'jenis' => $this->string(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%frontend_config}}');
    }
}














