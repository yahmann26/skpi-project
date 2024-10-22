<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use App\Models\KategoriPengaturan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (env('APP_ENV') === 'local' || env('APP_ENV') === 'testing') {
            // truncate table
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('kategori_pengaturan')->truncate();
            DB::table('pengaturan')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        // data kategori pengaturan dan pengaturan
        $kategoriPengaturan = [
            [
                'nama' => 'Dasar',
                'pengaturan' => [
                    [
                        'nama' => 'nama_aplikasi',
                        'nilai' => 'SKPI FASTIKOM',
                        'tipe' => 'text'
                    ],
                    [
                        'nama' => 'logo_aplikasi',
                        'nilai' => 'images/unsiq.png',
                        'tipe' => 'url'
                    ]
                ],
            ],
            [
                'nama' => 'universitas',
                'pengaturan' => [
                    [
                        'nama' => 'logo_universitas',
                        'nilai' => 'images/unsiq.png',
                        'tipe' => 'url'
                    ],
                    [
                        'nama' => 'nama_universitas',
                        'nilai' => 'Universitas Sains Al-Quran',
                        'tipe' => 'editor'
                    ],
                    [
                        'nama' => 'nama_universitas_en',
                        'nilai' => 'Sains alquran University',
                        'tipe' => 'text'
                    ],
                    [
                        'nama' => 'nama_universitas_singkat',
                        'nilai' => 'UNSIQ',
                        'tipe' => 'text'
                    ],
                    [
                        'nama' => 'sk_pendirian_universitas',
                        'nilai' => 'SK Mendiknas No. 155/D/O/2001, Tanggal 30 Agustus 2001',
                        'tipe' => 'text'
                    ],
                    [
                        'nama' => 'sk_pendirian_universitas_en',
                        'nilai' => 'SK Mendiknas No. 155/D/O/2001, Date August 30, 2001',
                        'tipe' => 'text'
                    ],
                    [
                        'nama' => 'jenis_pendidikan',
                        'nilai' => 'Sekolah Tinggi',
                        'tipe' => 'text'
                    ],
                    [
                        'nama' => 'jenis_pendidikan_en',
                        'nilai' => 'College',
                        'tipe' => 'text'
                    ],
                    [
                        'nama' => 'alamat_universitas',
                        'nilai' => 'Jalan Kalibeber',
                        'tipe' => 'textarea'
                    ],
                    [
                        'nama' => 'telepon_universitas',
                        'nilai' => '(0274) 486664',
                        'tipe' => 'text'
                    ],
                    [
                        'nama' => 'hp_universitas',
                        'nilai' => '+62-8112929757',
                        'tipe' => 'text'
                    ],
                    [
                        'nama' => 'email_universitas',
                        'nilai' => 'unsiq@ac.id',
                        'tipe' => 'email'
                    ]
                ],
            ],
            [
                'nama' => 'Capaian Belajar',
                'pengaturan' => [
                    [
                        'nama' => 'informasi_kualifikasi_dan_hasil_capaian',
                        'tipe' => 'json',
                        'nilai' => [
                            [
                                'judul' => 'Capaian Pembelajaran',
                                'judul_en' => 'Learning Outcome',
                                'subs' => [
                                    [
                                        'judul' => 'Algoritma dan Pemrograman',
                                        'judul_en' => 'Programming and algorithm',
                                        'list' => [
                                            [
                                                'teks' => 'Menguasai teori dan konsep yang mendasari ilmu komputer',
                                                'teks_en' => 'mastering the theories and concepts underlying computer science',
                                            ],
                                            [
                                                'teks' => 'Memahami Konsep-konsep bahasa pemrograman, mengidentifikasi model-model bahasa pemrograman serta membandingkan berbagai solusi',
                                                'teks_en' => 'Understanding the concepts of programminng languages, identifying programming language models and comparing various solutions',
                                            ]
                                        ]
                                    ],
                                    [
                                        'judul' => 'Sistem Cerdas',
                                        'judul_en' => 'Intelegents System',
                                        'subs' => [
                                            [
                                                'teks' => 'Menguasai teori dan konsep yang mendasari ilmu komputer',
                                                'teks_en' => 'mastering the theories and concepts underlying computer science',
                                            ],
                                            [
                                                'teks' => 'Memahami Konsep-konsep bahasa pemrograman, mengidentifikasi model-model bahasa pemrograman serta membandingkan berbagai solusi',
                                                'teks_en' => 'Understanding the concepts of programminng languages, identifying programming language models and comparing various solutions',
                                            ]
                                        ]
                                    ],
                                    [
                                        'judul' => 'Rekayasa Perangkat Lunak',
                                        'judul_en' => 'Software Engineering',
                                        'subs' => [
                                            [
                                                'teks' => 'Menguasai teori dan konsep yang mendasari ilmu komputer',
                                                'teks_en' => 'mastering the theories and concepts underlying computer science',
                                            ],
                                            [
                                                'teks' => 'Memahami Konsep-konsep bahasa pemrograman, mengidentifikasi model-model bahasa pemrograman serta membandingkan berbagai solusi',
                                                'teks_en' => 'Understanding the concepts of programminng languages, identifying programming language models and comparing various solutions',
                                            ]
                                        ]
                                    ],
                                    [
                                        'judul' => 'Sikap dan Tata Nilai',
                                        'judul_en' => 'Attitude adn Values',
                                        'subs' => [
                                            [
                                                'teks' => 'Menguasai teori dan konsep yang mendasari ilmu komputer',
                                                'teks_en' => 'mastering the theories and concepts underlying computer science',
                                            ],
                                            [
                                                'teks' => 'Memahami Konsep-konsep bahasa pemrograman, mengidentifikasi model-model bahasa pemrograman serta membandingkan berbagai solusi',
                                                'teks_en' => 'Understanding the concepts of programminng languages, identifying programming language models and comparing various solutions',
                                            ]
                                        ]
                                    ],
                                ]
                            ]
                        ],
                    ]
                ]
            ]
        ];

        foreach ($kategoriPengaturan as $kategori) {
            $insertKategori = $kategori;
            unset($insertKategori['pengaturan']);
            $dataKategori = KategoriPengaturan::firstOrCreate([
                'nama' => $insertKategori['nama'],
            ], $insertKategori);

            if (isset($kategori['pengaturan'])) {
                foreach ($kategori['pengaturan'] as $pengaturan) {
                    $pengaturan['kategori_pengaturan_id'] = $dataKategori->id;

                    if ($pengaturan['tipe'] == 'json') {
                        $pengaturan['nilai'] = json_encode($pengaturan['nilai']);
                    }
                    $dataPengaturan = Pengaturan::firstOrCreate([
                        'nama' => $pengaturan['nama'],
                    ], [
                        'kategori_pengaturan_id' => $dataKategori->id,
                        'nama' => $pengaturan['nama'],
                        'nilai' => $pengaturan['nilai'],
                        'tipe' => $pengaturan['tipe'],
                    ]);
                }
            }
        }

        // get all prodi, and set setting 'informasi_kualifikasi_dan_hasil_capaian' for each prodi
        $prodis = ProgramStudi::all();
        foreach ($prodis as $prodi) {
            $pengaturan = Pengaturan::where('nama', 'informasi_kualifikasi_dan_hasil_capaian')->first();
            $prodi->kualifikasi_cpl = $pengaturan ? $pengaturan->nilai : json_encode([]);
            $prodi->save();
        }
    }
}
