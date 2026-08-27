from pathlib import Path
import subprocess

out = Path("/mnt/data/frontend-dokumen-view-rapi.php")

php = r'''<?php

use frontend\models\DataLampiran;
use frontend\models\DataStatus;
use frontend\models\DokumenTerkait;
use frontend\models\PeraturanTerkait;
use yii\helpers\Html;
use yii\helpers\Url;


/*
|--------------------------------------------------------------------------
| DATA DOKUMEN
|--------------------------------------------------------------------------
*/

$this->title = $model->judul ?: 'Detail Produk Hukum';

$lampiran = DataLampiran::find()
    ->where(['id_dokumen' => $model->id])
    ->one();

$relatedRules = PeraturanTerkait::find()
    ->where(['id_dokumen' => $model->id])
    ->limit(3)
    ->all();

$relatedDocs = DokumenTerkait::find()
    ->where(['id_dokumen' => $model->id])
    ->limit(3)
    ->all();

$statusHistory = DataStatus::find()
    ->where(['id_dokumen' => $model->id])
    ->limit(3)
    ->all();


/*
|--------------------------------------------------------------------------
| FILE DOKUMEN
|--------------------------------------------------------------------------
*/

$documentUrl = null;
$documentFileUrl = null;

if ($lampiran && $lampiran->dokumen_lampiran) {

    $documentUrl = Url::to([
        '/dokumen/download',
        'id' => $lampiran->dokumen_lampiran,
        'docId' => $model->id,
    ]);

    $documentFileUrl = Url::to(
        '@web/uploads/dokumen/' .
        rawurlencode($lampiran->dokumen_lampiran)
    );
}


/*
|--------------------------------------------------------------------------
| STATUS
|--------------------------------------------------------------------------
*/

$status = $model->status ?: 'Masih Berlaku';


/*
|--------------------------------------------------------------------------
| CSS HALAMAN DETAIL
|--------------------------------------------------------------------------
|
| Seluruh CSS dibuat scoped ke .document-detail-page supaya tidak
| mengganggu halaman lain.
|
*/

$this->registerCss(<<<'CSS'

/* =========================================================
   DOCUMENT DETAIL PAGE
   ========================================================= */

.document-detail-page {
    width: 100%;
    padding: 34px 24px 72px;
    background: #f7f7f3;
    color: #1f2a1f;
}

.document-detail-page *,
.document-detail-page *::before,
.document-detail-page *::after {
    box-sizing: border-box;
}

.document-detail-shell {
    width: min(100%, 1280px);
    margin: 0 auto;
}


/* =========================================================
   HERO / HEADER
   ========================================================= */

.document-detail-hero {
    display: grid;
    grid-template-columns: minmax(0, 1fr) auto;
    gap: 32px;
    align-items: end;

    width: 100%;
    margin: 0 0 28px;
    padding: 34px 38px;

    background: #ffffff;
    border: 1px solid #e1e2da;
    border-radius: 18px;

    box-shadow:
        0 8px 26px rgba(31, 42, 31, 0.055);
}

.document-detail-hero > div:first-child {
    min-width: 0;
}

.document-detail-hero p {
    margin: 0 0 16px;
    color: #70766f;
    font-size: 13px;
    line-height: 1.6;
}

.document-detail-hero p a {
    color: #4d6250;
    text-decoration: none;
}

.document-detail-hero p a:hover,
.document-detail-hero p a:focus-visible {
    color: #1f5b27;
    text-decoration: underline;
}

.document-detail-hero h1 {
    max-width: 920px;
    margin: 0 0 16px;

    color: #214b20;
    font-family: Georgia, "Times New Roman", serif;
    font-size: clamp(32px, 4vw, 48px);
    font-weight: 800;
    line-height: 1.12;
    letter-spacing: -0.018em;

    overflow-wrap: anywhere;
    word-break: normal;
}

.catalog-doc-card__meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 9px;

    color: #69706a;
    font-size: 14px;
    line-height: 1.5;
}

.catalog-doc-card__meta > span {
    display: inline-flex;
    align-items: center;

    min-height: 30px;
    padding: 4px 10px;

    border-radius: 999px;
}

.catalog-doc-card__status {
    background: #e8f5e8;
    color: #2d7a39;
    font-weight: 700;
}


/* =========================================================
   ACTIONS
   ========================================================= */

.document-actions-card {
    display: flex;
    flex-direction: column;
    gap: 9px;

    width: 238px;
    flex: 0 0 238px;
}

.document-actions-card a {
    width: 100%;
    min-height: 44px;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 10px 16px;

    border-radius: 10px;

    font-size: 13px;
    font-weight: 700;
    line-height: 1.25;

    text-decoration: none;

    transition:
        background-color .18s ease,
        border-color .18s ease,
        color .18s ease,
        transform .18s ease;
}

.document-actions-card a:hover,
.document-actions-card a:focus-visible {
    transform: translateY(-1px);
    text-decoration: none;
}

.document-primary-action {
    background: #214b20;
    border: 1px solid #214b20;
    color: #ffffff;
}

.document-primary-action:hover,
.document-primary-action:focus-visible {
    background: #173b17;
    border-color: #173b17;
    color: #ffffff;
}

.document-secondary-action {
    background: #ffffff;
    border: 1px solid #d9ddd5;
    color: #244524;
}

.document-secondary-action:hover,
.document-secondary-action:focus-visible {
    background: #f2f5ef;
    border-color: #b9c7b8;
    color: #214b20;
}

.document-ai-action {
    background: #f5cf57;
    border: 1px solid #f5cf57;
    color: #214b20;
}

.document-ai-action:hover,
.document-ai-action:focus-visible {
    background: #efc43a;
    border-color: #efc43a;
    color: #183918;
}


/* =========================================================
   MAIN GRID
   ========================================================= */

.document-detail-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 340px;
    gap: 28px;
    align-items: start;
}


/* =========================================================
   PDF VIEWER
   ========================================================= */

.document-viewer {
    min-width: 0;
    overflow: hidden;

    background: #ffffff;
    border: 1px solid #e0e2da;
    border-radius: 18px;

    box-shadow:
        0 8px 26px rgba(31, 42, 31, 0.055);
}

.document-viewer__toolbar {
    min-height: 58px;

    display: flex;
    align-items: center;
    gap: 8px;

    padding: 10px 14px;

    background: #fbfcf9;
    border-bottom: 1px solid #e3e5df;
}

.document-viewer__toolbar button {
    width: 38px;
    height: 38px;
    flex: 0 0 38px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    border: 1px solid transparent;
    border-radius: 9px;

    background: transparent;
    color: #263a27;

    font-size: 17px;
    cursor: pointer;

    transition:
        background-color .18s ease,
        border-color .18s ease;
}

.document-viewer__toolbar button:hover,
.document-viewer__toolbar button:focus-visible {
    background: #eef2eb;
    border-color: #d8dfd4;
}

.document-viewer__toolbar span {
    margin: 0 auto 0 4px;

    color: #28342a;
    font-size: 14px;
    font-weight: 700;
    white-space: nowrap;
}

.document-page-preview {
    width: 100%;
    min-height: 760px;

    display: flex;
    align-items: stretch;
    justify-content: center;

    overflow: hidden;
    background: #dfe2dc;
}

.document-page-preview iframe {
    display: block;

    width: 100%;
    height: 820px;

    border: 0;
    background: #ffffff;
}

.document-page-preview > p {
    margin: auto;
    padding: 40px;

    color: #687168;
    font-size: 15px;
    text-align: center;
}


/* =========================================================
   SIDEBAR
   ========================================================= */

.document-side {
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 18px;
}

.document-info-card,
.document-related-card,
.document-history-card {
    background: #ffffff;
    border: 1px solid #e0e2da;
    border-radius: 18px;
    padding: 25px 26px;

    box-shadow:
        0 8px 26px rgba(31, 42, 31, 0.045);
}

.document-info-card h2,
.document-related-card h2,
.document-history-card h2 {
    margin: 0 0 20px;

    color: #214b20;

    font-family: Georgia, "Times New Roman", serif;
    font-size: 25px;
    font-weight: 800;
    line-height: 1.2;
}

.document-info-card h2 i {
    margin-right: 7px;
    font-size: 22px;
}

.document-info-card dl {
    margin: 0;
    padding: 0;
}

.document-info-card dl > div {
    display: grid;
    grid-template-columns: minmax(0, 1fr) auto;
    gap: 18px;

    padding: 14px 0;

    border-bottom: 1px solid #e4e6df;
}

.document-info-card dl > div:first-child {
    padding-top: 0;
}

.document-info-card dl > div:last-child {
    padding-bottom: 0;
    border-bottom: 0;
}

.document-info-card dt {
    min-width: 0;

    color: #70776f;
    font-size: 13px;
    font-weight: 600;
    line-height: 1.5;
}

.document-info-card dd {
    max-width: 190px;

    margin: 0;

    color: #273127;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.5;

    text-align: right;
    overflow-wrap: anywhere;
}

.document-info-card dd a {
    color: #214b20;
    text-decoration: none;
}

.document-info-card dd a:hover,
.document-info-card dd a:focus-visible {
    text-decoration: underline;
}


/* =========================================================
   RELATED DOCUMENTS
   ========================================================= */

.document-related-card p {
    margin: 0;
    padding: 12px 0;

    border-bottom: 1px solid #e4e6df;

    color: #667066;
    font-size: 13px;
    line-height: 1.55;
}

.document-related-card p:first-of-type {
    padding-top: 0;
}

.document-related-card p:last-of-type {
    padding-bottom: 0;
    border-bottom: 0;
}

.document-related-card p a {
    color: #284c2a;
    text-decoration: none;
    font-weight: 600;
}

.document-related-card p a:hover,
.document-related-card p a:focus-visible {
    color: #173a18;
    text-decoration: underline;
}


/* =========================================================
   HISTORY
   ========================================================= */

.document-history-card ol {
    margin: 0;
    padding: 0;

    list-style: none;
}

.document-history-card li {
    display: grid;
    grid-template-columns: 92px minmax(0, 1fr);
    gap: 14px;

    padding: 12px 0;

    border-bottom: 1px solid #e4e6df;
}

.document-history-card li:first-child {
    padding-top: 0;
}

.document-history-card li:last-child {
    padding-bottom: 0;
    border-bottom: 0;
}

.document-history-card li strong {
    color: #214b20;
    font-size: 12px;
    line-height: 1.5;
}

.document-history-card li span {
    color: #697169;
    font-size: 13px;
    line-height: 1.55;
}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 1100px) {

    .document-detail-page {
        padding-left: 18px;
        padding-right: 18px;
    }

    .document-detail-hero {
        grid-template-columns: minmax(0, 1fr);
        align-items: start;
        gap: 22px;
    }

    .document-actions-card {
        width: 100%;
        max-width: 720px;
        flex-basis: auto;

        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .document-detail-grid {
        grid-template-columns: minmax(0, 1fr) 310px;
        gap: 22px;
    }
}


@media (max-width: 900px) {

    .document-detail-page {
        padding-top: 24px;
        padding-bottom: 50px;
    }

    .document-detail-hero {
        padding: 28px;
        border-radius: 15px;
    }

    .document-detail-hero h1 {
        font-size: 36px;
    }

    .document-detail-grid {
        grid-template-columns: 1fr;
    }

    .document-side {
        order: 2;
    }

    .document-viewer {
        order: 1;
    }

    .document-page-preview {
        min-height: 620px;
    }

    .document-page-preview iframe {
        height: 700px;
    }
}


@media (max-width: 640px) {

    .document-detail-page {
        padding: 16px 12px 38px;
    }

    .document-detail-hero {
        gap: 20px;
        padding: 22px 20px;
        border-radius: 13px;
    }

    .document-detail-hero p {
        margin-bottom: 12px;
        font-size: 12px;
    }

    .document-detail-hero h1 {
        margin-bottom: 14px;
        font-size: 29px;
        line-height: 1.18;
    }

    .catalog-doc-card__meta {
        gap: 6px;
        font-size: 12px;
    }

    .catalog-doc-card__meta > span {
        min-height: 28px;
        padding: 4px 9px;
    }

    .document-actions-card {
        grid-template-columns: 1fr;
    }

    .document-viewer,
    .document-info-card,
    .document-related-card,
    .document-history-card {
        border-radius: 13px;
    }

    .document-viewer__toolbar {
        padding: 9px;
    }

    .document-viewer__toolbar button {
        width: 36px;
        height: 36px;
        flex-basis: 36px;
    }

    .document-viewer__toolbar span {
        font-size: 12px;
    }

    .document-page-preview {
        min-height: 520px;
    }

    .document-page-preview iframe {
        height: 600px;
    }

    .document-info-card,
    .document-related-card,
    .document-history-card {
        padding: 20px;
    }

    .document-info-card h2,
    .document-related-card h2,
    .document-history-card h2 {
        font-size: 22px;
    }

    .document-info-card dl > div {
        grid-template-columns: 1fr;
        gap: 5px;
    }

    .document-info-card dd {
        max-width: none;
        text-align: left;
    }

    .document-history-card li {
        grid-template-columns: 1fr;
        gap: 4px;
    }
}


/* =========================================================
   SAFETY AGAINST GLOBAL OVERRIDES
   ========================================================= */

.document-detail-page h1,
.document-detail-page h2,
.document-detail-page h3,
.document-detail-page p {
    max-width: none;
}

.document-detail-page a {
    text-decoration: none;
}

.document-detail-page img,
.document-detail-page iframe {
    max-width: 100%;
}

CSS
);
?>


<section class="document-detail-page">

    <div class="container document-detail-shell">

        <!-- =================================================
             HEADER / HERO
             ================================================= -->

        <main class="document-detail-main">

            <div class="document-detail-hero">

                <div>

                    <p>
                        <?= Html::a(
                            'Beranda',
                            ['/site/index']
                        ) ?>

                        &nbsp;&gt;&nbsp;

                        <?= Html::a(
                            'Peraturan',
                            ['/dokumen/peraturan']
                        ) ?>

                        &nbsp;&gt;&nbsp;

                        <span>
                            <?= Html::encode(
                                $model->singkatan_jenis
                                ?: 'Produk Hukum'
                            ) ?>
                        </span>
                    </p>


                    <h1>
                        <?= Html::encode(
                            $model->judul
                        ) ?>
                    </h1>


                    <div class="catalog-doc-card__meta">

                        <span class="catalog-doc-card__status">
                            <?= Html::encode($status) ?>
                        </span>

                        <span>
                            <?= Html::encode(
                                $model->bentuk_peraturan
                                ?: 'Rektorat'
                            ) ?>
                        </span>

                        <span>
                            <?= Html::encode(
                                $model->bidang_hukum
                                ?: 'Saintek'
                            ) ?>
                        </span>

                    </div>

                </div>


                <!-- ACTIONS -->

                <div class="document-actions-card">

                    <?php if ($documentUrl): ?>

                        <?= Html::a(
                            '<i class="bi bi-download" aria-hidden="true"></i> Unduh Salinan Resmi',
                            $documentUrl,
                            [
                                'class' =>
                                    'document-primary-action',
                            ]
                        ) ?>

                    <?php endif; ?>


                    <?= Html::a(
                        '<i class="bi bi-share" aria-hidden="true"></i> Bagikan Dokumen',
                        '#',
                        [
                            'class' =>
                                'document-secondary-action',
                        ]
                    ) ?>


                    <?= Html::a(
                        '<i class="bi bi-magic" aria-hidden="true"></i> Lihat Ringkasan AI',
                        '#',
                        [
                            'class' =>
                                'document-ai-action',
                        ]
                    ) ?>

                </div>

            </div>


            <!-- =================================================
                 VIEWER + SIDEBAR
                 ================================================= -->

            <div class="document-detail-grid">


                <!-- =================================================
                     PDF VIEWER
                     ================================================= -->

                <section
                    class="document-viewer"
                    aria-label="Viewer dokumen PDF"
                >

                    <div class="document-viewer__toolbar">

                        <button
                            type="button"
                            aria-label="Perbesar"
                            title="Perbesar"
                        >
                            <i
                                class="bi bi-zoom-in"
                                aria-hidden="true"
                            ></i>
                        </button>

                        <button
                            type="button"
                            aria-label="Perkecil"
                            title="Perkecil"
                        >
                            <i
                                class="bi bi-zoom-out"
                                aria-hidden="true"
                            ></i>
                        </button>

                        <span>
                            Halaman 1 dari 42
                        </span>

                        <button
                            type="button"
                            aria-label="Cetak"
                            title="Cetak"
                        >
                            <i
                                class="bi bi-printer"
                                aria-hidden="true"
                            ></i>
                        </button>

                        <button
                            type="button"
                            aria-label="Layar penuh"
                            title="Layar penuh"
                        >
                            <i
                                class="bi bi-fullscreen"
                                aria-hidden="true"
                            ></i>
                        </button>

                    </div>


                    <div class="document-page-preview">

                        <?php if ($documentFileUrl): ?>

                            <iframe
                                src="<?= Html::encode(
                                    $documentFileUrl .
                                    '#toolbar=1&navpanes=0'
                                ) ?>"
                                title="PDF <?= Html::encode(
                                    $model->judul
                                ) ?>"
                                loading="lazy"
                            ></iframe>

                        <?php else: ?>

                            <p>
                                PDF dokumen belum tersedia.
                            </p>

                        <?php endif; ?>

                    </div>

                </section>


                <!-- =================================================
                     SIDEBAR
                     ================================================= -->

                <aside class="document-side">


                    <!-- =================================================
                         INFORMASI DETAIL
                         ================================================= -->

                    <section class="document-info-card">

                        <h2>
                            <i
                                class="bi bi-info-circle"
                                aria-hidden="true"
                            ></i>
                            Informasi Detail
                        </h2>


                        <dl>

                            <div>

                                <dt>
                                    Nomor Dokumen
                                </dt>

                                <dd>
                                    <?= Html::encode(
                                        $model->nomor_peraturan
                                        ?: '-'
                                    ) ?>
                                </dd>

                            </div>


                            <div>

                                <dt>
                                    Tahun
                                </dt>

                                <dd>
                                    <?= Html::encode(
                                        $model->tahun_terbit
                                        ?: '-'
                                    ) ?>
                                </dd>

                            </div>


                            <div>

                                <dt>
                                    Tgl Pengesahan
                                </dt>

                                <dd>
                                    <?= Html::encode(
                                        $model->tanggal_penetapan
                                            ? $model->getTanggal(
                                                $model->tanggal_penetapan
                                            )
                                            : '-'
                                    ) ?>
                                </dd>

                            </div>


                            <div>

                                <dt>
                                    Status
                                </dt>

                                <dd>
                                    <?= Html::encode($status) ?>
                                </dd>

                            </div>


                            <div>

                                <dt>
                                    Abstraksi
                                </dt>

                                <dd>

                                    <?php if ($model->abstrak): ?>

                                        <?= Html::a(
                                            'Lihat Ringkasan',
                                            [
                                                '/dokumen/download',
                                                'id' => $model->abstrak,
                                            ]
                                        ) ?>

                                    <?php else: ?>

                                        <?= Html::a(
                                            'Lihat Ringkasan AI',
                                            '#'
                                        ) ?>

                                    <?php endif; ?>

                                </dd>

                            </div>

                        </dl>

                    </section>


                    <!-- =================================================
                         RELATED
                         ================================================= -->

                    <section class="document-related-card">

                        <h2>
                            Produk Hukum Terkait
                        </h2>


                        <?php foreach ($relatedRules as $related): ?>

                            <p>
                                <?= Html::a(
                                    Html::encode(
                                        $related->getJudul(
                                            $related->peraturan_terkait
                                        )
                                    ),
                                    [
                                        '/dokumen/view',
                                        'id' =>
                                            $related->peraturan_terkait,
                                    ]
                                ) ?>
                            </p>

                        <?php endforeach; ?>


                        <?php foreach ($relatedDocs as $relatedDoc): ?>

                            <p>
                                <?= Html::encode(
                                    $relatedDoc->document_terkait
                                ) ?>
                            </p>

                        <?php endforeach; ?>


                        <?php if (
                            !$relatedRules &&
                            !$relatedDocs
                        ): ?>

                            <p>
                                Belum ada produk hukum terkait.
                            </p>

                        <?php endif; ?>

                    </section>


                    <!-- =================================================
                         HISTORY
                         ================================================= -->

                    <section class="document-history-card">

                        <h2>
                            Riwayat Perubahan
                        </h2>


                        <ol>

                            <?php if ($statusHistory): ?>

                                <?php foreach (
                                    $statusHistory
                                    as $history
                                ): ?>

                                    <li>

                                        <strong>
                                            <?= Html::encode(
                                                $model->tahun_terbit
                                                ?: date('Y')
                                            ) ?>
                                        </strong>

                                        <span>
                                            <?= Html::encode(
                                                $history->status_peraturan
                                                ?: 'Pembaruan status dokumen'
                                            ) ?>
                                        </span>

                                    </li>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <li>

                                    <strong>
                                        <?= Html::encode(
                                            $model->tahun_terbit
                                            ?: date('Y')
                                        ) ?>
                                        - Terbaru
                                    </strong>

                                    <span>
                                        Pengesahan dokumen
                                    </span>

                                </li>

                            <?php endif; ?>

                        </ol>

                    </section>

                </aside>

            </div>

        </main>

    </div>

</section>
'''

out.write_text(php, encoding="utf-8")

result = subprocess.run(
    ["php", "-l", str(out)],
    capture_output=True,
    text=True
)

print(result.stdout.strip() or result.stderr.strip())
print(f"File dibuat: {out}")
