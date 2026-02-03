<?php

namespace Database\Seeders;

use App\Models\MstKi;
use App\Models\MstSyaratKi;
use Illuminate\Database\Seeder;

class MstKiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        MstSyaratKi::truncate();
        MstKi::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Paten
        $paten = MstKi::create([
            'nama' => 'Paten',
            'deskripsi' => 'Perlindungan untuk invensi dan inovasi teknologi'
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $paten->id,
            'nama' => 'Jenis Paten',
            'tipe' => 'json',
            'value' => json_encode(['Paten Biasa', 'Paten Sederhana']),
            'urutan' => 1
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $paten->id,
            'nama' => 'Bidang Teknologi',
            'tipe' => 'json',
            'value' => json_encode(['Baterai', 'Biologi', 'Kimia', 'Mekanik', 'Elektronik']),
            'urutan' => 2
        ]);

        // 2. Hak Cipta
        $hakCipta = MstKi::create([
            'nama' => 'Hak Cipta',
            'deskripsi' => 'Perlindungan karya cipta seni, sastra, dan ilmu pengetahuan'
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $hakCipta->id,
            'nama' => 'Tempat Hak Cipta',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 1
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $hakCipta->id,
            'nama' => 'Tanggal Hak Cipta',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 2
        ]);

        // 3. PVT (Perlindungan Varietas Tanaman)
        $pvt = MstKi::create([
            'nama' => 'PVT',
            'deskripsi' => 'Perlindungan Varietas Tanaman'
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $pvt->id,
            'nama' => 'Nama Varietas',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 1
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $pvt->id,
            'nama' => 'Jenis Tanaman',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 2
        ]);

        // 4. Merek
        $merek = MstKi::create([
            'nama' => 'Merek',
            'deskripsi' => 'Perlindungan tanda pengenal produk atau jasa'
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $merek->id,
            'nama' => 'Nama Merek',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 1
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $merek->id,
            'nama' => 'Kelas Merek',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 2
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $merek->id,
            'nama' => 'Logo Merek',
            'tipe' => 'file',
            'value' => null,
            'urutan' => 3
        ]);

        // 5. Desain Industri
        $desainIndustri = MstKi::create([
            'nama' => 'Desain Industri',
            'deskripsi' => 'Perlindungan untuk desain tampilan produk'
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $desainIndustri->id,
            'nama' => 'Nama Desain',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 1
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $desainIndustri->id,
            'nama' => 'Gambar Desain',
            'tipe' => 'file',
            'value' => null,
            'urutan' => 2
        ]);

        // 6. Rahasia Dagang
        $rahasiaDagang = MstKi::create([
            'nama' => 'Rahasia Dagang',
            'deskripsi' => 'Perlindungan informasi bisnis yang bersifat rahasia'
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $rahasiaDagang->id,
            'nama' => 'Jenis Informasi',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 1
        ]);

        // 7. Desain Tata Letak Sirkuit Terpadu
        $dtlst = MstKi::create([
            'nama' => 'DTLST',
            'deskripsi' => 'Desain Tata Letak Sirkuit Terpadu'
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $dtlst->id,
            'nama' => 'Nama Sirkuit',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 1
        ]);

        // 8. Indikasi Geografis
        $indikasiGeografis = MstKi::create([
            'nama' => 'Indikasi Geografis',
            'deskripsi' => 'Perlindungan tanda yang menunjukkan asal geografis produk'
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $indikasiGeografis->id,
            'nama' => 'Nama Produk',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 1
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $indikasiGeografis->id,
            'nama' => 'Daerah Asal',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 2
        ]);

        // 9. Hak Terkait
        $hakTerkait = MstKi::create([
            'nama' => 'Hak Terkait',
            'deskripsi' => 'Hak pelaku, produser rekaman, dan lembaga penyiaran'
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $hakTerkait->id,
            'nama' => 'Jenis Hak',
            'tipe' => 'json',
            'value' => json_encode(['Pelaku', 'Produser Rekaman', 'Lembaga Penyiaran']),
            'urutan' => 1
        ]);

        MstSyaratKi::create([
            'mst_ki_id' => $hakTerkait->id,
            'nama' => 'Nama Karya',
            'tipe' => 'text',
            'value' => null,
            'urutan' => 2
        ]);
    }
}
