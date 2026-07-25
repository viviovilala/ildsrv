<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121353_create_table_provinsi extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%provinsi}}',
            [
                'id' => $this->char(2)->notNull()->notNull(),
                'name' => $this->string()->notNull(),
                'created_at' => $this->date(),
                'updated_at' => $this->date(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%provinsi}}');
    }
}














