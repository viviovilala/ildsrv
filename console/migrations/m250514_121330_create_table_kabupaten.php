<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121330_create_table_kabupaten extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%kabupaten}}',
            [
                'id' => $this->char(4)->notNull()->notNull(),
                'province_id' => $this->char(2)->notNull(),
                'name' => $this->string()->notNull(),
                'created_at' => $this->date(),
                'updated_at' => $this->date(),
                'id_kab' => $this->char(2),
            ],
            $tableOptions
        );

        $this->createIndex('idx_kabupaten_province_id','{{%kabupaten}}',['province_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%kabupaten}}');
    }
}














