<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #4f46e5;
            --primary-soft: #eef2ff;
            --text-main: #0f172a;
            --text-light: #64748b;
            --white: #ffffff;
            --bg-gradient: radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.12) 0px, transparent 50%),
                           radial-gradient(at 100% 0%, rgba(6, 182, 212, 0.12) 0px, transparent 50%),
                           radial-gradient(at 50% 100%, rgba(244, 63, 94, 0.08) 0px, transparent 50%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f1f5f9;
            background-image: var(--bg-gradient);
            background-attachment: fixed;
            color: var(--text-main);
            min-height: 100vh;
        }

        /* NAVBAR DASHBOARD STYLE */
        .navbar {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 1rem 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--text-main);
            letter-spacing: -1px;
            text-decoration: none;
        }

        .brand i { color: var(--primary); }

        /* MAIN CONTENT */
        .container {
            max-width: 1100px;
            margin: 30px auto 50px;
            padding: 0 24px;
            display: grid;
            grid-template-columns: 1fr 1.2fr; /* Ditukar posisinya agar lebih estetik */
            gap: 30px;
        }

        /* CARD STYLE (Glassmorphism & Pop-up) */
        .card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(15px);
            border-radius: 32px;
            padding: 35px;
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 20px 50px -15px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* RINGKASAN TIKET */
        .ticket-summary {
            background: var(--white);
            border-radius: 24px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.02);
        }

        .route {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .route h4 { font-size: 1.3rem; font-weight: 800; }
        .route p { font-size: 0.7rem; color: var(--text-light); text-transform: uppercase; font-weight: 700; }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 0.9rem;
        }
        .detail-row span { color: var(--text-light); font-weight: 500; }
        .detail-row strong { font-weight: 700; color: var(--text-main); }

        .total-pay {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid var(--primary-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-pay span { font-weight: 800; font-size: 1.1rem; color: var(--primary); }

        /* PAYMENT SELECTION */
        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 25px;
        }

        .payment-option {
            position: relative;
            cursor: pointer;
        }

        .payment-option input {
            position: absolute;
            opacity: 0;
        }

        .option-box {
            background: var(--white);
            border: 2px solid #f1f5f9;
            padding: 15px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .payment-option input:checked + .option-box {
            border-color: var(--primary);
            background: var(--primary-soft);
            color: var(--primary);
        }

        /* INSTRUCTION BOX */
        #payment-instruction {
            background: #0f172a;
            color: #fff;
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 25px;
            display: none; /* Hidden by default */
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* FILE UPLOAD */
        .upload-section label {
            display: block;
            margin-bottom: 10px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .custom-file-upload {
            border: 2px dashed #cbd5e1;
            padding: 25px;
            border-radius: 20px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
            background: rgba(255,255,255,0.5);
        }

        .custom-file-upload:hover {
            border-color: var(--primary);
            background: var(--primary-soft);
        }

        .btn-confirm {
            width: 100%;
            padding: 18px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 25px;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
            transition: 0.3s;
        }

        .btn-confirm:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 35px -10px rgba(79, 70, 229, 0.5);
        }

        @media (max-width: 900px) {
            .container { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <header class="navbar">
        <a href="/" class="brand">
            <i data-lucide="plane-takeoff"></i> AirFlight
        </a>
        <div class="nav-actions">
            <div style="font-size: 0.8rem; color: var(--text-light); font-weight: 600;">Secure Checkout</div>
        </div>
    </header>

    <div class="container">

        <div class="card">
            <div class="card-title">
                <i data-lucide="ticket" style="color: var(--primary)"></i>
                Ringkasan Pembayaran
            </div>

            <div class="ticket-summary">
                <div class="route">
                    <div>
                        <p>Origin</p>
                        <h4>{{ $booking->schedule->origin }}</h4>
                    </div>
                    <i data-lucide="move-right" style="color: #cbd5e1"></i>
                    <div style="text-align: right;">
                        <p>Destination</p>
                        <h4>{{ $booking->schedule->destination }}</h4>
                    </div>
                </div>

                <div class="detail-row">
                    <span>Maskapai</span>
                    <strong>{{ $booking->schedule->plane_name }}</strong>
                </div>
                <div class="detail-row">
                    <span>Penumpang</span>
                    <strong>{{ $booking->total_seats }} Orang</strong>
                </div>
                <div class="detail-row">
                    <span>Harga Satuan</span>
                    <strong>Rp {{ number_format($booking->schedule->price) }}</strong>
                </div>
                <div class="total-pay">
                    <p style="font-weight: 700;">Total Bayar</p>
                    <span>Rp {{ number_format($booking->total_price) }}</span>
                </div>
            </div>

            <div style="text-align: center; color: var(--text-light); font-size: 0.75rem;">
                <i data-lucide="shield-check" size="14" style="vertical-align: middle;"></i>
                Pembayaran diamankan dengan enkripsi 256-bit
            </div>
        </div>

        <div class="card" style="box-shadow: 0 30px 60px -12px rgba(79, 70, 229, 0.15);">
            <div class="card-title">
                <i data-lucide="credit-card" style="color: var(--primary)"></i>
                Pilih Metode Pembayaran
            </div>

            <form action="/bayar/{{ $booking->id }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="payment-grid">
                    <label class="payment-option">
                        <input type="radio" name="metode_pembayaran" value="transfer_bca" required onclick="showInstruction('BCA: 1234567890 a.n E-AirFlight')">
                        <div class="option-box">BCA</div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="metode_pembayaran" value="transfer_mandiri" onclick="showInstruction('Mandiri: 9876543210 a.n E-AirFlight')">
                        <div class="option-box">Mandiri</div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="metode_pembayaran" value="transfer_bri" onclick="showInstruction('BRI: 1122334455 a.n E-AirFlight')">
                        <div class="option-box">BRI</div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="metode_pembayaran" value="transfer_bni" onclick="showInstruction('BNI: 5566778899 a.n E-AirFlight')">
                        <div class="option-box">BNI</div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="metode_pembayaran" value="dana" onclick="showInstruction('DANA: 081234567890')">
                        <div class="option-box">DANA</div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="metode_pembayaran" value="gopay" onclick="showInstruction('GoPay: 081234567890')">
                        <div class="option-box">GoPay</div>
                    </label>
                </div>

                <div id="payment-instruction">
                    <p style="font-size: 0.75rem; opacity: 0.7; text-transform: uppercase; margin-bottom: 5px;">Kirim Ke Rekening:</p>
                    <h2 id="acc-number" style="letter-spacing: 1px;">-</h2>
                </div>

                <div class="upload-section">
                    <label>Upload Bukti Pembayaran</label>
                    <label for="bukti" class="custom-file-upload">
                        <i data-lucide="image-plus" style="margin-bottom: 8px; color: var(--primary);"></i>
                        <p style="font-size: 0.8rem; font-weight: 600;" id="file-name">Klik untuk pilih foto bukti transfer</p>
                    </label>
                    <input type="file" name="bukti_pembayaran" id="bukti" style="display: none;" required onchange="updateFileName(this)">
                </div>

                <button type="submit" class="btn-confirm">
                    Konfirmasi Pembayaran
                </button>
            </form>
        </div>

    </div>

    <script>
        lucide.createIcons();

        // Fungsi menampilkan instruksi rekening sesuai pilihan
        function showInstruction(text) {
            const box = document.getElementById('payment-instruction');
            const target = document.getElementById('acc-number');
            box.style.display = 'block';
            target.innerText = text;
        }

        // Fungsi merubah teks label saat file dipilih
        function updateFileName(input) {
            const fileName = input.files[0].name;
            document.getElementById('file-name').innerText = "Terpilih: " + fileName;
            document.getElementById('file-name').style.color = "var(--primary)";
        }
    </script>
</body>
</html>
