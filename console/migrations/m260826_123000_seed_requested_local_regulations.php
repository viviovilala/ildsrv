<?php

namespace console\migrations;

use yii\db\Migration;
use yii\db\Query;

/**
 * Adds the locally requested regulations without changing or removing existing documents.
 */
class m260826_123000_seed_requested_local_regulations extends Migration
{
    public function safeUp()
    {
        $documents = [
            ['Keputusan Menteri', 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi', 'Organisasi UPN', 'PEMBERHENTIAN REKTOR UPN "VETERAN" JAWA TIMUR PERIODE 2018-2022 DAN PENGANGKATAN REKTOR UPN "VETERAN" JAWA TIMUR PERIODE 2022-2026', '6521', '2022', 'LUAR UPN', '2022-10-19'],
            ['Keputusan Presiden', 'Universitas Pembangunan Nasional "Veteran" Jawa Timur', 'Wisuda', 'Salinan Kep. Rektor No. 741-UN63-BAKK-2025 tentang Wisudawan Perwakilan Program Studi Wisuda Sarjana Ke-96, Magister Ke-58 dan Doktor Ke-4 Periode I UPN Veteran Jawa Timur T.A. 2025-2026.', '741', '2025', 'UPN JATIM', '2025-10-01'],
            ['Keputusan Rektor', 'Universitas Pembangunan Nasional "Veteran" Jawa Timur', 'BMN', 'Salinan Kep. Rektor No. 48-UN63-BMN-2026 tentang Penggunaan Aplikasi Sistem Informasi Manajemen Aset Negara Tingkat Instansi Pada UPN Veteran Jawa Timur.', '48', '2025', 'UPN JATIM', '2026-01-13'],
            ['Nota Dinas UPNVJT', 'Rektor UPN "Veteran" Jawa Timur', 'Kegiatan Umum', 'Halal Bi Halal 2024', '4', '2024', 'UPN JATIM', '2024-04-01'],
            ['Nota Kesepahaman (Memorandum of Understanding)', 'Universitas Pembangunan Nasional "Veteran" Jawa Timur', 'Kerja Sama', 'Kerjasama RS UNAIR dengan UPNVJT', '1', '2023', 'UPN JATIM', '2023-06-22'],
            ['Peraturan Menteri', 'Kementerian Pendidikan dan Kebudayaan', 'Standar', 'PERATURAN MENTERI PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI REPUBLIK INDONESIA NOMOR 53 TAHUN 2023 TENTANG PENJAMINAN MUTU PENDIDIKAN TINGGI', '53', '2023', 'LUAR UPN', '2023-08-18'],
            ['Peraturan Presiden', 'Universitas Pembangunan Nasional "Veteran" Jawa Timur', 'Universitas', 'tentang Pengelolaan Kampus Ramah Lingkungan (Green Campus) UPN Veteran Jawa Timur Yang Berkelanjutan.', '14', '2024', 'UPN JATIM', '2024-08-15'],
            ['Peraturan Rektor', 'Universitas Pembangunan Nasional "Veteran" Jawa Timur', 'Kearsipan', 'Salinan Peraturan Rektor Nomor 13 Tahun 2026 tentang Perubahan Atas Pertor Nomor 01 Tahun 2026 tentang Tata Naskah Dinas di Lingkungan UPN Veteran Jawa Timur.', '13', '2025', 'UPN JATIM', '2026-02-27'],
            ['Peraturan Senat', 'Senat Universitas - Universitas Pembangunan Nasional "Veteran" Jawa Timur', 'Organisasi UPN', 'TATA CARA PEMILIHAN REKTOR UNIVERSITAS PEMBANGUNAN NASIONAL "VETERAN" JAWA TIMUR', '2', '2018', 'UPN JATIM', '2018-05-21'],
            ['Surat Edaran Rektor UPNVJT', 'Rektor UPN "Veteran" Jawa Timur', 'Operasionalisasi', 'Libur Nasional dan Cuti Bersama Hari Raya Idul Fitri 1445 Hijriyah/tahun 2024 Bagi Seluruh Dosen dan Tendik di Lingkungan UPNVJT', '6', '2024', 'UPN JATIM', '2024-03-27'],
            ['Undang-undang', 'Presiden Republik Indonesia', 'Pendidikan Tinggi', 'Pendidikan Tinggi', '12', '2012', 'LUAR UPN', '2012-08-10'],
        ];

        foreach ($documents as [$type, $publisher, $topic, $title, $number, $year, $source, $date]) {
            $exists = (new Query())
                ->from('{{%document}}')
                ->where(['nomor_peraturan' => $number, 'judul' => $title])
                ->exists($this->db);

            if (!$exists) {
                $this->insert('{{%document}}', [
                    'judul' => $title,
                    'nomor_peraturan' => $number,
                    'bentuk_peraturan' => $type,
                    'jenis_peraturan' => $type,
                    'penerbit' => $publisher,
                    'bidang_hukum' => $topic,
                    'tahun_terbit' => $year,
                    'tanggal_penetapan' => $date,
                    'tanggal_pengundangan' => $date,
                    'sumber' => $source,
                    'sumber_perolehan' => $source,
                    'status' => 'Berlaku',
                    'is_publish' => 0,
                ]);
            }
        }
    }

    public function safeDown()
    {
        echo "Seed documents are intentionally retained to avoid deleting local data.\n";

        return false;
    }
}
