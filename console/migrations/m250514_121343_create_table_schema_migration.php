<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121343_create_table_schema_migration extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%schema_migration}}',
            [
                'id' => $this->primaryKey(),
                'migration' => $this->string()->notNull(),
                'batch' => $this->integer()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%schema_migration}}');
    }
}














