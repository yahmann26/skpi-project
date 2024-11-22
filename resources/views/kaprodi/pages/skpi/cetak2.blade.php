<html>

<head>
    <title>SKPI</title>
    </link>

</head>

<body>

    <div>

        {{-- Kualifikasi dan hasil yang dicapai --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; ">
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
                        <td style="width: 4%;">
                        </td>
                        <td style="width: 3%; background-color: #D3D3D3; ">
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
                                <td style="width: 4%;">
                                </td>

                                <td style="width: 3%; font-size: 12px; font-weight: normal; vertical-align: top;">
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
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 10px; text-align: left;">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; margin-top: 0; margin-bottom: 0;">
                        2.
                    </h1>
                </td>
                <td style="width: 43%; font-weight: bold; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; margin-top: 0; margin-bottom: 0;">
                        AKTIVITAS, PRESTASI DAN PENGHARGAAN
                    </h1>
                </td>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 2%; font-weight: bold; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; margin-top: 0; margin-bottom: 0;">
                        2.
                    </h1>
                </td>
                <td style="width: 43%; font-weight: bold; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: bold; font-style: italic; margin-top: 0; margin-bottom: 0;">
                        Activities, Achievements and Awards
                    </h1>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 0; text-align: justify;">
            <tr>
                <td style="width: 5%; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; margin-top: 0; margin-bottom: 0;">
                        Pemilik Surat Keterangan Pendamping Ijazah ini memiliki prestasi dan telah mengikuti kegiatan:
                    </h1>
                </td>
                <td style="width: 5%; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; font-style: italic; margin-top: 0; margin-bottom: 0;">
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
                    <td style="width: 2%; text-align: left; font-style: italic; vertical-align: top;">
                        <h1
                            style="font-size: 12px; font-weight: normal; text-align: left; margin-top: 0; margin-bottom: 0;">
                            {{ $index + 1 }}.
                        </h1>
                    </td>
                    <td style="width: 43%; text-align: left; font-style: italic; vertical-align: top;">
                        <h1
                            style="font-size: 12px; font-weight: normal; text-align: left; margin-top: 0; margin-bottom: 0;">
                            {{ $k->nama_en }}
                        </h1>
                    </td>
                </tr>
            @endforeach
        </table>
        {{-- end kegiatan  --}}

    </div>
    <div style="page-break-before:always;">

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
                        Information of the Indonesia Higher Education System and the Indonesian National
                        Qualifications
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

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 0; text-align: justify;" >
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; margin-top: 0; margin-bottom: 0;">
                        {{ $pt->sistem_pendidikan }}
                    </h1>
                </td>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; font-style: italic; margin-top: 0; margin-bottom: 0;">
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

        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 0; text-align: justify;">
            <tr>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; margin-top: 0; margin-bottom: 0;">
                        {{ $pt->kkni }}
                    </h1>
                </td>
                <td style="width: 5%; text-align: center; padding: 0;">
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <h1
                        style="font-size: 12px; font-weight: normal; font-style: italic; margin-top: 0; margin-bottom: 0;">
                        {{ $pt->kkni_en }}
                    </h1>
                </td>
            </tr>
        </table>

        {{-- end sistem pendidikan dan kkni --}}



        {{-- pengesahan skpi --}}
        <table border="0" style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-top: 20px">
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
                <td style="width: 45%;">
                </td>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: no; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Wonosobo, 29 Maret 2021
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%;">
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
                <td style="width: 45%;">
                </td>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%; font-weight: bold; text-align: left; vertical-align: top;">
                    <h1 style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                        Dekan Fakultas Teknik dan Ilmu Komputer
                    </h1>
                </td>
            </tr>
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%;">
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
            <br>
            <br>
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%;">
                </td>
                <td style="width: 5%;">
                </td>
                <td
                    style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0; text-decoration: underline">
                    {{ $ttd }}
                </td>
            </tr>
            <tr>
                <td style="width: 5%;">
                </td>
                <td style="width: 45%;">
                </td>
                <td style="width: 5%;">
                </td>
                <td style="font-size: 12px; font-weight: bold; text-align: left; margin-top: 0; margin-bottom: 0;">
                    NIDN: {{ $nidn }}
                </td>
            </tr>

        </table>
    </div>
</body>



</html>
