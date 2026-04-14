<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan | FlyHigh</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #4f46e5;
            --primary-soft: #eef2ff;
            --bg-canvas: #f1f5f9;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: var(--bg-canvas);
            background-image:
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(236, 72, 153, 0.05) 0px, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px; /* Sedikit diperlebar untuk mengakomodasi kolom baru */
            margin: 0 auto;
        }

        /* HEADER SECTION */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 30px;
            padding: 0 10px;
        }

        .header-title h2 {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: var(--text-main);
        }

        .header-title p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-top: 4px;
        }

        .btn-back {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--primary);
            font-weight: 700;
            font-size: 0.9rem;
            padding: 10px 16px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        /* TABLE CARD */
        .table-card {
            background: var(--card-bg);
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th {
            padding: 20px;
            text-align: left;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 700;
            border-bottom: 1px solid var(--border-color);
            background: #f8fafc;
        }

        td {
            padding: 20px;
            font-size: 0.9rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        /* BUKTI PEMBAYARAN STYLING */
        .proof-thumb {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .proof-thumb:hover {
            transform: scale(1.15);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
        }

        .no-proof {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-style: italic;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* LIGHTBOX MODAL */
        #imgModal {
            display: none;
            position: fixed;
            z-index: 999;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.9);
            align-items: center;
            justify-content: center;
        }

        #imgModal img {
            max-width: 90%;
            max-height: 80%;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
        }

        /* EXISTING STYLES */
        .plane-name { font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .route-path { display: flex; align-items: center; gap: 8px; font-weight: 600; }
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 10px; font-size: 0.75rem; font-weight: 700; }
        .badge-success { background: #ecfdf5; color: #059669; }
        .badge-pending { background: #fffbeb; color: #d97706; }
        .price-tag { font-weight: 700; color: var(--primary); }
    </style>
</head>

<body>

    <div id="imgModal" onclick="this.style.display='none'">
        <img id="modalContent" src="">
    </div>

    <div class="container">
        <div class="header">
            <div class="header-title">
                <h2>Riwayat Pemesanan</h2>
                <p>Kelola dan pantau semua perjalanan Anda</p>
            </div>
            <a href="/dashboard" class="btn-back">
                <i data-lucide="layout-grid" size="18"></i>
                Dashboard
            </a>
        </div>

        <div class="table-card">
            <div class="table-responsive">
                @if ($orders->isEmpty())
                    <div class="empty-view" style="padding: 60px; text-align: center;">
                        <i data-lucide="database-zap" size="48" style="color: #cbd5e1; margin-bottom: 16px;"></i>
                        <p>Belum ada riwayat pemesanan yang tercatat.</p>
                    </div>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Pesawat</th>
                                <th>Rute Perjalanan</th>
                                <th>Total Bayar</th>
                                <th>Bukti Bayar</th> <th>Status</th>
                                <th>Waktu Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td>
                                        <div class="plane-name">
                                            <div style="background: var(--primary-soft); padding: 8px; border-radius: 8px; color: var(--primary)">
                                                <i data-lucide="plane" size="16"></i>
                                            </div>
                                            {{ $item->schedule->plane_name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="route-path">
                                            <span>{{ $item->schedule->origin }}</span>
                                            <i data-lucide="arrow-right" size="14"></i>
                                            <span>{{ $item->schedule->destination }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="price-tag">Rp{{ number_format($item->total_price, 0, ',', '.') }}</span>
                                    </td>

                                    <td>
                                        @if($item->bukti_pembayaran)
                                            <img src="{{ asset('storage/' . $item->bukti_pembayaran) }}"
                                                 class="proof-thumb"
                                                 title="Klik untuk memperbesar"
                                                 onclick="showImg('{{ asset('storage/' . $item->bukti_pembayaran) }}')">
                                        @else
                                            <div class="no-proof">
                                                <i data-lucide="image-off" size="14"></i> Belum ada
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge {{ $item->status == 'Success' ? 'badge-success' : 'badge-pending' }}">
                                            <span style="width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="font-size: 0.85rem; font-weight: 600;">{{ $item->created_at->format('d M Y') }}</div>
                                        <div style="font-size: 0.7rem; color: var(--text-muted)">{{ $item->created_at->format('H:i') }} WIB</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Fungsi Lightbox
        function showImg(src) {
            const modal = document.getElementById('imgModal');
            const modalImg = document.getElementById('modalContent');
            modal.style.display = "flex";
            modalImg.src = src;
        }
    </script>
</body>
</html>
