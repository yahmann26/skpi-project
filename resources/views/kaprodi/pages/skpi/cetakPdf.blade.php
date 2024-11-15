<html>

<head>
    <title>SKPI</title>
    </link>
    <style>
        @media print {
            @page {
                margin-top: 50mm;
                margin-right: 15mm;
                margin-bottom: 10mm;
                margin-left: 15mm;
            }

            @page:first {
                margin-top: 1mm;
                margin-right: 15mm;
                margin-bottom: 10mm;
                margin-left: 15mm;
            }

            body {
                margin: 0;
                padding: 0;
                font-family: Arial, Helvetica, sans-serif;
            }

            .first-page {
                margin-top: 1mm;
                margin-bottom: 10mm;
                margin-right: 15mm;
                margin-left: 15mm;
                padding: 0;
            }

            .other-pages {
                margin-top: 30mm;
                margin-bottom: 50mm;
                margin-right: 15mm;
                margin-left: 15mm;
                padding: 0;
            }
        }
    </style>

</head>

<body>
    <div class="first-page">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0;">
            <div style="display: flex; align-items: center;">

                {{-- table logo --}}
                <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                    <tr>
                        <td style="width: 15%; text-align: center; padding: 0;">
                            <img class="logo" src="data:image/png;base64,{{ $logoUniv }}" alt="University logo"
                                width="100" height="100">
                        </td>
                        <td style="width: 45%; color: #2F9B58; padding: 0; vertical-align: left;">
                            <h1 style="font-size: 1.125rem; font-weight: bold; margin-top: 10px; margin-bottom: 3px;">
                                UNIVERSITAS <br> SAINS AL-QUR'AN
                            </h1>
                            <h2 style="font-size: 0.875rem; font-weight: bold; margin-top: 0; margin-bottom: 0;">
                                JAWA TENGAH DI WONOSOBO
                            </h2>
                            <h3
                                style="font-size: 0.875rem; font-weight: 600; margin: 0; color: black; font-style: italic; ">
                                Sains Al-Qur'an University
                            </h3>
                        </td>

                        <td>
                            <p style="width: 40%; font-size: 0.75rem;">Transformatif - Humanis - Qur'ani</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Nomor SKPI -->
        <div style="text-align: right; margin-bottom: 0;">
            <p style="font-size: 0.75rem; background-color: #e5e7eb; display: inline-block; padding: 0.25rem;">
                &nbsp;&nbsp;&nbsp; Nomor : {{ $skpi->nomor }} &nbsp;&nbsp;&nbsp;</p>
        </div>

        <!-- Judul SKPI -->
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td
                    style="width: 90%; font-size: 1.875rem; font-weight: bold; text-align: left; color: #2F9B58; padding: 0; vertical-align: top;">
                    <h1 style="font-size: 1.875rem; font-weight: bold; text-align: left; margin: 0;">
                        SURAT KETERANGAN <br> PENDAMPING IJAZAH
                    </h1>
                </td>
            </tr>
        </table>

        {{-- DIploma SUpleement --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>

                <td
                    style="width: 90%; font-weight: bold; font-style: italic; text-align: left; padding: ; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 5px; margin-bottom: 3px;">
                        Diploma Supplement
                    </h1>
                </td>
            </tr>
        </table>

        <hr style="margin-top: 0.5rem; margin-bottom: 0.5rem; border: 1px solid green;">

        {{-- SKPI --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 95%; text-align: left; padding: ; vertical-align: top;">
                    <p style="font-size: 0.75rem; margin-top: 2px; margin-bottom: 2px; text-align: justify;">
                        Surat Keterangan Pendamping Ijazah (SKPI) ini mengacu pada Kerangka Kualifikasi Nasional
                        Indonesia (KKNI).
                        Tujuan dari SKPI ini adalah menjadi dokumen yang menyatakan kemampuan kerja, penguasaan
                        pengetahuan, dan
                        sikap/moral pemiliknya.
                    </p>
                </td>
            </tr>
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 95%; text-align: left; padding: ; vertical-align: top;">
                    <p
                        style="font-size: 0.75rem; margin-top: 2px; margin-bottom: 2px; font-style: italic; text-align: justify;">
                        The certificate of diploma companion refers to the Framework of the Indonesian National
                        Qualification.
                        The purpose of this SKPI is to become a document stating the ability of work, mastery of
                        knowledge,
                        and attitudes or moral of the owner.
                    </p>
                </td>
            </tr>
        </table>

        <hr style="margin-top: 0; margin-bottom: 0.5rem; border: 0.5px solid;">

        {{-- Identitas Pemilik SKPI --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
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
                <td style="width: 5%; text-align: center; padding: 0;">
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
                <td style="width: 5%; text-align: center; padding: 0;">
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
                        <span>{{ $mahasiswa->jenis_pendaftaran }}</span> <br>
                        <span style="font-style:italic; color: gray;">{{ $mahasiswa->jenis_pendaftaran_en }}</span>
                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px;">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
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
                            {{ \App\Helper\Skpi::dateEN($mahasiswa->tgl_lahir_en) }}</span>
                    </p>
                </td>
                <td style="width: 3%; ">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>
                <td style="width: 20%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px;  margin-top: 2px; margin-bottom: 0;">
                        <span style=" padding: 2px">{{ \App\Helper\Skpi::dateIndo($mahasiswa->tgl_lulus) }}</span>
                        <br>
                        <span
                            style="font-style:italic; color: gray;">{{ \App\Helper\Skpi::dateEN($mahasiswa->tgl_lulus_en) }}</span>
                    </p>
                </td>
                <td style="width: 3%; ">
                </td>
                <td style="width: 2%; background-color: #D3D3D3;">
                </td>
                <td style="width: 33%; background-color: #D3D3D3; padding: 0; vertical-align: left;">
                    <p style="font-size: 12px; margin-top: 2px; margin-bottom: 0;">
                        <span>{{ $mahasiswa->no_ijazah }}</span> <br>
                    </p>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px;">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
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
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 15px">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
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
                <td style="width: 5%; text-align: center; padding: 0;">
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
                <td style="width: 5%; text-align: center; padding: 0;">
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
                <td style="width: 5%; text-align: center; padding: 0;">
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
                <td style="width: 5%; text-align: center; padding: 0;">
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
                <td style="width: 5%; text-align: center; padding: 0;">
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

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
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
        {{-- End identitas penyelenggara program --}}

    </div>

    <div class="other-pages" style="page-break-before: always;">
        {{-- Kualifikasi dan hasil yang dicapai --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0;">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        C.
                    </h1>
                </td>
                <td style="width: 93%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        KUALIFIKASI DAN HASIL YANG DICAPAI
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%;">
                </td>
                <td style="width: 94%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; font-style: italic; color: gray; text-align: left; margin-top: 0; margin-bottom: 0;">
                        The Qualification and Outcomes Obtained
                    </h1>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        1.
                    </h1>
                </td>
                <td style="width: 43%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        CAPAIAN PEMBELAJARAN
                    </h1>
                </td>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        1.
                    </h1>
                </td>
                <td style="width: 43%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; font-style: italic; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Learning Outcomes
                    </h1>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px">
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3; ">
                </td>
                <td style="width: 43%; background-color: #D3D3D3; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; text-align: left; margin-top: 0; margin-bottom: 0;">
                        {{ strtoupper($prodi->gelar) }} : {{ $prodi->nama }} <br>
                        (KKNI {{ strtoupper($jenjangPendidikan->kualifikasi_kkni) }})
                    </h1>
                </td>
                <td style="width: 5%;">
                </td>
                <td style="width: 2%; background-color: #D3D3D3; ">
                </td>
                <td style="width: 43%; background-color: #D3D3D3; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; font-style: italic; text-align: left; margin-top: 0; margin-bottom: 0;">
                        {{ ucwords($prodi->gelar_en) }} Level <br> (KKNI
                        {{ $jenjangPendidikan->kualifikasi_kkni }})
                    </h1>
                </td>
            </tr>
        </table>

        {{-- CPL --}}
        @foreach ($cpl as $item)
            <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px">
                @foreach ($item['subs'] as $sub)
                    <tr>
                        <td style="width: 5%;">
                        </td>
                        <td style="width: 2%; background-color: #D3D3D3; ">
                        </td>
                        <td style="width: 43%; background-color: #D3D3D3; text-align: left; vertical-align: top;">
                            <h1
                                style="font-size: 12px; font-weight: normal; text-align: left; margin-top: 0; margin-bottom: 0;">
                                {{ strtoupper($sub['judul']) ?? 'Judul sub tidak tersedia' }}
                            </h1>
                        </td>
                        <td style="width: 5%;">
                        </td>
                        <td style="width: 2%; background-color: #D3D3D3; ">
                        </td>
                        <td style="width: 43%; background-color: #D3D3D3; text-align: left; vertical-align: top;">
                            <h1
                                style="font-size: 12px; font-weight: normal; font-style: italic; text-align: left; margin-top: 0; margin-bottom: 0;">
                                {{ ucwords($sub['judul_en']) ?? 'Judul sub tidak tersedia' }}
                            </h1>
                        </td>
                    </tr>

                    @if (isset($sub['list']) && is_array($sub['list']))
                        @foreach ($sub['list'] as $index => $list)
                            <tr style="margin-buttom: 10px">
                                <td style="width: 5%;">
                                </td>

                                <td style="width: 2%; font-size: 12px; font-weight: normal; vertical-align: top;">
                                    {{ $index + 1 }}.
                                </td>
                                <td style="width: 43%; text-align: justify; vertical-align: top;">
                                    <h1
                                        style="font-size: 12px; font-weight: normal; text-align: justify; margin-top: 0; margin-bottom: 0;">
                                        {{ $list['teks'] ?? 'Teks tidak tersedia' }}
                                    </h1>
                                </td>
                                <td style="width: 5%;">
                                </td>

                                <td
                                    style="width: 2%; font-size: 12px; font-weight: normal; font-style: italic; vertical-align: top;">
                                    {{ $index + 1 }}.
                                </td>
                                <td style="width: 43%; text-align: justify; vertical-align: top;">
                                    <h1
                                        style="font-size: 12px; font-weight: normal; font-style: italic; text-align: justify; margin-top: 0; margin-bottom: 0;">
                                        {{ $list['teks_en'] ?? 'Teks tidak tersedia' }}
                                    </h1>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </table>
        @endforeach

        {{-- Kegiatan Mahasiswa --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        2.
                    </h1>
                </td>
                <td style="width: 43%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        AKTIVITAS, PRESTASI DAN PENGHARGAAN
                    </h1>
                </td>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        2.
                    </h1>
                </td>
                <td style="width: 43%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; font-style: italic; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Activities, Achievements and Awards
                    </h1>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 0">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; text-align: justify; margin-top: 0; margin-bottom: 0;">
                        Pemilik Surat Keterangan Pendamping Ijazah ini memiliki prestasi dan telah mengikuti kegiatan:
                    </h1>
                </td>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; font-style: italic; text-align: justify; margin-top: 0; margin-bottom: 0;">
                        The owner of this Diploma Suplement obtains the following professional certifications:
                    </h1>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 0">
            @foreach ($kegiatan as $index => $k)
                <tr>
                    <td style="width: 5%; text-align: center; padding: 0;">
                    </td>
                    <td style="width: 2%; text-align: left; vertical-align: top;">
                        <h1
                            style="font-size: 12px; font-weight: normal; text-align: left; margin-top: 0; margin-bottom: 0;">
                            {{ $index + 1 }}.
                        </h1>
                    </td>
                    <td style="width: 43%; text-align: left; vertical-align: top;">
                        <h1
                            style="font-size: 12px; font-weight: normal; text-align: left; margin-top: 0; margin-bottom: 0;">
                            {{ $k->nama }}
                        </h1>
                    </td>
                    <td style="width: 5%; text-align: center; padding: 0;">
                    </td>
                    <td style="width: 2%; text-align: left; vertical-align: top;">
                        <h1
                            style="font-size: 12px; font-weight: normal; text-align: left; margin-top: 0; margin-bottom: 0;">
                            {{ $index + 1 }}.
                        </h1>
                    </td>
                    <td style="width: 43%; text-align: left; vertical-align: top;">
                        <h1
                            style="font-size: 12px; font-weight: normal; font-style: italic; text-align: left; margin-top: 0; margin-bottom: 0;">
                            {{ $k->nama_en }}
                        </h1>
                    </td>
                </tr>
            @endforeach
        </table>
        {{-- end kegiatan  --}}

        {{-- sistem pendidikan tinggi dan skpi --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        D.
                    </h1>
                </td>
                <td style="width: 93%; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        INFROMASI TENTANG SISTEM PENDIDIKAN TINGGI DAN KERANGKA KUALIFIKASI NASIONAL INDONESIA
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%;">
                </td>
                <td style="width: 94%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; font-style: italic; color: gray; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Information of the Indonesia Higher Education System and the Indonesian National Qualifications
                        Framework
                    </h1>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        1.
                    </h1>
                </td>
                <td style="width: 43%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        SISTEM PENDIDIKAN TINGGI DI INDONESIA
                    </h1>
                </td>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        1.
                    </h1>
                </td>
                <td style="width: 43%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; font-style: italic; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Higher Education System in Indonesia
                    </h1>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 0">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; text-align: justify; margin-top: 0; margin-bottom: 0;">
                        {{ $pt->sistem_pendidikan }}
                    </h1>
                </td>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; font-style: italic; text-align: justify; margin-top: 0; margin-bottom: 0;">
                        {{ $pt->sistem_pendidikan_en }}
                    </h1>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        2.
                    </h1>
                </td>
                <td style="width: 43%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        KERANGKA KUALIFIKASI NASIONAL INDONESIA
                    </h1>
                </td>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        2.
                    </h1>
                </td>
                <td style="width: 43%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; font-style: italic; text-align: left; margin-top: 0; margin-bottom: 0;">
                        The Indonesian National Qualifications Framework
                    </h1>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 0">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; text-align: justify; margin-top: 0; margin-bottom: 0;">
                        {{ $pt->kkni }}
                    </h1>
                </td>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; font-style: italic; text-align: justify; margin-top: 0; margin-bottom: 0;">
                        {{ $pt->kkni_en }}
                    </h1>
                </td>
            </tr>
        </table>

        {{-- end sistem pendidikan dan kkni --}}

        {{-- pengesahan skpi --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 25mm" >
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        E.
                    </h1>
                </td>
                <td style="width: 93%; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        PENGESAHAN SKPI
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%;">
                </td>
                <td style="width: 94%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; font-style: italic; color: gray; text-align: left; margin-top: 0; margin-bottom: 0;">
                        SKPI Legalization
                    </h1>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px">
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%;" >
                </td>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: no; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Wonosobo, 29 Maret 2021
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%;" >
                </td>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-style: italic; color: gray; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Wonosobo, 29 Maret 2021
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%;" >
                </td>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Dekan Fakultas Teknik dan Ilmu Komputer
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%;" >
                </td>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-style: italic; color: gray; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Dean of Engineering and Computer Science Faculty
                    </h1>
                </td>
            </tr>
            <br>
            <br>
            <br>
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%;" >
                </td>
                <td style="width: 5%;">
                </td>
                <td style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0; text-decoration: underline">
                    {{ $ttd }}
                </td>
            </tr>
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%;" >
                </td>
                <td style="width: 5%;">
                </td>
                <td style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                    NIDN: {{ $nidn }}
                </td>
            </tr>

        </table>
    </div>

    <script type="text/php">
        if(isset($pdf)) {
            $x = 50;
            $y = 800;

            $text = "{PAGE_NUM} | Surat Keterangan Pendamping Ijazah";

            $fontBold = $fontMetrics->get_font("Times-Roman", "bold");
            $fontNormal = $fontMetrics->get_font("Times-Roman", "normal");
            $size = 10;
            $color = array(.16, .16, .16);
            $word_space = 0.0;
            $char_space = 0.0;
            $angel = 0.0;

            $pdf->page_text($x, $y, "{PAGE_NUM}", $fontBold, $size, $color, $word_space, $char_space, $angel);

            $pdf->page_text($x + 5, $y, " | Surat Keterangan Pendamping Ijazah", $fontNormal, $size, $color, $word_space, $char_space, $angel);
        }
    </script>



</body>



</html>
