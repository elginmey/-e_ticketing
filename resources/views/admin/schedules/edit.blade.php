<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Penerbangan | FlyHigh Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-canvas: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --glass: rgba(255, 255, 255, 0.8);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-canvas);
            background-image:
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(6, 182, 212, 0.08) 0px, transparent 50%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR / TOP BAR */
        .top-bar {
            padding: 20px 40px;
            display: flex;
            align-items: center;
        }

        .btn-back {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.9rem;
            transition: 0.3s;
            background: white;
            padding: 10px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .btn-back:hover {
            color: var(--primary);
            transform: translateX(-5px);
        }

        /* MAIN CONTENT */
        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .edit-card {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 1);
            width: 100%;
            max-width: 550px;
            padding: 40px;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        }

        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .header h2 {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.025em;
        }

        .header p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-top: 8px;
        }

        /* FORM STYLING */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .full-width {
            grid-column: span 2;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
            margin-left: 4px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            color: var(--text-muted);
        }

        input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            background: white;
            font-size: 0.95rem;
            color: var(--text-main);
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        /* BUTTON */
        .btn-update {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 18px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .btn-update:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.25);
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .full-width {
                grid-column: span 1;
            }
            .edit-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="top-bar">
        <a href="/dashboard" class="btn-back">
            <i data-lucide="chevron-left" size="18"></i>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="container">
        <div class="edit-card">
            <div class="header">
                <h2>Edit Jadwal</h2>
                <p>Perbarui informasi penerbangan FlyHigh</p>
            </div>

            <form action="/admin/schedules/update/{{ $schedule->id }}" method="POST">
                @csrf
                <div class="form-grid">

                    <div class="form-group full-width">
                        <label>Nama Pesawat</label>
                        <div class="input-wrapper">
                            <i data-lucide="plane"></i>
                            <input type="text" name="plane_name" value="{{ $schedule->plane_name }}" placeholder="Contoh: FlyHigh Air A320" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kota Asal</label>
                        <div class="input-wrapper">
                            <i data-lucide="map-pin"></i>
                            <input type="text" name="origin" value="{{ $schedule->origin }}" placeholder="Asal" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Kota Tujuan</label>
                        <div class="input-wrapper">
                            <i data-lucide="navigation"></i>
                            <input type="text" name="destination" value="{{ $schedule->destination }}" placeholder="Tujuan" required>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label>Waktu Keberangkatan</label>
                        <div class="input-wrapper">
                            <i data-lucide="calendar"></i>
                            <input
                                type="datetime-local"
                                name="departure"
                                value="{{ date('Y-m-d\TH:i', strtotime($schedule->departure)) }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Harga Tiket (Rp)</label>
                        <div class="input-wrapper">
                            <i data-lucide="banknote"></i>
                            <input type="number" name="price" value="{{ $schedule->price }}" placeholder="Harga" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Sisa Kursi</label>
                        <div class="input-wrapper">
                            <i data-lucide="armchair"></i>
                            <input type="number" name="stock" value="{{ $schedule->stock }}" placeholder="Stock" required>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn-update">
                    <i data-lucide="save" size="20"></i>
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
