<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121257_create_table_auth_item extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%auth_item}}',
            [
                'name' => $this->string(64)->notNull()->notNull(),
                'type' => $this->smallInteger()->notNull(),
                'description' => $this->text(),
                'rule_name' => $this->string(64),
                'data' => $this->binary(),
                'created_at' => $this->integer(),
                'updated_at' => $this->integer(),
            ],
            $tableOptions
        );

        $this->createIndex('idx_auth_item_type','{{%auth_item}}',['type']);
        $this->createIndex('idx_auth_item_rule_name','{{%auth_item}}',['rule_name']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%auth_item}}');
    }
}














