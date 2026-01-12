<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/LogoDLaundry.png" type="image/png">
    <title>Verifikasi Email - D'Laundry</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            text-align: center;
            color: #ffffff;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .email-body {
            padding: 40px 30px;
            color: #2d3748;
            line-height: 1.6;
        }
        .email-body h2 {
            color: #1a202c;
            font-size: 22px;
            margin-bottom: 20px;
        }
        .email-body p {
            margin: 15px 0;
            font-size: 16px;
        }
        .verify-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 16px 40px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 25px 0;
            text-align: center;
        }
        .verify-button:hover {
            opacity: 0.9;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .footer {
            background-color: #f7fafc;
            padding: 25px;
            text-align: center;
            color: #718096;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 5px 0;
        }
        .link-text {
            word-break: break-all;
            background-color: #f7fafc;
            padding: 15px;
            border-radius: 6px;
            font-size: 14px;
            color: #4a5568;
            margin: 20px 0;
        }
        .warning-box {
            background-color: #fff5f5;
            border-left: 4px solid #f56565;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning-box p {
            margin: 5px 0;
            font-size: 14px;
            color: #742a2a;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>D'Laundry</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <h2>Halo, {{ $nama }}! 👋</h2>
            
            <p>Terima kasih telah mendaftar di <strong>D'Laundry</strong>!</p>
            
            <p>Untuk melengkapi pendaftaran Anda, silakan verifikasi alamat email Anda dengan mengklik tombol di bawah ini:</p>

            <div class="button-container">
                <a href="{{ $verificationUrl }}" class="verify-button">
                    ✅ Verifikasi Email Saya
                </a>
            </div>

            <p>Atau salin dan tempel link berikut di browser Anda:</p>
            <div class="link-text">
                {{ $verificationUrl }}
            </div>

            <div class="warning-box">
                <p><strong>⚠️ Penting:</strong></p>
                <p>Link verifikasi ini akan kedaluwarsa dalam <strong>24 jam</strong>.</p>
                <p>Jika Anda tidak mendaftar di D'Laundry, abaikan email ini.</p>
            </div>

            <p>Setelah verifikasi berhasil, Anda dapat langsung login dan menikmati layanan laundry terbaik kami! 🎉</p>

            <p style="margin-top: 30px;">
                Salam hangat,<br>
                <strong>Tim D'Laundry</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>D'Laundry</strong> - Layanan Laundry Terpercaya</p>
            <p>Email ini dikirim otomatis, mohon tidak membalas email ini.</p>
            <p style="margin-top: 15px; color: #a0aec0; font-size: 12px;">
                © {{ date('Y') }} D'Laundry. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>