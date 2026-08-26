<?php

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\BeritaSearch */
?>

<aside class="berita-sidebar">

    <div class="berita-sidebar__panel">

        <h2 class="berita-sidebar__title">
            <i
                class="bi bi-search"
                aria-hidden="true"
            ></i>
            Cari berita
        </h2>

        <div class="berita-sidebar__search">

            <?= $this->render(
                '_search',
                [
                    'model' => $searchModel,
                ]
            ) ?>

        </div>

    </div>

</aside>