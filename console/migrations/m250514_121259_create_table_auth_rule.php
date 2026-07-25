<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121259_create_table_auth_rule extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = '  ';
        }

        $this->createTable(
            '{{%auth_rule}}',
            [
                'name' => $this->string(64)->notNull()->notNull(),
                'data' => $this->binary(),
                'created_at' => $this->integer(),
                'updated_at' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%auth_rule}}');
    }
}














