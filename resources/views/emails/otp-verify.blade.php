<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
            text-align: center;
        }

        .otp-code {
            background: #f8f9fa;
            border: 2px dashed #007bff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
            letter-spacing: 5px;
            font-family: 'Courier New', monospace;
        }

        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: left;
        }

        .warning h3 {
            color: #856404;
            margin-top: 0;
        }

        .warning ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        .warning li {
            color: #856404;
            margin: 5px 0;
        }

        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
            font-size: 12px;
            color: #6c757d;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 15px 0;
        }

        .timer {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🔐 Kode OTP Login</h1>
            <p>Dinas Sosial Kabupaten Majalengka</p>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Halo, {{ $userName ?? 'Admin' }}!</h2>

            <p>Anda telah melakukan permintaan login ke sistem admin. Gunakan kode OTP berikut untuk melanjutkan proses login:</p>

            <!-- OTP Code -->
            <div class="otp-code">
                {{ $otpCode ?? '123456' }}
            </div>

            <p><span class="timer">⏰ Kode ini berlaku selama 5 menit</span></p>

            <!-- Warning -->
            <div class="warning">
                <h3>⚠️ Penting untuk Keamanan!</h3>
                <ul>
                    <li>Jangan berikan kode ini kepada siapa pun</li>
                    <li>Kode OTP hanya berlaku untuk 1 kali penggunaan</li>
                    <li>Jika Anda tidak melakukan login, abaikan email ini</li>
                </ul>
            </div>

            <p><strong>Butuh Bantuan?</strong><br>
                Jika Anda mengalami masalah, silakan hubungi administrator sistem.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Dinas Sosial Kabupaten Majalengka. Semua hak cipta dilindungi.</p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>

</html>