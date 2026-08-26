<?php

namespace console\migrations;

use yii\db\Migration;
use yii\db\Query;

class m260826_124000_seed_requested_document_types extends Migration
{
    public function safeUp()
    {
        $types = [
            'Keputusan Menteri',
            'Keputusan Presiden',
            'Keputusan Rektor',
            'Nota Dinas UPNVJT',
            'Nota Kesepahaman (Memorandum of Understanding)',
            'Peraturan Menteri',
            'Peraturan Presiden',
            'Peraturan Rektor',
            'Peraturan Senat',
            'Surat Edaran Rektor UPNVJT',
            'Undang-undang',
        ];

        foreach ($types as $name) {
            $typeId = (new Query())
                ->select('id')
                ->from('{{%document_type}}')
                ->where(['name' => $name, 'parent_id' => 1])
                ->scalar($this->db);

            if ($typeId === false) {
                $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $name), '-'));
                $this->insert('{{%document_type}}', [
                    'second_id' => $slug,
                    'parent_id' => 1,
                    'name' => $name,
                    'singkatan' => $name,
                    'status' => 'Aktif',
                    'integrasi' => 1,
                    'document_group_label' => 'legislation',
                    'slug' => $slug,
                ]);
                $typeId = (new Query())
                    ->select('id')
                    ->from('{{%document_type}}')
                    ->where(['name' => $name, 'parent_id' => 1])
                    ->scalar($this->db);
            }

            $this->update(
                '{{%document}}',
                ['dokumen_type_id' => $typeId],
                ['jenis_peraturan' => $name, 'tipe_dokumen' => 1]
            );
        }
    }

    public function safeDown()
    {
        echo "Requested document types are intentionally retained to avoid deleting local data.\n";

        return false;
    }
}
