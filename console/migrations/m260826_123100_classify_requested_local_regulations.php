<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Classifies only the requested local seed documents as regulations.
 */
class m260826_123100_classify_requested_local_regulations extends Migration
{
    public function safeUp()
    {
        $this->update('{{%document}}', ['tipe_dokumen' => 1], [
            'nomor_peraturan' => ['6521', '741', '48', '4', '1', '53', '14', '13', '2', '6', '12'],
        ]);
    }

    public function safeDown()
    {
        echo "Document classifications are intentionally retained to avoid changing local data.\n";

        return false;
    }
}
