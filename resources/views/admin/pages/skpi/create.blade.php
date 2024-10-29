<html>

<head>
    <title>Surat Keterangan Pendamping Ijazah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </link>
    <style>
        @page {
            size: A4;
            margin: 0.75cm;
            /* Atur margin di sini */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            /* Menghapus margin body untuk menghindari konflik */
            padding: 0;
            /* Menghapus padding body */
        }

        .a4 {
            width: 210mm;
            height: 297mm;
            padding: 20mm;
            /* Padding di dalam elemen */
            box-sizing: border-box;
            /* Pastikan padding terhitung dalam ukuran */
        }
    </style>

</head>

<body class="bg-white">
    <div class="a4 border border-gray-300 p-6">
        <div class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <img src="{{ asset('images/unsiq.png') }}" alt="University logo" class="mr-0" width="110"
                    height="110">
                <div class="text-green-700">
                    <h1 class="text-lg font-bold">UNIVERSITAS <br> SAINS AL-QUR'AN</h1>
                    <h2 class="text-sm font-bold">JAWA TENGAH DI WONOSOBO</h2>

                    <h3 class="text-sm text-black font-semibold italic">Sains Al-Qur'an University</h3>
                </div>
            </div>
            <div class="text-right">
                <p class="text-xs">Transformatif - Humanis - Qur'ani</p>
            </div>
        </div>

        {{-- nomor skpi --}}
        <div class="text-right mb-2">
            <p class="text-xs bg-gray-300 inline-block p-1">&nbsp;&nbsp;&nbsp;Nomor.
                02237/SKPI/FASTIKOM/UNSIQ/S1.TI/552021/2022&nbsp;&nbsp;&nbsp;</p>
        </div>

        {{-- judul SKPI --}}
        <h1 class="ml-6 text-3xl font-bold text-left mb-0 text-green-700">SURAT KETERANGAN <br> PENDAMPING IJAZAH</h1>

        {{-- diploma suplement --}}
        <h2 class="ml-6 font-bold text-left mb-1 italic" style="font-size: 12px;">Diploma Supplement</h2>

        <hr class="my-2" style="border: 1px solid green;">

        <p class="ml-6 mb-4" style="text-align: justify; font-size: 12px;">
            Surat Keterangan Pendamping Ijazah (SKPI) ini mengacu pada Kerangka Kualifikasi Nasional Indonesia (KKNI).
            Tujuan dari SKPI ini adalah menjadi dokumen yang menyatakan kemampuan kerja, penguasaan pengetahuan, dan
            sikap/moral pemiliknya.
        </p>

        <p class="ml-6 mb-1 italic" style="text-align: justify; font-size: 12px;">The certificate of diploma companion
            refers to the
            Framework of the Indonesian National
            Qualification. The purpose of this SKPI is to become a document stating the ability of work, mastery of
            knowledge and attitudes or moral of the owner.</p>

        <hr class="my-2" style="border: 1px solid ;">

        <h3 class="ml-6 text-xs font-bold">A. IDENTITAS DIRI PEMILIK SKPI</h3>
        <h4 class="ml-10 text-xs italic mb-3" style="color: gray;">Identity of The Owner of Diploma Supplement</h4>

        {{-- identitas pemilik --}}

        <div class="ml-6 max-w-[210mm] mx-auto grid grid-cols-8 gap-4 mb-4">
            {{-- Nama Lengkap --}}
            <div class="col-span-3">
                <p><span class="text-xs">NAMA LENGKAP</span> <br> <span class="text-xs italic" style="color: gray;">Full
                        Name</span></p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        {{ $kegiatan->mahasiswa->nama }}
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">&nbsp;</span>
                </p>
            </div>

            {{-- Tanggal Masuk --}}
            <div class="col-span-2">
                <p>
                    <span class="text-xs">TANGGAL MASUK</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Date of Admission</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        3 Agustus 2020
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        August 3 2020
                    </span>
                </p>
            </div>

            {{-- Jenis Pendaftaran --}}
            <div class="col-span-3">
                <p>
                    <span class="text-xs">JENIS PENDAFTARAN</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Type Of Admission</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        Peserta Didik Baru
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        New Student
                    </span>
                </p>
            </div>

            {{-- Tempat dan Tanggal Lahir --}}
            <div class="col-span-3">
                <p>
                    <span class="text-xs">TEMPAT DAN TANGGAL LAHIR</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Date and Place of Birth</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        Wonosobo, 3 Agustus 2001
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        Wonosobo, August 3 2001
                    </span>
                </p>
            </div>

            {{-- Tanggal Lulus --}}
            <div class="col-span-2">
                <p>
                    <span class="text-xs">TANGGAL LULUS</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Date of Graduation</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        29 Februari 2024
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        February 29, 2024
                    </span>
                </p>
            </div>

            {{-- Nomor Ijazah Nasional --}}
            <div class="col-span-3">
                <p>
                    <span class="text-xs">NOMOR IJAZAH NASIONAL</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Number of National Diploma</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        55201280183
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">&nbsp;</span>
                </p>
            </div>

            {{-- NOMOR INDUK MAHASISWA --}}
            <div class="col-span-3">
                <p>
                    <span class="text-xs">NOMOR INDUK MAHASISWA</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Number of Student Identification</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        2021160019
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        &nbsp;
                    </span>
                </p>
            </div>

            {{-- GELAR --}}
            <div class="col-span-5">
                <p>
                    <span class="text-xs">NOMOR IJAZAH NASIONAL</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Title</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        Sarjana Komputer (S.Kom)
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        Bachelor of Computer
                    </span>
                </p>
            </div>
        </div>


        {{-- identitas penyelenggaran program --}}
        <h3 class="ml-6 text-xs font-bold">B. IDENTITAS PENYELENGGARA PROGRAM</h3>
        <h4 class="ml-10 text-xs italic mb-3" style="color: gray;">Identity of Awarding Institution</h4>

        <div class="ml-6 max-w-[210mm] mx-auto grid grid-cols-8 gap-4 mb-4">

            {{-- NAMA PERGURUAN TINGGI --}}
            <div class="col-span-3">
                <p><span class="text-xs">NAMA PERGURUAN TINGGI</span> <br> <span class="text-xs italic"
                        style="color: gray;">Name of College</span></p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        Universitas Sains Al-Qur'an
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">Sains Al-Qur'an
                        University</span>
                </p>
            </div>

            {{-- KUALIFIKASI SESUAI KKNI --}}
            <div class="col-span-5">
                <p>
                    <span class="text-xs">KUALIFIKASI SESUAI KKNI</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Qualification in the national Qualification
                        Framework</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        Level 6
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        &nbsp;
                    </span>
                </p>
            </div>

            {{-- PROGRAM STUDI --}}
            <div class="col-span-3">
                <p>
                    <span class="text-xs">PROGRAM STUDI</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Study Program</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        Teknik Informatika
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        Informatics Engineering
                    </span>
                </p>
            </div>

            {{-- BAHASA PENGANTAR KULIAH --}}
            <div class="col-span-5">
                <p>
                    <span class="text-xs">BAHASA PENGANTAR KULIAH</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Language of Intruction</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        Indonesia
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        Indonesian
                    </span>
                </p>
            </div>

            {{-- AKREDITASI --}}
            <div class="col-span-1">
                <p>
                    <span class="text-xs">AKREDITASI</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Accreditation</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        B
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">&nbsp;</span>
                </p>
            </div>

            {{-- SK AKREDITASI --}}
            <div class="col-span-2">
                <p>
                    <span class="text-xs">SK AKREDITASI</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Legalization of Accreditation</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        1062/SK/BAN-PT/Akred/S/IV/2019
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">

                    </span>
                </p>
            </div>

            {{-- SISTEM PENILAIAN --}}
            <div class="col-span-5">
                <p>
                    <span class="text-xs">SISTEM PENILAIAN</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Grading System</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        Skala 1-4: A=4.0
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        Scale 1-4: A=4.0
                    </span>
                </p>
            </div>

            {{-- JENIS DAN PROGRAM PENDIDIKAN --}}
            <div class="col-span-3">
                <p>
                    <span class="text-xs">JENIS & PROGRAM PENDIDIKAN</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Type & Program of Education</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        Akademik & Sarjana (Strata 1)
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        Academic & Bachelor Degree
                    </span>
                </p>
            </div>

            {{-- JENIS & JENJANG PENDIDIKAN LANJUTAN --}}
            <div class="col-span-5">
                <p>
                    <span class="text-xs">JENIS & JENJANG PENDIDIKAN LANJUTAN</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Type & Level Further Study</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        Program Magister & Doctoral
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        Master & Doctoral Program
                    </span>
                </p>
            </div>
        </div>

        <h3 class="ml-6 text-xs font-bold">C. KUALIFIKASI DAN HASIL YANG DICAPAI</h3>
        <h4 class="ml-6 italic mb-3" style="color: gray;">The Qualification and Outcomes Obtaided</h4>

        <div class="ml-6 grid grid-cols-2 gap-4">
            <div>
                <h3 class="text-xs mt-4">ALGORITMA DAN PEMROGRAMAN</h3>
                <ol class="text-xs list-decimal list-inside mt-2">
                    <li>Menguasai teori dan konsep yang mendasari ilmu komputer.</li>
                    <li>Memahami konsep-konsep bahasa pemrograman, mengidentifikasi model-model bahasa pemrograman,
                        serta membandingkan berbagai solusi.</li>
                    <li>Memahami teori dasar arsitektur komputer, termasuk perangkat keras komputer dan jaringan.</li>
                    <li>Menguasai bidang fokus pengetahuan ilmu komputer serta mampu beradaptasi dengan perkembangan
                        ilmu pengetahuan dan teknologi.</li>
                    <li>Menguasai metodologi pengembangan sistem, yaitu perencanaan, desain, penerapan, pengujian dan
                        pemeliharaan sistem.</li>
                    <li>Memahami konsep-konsep algoritma dan kompleksitas, meliputi konsep-konsep sentral dan kecakapan
                        yang dibutuhkan untuk mendesain, mengimplementasi dan menganalisis algoritma untuk menyelesaikan
                        masalah.</li>
                    <li>Memahami konsep dan prinsip algoritma serta teori ilmu komputer yang dapat digunakan dalam
                        pemodelan dan desain sistem berbasis komputer.</li>
                    <li>Menguasai konsep-konsep bahasa pemrograman, serta mampu membandingkan berbagai solusi serta
                        berbagai model bahasa pemrograman.</li>
                    <li>Menganalisis, merancang, dan menerapkan suatu sistem berbasis komputer secara efisien untuk
                        menyelesaikan masalah, menggunakan pemrograman prosedural dan berorientasi objek.</li>
                    <li>Menguasai bahasa dan algoritma pemrograman yang berkaitan dengan program aplikasi untuk
                        memanipulasi model gambar, grafis dan citra.</li>
                </ol>
                <h3 class="text-xs mt-4">SISTEM CERDAS</h3>
                <ol class="text-xs list-decimal list-inside mt-2">
                    <li>Menentukan pendekatan sistem cerdas yang sesuai dengan problem yang dihadapi, memilih
                        representasi pengetahuan dan mekanisme penalarannya.</li>
                    <li>Menerapkan pendekatan berbagai sistem cerdas yang sesuai dengan problem yang dihadapi.</li>
                    <li>Menerapkan penggunaan representasi pengetahuan dan mekanisme penalarannya.</li>
                    <li>Evaluasi kinerja dari penerapan sistem cerdas yang sesuai dengan problem yang dihadapi, termasuk
                        dalam pemilihan representasi pengetahuan dan mekanisme penalarannya.</li>
                </ol>
            </div>
            <div>
                <h3 class="text-xs mt-4">Programming and Algorithm</h3>
                <ol class="text-xs list-decimal list-inside mt-2">
                    <li>Mastering the theories and concepts underlying computer science.</li>
                    <li>Understanding the concepts of programming languages, identifying programming language models,
                        and comparing various solutions.</li>
                    <li>Understanding the basic theories of computer architecture, including computer hardware and
                        networks.</li>
                    <li>Mastering the field of focus on computer science knowledge and being able to adapt to the
                        development of science and technology.</li>
                    <li>Mastering system development methodology, namely planning, design, implementation, testing and
                        maintenance of the system.</li>
                    <li>Understanding algorithm concepts and complexity, including central concepts and skills needed to
                        design, implement and analyze algorithms to solve problems.</li>
                    <li>Mastering the concepts and principles of algorithms and computer science theories that can be
                        used in computer-based system modeling and design.</li>
                    <li>Mastering the concepts of programming languages, and being able to compare various solutions and
                        various programming language models.</li>
                    <li>Analyze, design, and implement a computer-based system efficiently to solve problems, using
                        procedural and object-oriented programming.</li>
                    <li>Mastering languages and programming algorithms related to application programs to manipulate
                        image, graphic and image models.</li>
                </ol>
                <h3 class="text-xs mt-4">Intelligent System</h3>
                <ol class="text-xs list-decimal list-inside mt-2">
                    <li>Determine an intelligent system approach that matches the problem at hand, choosing the
                        representation of knowledge and the mechanism of reasoning.</li>
                    <li>Applying the approach of various intelligent systems that are in accordance with the problems at
                        hand.</li>
                    <li>Applying the use of knowledge representation and reasoning mechanisms.</li>
                    <li>Performance evaluation of the application of intelligent systems in accordance with the problems
                        faced, including in the selection of representation of knowledge and mechanism of reasoning.
                    </li>
                </ol>
            </div>
        </div>




        {{-- <div class="text-center mt-8">
            <p class="text-xs">SURAT KETERANGAN PENDAMPING IJAZAH - Diploma Supplement</p>
        </div> --}}
    </div>


</body>



</html>
