<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket | FlyHigh</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #4f46e5;
            --bg: #f1f5f9;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --white: #ffffff;
            --success: #22c55e;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* NAVIGATION */
        .nav-container {
            width: 100%;
            max-width: 500px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .btn-nav {
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }

        .btn-nav:hover { color: var(--primary); }
        .btn-logout { color: #ef4444; }

        /* TICKET STRUCTURE */
        .ticket-card {
            background: var(--white);
            width: 100%;
            max-width: 450px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);
            position: relative;
        }

        .ticket-top {
            padding: 32px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: white;
            text-align: center;
        }

        .ticket-top h2 {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .ticket-body {
            padding: 32px;
            position: relative;
        }

        /* PERFORATION EFFECT */
        .perforation {
            display: flex;
            align-items: center;
            margin: 10px 0;
            position: relative;
        }

        .perforation::before, .perforation::after {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            background: var(--bg);
            border-radius: 50%;
            z-index: 2;
        }

        .perforation::before { left: -44px; }
        .perforation::after { right: -44px; }

        .dashed-line {
            flex-grow: 1;
            border-bottom: 2px dashed #e2e8f0;
        }

        /* CONTENT STYLING */
        .booking-code-box {
            text-align: center;
            margin-bottom: 24px;
        }

        .booking-code-box span {
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .booking-code-box h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: 2px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
            display: block;
        }

        .value {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .route-display {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            padding: 16px;
            border-radius: 16px;
            margin-bottom: 24px;
        }

        .city-code {
            text-align: center;
        }

        .city-code h3 { font-size: 1.25rem; font-weight: 800; }
        .city-code p { font-size: 0.75rem; color: var(--text-muted); }

        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-lunas { background: #dcfce7; color: #166534; }
        .status-pending { background: #fef9c3; color: #854d0e; }

        .qr-mockup {
            text-align: center;
            margin-top: 10px;
            opacity: 0.8;
        }

        /* PRINT BUTTON */
        .btn-print {
            margin-top: 24px;
            background: var(--white);
            border: 1px solid #e2e8f0;
            padding: 12px 24px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
        }

        .btn-print:hover { background: #f8fafc; border-color: var(--primary); color: var(--primary); }

        /* PRINT OPTIMIZATION */
        @media print {
            .nav-container, .btn-print { display: none; }
            body { padding: 0; background: white; }
            .ticket-card { box-shadow: none; border: 1px solid #eee; }
            .perforation::before, .perforation::after { background: white; border: 1px solid #eee; }
        }
    </style>
</head>

<body>

    <div class="nav-container">
        <a href="/dashboard" class="btn-nav"><i data-lucide="arrow-left" size="18"></i> Dashboard</a>
        <a href="/logout" class="btn-nav btn-logout"><i data-lucide="log-out" size="18"></i> Logout</a>
    </div>

    <div class="ticket-card">
        <div class="ticket-top">
            <h2>Boarding Pass</h2>
        </div>

        <div class="ticket-body">
            <div class="booking-code-box">
                <span>Booking Code</span>
                <h1>{{ $booking->kode_booking ?? 'WAITING' }}</h1>
            </div>

            <div class="route-display">
                <div class="city-code">
                    <h3>{{ strtoupper(substr($booking->schedule->origin, 0, 3)) }}</h3>
                    <p>{{ $booking->schedule->origin }}</p>
                </div>
                <div style="color: var(--primary); display: flex; flex-direction: column; align-items: center;">
                    <i data-lucide="plane" size="20"></i>
                    <div style="width: 60px; height: 1px; background: #e2e8f0; margin-top: 4px;"></div>
                </div>
                <div class="city-code">
                    <h3>{{ strtoupper(substr($booking->schedule->destination, 0, 3)) }}</h3>
                    <p>{{ $booking->schedule->destination }}</p>
                </div>
            </div>

            <div class="info-grid">
                <div>
                    <span class="label">Passenger</span>
                    <span class="value">{{ $booking->user->name }}</span>
                </div>
                <div style="text-align: right;">
                    <span class="label">Seats</span>
                    <span class="value">{{ $booking->total_seats }} Person</span>
                </div>
                <div>
                    <span class="label">Airline</span>
                    <span class="value">{{ $booking->schedule->plane_name }}</span>
                </div>
                <div style="text-align: right;">
                    <span class="label">Status</span>
                    <span class="status-pill status-{{ $booking->status }}">
                        {{ $booking->status }}
                    </span>
                </div>
            </div>

            <div class="perforation">
                <div class="dashed-line"></div>
            </div>

            <div class="info-grid" style="margin-top: 24px;">
                <div>
                    <span class="label">Payment Method</span>
                    <span class="value">{{ $booking->metode_pembayaran }}</span>
                </div>
                <div style="text-align: right;">
                    <span class="label">Total Paid</span>
                    <span class="value" style="color: var(--primary); font-size: 1.1rem;">Rp {{ number_format($booking->total_price) }}</span>
                </div>
            </div>
        </div>
    </div>

    <button class="btn-print" onclick="window.print()">
        <i data-lucide="printer" size="18"></i> Cetak Tiket
    </button>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
