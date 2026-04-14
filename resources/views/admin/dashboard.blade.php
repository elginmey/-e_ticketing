<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #4f46e5;
            --primary-soft: #eef2ff;
            --success: #10b981;
            --danger: #ef4444;
            --text-main: #0f172a;
            --text-light: #64748b;
            --white: #ffffff;
            --bg-gradient: radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.08) 0px, transparent 50%),
                           radial-gradient(at 100% 100%, rgba(6, 182, 212, 0.08) 0px, transparent 50%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f8fafc;
            background-image: var(--bg-gradient);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--text-main);
            text-decoration: none;
        }

        .brand i { color: var(--primary); }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout-btn {
            color: var(--danger);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 8px 16px;
            border-radius: 12px;
            transition: 0.3s;
        }

        .logout-btn:hover { background: #fef2f2; }

        /* MAIN CONTAINER */
        .container {
            padding: 40px 5%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-header h1 { font-size: 1.75rem; font-weight: 800; }

        /* STATS CARDS (Optional, untuk mempercantik dashboard) */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 24px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.02);
            border: 1px solid #f1f5f9;
        }

        /* DATA CARD / TABLE AREA */
        .card {
            background: white;
            border-radius: 32px;
            padding: 30px;
            box-shadow: 0 20px 50px -15px rgba(0,0,0,0.04);
            border: 1px solid rgba(255,255,255,1);
            margin-bottom: 40px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .card-header h3 { font-weight: 800; color: var(--text-main); }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
            border: none;
        }

        .btn-add { background: var(--primary); color: white; }
        .btn-edit { background: var(--primary-soft); color: var(--primary); }
        .btn-delete { background: #fff1f2; color: var(--danger); }
        .btn-confirm { background: var(--success); color: white; }
        .btn-view { background: #f8fafc; color: var(--text-light); border: 1px solid #e2e8f0; }

        .btn:hover { transform: translateY(-2px); filter: brightness(0.95); }

        /* TABLE STYLING */
        .table-container { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        th {
            text-align: left;
            padding: 0 20px;
            color: var(--text-light);
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }

        td {
            background: white;
            padding: 20px;
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
            font-weight: 600;
        }

        td:first-child { border-left: 1px solid #f1f5f9; border-radius: 16px 0 0 16px; }
        td:last-child { border-right: 1px solid #f1f5f9; border-radius: 0 16px 16px 0; }

        tr:hover td { background: #f8fafc; }

        /* BADGES */
        .badge {
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
        }
        .badge-pending { background: #fff7ed; color: #f97316; }
        .badge-success { background: #f0fdf4; color: var(--success); }

        /* IMAGE THUMBNAIL (Bukti Pembayaran) */
        .img-thumb {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .img-thumb:hover { transform: scale(1.2); }

    </style>
</head>
<body>

    <nav class="navbar">
        <a href="#" class="brand">
            <i data-lucide="layout-dashboard"></i>
            AirFlight Admin
        </a>
        <div class="nav-user">
            <span style="font-weight: 700; font-size: 0.85rem;">Halo, Administrator</span>
            <a href="/logout" class="logout-btn">Logout</a>
        </div>
    </nav>

    <div class="container">

        <div class="page-header">
            <h1>Dashboard Overview</h1>
            <a href="/admin/schedules/create" class="btn btn-add">
                <i data-lucide="plus" size="18"></i> Tambah Jadwal Baru
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Jadwal Penerbangan</h3>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Pesawat</th>
                            <th>Rute</th>
                            <th>Keberangkatan</th>
                            <th>Harga</th>
                            <th>Sisa Kursi</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $s)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="padding: 8px; background: var(--primary-soft); border-radius: 8px; color: var(--primary);">
                                        <i data-lucide="plane" size="16"></i>
                                    </div>
                                    {{ $s->plane_name }}
                                </div>
                            </td>
                            <td>{{ $s->origin }} <i data-lucide="arrow-right" size="14" style="margin: 0 5px; color: #cbd5e1;"></i> {{ $s->destination }}</td>
                            <td>{{ \Carbon\Carbon::parse($s->departure)->format('d M Y, H:i') }}</td>
                            <td style="color: var(--primary);">Rp {{ number_format($s->price) }}</td>
                            <td>{{ $s->stock }} Kursi</td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="/admin/schedules/edit/{{ $s->id }}" class="btn btn-edit" title="Edit">
                                        <i data-lucide="edit-3" size="16"></i>
                                    </a>
                                    <a href="/admin/schedules/delete/{{ $s->id }}" class="btn btn-delete" title="Hapus" onclick="return confirm('Hapus jadwal ini?')">
                                        <i data-lucide="trash-2" size="16"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" style="text-align: center; color: var(--text-light); padding: 40px;">Belum ada jadwal penerbangan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card" style="border-top: 4px solid var(--primary);">
            <div class="card-header">
                <h3>Menunggu Konfirmasi</h3>
                <span class="badge badge-pending">{{ count($pendingBookings) }} Pending</span>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Pemesan</th>
                            <th>Flight</th>
                            <th>Total</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingBookings as $b)
                        <tr>
                            <td>
                                <div style="font-weight: 700;">{{ $b->user->name }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-light);">ID: #{{ $b->id }}</div>
                            </td>
                            <td>{{ $b->schedule->plane_name }} ({{ $b->total_seats }} Kursi)</td>
                            <td style="font-weight: 800;">Rp {{ number_format($b->total_price) }}</td>
                            <td>
                                @if($b->bukti_pembayaran)
                                    <img src="{{ asset('storage/'.$b->bukti_pembayaran) }}" class="img-thumb" alt="Bukti">
                                @else
                                    <span style="font-size: 0.7rem; color: var(--danger);">Tanpa Bukti</span>
                                @endif
                            </td>
                            <td><span class="badge badge-pending">Pending</span></td>
                            <td style="text-align: center;">
                                <form action="/admin/bookings/{{ $b->id }}/confirm" method="POST" style="margin:0;">
                                    @csrf
                                    <button class="btn btn-confirm" type="submit">
                                        <i data-lucide="check-circle" size="16"></i> Konfirmasi
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" style="text-align: center; color: var(--text-light); padding: 40px;">Tidak ada pesanan yang perlu dikonfirmasi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Riwayat Transaksi Berhasil</h3>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pemesan</th>
                            <th>Rute</th>
                            <th>Total Bayar</th>
                            <th>Waktu Transaksi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($confirmedBookings as $b)
                        <tr>
                            <td>#{{ $b->id }}</td>
                            <td>{{ $b->user->name }}</td>
                            <td>{{ $b->schedule->origin }} → {{ $b->schedule->destination }}</td>
                            <td>Rp {{ number_format($b->total_price) }}</td>
                            <td style="color: var(--text-light); font-size: 0.8rem;">{{ $b->created_at->format('d/m/Y H:i') }}</td>
                            <td><span class="badge badge-success">Selesai</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
