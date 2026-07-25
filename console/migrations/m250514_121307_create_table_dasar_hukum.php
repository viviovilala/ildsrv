<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121307_create_table_dasar_hukum extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%dasar_hukum}}',
            [
                'id' => $this->primaryKey(),
                'isi' => $this->text(),
                'dokumen' => $this->text(),
                'status' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%dasar_hukum}}');
    }
}














