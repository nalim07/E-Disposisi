<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Surat Masuk</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px 20px;
        }
        .mail-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .detail-row {
            display: flex;
            margin-bottom: 12px;
            align-items: flex-start;
        }
        .detail-label {
            font-weight: 600;
            color: #495057;
            min-width: 120px;
            margin-right: 15px;
        }
        .detail-value {
            color: #212529;
            flex: 1;
        }
        .action-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            text-align: center;
            margin: 20px 0;
            transition: transform 0.2s ease;
        }
        .action-button:hover {
            transform: translateY(-2px);
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .footer p {
            margin: 5px 0;
        }
        .urgent-badge {
            background-color: #dc3545;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 10px;
        }
        @media (max-width: 600px) {
            .container {
                margin: 10px;
            }
            .header {
                padding: 20px 15px;
            }
            .content {
                padding: 20px 15px;
            }
            .detail-row {
                flex-direction: column;
            }
            .detail-label {
                min-width: auto;
                margin-bottom: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">📧</div>
            <h1>Notifikasi Surat Masuk</h1>
            <p>Surat baru memerlukan perhatian Anda</p>
        </div>

        <div class="content">
            <div class="urgent-badge">Perlu Didisposisi</div>

            <p>Yth. Bapak/Ibu Pimpinan,</p>

            <p>Ada surat masuk baru yang telah diteruskan untuk ditindaklanjuti. Berikut adalah detail surat:</p>

            <div class="mail-details">
                <div class="detail-row">
                    <div class="detail-label">No. Surat:</div>
                    <div class="detail-value">{{ $incomingMail->mail_number }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Pengirim:</div>
                    <div class="detail-value">{{ $incomingMail->sender }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Perihal:</div>
                    <div class="detail-value">{{ $incomingMail->subject }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Tanggal Surat:</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($incomingMail->mail_date)->format('d F Y') }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Tanggal Diterima:</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($incomingMail->received_date)->format('d F Y') }}</div>
                </div>

                {{-- <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div class="detail-value">
                        <span style="background-color: #28a745; color: white; padding: 2px 8px; border-radius: 4px; font-size: 12px;">
                            {{ $incomingMail->status }}
                        </span>
                    </div>
                </div> --}}
            </div>

            <p>Silakan login ke sistem untuk melihat detail lengkap surat dan memberikan disposisi yang diperlukan.</p>

            <div style="text-align: center;">
                <a href="{{ url('/login') }}" class="action-button">
                    🔗 Login ke Sistem
                </a>
            </div>

            <p style="margin-top: 20px; color: #6c757d; font-size: 14px;">
                Email ini dikirim secara otomatis oleh Sistem Manajemen Surat.
            </p>
        </div>

        <div class="footer">
            <p><strong>Sistem Manajemen Surat</strong></p>
            <p>Dikirim pada: {{ now()->format('d F Y H:i') }}</p>
            <p>&copy; {{ date('Y') }} - Semua hak dilindungi</p>
        </div>
    </div>
</body>
</html>
