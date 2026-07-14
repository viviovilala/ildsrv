<?php

namespace console\migrations;

use yii\db\Migration;

class m250514_121345_create_table_pcounter_save extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        if ($this->db->getTableSchema('{{%pcounter_save}}', true) !== null) {
            return;
        }

        $this->createTable(
            '{{%pcounter_save}}',
            [
                'save_name' => $this->string(10)->notNull()->notNull(),
                'save_value' => $this->integer()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%pcounter_save}}');
    }
}





