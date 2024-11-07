<html>

<head>
    <title>SKPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </link>
    <style>
        @page {
            size: A4;
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 40mm;
        }

        .a4 {
            width: 210mm;
            height: 297mm;
            box-sizing: border-box;
            margin: 0;
            position: relative;
            /* Added for positioning header and footer */
        }
    </style>

</head>

<body class="bg-white">
    <div class="a4 border border-gray-300 p-6">
        <div class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <img src="{{ $logoUniv }}" alt="University logo" class="mr-0" width="110"
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
            <p class="text-xs bg-gray-300 inline-block p-1">&nbsp;&nbsp;&nbsp; {{ $skpi->nomor }} &nbsp;&nbsp;&nbsp;</p>
        </div>

        {{-- judul SKPI --}}
        <h1 class="ml-6 text-3xl font-bold text-left mb-0 text-green-700">SURAT KETERANGAN <br> PENDAMPING IJAZAH</h1>

        {{-- diploma suplement --}}
        <h2 class="ml-6 font-bold italic text-left mb-1 " style="font-size: 12px;">Diploma Supplement</h2>

        <hr class="my-2" style="border: 1px solid green;">

        <p class="ml-6 text-xs mb-3" style="text-align: justify;">
            Surat Keterangan Pendamping Ijazah (SKPI) ini mengacu pada Kerangka Kualifikasi Nasional Indonesia (KKNI).
            Tujuan dari SKPI ini adalah menjadi dokumen yang menyatakan kemampuan kerja, penguasaan pengetahuan, dan
            sikap/moral pemiliknya.
        </p>

        <p class="ml-6 mb-0 text-xs italic" style="text-align: justify;">The certificate of diploma companion
            refers to the
            Framework of the Indonesian National
            Qualification. The purpose of this SKPI is to become a document stating the ability of work, mastery of
            knowledge and attitudes or moral of the owner.</p>

        <hr class="my-2" style="border: 1px solid ;">

        <h3 class="ml-6 text-xs font-bold">A. IDENTITAS DIRI PEMILIK SKPI</h3>
        <h4 class="ml-10 text-xs font-bold italic mb-2" style="color: gray;">Identity of The Owner of Diploma Supplement
        </h4>

        {{-- identitas pemilik --}}

        <div class="ml-6 max-w-[210mm] mx-auto grid grid-cols-8 gap-6 mb-4">
            {{-- Nama Lengkap --}}
            <div class="col-span-3">
                <p><span class="text-xs">NAMA LENGKAP</span> <br> <span class="text-xs italic" style="color: gray;">Full
                        Name</span></p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        {{ $mahasiswa->nama }}
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
                        {{ \App\Helper\Skpi::dateIndo($mahasiswa->tgl_masuk) }}
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        {{ \App\Helper\Skpi::dateEN($mahasiswa->tgl_masuk) }}
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
                        {{ $mahasiswa->jenis_pendaftaran }}
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        {{ $mahasiswa->jenis_pendaftaran_en }}
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
                        {{ $mahasiswa->tempat_lahir }}, {{ \App\Helper\Skpi::dateIndo($mahasiswa->tgl_lahir) }}
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        {{ $mahasiswa->tempat_lahir }}, {{ \App\Helper\Skpi::dateEN($mahasiswa->tgl_lahir) }}
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
                        {{ \App\Helper\Skpi::dateIndo($mahasiswa->tgl_lulus) }}
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        {{ \App\Helper\Skpi::dateEN($mahasiswa->tgl_lulus) }}
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
                        {{ $mahasiswa->no_ijazah }}
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
                        {{ $mahasiswa->nim }}
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
                    <span class="text-xs">GELAR</span>
                    <br>
                    <span class="text-xs italic" style="color: gray;">Title</span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        {{ $prodi->gelar }} ({{ $prodi->gelar_singkat }})
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        {{ $prodi->gelar_en }}
                    </span>
                </p>
            </div>
        </div>


        {{-- IDENTITAS PENYELENGGARA PROGRAM --}}
        <h3 class="ml-6 text-xs font-bold">B. IDENTITAS PENYELENGGARA PROGRAM</h3>
        <h4 class="ml-10 text-xs italic font-bold mb-2" style="color: gray;">Identity of Awarding Institution</h4>

        <div class="ml-6 max-w-[210mm] mx-auto grid grid-cols-8 gap-6 mb-4">

            {{-- NAMA PERGURUAN TINGGI --}}
            <div class="col-span-3">
                <p><span class="text-xs"> NAMA PERGURUAN TINGGI </span> <br> <span class="text-xs italic"
                        style="color: gray;">Name of College</span></p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        {{ $namaUniv }}
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">{{ $namaUnivEn }}</span>
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
                        {{ $jenjangPendidikan->kualifikasi_kkni }}
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
                    <span class="text-xs italic" style="color: gray;">Study Program </span>
                </p>
                <p style="width: 100%;">
                    <span class="text-xs ml-3 bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); margin-bottom: -10px;">
                        {{ $prodi->nama }}
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        {{ $prodi->nama_en }}
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
                        {{ $prodi->bhs_pengantar_kuliah }}
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        {{ $prodi->bhs_pengantar_kuliah_en }}
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
                        {{ $prodi->akreditasi }}
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
                        {{ $prodi->sk_akreditasi }}
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
                        {{ $prodi->sistem_penilaian }}
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        {{ $prodi->sistem_penilaian_en }}
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
                        {{ $jenjangPendidikan->jenis_pendidikan }} & {{ $jenjangPendidikan->nama }}
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        {{ $jenjangPendidikan->jenis_pendidikan_en }} & {{ $jenjangPendidikan->nama_en }}
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
                        Program {{ $jenjangPendidikan->jenis_lanjutan }} & {{ $jenjangPendidikan->jenjang_lanjutan }}
                    </span>
                    <span class="text-xs ml-3 italic bg-gray-300 p-1"
                        style="display: block; width: calc(100% - 1rem); color: gray;">
                        {{ $jenjangPendidikan->jenis_lanjutan_en }} & {{ $jenjangPendidikan->jenjang_lanjutan_en }}
                        Program
                    </span>
                    </span>
                </p>
            </div>
        </div>

        <h3 class="ml-6 text-xs font-bold">C. KUALIFIKASI DAN HASIL YANG DICAPAI</h3>
        <h4 class="ml-10 text-xs italic font-bold mb-2" style="color: gray;">The Qualification and Outcomes Obtaided
        </h4>


        {{-- kualifikasi dan hasil yand dicapai --}}
        <div class="ml-6 max-w-[210mm] mx-auto grid grid-cols-2 gap-6 mb-4">
            <div>
                <h3 class="text-xs font-bold mb-2">1. CAPAIAN PEMBELAJARAN</h3>
                <h3 class="ml-2 text-xs bg-gray-300 p-1">{{ strtoupper($prodi->gelar) }} : {{ $prodi->nama }} <br>
                    (KKNI {{ strtoupper($jenjangPendidikan->kualifikasi_kkni) }})
                </h3>
            </div>
            <div>
                <h3 class="text-xs italic font-bold mb-2">1. Learning Outcomes</h3>
                <h3 class="ml-2 text-xs bg-gray-300 p-1">{{ ucwords($prodi->gelar_en) }} Level <br> (KKNI
                    {{ $jenjangPendidikan->kualifikasi_kkni }})
                </h3>
            </div>
        </div>

        {{-- cpl --}}
        <div class="ml-6 grid grid-cols-2 gap-6">

            @foreach ($cpl as $item)
                <div>
                    @foreach ($item['subs'] as $sub)
                        <h3 class="ml-2 text-xs bg-gray-300 p-1 ">{{ $sub['judul'] }}</h3>
                        @if (isset($sub['list']) && is_array($sub['list']))
                            <ol class="ml-5 list-decimal text-xs" style="text-align: justify">
                                @foreach ($sub['list'] as $list)
                                    <li>
                                        <span class="text-xs">{{ $list['teks'] ?? 'Teks tidak tersedia' }}</span>
                                    </li>
                                @endforeach
                            </ol>
                        @endif
                    @endforeach
                </div>

                <div>
                    @foreach ($item['subs'] as $sub)
                        <h3 class="ml-2 text-xs bg-gray-300 p-1 ">{{ $sub['judul_en'] }}</h3>
                        @if (isset($sub['list']) && is_array($sub['list']))
                            <ol class="ml-5 list-decimal text-xs" style="text-align: justify">
                                @foreach ($sub['list'] as $list)
                                    <li>
                                        <span class="text-xs">{{ $list['teks_en'] ?? 'Teks tidak tersedia' }}</span>
                                    </li>
                                @endforeach
                            </ol>
                        @endif
                    @endforeach
                </div>
            @endforeach


        </div>

        {{-- Kegiatan mahasiswa --}}
        <div class="ml-6 grid grid-cols-2 gap-6">
            <div>
                <h3 class="text-xs font-bold mt-4">2. AKTIFITAS, PRESTASI DAN PENGHARGAAN</h3>
            </div>
            <div>
                <h3 class="text-xs italic font-bold mt-4">2. Activities, Achievement And Award</h3>
                </h3>
            </div>
        </div>

        <div class="ml-2 grid grid-cols-2 gap-6">
            <div>
                <h3 class="ml-4 text-xs" style="text-align: justify;">Pemilik Surat Keterangan Pendamping Ijazah ini
                    memiliki prestasi dan telah
                    mengikuti kegiatan :</h3>

                <ol class="ml-4 text-xs list-decimal list-inside"
                    style="text-align: justify; list-style-position: inside; counter-reset: list;">
                    @foreach ($kegiatan as $k)
                        <li>
                            {{ $k->nama }}
                        </li>
                    @endforeach
                </ol>
            </div>
            <div>
                <h3 class="ml-2 text-xs " style="text-align: justify;">The owner of this Diploma Accompanying
                    Certificate has achievements and has participated in the following activities: </h3>
                <ol class="ml-2 text-xs list-decimal list-inside"
                    style="text-align: justify; list-style-position: inside; counter-reset: list;">
                    @foreach ($kegiatan as $k)
                        <li>
                            {{ $k->nama_en }}
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>

        {{-- sistem pendidikan dan skpi --}}
        <h3 class="ml-6 text-xs font-bold mt-3">D. INFORMASI TENTANG PENDIDIKAN TINGGI DAN KERANGKA KUALIFIKASI
            NASIONAL INDONESIA</h3>
        <h4 class="ml-10 text-xs italic font-bold mb-2" style="color: gray;">Information of Indonesia Higher Education
            System and teh Indonesian National Qualifications Framework
        </h4>

        <div class="ml-6 grid grid-cols-2 gap-6">
            <div>
                <h3 class="text-xs font-bold mt-3 mb-3">1. SISTEM PENDIDIKAN TINGGI DI INDONESIA</h3>
            </div>
            <div>
                <h3 class="text-xs italic font-bold mt-3 mb-3">1. Higher Education System in Indonesia</h3>
                </h3>
            </div>
        </div>

        <div class="ml-6 grid grid-cols-2 gap-6">
            <div>
                <p class=" text-xs list-decimal list-inside"
                    style="text-align: justify; list-style-position: inside; counter-reset: list;">
                    {{ $pt->sistem_pendidikan }}
                </p>

            </div>
            <div>
                <p class=" text-xs list-decimal list-inside"
                    style="text-align: justify; list-style-position: inside; counter-reset: list;">
                    {{ $pt->sistem_pendidikan_en }}
                </p>
            </div>
        </div>

        <div class="ml-6 grid grid-cols-2 gap-6">
            <div>
                <h3 class="text-xs font-bold mt-3">2. KERANGKA KUALIFIKASI NASIONAL INDONESIA</h3>
            </div>
            <div>
                <h3 class="text-xs italic font-bold mt-3"> 2. Indonesian National Qualifications Framework</h3>
                </h3>
            </div>
        </div>

        <div class="ml-6 grid grid-cols-2 gap-6">
            <div>
                <p class=" text-xs list-decimal list-inside"
                    style="text-align: justify; list-style-position: inside; counter-reset: list;">
                    {{ $pt->kkni }}
                </p>

            </div>
            <div>
                <p class=" text-xs list-decimal list-inside"
                    style="text-align: justify; list-style-position: inside; counter-reset: list;">
                    {{ $pt->kkni_en }}
                </p>
            </div>
        </div>

        {{-- Pengesahan SKPI --}}
        <h3 class="ml-6 text-xs font-bold mt-4">E. PENGESAHAN SKPI</h3>
        <h4 class="ml-10 text-xs italic font-bold mb-2" style="color: gray;"> SKPI Legalization</h4>

        <div class="ml-6 grid grid-cols-2 gap-6">
            <div class="text-right">
            </div>
            <div class="text-left">
                <p class=" text-xs">
                    Wonosobo, 28 Maret 2024
                </p>
                <p class="text-xs italic" style="color: gray;">
                    Wonosobo, Maret 28, 2024
                </p>

                <p class=" text-xs font-bold">
                    Dekan Fakultas Teknik dan Ilmu Komputer
                </p>

                <p class="text-xs italic" style="color: gray;">Dean of Engineering and Computer Science Faculty</p>

                <br><br><br>
                <p class="text-xs font-bold underline">{{ $ttd }}</p>
                <p class="text-xs">NIDN: {{ $nidn }}</p>
            </div>
        </div>



        {{-- <div class="text-center mt-8">
            <p class="text-xs">SURAT KETERANGAN PENDAMPING IJAZAH - Diploma Supplement</p>
        </div> --}}
    </div>


</body>



</html>
