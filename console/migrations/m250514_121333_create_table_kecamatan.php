<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121333_create_table_kecamatan extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%kecamatan}}',
            [
                'id' => $this->char(7)->notNull()->notNull(),
                'regency_id' => $this->char(4)->notNull(),
                'name' => $this->string()->notNull(),
                'created_at' => $this->date(),
                'updated_at' => $this->date(),
                'id_kec' => $this->char(3),
            ],
            $tableOptions
        );

        $this->createIndex('idx_kecamatan_regency_id','{{%kecamatan}}',['regency_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%kecamatan}}');
    }
}














