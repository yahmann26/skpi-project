<html>

<head>
    <title>SKPI</title>
    <style>
        body {
            font-family:'Times New Roman', Times, serif ;
        }
    </style>

</head>

<body>
    <div >
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center;">

                <table border="0"
                    style="width: 100%; border-collapse: collapse; border-spacing: 0; position: relative;">
                    <tr>
                        <td style="width: 15%; padding: 0;">
                            <img src="data:image/png;base64,{{ $logoUniv }}" alt="University logo"
                                width="100" height="100">
                        </td>
                        <td style="width:31%; color: #2F9B58; padding: 0; vertical-align: left; padding-top: 2mm;">
                            <h1 style="font-size: 18px; font-weight: bold;">
                                UNIVERSITAS <br> SAINS AL-QUR'AN
                            </h1>
                            <h2 style="font-size: 13px; font-weight: bold; margin-top:2mm; ">
                                JAWA TENGAH DI WONOSOBO
                            </h2>
                            <h3
                                style="font-size: 13px; font-weight: 600; color: black; font-style: italic; ">
                                Sains Al-Qur'an University
                            </h3>
                        </td>
                        <td >
                            <img class="logo2" src="data:image/png;base64,{{ $logoUniv2 }}" alt="University logo2"
                                width="400" height="" style="position: absolute; top: 0; right: 0; padding: 0;">

                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <!-- Nomor SKPI -->
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top:2mm;">
            <tr>
                <td style="width: 50%;">
                </td>
                <td style="width: 50%; background-color: #D3D3D3; text-align: center; padding: 5px; ">
                    <p style="font-size: 12px;">
                        <span>Nomor. {{ $skpi->nomor }}/SKPI/FASTIKOM/{{ $namaSingkat }}/{{ $jenjangPendidikan->singkatan }}.{{ $prodi->singkatan }}/{{ $prodi->kode_prodi }}/{{ \Carbon\Carbon::parse($skpi->tgl_lulus)->format('Y') }}</span>
                    </p>
                </td>
            </tr>
        </table>

        <!-- Judul SKPI -->
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; ">
            <tr>
                <td style="width: 5%;">
                </td>
                <td
                    style="width: 95%; font-weight: bold; text-align: left; color: #2F9B58; vertical-align: top; padding: 0;padding-top: 2mm;">
                    <h1 style="font-size: 30px; font-weight: bold; text-align: left; margin: 0;">
                        SURAT KETERANGAN <br> PENDAMPING IJAZAH
                    </h1>
                </td>
            </tr>
        </table>

        {{-- DIploma SUpleement --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%;">
                </td>

                <td
                    style="width: 90%; font-weight: bold; font-style: italic; text-align: left; padding: ; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; text-align: left;">
                        Diploma Supplement
                    </h1>
                </td>
            </tr>
        </table>

        <hr style="margin-top: 0.5rem; margin-bottom: 0.5rem; border: 3px solid; color: green;">

        {{-- SKPI --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>
                <td style="width: 95%; text-align: justify; padding: ; vertical-align: top;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 2px; text-align: justify;">
                        Surat Keterangan Pendamping Ijazah (SKPI) ini mengacu pada Kerangka Kualifikasi Nasional
                        Indonesia (KKNI).
                        Tujuan dari SKPI ini adalah menjadi dokumen yang menyatakan kemampuan kerja, penguasaan
                        pengetahuan, dan
                        sikap/moral pemiliknya.
                    </p>
                </td>
            </tr>
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>
                <td style="width: 95%; text-align: justify; padding-top: 3mm ; vertical-align: top;">
                    <p
                        style="font-size: 12px; margin-top: 2px; margin-bottom: 2px; font-style: italic; text-align: justify;">
                        The certificate of diploma companion refers to the Framework of the Indonesian National
                        Qualification.
                        The purpose of this SKPI is to become a document stating the ability of work, mastery of
                        knowledge,
                        and attitudes or moral of the owner.
                    </p>
                </td>
            </tr>
        </table>

        <hr style="margin-top: 0; margin-bottom: 0.5rem; border: 5px solid;">

        {{-- Identitas Pemilik SKPI --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        A.
                    </h1>
                </td>
                <td style="width: 93%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        IDENTITAS DIRI PEMILIK SKPI
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>
                <td style="width: 2%;">
                </td>
                <td style="width: 94%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; font-style: italic; color: gray; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Identity of The Owner of Diploma Supplement
                    </h1>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px;">
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>

                <td style="width: 35%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>NAMA LENGKAP</span> <br>
                        <span style="font-style:italic; color: gray;">Full Name</span>
                    </p>
                </td>
                <td style="width: 25%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>TANGGAL MASUK</span> <br>
                        <span style="font-style:italic; color: gray;">Date of Admission</span>
                    </p>
                </td>
                <td style="width: 35%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>JENIS PENDAFTARAN</span> <br>
                        <span style="font-style:italic; color: gray;">Type of Admission</span>
                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>

                <td style="width: 30%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>{{ $mahasiswa->nama }}</span> <br>
                    </p>
                </td>
                <td style="width: 3%; ">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>
                <td style="width: 20%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px;  margin-top: 2px; margin-bottom: 0;">
                        <span style=" padding: 2px">{{ \App\Helper\Skpi::dateIndo($mahasiswa->tgl_masuk) }}</span> <br>
                        <span
                            style="font-style:italic; color: gray;">{{ \App\Helper\Skpi::dateEN($mahasiswa->tgl_masuk) }}</span>
                    </p>
                </td>
                <td style="width: 3%; ">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>
                <td style="width: 33%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>{{ $mahasiswa->jenisPendaftaran->nama }}</span> <br>
                        <span style="font-style:italic; color: gray;">{{ $mahasiswa->jenisPendaftaran->nama_en }}</span>
                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px;">
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>

                <td style="width: 35%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>TEMPAT DAN TANGGAL LAHIR</span> <br>
                        <span style="font-style:italic; color: gray;">Date and Place of Birth</span>
                    </p>
                </td>
                <td style="width: 25%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>TANGGAL LULUS</span> <br>
                        <span style="font-style:italic; color: gray;">Date of Graduation</span>
                    </p>
                </td>
                <td style="width: 35%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>NOMOR IJAZAH NASIONAL</span> <br>
                        <span style="font-style:italic; color: gray;">Number of National Diploma</span>
                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>

                <td style="width: 30%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>{{ $mahasiswa->tempat_lahir }},
                            {{ \App\Helper\Skpi::dateIndo($mahasiswa->tgl_lahir) }}</span> <br>
                        <span style="font-style:italic; color: gray;">{{ $mahasiswa->tempat_lahir }},
                            {{ \App\Helper\Skpi::dateEN($mahasiswa->tgl_lahir) }}</span>
                    </p>
                </td>
                <td style="width: 3%; ">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>
                <td style="width: 20%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px;  margin-top: 2px; margin-bottom: 0;">
                        <span style=" padding: 2px">{{ \App\Helper\Skpi::dateIndo($skpi->tgl_lulus) }}</span>
                        <br>
                        <span
                            style="font-style:italic; color: gray;">{{ \App\Helper\Skpi::dateEN($skpi->tgl_lulus) }}</span>
                    </p>
                </td>
                <td style="width: 3%; ">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>
                <td style="width: 33%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>{{ $skpi->no_ijazah }}</span> <br>
                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px;">
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>

                <td style="width: 35%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>NOMOR INDUK MAHASISWA</span> <br>
                        <span style="font-style:italic; color: gray;">Number of Student Identification</span>
                    </p>
                </td>
                <td style="width: 60%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>Gelar</span> <br>
                        <span style="font-style:italic; color: gray;">Title</span>
                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>

                <td style="width: 30%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>{{ $mahasiswa->nim }}</span>
                    </p>
                </td>
                <td style="width: 3%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>
                <td style="width: 58%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px;  margin-top: 2px; margin-bottom: 0;">
                        <span style=" padding: 2px">{{ $prodi->gelar }} ({{ $prodi->gelar_singkat }})</span>
                        <br>
                        <span style="font-style:italic; color: gray;">{{ $prodi->gelar_en }}</span>
                    </p>
                </td>
            </tr>
        </table>
        {{-- End Identitas Pemilik SKPI --}}

        {{-- Identitas penyelenggara program --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 20px">
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        B.
                    </h1>
                </td>
                <td style="width: 93%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        IDENTITAS PENYELENGGARA PROGRAM
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>
                <td style="width: 2%;">
                </td>
                <td style="width: 94%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; font-style: italic; color: gray; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Identity of Awarding Institution
                    </h1>
                </td>
            </tr>
        </table>


        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px;">
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>

                <td style="width: 35%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>NAMA PERGURUAN TINGGI</span> <br>
                        <span style="font-style:italic; color: gray;">Name of College</span>
                    </p>
                </td>
                <td style="width: 60%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>KUALIFIKASI SESUAI KKNI</span> <br>
                        <span style="font-style:italic; color: gray;">Qualification in the National Qualification
                            Framework</span>
                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>

                <td style="width: 30%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>{{ $namaUniv }}</span> <br>
                        <span style="font-style:italic; color: gray;">{{ $namaUnivEn }}</span>
                    </p>
                </td>
                <td style="width: 3%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>
                <td style="width: 58%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px;  margin-top: 2px; margin-bottom: 0;">
                        <span style=" padding: 2px">{{ $jenjangPendidikan->kualifikasi_kkni }}</span>

                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px;">
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>

                <td style="width: 35%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>PROGRAM STUDI</span> <br>
                        <span style="font-style:italic; color: gray;">Study Program</span>
                    </p>
                </td>
                <td style="width: 60%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>BAHASA PENGANTAR KULIAH</span> <br>
                        <span style="font-style:italic; color: gray;">Language of Intruction</span>
                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>

                <td style="width: 30%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>{{ $prodi->nama }}</span> <br>
                        <span style="font-style:italic; color: gray;">{{ $prodi->nama_en }}</span>
                    </p>
                </td>
                <td style="width: 3%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>
                <td style="width: 58%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px;  margin-top: 2px; margin-bottom: 0;">
                        <span style=" padding: 2px">{{ $prodi->bhs_pengantar_kuliah }}</span><br>
                        <span style="font-style:italic; color: gray;">{{ $prodi->bhs_pengantar_kuliah_en }}</span>

                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px;">
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>

                <td style="width: 15%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>AKREDITASI</span> <br>
                        <span style="font-style:italic; color: gray;">Accreditation</span>
                    </p>
                </td>
                <td style="width: 20%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>SK AKREDITASI</span> <br>
                        <span style="font-style:italic; color: gray;">Legalization of Accreditation</span>
                    </p>
                </td>
                <td style="width: 60%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>SISTEM PENILAIAN</span> <br>
                        <span style="font-style:italic; color: gray;">Grading System</span>
                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>

                <td style="width: 10%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>{{ $prodi->akreditasi }}</span>
                    </p>
                </td>
                <td style="width: 3%;">
                </td>

                <td style="width: 2%; background-color: #D3D3D3;">
                </td>

                <td style="width: 15%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>{{ $prodi->sk_akreditasi }}</span>
                    </p>
                </td>
                <td style="width: 3%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>
                <td style="width: 58%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px;  margin-top: 2px; margin-bottom: 0;">
                        <span style=" padding: 2px">{{ $prodi->sistem_penilaian }}</span><br>
                        <span style="font-style:italic; color: gray;">{{ $prodi->sistem_penilaian }}</span>

                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px;">
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>

                <td style="width: 35%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>JENIS & PROGRAM PENDIDIKAN</span> <br>
                        <span style="font-style:italic; color: gray;">Type & Program of Education</span>
                    </p>
                </td>
                <td style="width: 60%; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>JENIS & JENJANG PENDIDIKAN LANJUTAN</span> <br>
                        <span style="font-style:italic; color: gray;">Type & Level Further Study</span>
                    </p>
                </td>
            </tr>
        </table>

        <table border="0"
            style="page-break-after:always; width: 100%; border-collapse: collapse; border-spacing: 0; ">
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>

                <td style="width: 30%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>{{ $jenjangPendidikan->jenis_pendidikan }} & {{ $jenjangPendidikan->nama }}</span> <br>
                        <span style="font-style:italic; color: gray;">{{ $jenjangPendidikan->jenis_pendidikan_en }} &
                            {{ $jenjangPendidikan->nama_en }}</span>
                    </p>
                </td>
                <td style="width: 3%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>
                <td style="width: 58%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px;  margin-top: 2px; margin-bottom: 0;">
                        <span style=" padding: 2px">Program {{ $jenjangPendidikan->jenis_lanjutan }} &
                            {{ $jenjangPendidikan->jenjang_lanjutan }}</span><br>
                        <span style="font-style:italic; color: gray;">{{ $jenjangPendidikan->jenis_lanjutan_en }} &
                            {{ $jenjangPendidikan->jenjang_lanjutan_en }} Program</span>

                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
