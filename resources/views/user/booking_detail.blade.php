<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Detail</title>

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

        /* NAVBAR DASHBOARD (UTAMA) */
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

        .brand i {
            color: var(--primary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* SUB-NAVBAR (Tombol Back) */
        .sub-nav {
            padding: 20px 8% 0;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-main);
            font-size: 0.85rem;
            font-weight: 700;
            background: white;
            padding: 10px 20px;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .btn-back:hover {
            transform: translateX(-5px);
            color: var(--primary);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.1);
        }

        /* LAYOUT CONTAINER */
        .container {
            max-width: 1100px;
            margin: 20px auto 50px;
            padding: 0 24px;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 30px;
        }

        /* CARD LEFT: Glassmorphism Style */
        .container > div:first-child {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(15px);
            border-radius: 32px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 20px 50px -15px rgba(0, 0, 0, 0.05);
        }

        /* Tag Maskapai */
        .container > div:first-child > span {
            background: var(--text-main);
            color: white;
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 25px;
            display: inline-block;
        }

        /* Flight Route Styles */
        .route-visual {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 35px 0;
        }

        .route-visual h2 { font-size: 1.8rem; font-weight: 800; letter-spacing: -1px; }
        .route-visual p { color: var(--text-light); font-size: 0.75rem; font-weight: 600; text-transform: uppercase; }

        .plane-divider {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 25px;
            position: relative;
        }

        .plane-divider::before {
            content: '';
            width: 100%;
            height: 2px;
            background: #e2e8f0;
        }

        .plane-icon-box {
            position: absolute;
            background: white;
            padding: 8px;
            border-radius: 50%;
            color: var(--primary);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        /* Flight Detail Items Grid */
        .flight-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px dashed #cbd5e1;
        }

        .detail-item { display: flex; align-items: center; gap: 12px; }
        .detail-item i {
            background: white;
            padding: 10px;
            border-radius: 12px;
            color: var(--primary);
            box-shadow: 0 5px 15px rgba(0,0,0,0.04);
        }

        .detail-item div p { font-size: 0.65rem; color: var(--text-light); font-weight: 600; text-transform: uppercase; }
        .detail-item div span { font-size: 0.95rem; font-weight: 700; }

        /* CARD RIGHT: Booking Pop-up Style */
        .booking-card {
            background: var(--white);
            border-radius: 32px;
            padding: 35px;
            box-shadow: 0 30px 60px -12px rgba(79, 70, 229, 0.18);
            border: 1px solid var(--primary-soft);
            height: fit-content;
            position: sticky;
            top: 100px; /* Menyesuaikan tinggi navbar sticky */
        }

        .booking-card h3 { font-size: 1.3rem; font-weight: 800; margin-bottom: 25px; }

        input[type="number"] {
            width: 100%;
            padding: 16px 20px;
            border-radius: 16px;
            border: 2px solid #f1f5f9;
            background: #f8fafc;
            font-size: 1rem;
            font-weight: 700;
            transition: 0.3s;
        }

        input[type="number"]:focus {
            border-color: var(--primary);
            background: white;
            outline: none;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .summary {
            background: #f8fafc;
            border-radius: 20px;
            padding: 24px;
            margin: 25px 0;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px dashed #e2e8f0;
            align-items: center;
        }

        .summary-total span:last-child { font-weight: 800; font-size: 1.3rem; color: var(--primary); }

        .btn-order {
            width: 100%;
            padding: 18px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 18px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
        }

        .btn-order:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px -10px rgba(79, 70, 229, 0.5);
        }

        @media (max-width: 900px) {
            .container { grid-template-columns: 1fr; }
            .booking-card { position: static; }
        }
    </style>
</head>
<body>

    <header class="navbar">
        <a href="/" class="brand">
            <i data-lucide="plane-takeoff"></i>
            AirFlight
        </a>
        <div class="nav-actions">
            <i data-lucide="bell" size="20" style="color: var(--text-light); cursor: pointer;"></i>
            <div style="width: 35px; height: 35px; background: #ddd; border-radius: 50%; overflow: hidden;">
                <img src="https://ui-avatars.com/api/?name=User" alt="avatar" style="width: 100%;">
            </div>
        </div>
    </header>

    <div class="sub-nav">
        <a href="/dashboard" class="btn-back">
            <i data-lucide="arrow-left" size="18"></i> Back to Dashboard
        </a>
    </div>

    <div class="container">
        <div>
            <span>{{ $schedule->plane_name }}</span>

            <div class="route-visual">
                <div>
                    <h2>{{ $schedule->origin }}</h2>
                    <p>Origin City</p>
                </div>
                <div class="plane-divider">
                    <div class="plane-icon-box">
                        <i data-lucide="plane" size="20"></i>
                    </div>
                </div>
                <div style="text-align: right;">
                    <h2>{{ $schedule->destination }}</h2>
                    <p>Destination</p>
                </div>
            </div>

            <div class="flight-details">
                <div class="detail-item">
                    <i data-lucide="calendar" size="18"></i>
                    <div>
                        <p>Departure Date</p>
                        <span>{{ \Carbon\Carbon::parse($schedule->departure)->format('d M Y, H:i') }}</span>
                    </div>
                </div>
                <div class="detail-item">
                    <i data-lucide="armchair" size="18"></i>
                    <div>
                        <p>Seats</p>
                        <span>{{ $schedule->stock }} left</span>
                    </div>
                </div>
                <div class="detail-item">
                    <i data-lucide="tag" size="18"></i>
                    <div>
                        <p>Price</p>
                        <span>Rp {{ number_format($schedule->price) }}</span>
                    </div>
                </div>
                <div class="detail-item">
                    <i data-lucide="info" size="18"></i>
                    <div>
                        <p>Class</p>
                        <span>Economy Premium</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="booking-card">
            <h3>Pemesanan Tiket</h3>
            <form action="/booking/{{ $schedule->id }}" method="POST">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-size:0.8rem; font-weight:700; margin-bottom:10px;">Jumlah Penumpang</label>
                    <input type="number" name="total_seats" id="jumlah_kursi" min="1" max="{{ $schedule->stock }}" placeholder="0" required>
                </div>

                <div class="summary">
                    <div class="summary-item">
                        <span>Price per seat</span>
                        <span>Rp {{ number_format($schedule->price) }}</span>
                    </div>
                    <div class="summary-total">
                        <span>Total Harga</span>
                        <span id="total_harga">Rp 0</span>
                    </div>
                </div>

                <button type="submit" class="btn-order">
                    Pesan Sekarang
                    <i data-lucide="chevron-right" size="20"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const jumlahKursiInput = document.getElementById('jumlah_kursi');
        const totalHargaEl = document.getElementById('total_harga');
        const pricePerSeat = {{ $schedule->price }};

        jumlahKursiInput.addEventListener('input', function() {
            const jumlah = parseInt(this.value) || 0;
            const total = jumlah * pricePerSeat;
            totalHargaEl.innerText = "Rp " + total.toLocaleString('id-ID');
        });
    </script>
</body>
</html>
