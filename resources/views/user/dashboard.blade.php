<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirFlight | Explorer Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #06b6d4;
            --accent: #f43f5e;
            --surface: rgba(255, 255, 255, 0.8);
            --text-main: #0f172a;
            --text-sub: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            color: var(--text-main);
            /* Menggunakan warna dasar yang sedikit lebih dalam agar putih card lebih kontras */
            background-color: #e2e8f0;
            background-image:
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(236, 72, 153, 0.1) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(255, 255, 255, 0.3) 0px, transparent 80%);
            background-attachment: fixed;
        }

        /* NAVBAR REDESIGN */
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
        }

        .brand i {
            color: var(--primary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn-history {
            text-decoration: none;
            color: var(--text-sub);
            font-size: 0.9rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-logout {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444 !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #ef4444 !important;
            color: white !important;
            transform: scale(1.05);
        }

        /* MAIN LAYOUT */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 24px;
        }

        .welcome-section {
            margin-bottom: 48px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .welcome-text h1 {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -1.5px;
            line-height: 1.1;
        }

        .welcome-text h1 span {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* CLEAN TICKET CARD */
        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 30px;
        }

        .flight-card {
            /* Gunakan putih solid atau glassmorphism yang sangat terang */
            background: #ffffff;
            border-radius: 28px;
            padding: 24px;
            /* Border tipis tapi tegas */
            border: 1px solid rgba(99, 102, 241, 0.1);

            /* SHADOW BARU: Layered Shadow untuk efek kedalaman nyata */
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.05),
                0 20px 25px -5px rgba(0, 0, 0, 0.05),
                0 10px 10px -5px rgba(0, 0, 0, 0.02);

            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .flight-card:hover {
            transform: translateY(-12px) scale(1.02);
            /* Sedikit membesar saat hover */
            background: #ffffff;
            border-color: var(--primary);

            /* Shadow saat hover dibuat lebih lebar dan berwarna soft indigo */
            box-shadow:
                0 30px 60px -15px rgba(99, 102, 241, 0.25);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .airline-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .airline-logo {
            width: 40px;
            height: 40px;
            background: #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .airline-name {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--text-main);
        }

        .seat-badge {
            background: #f0fdf4;
            color: #16a34a;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* TRIP VISUAL */
        .trip-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            position: relative;
        }

        .loc-box {
            flex: 1;
        }

        .loc-box.end {
            text-align: right;
        }

        .city-code {
            font-size: 1.2rem;
            font-weight: 800;
            line-height: 1.2;
            color: var(--text-main);
            display: block;
        }

        .city-name {
            font-size: 0.7rem;
            color: var(--text-sub);
            font-weight: 500;
        }

        .flight-path {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 10px;
        }

        .path-line {
            width: 100%;
            height: 2px;
            background: #f1f5f9;
            /* Garis lebih halus */
            position: relative;
            margin: 8px 0;
        }

        .path-line::after {
            content: '';
            position: absolute;
            right: 0;
            top: -3px;
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
        }

        .flight-path i {
            color: var(--primary);
            transform: rotate(90deg);
        }

        /* CARD BOTTOM */
        .card-info-row {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            padding: 15px 0;
            border-top: 1px dashed #e2e8f0;
        }

        .info-item span {
            display: block;
            font-size: 0.65rem;
            color: var(--text-sub);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .info-item p {
            font-size: 0.85rem;
            font-weight: 700;
        }

        .card-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .price-tag {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .price-tag small {
            font-size: 0.8rem;
            color: var(--text-sub);
            font-weight: 400;
        }

        .btn-reserve {
            background: var(--primary);
            box-shadow: 0 8px 15px rgba(79, 70, 229, 0.2);
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 0.8rem;
            transition: 0.3s;
        }

        .btn-reserve:hover {
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4);
            transform: scale(1.02);
        }

        @media (max-width: 768px) {
            .welcome-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .schedule-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="brand">
            <i data-lucide="plane-takeoff" size="28"></i>
            <span>AirFlight</span>
        </div>
        <div class="nav-actions">
            <a href="/history" class="btn-history">History</a>
            <a href="/logout" class="btn-logout">Log Out</a>
        </div>
    </nav>

    <div class="container">
        <header class="welcome-section">
            <div class="welcome-text">
                <h1>Halo, <span>{{ Auth::user()->name }}</span></h1>
                <p style="color: var(--text-sub); margin-top: 8px; font-weight: 500;">Mau terbang ke mana kita hari ini?
                </p>
            </div>
        </header>

        <div class="schedule-grid">
            @forelse ($schedules as $item)
                <div class="flight-card">
                    <div class="card-top">
                        <div class="airline-info">
                            <div class="airline-logo">
                                <i data-lucide="shield-check" size="20"></i>
                            </div>
                            <span class="airline-name">{{ $item->plane_name }}</span>
                        </div>
                        <div class="seat-badge">
                            <i data-lucide="armchair" size="14"></i>
                            {{ $item->stock }} Left
                        </div>
                    </div>

                    <div class="trip-details">
                        <div class="loc-box">
                            <span class="city-code">{{ $item->origin }}</span>
                            <span class="city-name" style="display: block; max-width: 80px; line-height: 1.2;">
                                {{ $item->origin_name }}
                            </span>
                        </div>

                        <div class="flight-path">
                            <i data-lucide="plane" size="16"></i>
                            <div class="path-line"></div>
                            <span style="font-size: 0.6rem; letter-spacing: 0.5px;">DIRECT</span>
                        </div>

                        <div class="loc-box end">
                            <span class="city-code">{{ $item->destination }}</span>
                            <span class="city-name" style="display: block; max-width: 80px; line-height: 1.2;">
                                {{ $item->destination_name }}
                            </span>
                        </div>
                    </div>

                    <div class="card-info-row">
                        <div class="info-item">
                            <span>Date & Time</span>
                            <p>{{ \Carbon\Carbon::parse($item->departure)->format('D, d M • H:i') }}</p>
                        </div>
                    </div>

                    <div class="card-action">
                        <div class="price-tag">
                            <small>IDR</small> {{ number_format($item->price, 0, ',', '.') }}
                        </div>
                        <a href="/booking/{{ $item->id }}" class="btn-reserve">Book Seat</a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 100px 0;">
                    <i data-lucide="wind" size="48" style="color: #cbd5e1; margin-bottom: 20px;"></i>
                    <p style="color: var(--text-sub); font-weight: 600;">Belum ada jadwal tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
