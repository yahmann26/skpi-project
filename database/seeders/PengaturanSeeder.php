<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use App\Models\KategoriPengaturan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use function Laravel\Prompts\text;

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
                        'tipe' => 'teks'
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
                        'nilai' => 'Sains Al-Quran University',
                        'tipe' => 'teks'
                    ],
                    [
                        'nama' => 'nama_universitas_singkat',
                        'nilai' => 'UNSIQ',
                        'tipe' => 'teks'
                    ],
                    [
                        'nama' => 'fax',
                        'nilai' => '(0286) 324160',
                        'tipe' => 'teks'
                    ],
                    [
                        'nama' => 'website',
                        'nilai' => 'http://unsiq.ac.id',
                        'tipe' => 'teks'
                    ],
                    [
                        'nama' => 'jenis_pendidikan',
                        'nilai' => 'Akademik',
                        'tipe' => 'teks'
                    ],
                    [
                        'nama' => 'jenis_pendidikan_en',
                        'nilai' => 'Academic',
                        'tipe' => 'teks'
                    ],
                    [
                        'nama' => 'alamat_universitas',
                        'nilai' => 'Jalan Raya Kalibeber Km. 03 Mojotengah Wonosobo Jawa Tengah 56351',
                        'tipe' => 'textarea'
                    ],
                    [
                        'nama' => 'telepon_universitas',
                        'nilai' => '(0274) 486664',
                        'tipe' => 'teks'
                    ],
                    [
                        'nama' => 'email_universitas',
                        'nilai' => 'humas@unsiq.ac.id',
                        'tipe' => 'email'
                    ]
                ],
            ],

            [
                'nama' => 'kegiatan',
                'pengaturan' => [
                    [
                        'nama' => 'kegiatan_default',
                        'tipe' => 'json',
                        'nilai' => [
                            [
                                'nama' => 'PKKMB',
                                'nama_en' => 'PKKMB Eng',
                            ],
                        ],
                    ],

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
                                        'judul' => 'ALGORITMA DAN PEMROGRAMAN',
                                        'judul_en' => 'Programming and Algorithm',
                                        'list' => [
                                            [
                                                'teks' => 'Menguasai teori dan konsep yang mendasari ilmu komputer.',
                                                'teks_en' => 'Mastering the theories and concepts underlying computer science.',
                                            ],
                                            [
                                                'teks' => 'Memahami konsep-konsep bahasa pemrograman, mengidentifikasi model-model bahasa pemrograman, serta membandingkan berbagai solusi.',
                                                'teks_en' => 'Understanding the concepts of programming languages, identifying programming language models, and comparing various solutions.',
                                            ],
                                            [
                                                'teks' => 'Memahami teori dasar arsitektur komputer, termasuk perangkat keras komputer dan jaringan.',
                                                'teks_en' => 'Understanding the basic theories of computer architecture, including computer hardware and networks.',
                                            ],
                                            [
                                                'teks' => 'Menguasai bidang fokus pengetahuan ilmu komputer serta mampu beradaptasi dengan perkembangan ilmu pengetahuan dan teknologi.',
                                                'teks_en' => 'Mastering the field of focus on computer science knowledge and being able to adapt to the development of science and technology.',
                                            ],
                                            [
                                                'teks' => 'Menguasai metodologi pengembangan sistem, yaitu perencanaan, desain, penerapan, pengujian dan pemeliharaan sistem.',
                                                'teks_en' => 'Mastering system development methodology, namely planning, design, implementation, testing and maintenance of the system.',
                                            ],
                                            [
                                                'teks' => 'Memahami konsep-konsep algoritma dan kompleksitas, meliputi konsep-konsep esensial dan kecakapan yang dibutuhkan untuk mendesain, mengimplementasikan dan menganalisis algoritma untuk menyelesaikan masalah.',
                                                'teks_en' => 'Understanding algorithm concepts and complexity, including central concepts and skills needed to design, implement and analyze algorithms to solve problems.',
                                            ],
                                            [
                                                'teks' => 'Memahami konsep dan prinsip algoritma serta teori ilmu komputer yang dapat digunakan dalam pemodelan dan desain sistem berbasis komputer.',
                                                'teks_en' => 'Mastering the concepts and principles of algorithms and computer science theories that can be used in computer-based system modeling and design.',
                                            ],
                                            [
                                                'teks' => 'Menguasai konsep-konsep bahasa pemrograman, serta mampu membandingkan berbagai solusi serta berbagai model bahasa pemrograman.',
                                                'teks_en' => 'Mastering the concepts of programming languages, and being able to compare various solutions and various programming language models.',
                                            ],
                                            [
                                                'teks' => 'Menganalisis, merancang, dan menerapkan suatu sistem berbasis komputer secara efisien untuk menyelesaikan masalah, menggunakan pemrograman prosedural dan berorientasi objek.',
                                                'teks_en' => 'Analyze, design, and implement a computer-based system efficiently to solve problems, using procedural and object-oriented programming.',
                                            ],
                                            [
                                                'teks' => 'Menguasai bahasa dan algoritma pemrograman yang berkaitan dengan program aplikasi untuk memanipulasi model gambar, grafis dan citra.',
                                                'teks_en' => 'Mastering languages and programming algorithms related to application programs to manipulate image, graphic and image models.',
                                            ],
                                        ]
                                    ],
                                    [
                                        'judul' => 'SISTEM CERDAS',
                                        'judul_en' => 'Intelegents System',
                                        'list' => [
                                            [
                                                'teks' => 'Menentukan pendekatan sistem cerdas yang sesuai dengan problem yang dihadapi, memilih representasi pengetahuan dan mekanisme penalarannya.',
                                                'teks_en' => 'Determine an intelligent system approach that matches the problem at hand, choosing the representation of knowledge and the mechanism of reasoning.',
                                            ],
                                            [
                                                'teks' => 'Menerapkan pendekatan berbagai sistem cerdas yang sesuai dengan problem yang dihadapi.',
                                                'teks_en' => 'Applying the approach of various intelligent systems that are in accordance with problems at hand.',
                                            ],
                                            [
                                                'teks' => 'Menerapkan penggunaan representasi pengetahuan dan mekanisme penalarannya.',
                                                'teks_en' => 'Applying the use of knowledge representation and reasoning mechanisms.',
                                            ],
                                            [
                                                'teks' => 'Evaluasi kinerja dari penerapan sistem cerdas yang sesuai dengan problem yang dihadapi, termasuk dalam pemilihan representasi pengetahuan dan mekanisme penalarannya.',
                                                'teks_en' => 'Performance evaluation of the application of intelligent systems in accordance with the problems faced, including in the selection of representation of knowledge and mechanism of reasoning.',
                                            ],
                                        ]
                                    ],
                                    [
                                        'judul' => 'REKAYASA PERANGKAT LUNAK',
                                        'judul_en' => 'Software Engineering',
                                        'list' => [
                                            [
                                                'teks' => 'Membangun aplikasi perangkat lunak yang berkaitan dengan pengetahuan ilmu komputer.',
                                                'teks_en' => 'Develop software applications related to computer science knowledge.',
                                            ],
                                            [
                                                'teks' => 'Menulis kode yang diperlukan untuk digunakan sebagai instruksi dalam membangun aplikasi komputer.',
                                                'teks_en' => 'Write the code needed to be used as instructions in building a computer application.',
                                            ],
                                            [
                                                'teks' => 'Memanfaatkan pengetahuan yang dimiliki berkaitan dengan konsep-konsep dasar pengembangan perangkat lunak dan kecakapan yang berhubungan dengan proses pengembangan perangkat lunak, serta mampu memperbaiki program untuk meningkatkan efektivitas penggunaan komputer untuk memecahkan masalah tertentu.',
                                                'teks_en' => 'Utilizing the knowledge possessed in relation to the basic concepts of software development and skills related to the software development process, and being able to create programs to improve the effectiveness of computer use to solve certain problems.',
                                            ],
                                            [
                                                'teks' => 'Merancang dan mengembangkan program aplikasi untuk memanipulasi model gambar, grafis dan citra, serta dapat memvisualisasikannya.',
                                                'teks_en' => 'Design and develop application programs to manipulate image, graphic and image models, and can visualize them.',
                                            ],
                                            [
                                                'teks' => 'Membangun dan mengevaluasi perangkat lunak dalam berbagai area, termasuk yang berkaitan dengan interaksi antara manusia dan komputer.',
                                                'teks_en' => 'Build and evaluate software in various areas, including those related to interactions between humans and computers.',
                                            ],
                                            [
                                                'teks' => 'Membangun aplikasi perangkat lunak dalam berbagai area yang berkaitan dengan bidang robotik, pengenalan suara, sistem cerdas, dan bahasa natural.',
                                                'teks_en' => 'Build software applications in various areas related to the field of robotics, speech recognition, intelligent systems, and natural languages.',
                                            ],
                                            [
                                                'teks' => 'Build software applications in various areas related to the field of robotics, speech recognition, intelligent systems, and natural languages.',
                                                'teks_en' => 'Applying concepts related to information management, including compiling data modeling and abstraction and building software applications for organizing data and guaranteeing data access security.',
                                            ],
                                        ]
                                    ],
                                    [
                                        'judul' => 'SIKAP DAN TATA NILAI',
                                        'judul_en' => 'Attitude adn Values',
                                        'list' => [
                                            [
                                                'teks' => 'Mendemonstrasikan kemampuan komunikasi lisan dan tulisan yang berkaitan dengan aspek teknis dan non-teknis.',
                                                'teks_en' => 'Demonstrate oral and written communication skills related to technical and non-technical aspects.',
                                            ],
                                            [
                                                'teks' => 'Berpikir kritis, mengidentifikasi akar masalah dan pemecahannya secara komprehensif, serta mengambil keputusan yang tepat berdasarkan analisis informasi dan data.',
                                                'teks_en' => 'Critical thinking, identifying root causes and solving it comprehensively, and making appropriate decisions based on analysis of information and data.',
                                            ],
                                            [
                                                'teks' => 'Memiliki integritas profesional dan berkomitmen terhadap nilai-nilai etika.',
                                                'teks_en' => 'Have professional integrity and are committed to ethical values.',
                                            ],
                                            [
                                                'teks' => 'Memiliki sikap untuk belajar seumur hidup (life-long learning).',
                                                'teks_en' => 'Having an attitude for lifelong learning (life-long learning).',
                                            ],
                                            [
                                                'teks' => 'Memimpin dan bekerja dalam tim, mandiri dan bertanggung jawab terhadap pekerjaannya.',
                                                'teks_en' => 'Leading and working in teams, independent and responsible for their work.',
                                            ],
                                            [
                                                'teks' => 'Bekerja dengan individu-individu yang memiliki latar belakang sosial dan budaya yang beragam.',
                                                'teks_en' => 'Working with individuals who have diverse social and cultural backgrounds.',
                                            ],
                                            [
                                                'teks' => 'Mencari, menelusuri, menemukan, dan menganalisis informasi ilmiah secara mandiri dan kritis.',
                                                'teks_en' => 'Looking for, tracing, extracting scientific and non-island information independently and critically.',
                                            ],
                                            [
                                                'teks' => 'Berdaptasi terhadap situasi yang dihadapi dan menangani berbagai kegiatan secara simultan pada berbagai kondisi.',
                                                'teks_en' => 'Adapting to the situation at hand and handling various activities simultaneously in various conditions.',
                                            ],
                                        ]
                                    ],
                                ]
                            ]
                        ],
                    ]
                ]
            ],
            [
                'nama' => 'Tanda Tangan',
                'pengaturan' => [
                    [
                        'nama' => 'nama_penandatangan',
                        'nilai' => 'NASYIIN FAQIH, S.T., M.T, I.P.M',
                        'tipe' => 'teks',
                    ],
                    [
                        'nama' => 'nip_penandatangan',
                        'nilai' => '0629077202',
                        'tipe' => 'number',
                    ],
                    [
                        'nama' => 'jabatan_penandatangan',
                        'nilai' => 'Dekan',
                        'tipe' => 'teks',
                    ],
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

        // get all prodi, and set setting 'kegiatan_default' for each prodi
        $prodis = ProgramStudi::all();
        foreach ($prodis as $prodi) {
            $pengaturan = Pengaturan::where('nama', 'kegiatan_default')->first();
            $prodi->kegiatan_default = $pengaturan ? $pengaturan->nilai : json_encode([]);
            $prodi->save();
        }
    }
}
