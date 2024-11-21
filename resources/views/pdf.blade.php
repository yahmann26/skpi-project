<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Document</title>
    <style>
        @page {
            margin-top: 40px;
            /* Sesuaikan dengan tinggi header */
        }

        /* Hanya tampilkan header di halaman kedua dan seterusnya */
        @page :first {
            margin-top: 0;
            /* Hilangkan margin untuk halaman pertama */
        }

        /* Header yang akan ditampilkan pada semua halaman, kecuali halaman pertama */
        header {
            display: none;
            /* Secara default, header tidak tampil */
        }

        @page :not(:first) header {
            display: block;
            /* Hanya tampilkan header pada halaman selain halaman pertama */
            position: relative;
            top: 0;
            left: 0;
            right: 0;
            height: 40px;
            /* Sesuaikan dengan tinggi header */
            background-color: #f0f0f0;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        /* Gambar atau logo di dalam header */
        header img {
            height: 20px;
            width: auto;
            margin-left: 20px;
        }

        /* Konten utama, beri padding-top agar tidak tertutup header */
        body {
            padding-top: 50px;
            /* Sesuaikan dengan tinggi header */
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <section>
            <img src="data:image/png;base64,{{ $logoUniv2 }}" alt="Logo">
        </section>
    </header>

    <!-- Konten PDF -->
    <div class="content">
        {{-- <h1>Judul Dokumen</h1> --}}
        <p>Ini adalah konten utama yang ada di dalam dokumen PDF. Isi dari dokumen ini akan mengikuti header dan tidak
            tertutup oleh header tersebut.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>
        <p>Tambahkan lebih banyak konten sesuai kebutuhan Anda.</p>

        <!-- Tambahkan lebih banyak konten di sini -->
    </div>
</body>

</html>
