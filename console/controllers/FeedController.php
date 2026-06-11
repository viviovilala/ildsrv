<?php

namespace console\controllers;

use backend\models\DataLampiran;
use backend\models\DokumenJdih;
use yii\console\Controller;
use yii\db\ActiveQuery;
use yii\helpers\FileHelper;

class FeedController extends Controller
{
    public function actionGenerateDocument()
    {
        $filePath = \Yii::getAlias('@feed/document.json');
        $tempPath = $filePath . '.tmp.' . getmypid();

        try {
            $dokumen = $this->fetchDocuments($this->buildBaseQuery());

            if (empty($dokumen)) {
                echo "[feed] Peringatan: Tidak ada dokumen yang dipublikasikan. File tidak diperbarui.\n";
                return self::EXIT_CODE_ERROR;
            }

            $dokumen = $this->enrichRows($dokumen);

            $bytes = $this->writeJsonFile($filePath, $dokumen);

            echo "[feed] Berhasil: {$filePath} (" . count($dokumen) . " dokumen, {$bytes} bytes)\n";
            return self::EXIT_CODE_NORMAL;

        } catch (\Exception $e) {
            \Yii::error("[feed] Gagal generate document.json: " . $e->getMessage(), 'feed');
            echo "[feed] ERROR: " . $e->getMessage() . "\n";

            if (file_exists($tempPath)) {
                @unlink($tempPath);
            }
            return self::EXIT_CODE_ERROR;
        }
    }

    /**
     * @return string[]
     */
    private function getDocumentSelectColumns(): array
    {
        return [
            'd.id AS idData',
            'd.tahun_terbit AS tahun_pengundangan',
            'd.tanggal_penetapan',
            'd.tanggal_pengundangan',
            'd.jenis_peraturan AS jenis',
            'd.nomor_peraturan AS noPeraturan',
            'd.judul',
            'd.nomor_panggil AS noPanggil',
            'd.singkatan_jenis AS singkatanJenis',
            'd.tempat_terbit AS tempatTerbit',
            'd.penerbit',
            'd.deskripsi_fisik AS deskripsiFisik',
            'd.sumber',
            'd.isbn',
            'd.status',
            'd.bahasa',
            'd.bidang_hukum AS bidangHukum',
            'd.teu AS teuBadan',
            'd.nomor_induk_buku AS nomorIndukBuku',
            'd.abstrak',
            'd.updated_at AS last_updated',
        ];
    }

    private function buildBaseQuery(): ActiveQuery
    {
        return DokumenJdih::find()
            ->alias('d')
            ->select($this->getDocumentSelectColumns())
            ->where(['d.is_publish' => 1]);
    }

    private function fetchDocuments(ActiveQuery $query): array
    {
        return $query->asArray()->all();
    }

    private function enrichRows(array $dokumen): array
    {
        $baseUrl = \Yii::getAlias('@imageurl');

        $lampiranMap = [];
        $allLampiran = DataLampiran::find()
            ->select(['id_dokumen', 'dokumen_lampiran', 'url_lampiran'])
            ->where(['id_dokumen' => array_column($dokumen, 'idData')])
            ->orderBy(['urutan' => SORT_ASC, 'id' => SORT_ASC])
            ->asArray()
            ->all();

        foreach ($allLampiran as $lampiran) {
            $docId = $lampiran['id_dokumen'];
            if (!isset($lampiranMap[$docId]) && !empty($lampiran['dokumen_lampiran'])) {
                $lampiranMap[$docId] = $lampiran;
            }
        }

        foreach ($dokumen as &$row) {
            if (!empty($row['abstrak'])) {
                $row['urlAbstrak'] = rtrim($baseUrl, '/') . '/common/dokumen/' . $row['abstrak'];
            } else {
                $row['abstrak'] = '';
                $row['urlAbstrak'] = '';
            }

            $row['urlDetailPeraturan'] = \Yii::$app->urlManager->createAbsoluteUrl([
                'dokumen/view', 'id' => $row['idData']
            ]);

            $docId = $row['idData'];
            if (isset($lampiranMap[$docId])) {
                $row['fileDownload'] = $lampiranMap[$docId]['dokumen_lampiran'];
                if (!empty($lampiranMap[$docId]['url_lampiran'])) {
                    $row['urlDownload'] = $lampiranMap[$docId]['url_lampiran'];
                } else {
                    $row['urlDownload'] = rtrim($baseUrl, '/') . '/common/dokumen/' . $lampiranMap[$docId]['dokumen_lampiran'];
                }
            } else {
                $row['fileDownload'] = '-';
                $row['urlDownload'] = '-';
            }

            $row['subjek'] = '';
            $row['operasi'] = '4';
            $row['display'] = '1';
        }

        return $dokumen;
    }

    private function writeJsonFile(string $filePath, array $dokumen): int
    {
        $tempPath = $filePath . '.tmp.' . getmypid();

        FileHelper::createDirectory(dirname($filePath));

        $json = json_encode($dokumen, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            throw new \RuntimeException('Gagal encode JSON: ' . json_last_error_msg());
        }

        $bytes = file_put_contents($tempPath, $json);
        if ($bytes === false) {
            throw new \RuntimeException("Gagal menulis file temporer: {$tempPath}");
        }

        if (!rename($tempPath, $filePath)) {
            throw new \RuntimeException("Gagal rename {$tempPath} ke {$filePath}");
        }

        return $bytes;
    }
}
