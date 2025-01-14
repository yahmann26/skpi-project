<?php

namespace Database\Seeders;

use App\Models\JenisPendaftaran;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use App\Models\JenjangPendidikan;
use App\Models\KategoriKegiatan;
use App\Models\Pt;
use App\Models\Semester;
use App\Models\TahunAkademik;
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
            $pendidikanTinggi = [
                [
                    'sistem_pendidikan' => 'Pendidikan Tinggi terdiri dari dari (1) pendidikan akademik yang memiliki fokus dalam ilmu pengetahuan dan (2) pendidikan vokasi yang menitikberatkan pada persiapan lulusan untuk mengaplikasikan keahliannya.',
                    'sistem_pendidikan_en' => 'The Higher Education in Indonesia includes (1) academic education that focuses on mastery knowladge and (2) vocational education that emphasizes onpreparing graduates to apply their expertise.',
                    'kkni' => 'Kerangka Kualifikasi Nasional Indonesia (KKNI) adalah kerangka perjenjangan kualifikasi dan kompetensi tenaga kerja indonesia yang menyandingkan, menyetarakan, dan mengintegrasikan sektor pendidikan dengan sektor pelatihan dan pengalaman kerja dalam skema pengakuan kemampuan kerja yang desesuaikan dengan struktur di berbagai sektor pekerjaan. KKNI merupakan perwujudan mutu dan jati diri Bangsa Indonesia terkait dengan sistem pendidikan nasional, sistem pelatihan kerja nasional serta sistem penilaian kesetaraan capaian pembelajaran (Learning Outcomes) nasional yang dimiliki Indonesia untuk menghasilkan sumber daya nasional yang bermutu dan produktif. KKNI merupakan sistem yang berdiri sendiri dan merupakan jembatan antara sektor pendidikan dan pelatihan untuk membentuk SDM nasional berkualitas dan bersertifikat melalui skema pendidikan formal , non formal, informal, pelatihan kerja atau pengalaman kerja. Jenjang kualifikasi adalah tingkat capaian pembelajaran yang disepakati secara nasional, disusun berdasarkan ukuran hasil pendidikan dan/atau pelatihan yang diperoleh melalui pendidikan formal, non formal, informal , pelatihan kerja atau pengalaman kerja. KKNI terdidri dari 9 (sembilan) jenjang kualifikasi, dimulai dari kualifikasi 1 sebagai kualitas terendah hingga kualifikasi 9 sebagai kualitas tertinggi.',
                    'kkni_en' => 'The Indonesian National Qualification Framework (KKNI) is a framework for the qualification and competency levels of the Indonesian workforce that juxtaposes, equalizes, and integrates the education sector with the training and work experience sector in a work capability recognition scheme that is adjusted to the structure in various employment sectors. KKNI is a manifestation of the quality and identity of the Indonesian nation related to the national education system, the national job training system and the national learning outcomes assessment system (Learning Outcomes) owned by Indonesia to produce quality and productive national resources. KKNI is a stand-alone system and is a bridge between the education and training sectors to form quality and certified national human resources through formal, non-formal, informal education schemes, job training or work experience. Qualification levels are levels of learning achievement that are agreed upon nationally, arranged based on the measurement of education and/or training results obtained through formal, non-formal, informal education, job training or work experience. KKNI consists of 9 (nine) qualification levels, starting from qualification 1 as the lowest quality to qualification 9 as the highest quality.',
                ],

            ];

            foreach ($pendidikanTinggi as $pt) {
                Pt::firstOrCreate([
                    'sistem_pendidikan' => $pt['sistem_pendidikan'],
                    'sistem_pendidikan_en' => $pt['sistem_pendidikan_en'],
                    'kkni' => $pt['kkni'],
                    'kkni_en' => $pt['kkni_en'],
                ], $pt);
            }

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
            // data tahun akademik
            $semester = [
                [
                    'nama' => 'Ganjil',
                    'tahun_akademik' => [
                        ['nama' => '2020'],
                        ['nama' => '2021'],
                        ['nama' => '2022'],
                        ['nama' => '2023'],
                        ['nama' => '2024'],
                        ['nama' => '2025'],
                    ]
                ],
                [
                    'nama' => 'Genap',
                    'tahun_akademik' => [
                        ['nama' => '2020'],
                        ['nama' => '2021'],
                        ['nama' => '2022'],
                        ['nama' => '2023'],
                        ['nama' => '2024'],
                        ['nama' => '2025'],
                    ]
                ],
            ];

            foreach ($semester as $s) {
                $insertSemester = $s;
                unset($insertSemester['tahun_akademik']);

                // Insert or get semester
                $dataSemester = Semester::firstOrCreate([
                    'nama' => $s['nama'],
                ], $insertSemester);

                if (isset($s['tahun_akademik'])) {
                    foreach ($s['tahun_akademik'] as $thnAkademik) {
                        // Add semester_id to tahun akademik
                        $thnAkademik['semester_id'] = $dataSemester->id;

                        // Insert or get tahun akademik
                        TahunAkademik::firstOrCreate(
                            [
                                'nama' => $thnAkademik['nama'],
                                'semester_id' => $dataSemester->id,
                            ],
                            $thnAkademik
                        );
                    }
                }
            }

            // data Jenis Pendaftaran
            $jenisPendaftaran = [
                [
                    'nama' => 'Peserta Didik baru',
                    'nama_en' => 'New Student',
                ],
                [
                    'nama' => 'Peserta Didik Transfer',
                    'nama_en' => 'Transfer Student',
                ],

            ];

            foreach ($jenisPendaftaran as $jp) {
                JenisPendaftaran::firstOrCreate([
                    'nama' => $jp['nama'],
                    'nama_en' => $jp['nama_en'],
                ], $jp);
            }

            // data jenjang pendidikan
            $jenjangPendidikan = [
                [
                    'nama' => 'Sarjana (Strata 1)',
                    'nama_en' => 'Bachelor Degree',
                    'singkatan' => 'S1',
                    'jenis_pendidikan' => 'Akademik',
                    'jenis_pendidikan_en' => 'Academic',
                    'kualifikasi_kkni' => 'level 6',
                    'lama_studi_reguler' => '8',
                    'jenis_lanjutan' => 'Magister',
                    'jenis_lanjutan_en' => 'Master',
                    'jenjang_lanjutan' => 'Magister',
                    'jenjang_lanjutan_en' => 'Magister',
                    'program_studi' => [
                        [
                            'kode_prodi' => '55201',
                            'nama' => 'Teknik Informatika',
                            'nama_en' => 'Informatics Engineering',
                            'singkatan' => 'TI',
                            'akreditasi' => 'B',
                            'sk_akreditasi' => '1602/SK/BAN-PT/Akred/S/IV/2019',
                            'bhs_pengantar_kuliah' => 'Indonesia',
                            'bhs_pengantar_kuliah_en' => 'Indonesian',
                            'sistem_penilaian' => 'Skala 1-4: A=4.0, B=3.0-3.9, C=2.0-2.9, D=1.0-1.9',
                            'sistem_penilaian_en' => 'Scale 1-4: A=4.0, B=3.0-3.9, C=2.0-2.9, D=1.0-1.9',
                            'gelar' => 'Sarjana Komputer ',
                            'gelar_en' => 'Bachelor of Computer',
                            'gelar_singkat' => 'S.Kom',
                        ],
                        [
                            'kode_prodi' => '22201',
                            'nama' => 'Teknik Sipil',
                            'nama_en' => 'Civil Engineering',
                            'singkatan' => 'TS',
                            'akreditasi' => 'B',
                            'sk_akreditasi' => '1603/SK/BAN-PT/Akred/S/IV/2019',
                            'bhs_pengantar_kuliah' => 'Indonesia',
                            'bhs_pengantar_kuliah_en' => 'Indonesian',
                            'sistem_penilaian' => 'Skala 1-4: A=4.0, B=3.0-3.9, C=2.0-2.9, D=1.0-1.9',
                            'sistem_penilaian_en' => 'Scale 1-4: A=4.0, B=3.0-3.9, C=2.0-2.9, D=1.0-1.9',
                            'gelar' => 'Sarjana Teknik',
                            'gelar_en' => 'Bachelor of Engineering',
                            'gelar_singkat' => 'S.T',
                        ],
                        [
                            'kode_prodi' => '21201',
                            'nama' => 'Teknik Mesin',
                            'nama_en' => 'Mechanical Engineering',
                            'singkatan' => 'TM',
                            'akreditasi' => 'B',
                            'sk_akreditasi' => '1604/SK/BAN-PT/Akred/S/IV/2019',
                            'bhs_pengantar_kuliah' => 'Indonesia',
                            'bhs_pengantar_kuliah_en' => 'Indonesian',
                            'sistem_penilaian' => 'Skala 1-4: A=4.0, B=3.0-3.9, C=2.0-2.9, D=1.0-1.9',
                            'sistem_penilaian_en' => 'Scale 1-4: A=4.0, B=3.0-3.9, C=2.0-2.9, D=1.0-1.9',
                            'gelar' => 'Sarjana Teknik ',
                            'gelar_en' => 'Bachelor of Engineering',
                            'gelar_singkat' => 'S.T',
                        ],
                        [
                            'kode_prodi' => '23201',
                            'nama' => 'Arsitektur',
                            'nama_en' => 'Architecture',
                            'singkatan' => 'Ars',
                            'akreditasi' => 'B',
                            'sk_akreditasi' => '1605/SK/BAN-PT/Akred/S/IV/2019',
                            'bhs_pengantar_kuliah' => 'Indonesia',
                            'bhs_pengantar_kuliah_en' => 'Indonesian',
                            'sistem_penilaian' => 'Skala 1-4: A=4.0, B=3.0-3.9, C=2.0-2.9, D=1.0-1.9',
                            'sistem_penilaian_en' => 'Scale 1-4: A=4.0, B=3.0-3.9, C=2.0-2.9, D=1.0-1.9',
                            'gelar' => 'Sarjana Arsitektur ',
                            'gelar_en' => 'Bachelor of Architecture Degree',
                            'gelar_singkat' => 'S.Ars',
                        ],
                    ]
                ],
                [
                    'nama' => 'Diploma (Diploma 3)',
                    'nama_en' => 'Associate Degree',
                    'singkatan' => 'D3',
                    'jenis_pendidikan' => 'Akademik',
                    'jenis_pendidikan_en' => 'Academic',
                    'kualifikasi_kkni' => 'level 5',
                    'lama_studi_reguler' => '6',
                    'jenis_lanjutan' => 'Sarjana',
                    'jenis_lanjutan_en' => 'Bachelor',
                    'jenjang_lanjutan' => 'Strata',
                    'jenjang_lanjutan_en' => 'Strata',
                    'program_studi' => [
                        [
                            'kode_prodi' => '57401',
                            'nama' => 'Manajemen Informatika',
                            'nama_en' => 'Informatics Manajement',
                            'singkatan' => 'MI',
                            'akreditasi' => 'Baik Sekali',
                            'sk_akreditasi' => '1610/SK/BAN-PT/Akred/S/IV/2023',
                            'bhs_pengantar_kuliah' => 'Indonesia',
                            'bhs_pengantar_kuliah_en' => 'Indonesian',
                            'sistem_penilaian' => 'Skala 1-4: A=4.0, B=3.0-3.9, C=2.0-2.9, D=1.0-1.9',
                            'sistem_penilaian_en' => 'Scale 1-4: A=4.0, B=3.0-3.9, C=2.0-2.9, D=1.0-1.9',
                            'gelar' => 'Ahli Madya Komputer',
                            'gelar_en' => 'Diploma Program of Informatics Management',
                            'gelar_singkat' => 'A.Md',
                        ],
                    ]
                ],
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
