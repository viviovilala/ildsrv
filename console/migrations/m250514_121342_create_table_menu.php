<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121342_create_table_menu extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%menu}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(128)->notNull(),
                'parent' => $this->integer(),
                'route' => $this->string(),
                'order' => $this->integer(),
                'data' => $this->binary(),
            ],
            $tableOptions
        );

        $this->createIndex('idx_menu_parent','{{%menu}}',['parent']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%menu}}');
    }
}














