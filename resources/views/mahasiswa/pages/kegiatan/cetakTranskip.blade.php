<html>

<head>
    <title>Kegiatan</title>
    <style>
        body {
            font-family: serif;
        }
    </style>

</head>

<body>
    <div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center;">

                <table border="0"
                    style="width: 100%; border-collapse: collapse; border-spacing: 0; position: relative;">
                    <tr>
                        <td style="width: 15%; padding: 0;">
                            <img src="data:image/png;base64,{{ $logoUniv }}" alt="University logo" width="90"
                                height="90">
                        </td>
                        <td
                            style="width:85%; padding: 0; padding-top: 2mm; text-align: center; justify-content: space-between;">

                            <div style="font-size: 15px; font-weight: bold;">
                                UNIVERSITAS SAINS AL-QUR'AN (UNSIQ) JAWA TENGAH DI WONOSOBO
                            </div>

                            <div style="font-size: 22px; font-weight: bold;">
                                FAKULTAS TEKNIK DAN ILMU KOMPUTER
                            </div>

                            <div style="font-size: 15px; font-weight: italic; ">
                                Program Studi {{ $mahasiswa->prodi->nama }}
                            </div>

                        </td>

                    </tr>
                </table>

                <hr style="margin-top: 0.5rem; margin-bottom: 0.5rem; border: 3px solid; color: black;">

                <table border="0"
                    style="width: 100%; border-collapse: collapse; border-spacing: 0; position: relative;">
                    <tr>
                        <td style="width:100%; padding: 0; text-align: center;">
                            <h3 style="font-size: 13px; font-weight: 700;  ">
                                Alamat Kampus : {{ $alamat }}
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:100%; padding: 0; text-align: center; padding-top: 1mm;">
                            <h3 style="font-size: 13px; font-weight: 700;  ">
                                Telp : {{ $telp }} FAX. {{ $fax }} website: {{ $website }}, Email:
                                {{ $email }}
                            </h3>
                        </td>
                    </tr>
                </table>

                <hr style="margin-top: 0.5rem; margin-bottom: 0.5rem; border: 3px solid; color: black;">

                <table border="0"
                    style="width: 100%; border-collapse: collapse; border-spacing: 0; position: relative;">
                    <tr>
                        <td style="width:100%; padding: 0; text-align: center;">
                            <h3 style="font-size: 18px; font-weight: bold;  ">
                                TRANSKIP KEGIATAN MAHASISWA
                            </h3>
                        </td>
                    </tr>
                </table>

                <table border="0"
                    style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px; font-weight: bold;">
                    <tr>
                        <td style="width: 25%; padding: 0; vertical-align: left;">
                            <p style="font-size: 14px; ">
                                <span>Nama</span>
                            </p>
                        </td>
                        <td style="width: 75%; padding: 0; vertical-align: left;">
                            <p style="font-size: 14px; ">
                                <span>: {{ $mahasiswa->nama }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 25%; padding: 0; vertical-align: left;">
                            <p style="font-size: 14px; ">
                                <span>NIM</span>
                            </p>
                        </td>
                        <td style="width: 75%; padding: 0; vertical-align: left;">
                            <p style="font-size: 14px; ">
                                <span>: {{ $mahasiswa->nim }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 25%; padding: 0; vertical-align: left;">
                            <p style="font-size: 14px; ">
                                <span>Tempat/Tgl Lahir</span>
                            </p>
                        </td>
                        <td style="width: 75%; padding: 0; vertical-align: left;">
                            <p style="font-size: 14px; ">
                                <span>: {{ $mahasiswa->tempat_lahir }},
                                    {{ \App\Helper\Skpi::dateIndo($mahasiswa->tgl_lahir) }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 25%; padding: 0; vertical-align: left;">
                            <p style="font-size: 14px; ">
                                <span>Jenis Kelamin</span>
                            </p>
                        </td>
                        <td style="width: 75%; padding: 0; vertical-align: left;">
                            <p style="font-size: 14px;">
                                <span>:
                                    @if ($mahasiswa->jenis_kelamin == 'L')
                                        Laki-Laki
                                    @elseif($mahasiswa->jenis_kelamin == 'P')
                                        Perempuan
                                    @else
                                        Tidak Diketahui
                                    @endif
                                </span>
                            </p>
                        </td>
                    </tr>

                </table>

                <table border="1"
                    style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px">
                    <thead>
                        <tr>
                            <th style="width: 10%">No</th>
                            <th colspan="2">Nama Kegiatan</th>
                            <th style="width: 15%">Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $alphabet = 'A'; @endphp
                        @foreach ($kategori as $kategoriNama => $kegiatanKategori)
                            <tr class="section-header">
                                <td style="text-align: center; width: 40px;">{{ $alphabet }}</td>
                                <td colspan="3">{{ $kategoriNama }}</td>
                            </tr>
                            @foreach ($kegiatanKategori as $kegiatan)
                                <tr>
                                    <td></td>
                                    <td style="text-align: left; width: 20px;">{{ $loop->iteration }}</td>
                                    <td>{{ $kegiatan->nama }}</td>
                                    <td>{{ $kegiatan->tahunAkademik->nama }}/{{ $kegiatan->tahunAkademik->semester->nama }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">&nbsp;</td>
                            </tr>

                            @php $alphabet++; @endphp
                        @endforeach
                    </tbody>
                </table>


                <table border="0"
                    style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px">
                    <tr>
                        <td style="width: 70%;">
                        </td>
                        <td style="width: 30%; font-size: 12px;  text-align: center; margin-top: 0; margin-bottom: 0;">
                            Wonosobo, {{ \App\Helper\Skpi::dateIndo(now()) }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 70%;">
                        </td>
                        <td style="width: 30%; font-size: 12px;  text-align: center; margin-top: 0; margin-bottom: 0;">
                            Ketua Program Studi,
                        </td>
                    </tr>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <tr>
                        <td style="width: 30%;">
                        </td>
                        <td
                            style="font-size: 12px; text-align: center; margin-top: 0; margin-bottom: 0; border-bottom: 1px solid black;">
                            {{ $kaprodi->nama }}
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 30%;">
                        </td>
                        <td style="font-size: 12px;  text-align: center; margin-top: 0; margin-bottom: 0;">
                            {{ $kaprodi->nip }}
                        </td>
                    </tr>

                </table>

            </div>
        </div>
    </div>
</body>

</html>
