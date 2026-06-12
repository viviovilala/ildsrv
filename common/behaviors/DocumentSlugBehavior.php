<?php

namespace common\behaviors;

use common\components\DocumentSlug;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class DocumentSlugBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'ensureSlug',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'ensureSlug',
        ];
    }

    public function ensureSlug(): void
    {
        $owner = $this->owner;

        if (!empty($owner->slug) || empty($owner->judul)) {
            return;
        }

        $owner->slug = DocumentSlug::fromJudul($owner->judul);
    }
}
