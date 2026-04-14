<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airflight login</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            /* BACKGROUND BERDIMENSI (Mesh Gradient) */
            background-color: #e2e8f0;
            background-image:
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(236, 72, 153, 0.08) 0px, transparent 50%);
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            width: 100%;
            max-width: 420px;
            padding: 40px;
            border-radius: 32px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            /* LAYERED SHADOW UNTUK DIMENSI CARD */
            box-shadow:
                0 10px 25px -5px rgba(0, 0, 0, 0.05),
                0 25px 50px -12px rgba(99, 102, 241, 0.15);
            animation: slideUp 0.6s ease-out;
        }

        .login-card::before {
            content: "";
            position: absolute;
            top: -20px;
            right: -20px;
            width: 80px;
            height: 80px;
            background: var(--primary);
            border-radius: 20px;
            z-index: -1;
            opacity: 0.2;
            transform: rotate(15deg);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* LOGO BOX SEPERTI SEBELUMNYA */
        .logo-box {
            background: var(--primary);
            width: 54px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border-radius: 16px;
            margin: 0 auto 20px;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h2 {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.5px;
        }

        /* FORM INPUT */
        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
            margin-left: 4px;
        }

        /* INPUT ROW DENGAN IKON DI SAMPING */
        .input-row {
            display: flex;
            align-items: center;
            background: rgba(248, 250, 252, 0.8);
            border: 2px solid #eef2f6;
            border-radius: 16px;
            padding: 0 16px;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 4px 0 rgba(0,0,0,0.03);
        }

        .input-row i {
            color: #94a3b8;
            transition: 0.3s;
        }

        .input-row input {
            flex: 1;
            padding: 14px 12px;
            border: none;
            outline: none;
            background: transparent;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .input-row:focus-within {
            background: #ffffff;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -6px rgba(99, 102, 241, 0.15);
        }

        .input-row:focus-within i {
            color: var(--primary);
        }

        /* TOMBOL BERDIMENSI */
        .btn-login {
            width: 100%;
            background: var(--primary);
            color: white;
            padding: 16px;
            border: none;
            border-radius: 16px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 0 0 #4338ca;
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: #5558e3;
            transform: translateY(-1px);
            box-shadow: 0 5px 0 0 #4338ca;
        }

        .btn-login:active {
            transform: translateY(3px);
            box-shadow: 0 1px 0 0 #4338ca;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="header">
            <div class="logo-box">
                <i data-lucide="ticket" size="28"></i>
            </div>
            <h2>Airflight Account</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 4px;">Akses perjalanan Anda sekarang</p>
        </div>

        <form action="/login" method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <div class="input-row">
                    <i data-lucide="mail" size="18"></i>
                    <input type="email" name="email" placeholder="nama@email.com" required>
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-row">
                    <i data-lucide="lock" size="18"></i>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Masuk Sekarang
                <i data-lucide="arrow-right" size="18"></i>
            </button>
        </form>

        <div class="footer">
            Belum punya akun? <a href="/register">Daftar Sekarang</a>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
