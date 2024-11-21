<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh PDF dengan Header</title>
    <style>
        /* Styling untuk body dan konten umum */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Styling untuk header yang akan muncul di setiap halaman */
        .header {
            text-align: center;
            font-weight: bold;
            padding: 10px;
            background-color: #f0f0f0;
            position: fixed; /* Fixed positioning agar header tetap di atas */
            width: 100%;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        /* Styling untuk konten utama */
        .content {
            padding: 2px;
            margin-top: 100px; /* Memberikan margin untuk konten agar tidak tertutupi header */
        }

        /* Styling untuk pemisah halaman */
        .page-break {
            page-break-before: always;
        }

        /* Styling untuk konten */
        .content p {
            margin-bottom: 20px;
        }

        /* Aturan untuk halaman */
        @page {
            margin-top: 100px;  /* Memberikan ruang atas agar header tidak tertutup */
            margin-bottom: 30px;
        }

        /* Aturan khusus untuk halaman pertama */
        @page :first {
            margin-top: 0px;
            padding-top: -10px;
        }

        /* Footer tetap muncul di bagian bawah jika diperlukan */
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 5px;
        }
    </style>
</head>
<body>
    <!-- Header yang akan muncul di setiap halaman -->
    <div class="header">
        <h2>Header Dokumen</h2>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        <h1>Contoh PDF dengan Header</h1>
        <p>Ini adalah contoh isi dari dokumen PDF. Setiap halaman akan memiliki header yang sama, tetapi header pada halaman pertama akan tertutupi oleh konten.</p>
        <div class="page-break"></div>
        <p>Ini adalah halaman kedua. Isi pada halaman kedua dan seterusnya. Halaman-halaman berikutnya akan memiliki header yang sama.</p>
        <div class="page-break"></div>
        <p>Ini adalah halaman ketiga. Setiap halaman baru akan dimulai setelah pemisah ini.</p>
        <div class="page-break"></div>
        <p>Ini adalah halaman keempat. Tambahkan lebih banyak konten sesuai kebutuhan.</p>
    </div>

    <!-- Footer jika diperlukan -->
    <div class="footer">
        <p>Halaman <span class="pageNumber"></span></p>
    </div>
</body>
</html>
