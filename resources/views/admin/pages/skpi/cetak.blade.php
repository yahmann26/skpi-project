<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak SKPI</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Tambahkan CSS jika diperlukan -->
</head>

<body>
    <div class="container">
        <h1>Cetak SKPI</h1>

        <h2>Data Mahasiswa</h2>
        <p>Nama: {{ $mahasiswa->nama }}</p>
        <p>NIM: {{ $mahasiswa->nim }}</p>
        <p>Program Studi: {{ $prodi->nama }}</p>
        <p>Jenjang Pendidikan: {{ $jenjangPendidikan->nama }}</p>

        <h2>Data SKPI</h2>
        <p>ID SKPI: {{ $skpi->id }}</p>
        <p>Deskripsi: {{ $skpi->deskripsi }}</p>

        <h2>Kegiatan</h2>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kegiatan as $kegiatanItem)
                    <tr>
                        <td>{{ $kegiatanItem->nama }}</td>
                        <td>{{ $kegiatanItem->nama_en }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>
        CPL Prodi: {{ $prodi->kualifikasi_cpl }}
        </p>
        <!-- Tambahkan data SKPI lainnya sesuai kebutuhan -->

        <button onclick="window.print()">Print</button>
    </div>
</body>

</html>
