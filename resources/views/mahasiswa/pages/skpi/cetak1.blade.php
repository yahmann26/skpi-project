<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 20mm;
            }

            body {
                width: 210mm;
                height: 297mm;
                margin: 0;
            }

            .page {
                page-break-after: always;
                height: 100%;
            }

            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                background-color: #f1f1f1;
                padding: 10px 0;
                text-align: center;
            }

            .page-number {
                display: inline-block;
                margin: 0;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div id="content">
        <div class="page">
            <div class="header">
                <h1>Header Surat</h1>
                <p>Tanggal: <span id="tanggal"></span></p>
            </div>
            <div class="body">
                <h2>Subjek</h2>
                <p>
                    Ini adalah isi surat untuk halaman pertama. Anda bisa menambahkan lebih banyak teks di sini untuk
                    mencetak halaman yang lebih panjang.
                </p>
            </div>
            <div class="footer">
                <p>Footer Halaman 1</p>
            </div>
        </div>
        <div class="page">
            <div class="header">
                <h1>Header Surat</h1>
                <p>Tanggal: <span id="tanggal"></span></p>
            </div>
            <div class="body">
                <h2>Subjek</h2>
                <p>
                    Ini adalah isi surat untuk halaman kedua. Anda bisa menambahkan lebih banyak teks di sini untuk
                    mencetak halaman yang lebih panjang.
                </p>
            </div>
            <div class="footer">
                <p>Footer Halaman 2</p>
            </div>
        </div>
        <!-- Tambahkan lebih banyak halaman sesuai kebutuhan -->
    </div>
    <button onclick="printSurat()">Cetak Surat</button>
    <script>
        function printSurat() {
            // Set tanggal saat ini
            const tanggalElement = document.getElementById('tanggal');
            const currentDate = new Date().toLocaleDateString('id-ID');
            tanggalElement.textContent = currentDate;

            // Menambahkan nomor halaman
            const pages = document.querySelectorAll('.page');
            pages.forEach((page, index) => {
                const pageNumber = page.querySelector('.page-number');
                pageNumber.textContent = `Halaman ${index + 1}`; // Menetapkan nomor halaman
            });

            // Cetak dokumen
            window.print();
        }
    </script>
</body>

</html>
