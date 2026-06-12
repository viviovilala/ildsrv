<?php

namespace common\components;

use Yii;
use yii\helpers\Inflector;

class DocumentSlug
{
    private const MAX_LENGTH = 80;

    public static function fromJudul(string $judul): string
    {
        $slug = Inflector::slug($judul);
        if ($slug === '') {
            $slug = 'dokumen';
        }

        if (strlen($slug) > self::MAX_LENGTH) {
            $slug = rtrim(substr($slug, 0, self::MAX_LENGTH), '-');
        }

        return $slug;
    }

    /**
     * Resolve slug for URL generation (uses DB slug when present, otherwise derives from judul).
     */
    public static function resolve(int $id, ?string $judul = null): string
    {
        static $cache = [];

        if (isset($cache[$id])) {
            return $cache[$id];
        }

        if ($judul !== null && $judul !== '') {
            return $cache[$id] = self::fromJudul($judul);
        }

        $row = Yii::$app->db->createCommand(
            'SELECT slug, judul FROM {{%document}} WHERE id = :id LIMIT 1',
            [':id' => $id]
        )->queryOne();

        if (!empty($row['slug'])) {
            return $cache[$id] = $row['slug'];
        }

        return $cache[$id] = self::fromJudul($row['judul'] ?? 'dokumen');
    }
}
