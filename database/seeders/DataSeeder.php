<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use App\Models\JenjangPendidikan;
use App\Models\KategoriKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (env('APP_ENV') === 'local' || env('APP_ENV') === 'testing') {
            // truncate table
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('users')->truncate();
            DB::table('jenjang_pendidikan')->truncate();
            DB::table('program_studi')->truncate();
            DB::table('mahasiswa')->truncate();
            DB::table('kategori_pengaturan')->truncate();
            DB::table('pengaturan')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        try {
            DB::beginTransaction();


            // data admin
            $admins = [
                [
                    'uid' => 'admin',
                    'email' => 'admin@mail.com',
                    'password' => Hash::make('admin'),
                    'role' => 'admin',
                ]
            ];

            foreach ($admins as $admin) {
                User::firstOrCreate([
                    'email' => $admin['email'],
                    'role' => 'admin'
                ], $admin);
            }

            // data kategori kegiatan
            $kategoriKegiatan = [
                [
                    'nama' => 'Organisasi'
                ],
                [
                    'nama' => 'Akademik'
                ],
                [
                    'nama' => 'Non Akademik'
                ],
                [
                    'nama' => 'Sertifikasi'
                ],

            ];

            foreach ($kategoriKegiatan as $kk) {
                KategoriKegiatan::firstOrCreate([
                    'nama' => $kk['nama'],
                ], $kk);
            }

            // data jenjang pendidikan
            $jenjangPendidikan = [
                [
                    'nama' => 'Sarjana',
                    'nama_en' => 'Bachelor Degree',
                    'singkatan' => 'S1',
                    'kualifikasi_kkni' => 'level 6',
                    'syarat_masuk' => 'Lulusan SMA/SMK/MA/MAK atau sederajat',
                    'syarat_masuk_en' => 'Graduated Senior High School / equivalent',
                    'lama_studi_reguler' => '8',
                    'jenjang_lanjutan' => 'Pasca Sarjana',
                    'jenjang_lanjutan_en' => 'Postgraduate',
                    'program_studi' => [
                        [
                            'nama' => ' Teknik Informatika',
                            'nama_en' => 'Informatics Engineering',
                            'singkatan' => 'TI',
                            'akreditasi' => 'B',
                            'bhs_pengantar_kuliah' => 'Indonesia',
                            'bhs_pengantar_kuliah_en' => 'Indonesian',
                            'sistem_penilaian' => 'Skala 1-4',
                            'sistem_penilaian_en' => 'Scale 1-4',
                            'gelar' => 'Sarjana Komputer (S.Kom)',
                            'gelar_en' => 'Bachelor of Computer',
                        ],
                        [
                            'nama' => 'Teknik Sipil',
                            'nama_en' => 'Civil Engineering',
                            'singkatan' => 'TS',
                            'akreditasi' => 'B',
                            'bhs_pengantar_kuliah' => 'Indonesia',
                            'bhs_pengantar_kuliah_en' => 'Indonesian',
                            'sistem_penilaian' => 'Skala 1-4',
                            'sistem_penilaian_en' => 'Scale 1-4',
                            'gelar' => 'Sarjana Teknik (S.T)',
                            'gelar_en' => 'Bachelor of Engineering',
                        ],
                        [
                            'nama' => 'Teknik Mesin',
                            'nama_en' => 'Mechanical Engineering',
                            'singkatan' => 'TM',
                            'akreditasi' => 'B',
                            'bhs_pengantar_kuliah' => 'Indonesia',
                            'bhs_pengantar_kuliah_en' => 'Indonesian',
                            'sistem_penilaian' => 'Skala 1-4',
                            'sistem_penilaian_en' => 'Scale 1-4',
                            'gelar' => 'Sarjana Teknik (S.T)',
                            'gelar_en' => 'Bachelor of Engineering',
                        ],
                        [
                            'nama' => 'Arsitektur',
                            'nama_en' => 'Architecture ',
                            'singkatan' => 'Ars',
                            'akreditasi' => 'B',
                            'bhs_pengantar_kuliah' => 'Indonesia',
                            'bhs_pengantar_kuliah_en' => 'Indonesian',
                            'sistem_penilaian' => 'Skala 1-4',
                            'sistem_penilaian_en' => 'Scale 1-4',
                            'gelar' => 'Sarjana Arsitektur (S.Ars)',
                            'gelar_en' => 'Bachelor of Architecture degree',
                        ],
                    ]
                ]
            ];

            foreach ($jenjangPendidikan as $jenjang) {
                $insertJenjang = $jenjang;
                unset($insertJenjang['program_studi']);
                $dataJenjang = JenjangPendidikan::firstOrCreate([
                    'nama' => $jenjang['nama'],
                    'singkatan' => $jenjang['singkatan'],
                ], $insertJenjang);

                if (isset($jenjang['program_studi'])) {
                    foreach ($jenjang['program_studi'] as $programStudi) {
                        $programStudi['jenjang_pendidikan_id'] = $dataJenjang->id;
                        $dataProgramStudi = ProgramStudi::firstOrCreate(
                            [
                                'nama' => $programStudi['nama'],
                                'jenjang_pendidikan_id' => $dataJenjang->id,
                            ],
                            $programStudi
                        );
                        $dataJenjang->programStudi()->save($dataProgramStudi);
                    }
                }
            }

            // is transaction success
            if (DB::transactionLevel() > 0) {
                DB::commit();
            } else {
                throw new \Exception('Transaction failed');
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
