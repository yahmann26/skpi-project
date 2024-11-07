<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKPI</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }
        }

        body {
            font-family: Arial, sans-serif;
            padding: 0;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo {
            margin-right: 0;
            width: 110px;
            height: 110px;
        }

        .text-container {
            color: #16a34a;
            /* Tailwind text-green-700 */
        }

        .title {
            font-size: 1.125rem;
            /* text-lg */
            font-weight: bold;
        }

        .subtitle {
            font-size: 0.875rem;
            /* text-sm */
            font-weight: bold;
        }

        .university-name {
            font-size: 0.875rem;
            /* text-sm */
            color: black;
            /* text-black */
            font-weight: 600;
            /* font-semibold */
            font-style: italic;
        }

        .header-right {
            text-align: right;
        }

        .slogan {
            font-size: 0.75rem;
            /* text-xs */
            color: #7f8c8d;
            /* Optional: Tailwind equivalent of gray color (gray-500 or similar) */
        }
    </style>
</head>

<body>

    <div class="">
        <div class="header-container">
            <div class="header-left">
                <img src="images/unsiq.png" alt="University logo" class="logo" width="110" height="110">
                <div class="text-container">
                    <h1 class="title">UNIVERSITAS <br> SAINS AL-QUR'AN</h1>
                    <h2 class="subtitle">JAWA TENGAH DI WONOSOBO</h2>
                    <h3 class="university-name">Sains Al-Qur'an University</h3>
                </div>
            </div>
            <div class="header-right">
                <p class="slogan">Transformatif - Humanis - Qur'ani</p>
            </div>
        </div>

    </div>

</body>

</html>
