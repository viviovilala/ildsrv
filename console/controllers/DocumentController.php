<?php

namespace console\controllers;

use common\components\DocumentSlug;
use yii\console\Controller;
use yii\db\Query;
use yii\helpers\Console;

class DocumentController extends Controller
{
    /**
     * Backfill empty document.slug values from judul.
     */
    public function actionBackfillSlugs(): int
    {
        $rows = (new Query())
            ->from('{{%document}}')
            ->select(['id', 'judul', 'slug'])
            ->where(['or', ['slug' => null], ['slug' => '']])
            ->orderBy(['id' => SORT_ASC])
            ->all();

        if (empty($rows)) {
            $this->stdout("No documents need slug backfill.\n", Console::FG_GREEN);
            return self::EXIT_CODE_NORMAL;
        }

        $updated = 0;
        foreach ($rows as $row) {
            if (empty($row['judul'])) {
                $this->stdout("Skipping id {$row['id']}: empty judul\n", Console::FG_YELLOW);
                continue;
            }

            $slug = DocumentSlug::fromJudul($row['judul']);
            \Yii::$app->db->createCommand()->update(
                '{{%document}}',
                ['slug' => $slug],
                ['id' => $row['id']]
            )->execute();

            $updated++;
        }

        $this->stdout("Backfilled slug for {$updated} document(s).\n", Console::FG_GREEN);

        return self::EXIT_CODE_NORMAL;
    }
}
