<?php
// app/views/auth/register.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Toko Tas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-register {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 440px;
        }
        .brand-icon {
            width: 56px;
            height: 56px;
            background-color: #3d3d3a;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }
        .btn-register {
            background-color: #3d3d3a;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.2s;
        }
        .btn-register:hover {
            background-color: #2c2c2a;
        }
        .form-control {
            border-radius: 10px;
            padding: 11px 14px;
            border: 1.5px solid #e0dfd8;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #3d3d3a;
            box-shadow: 0 0 0 3px rgba(61,61,58,0.1);
        }
        .input-group-text {
            border-radius: 0 10px 10px 0;
            border: 1.5px solid #e0dfd8;
            border-left: none;
            background-color: #fff;
            color: #888;
            cursor: pointer;
        }
        .input-group .form-control {
            border-right: none;
            border-radius: 10px 0 0 10px;
        }
        .password-hint {
            font-size: 12px;
            color: #aaa;
            margin-top: 4px;
        }
        .strength-bar {
            height: 4px;
            border-radius: 4px;
            background: #e0dfd8;
            margin-top: 6px;
            overflow: hidden;
        }
        .strength-fill {
            height: 100%;
            border-radius: 4px;
            width: 0%;
            transition: width 0.3s, background-color 0.3s;
        }
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #aaa;
            font-size: 13px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e0dfd8;
        }
    </style>
</head>
<body>

<div class="card-register card p-4 p-md-5 mx-3">

    <!-- Brand -->
    <div class="text-center mb-4">
        <div class="brand-icon">
            <i class="bi bi-bag-heart-fill text-white fs-4"></i>
        </div>
        <h5 class="fw-semibold mb-1">Buat Akun Baru</h5>
        <p class="text-muted small mb-0">Bergabung dan mulai belanja tas favoritmu</p>
    </div>

    <!-- Alert error -->
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger d-flex align-items-center gap-2 py-2 px-3 mb-3" style="border-radius:10px; font-size:14px;">
            <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Form Register -->
  <form action="index.php?controller=auth&action=register" method="POST" id="formRegister">

        <!-- Nama Lengkap -->
        <div class="mb-3">
            <label class="form-label small fw-medium text-dark">Nama Lengkap</label>
            <input
                type="text"
                name="nama"
                class="form-control"
                placeholder="Masukkan nama lengkap"
                value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>"
                required
                autofocus
            >
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label small fw-medium text-dark">Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                placeholder="contoh@email.com"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                required
            >
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label small fw-medium text-dark">Password</label>
            <div class="input-group">
                <input
                    type="password"
                    name="password"
                    id="passwordInput"
                    class="form-control"
                    placeholder="Minimal 6 karakter"
                    oninput="checkStrength(this.value)"
                    required
                >
                <span class="input-group-text" onclick="togglePassword('passwordInput', 'eyeIcon1')">
                    <i class="bi bi-eye" id="eyeIcon1"></i>
                </span>
            </div>
            <!-- Indikator kekuatan password -->
            <div class="strength-bar">
                <div class="strength-fill" id="strengthFill"></div>
            </div>
            <p class="password-hint" id="strengthText">Masukkan password</p>
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-4">
            <label class="form-label small fw-medium text-dark">Konfirmasi Password</label>
            <div class="input-group">
                <input
                    type="password"
                    name="konfirm_password"
                    id="konfirmInput"
                    class="form-control"
                    placeholder="Ulangi password"
                    oninput="checkMatch()"
                    required
                >
                <span class="input-group-text" onclick="togglePassword('konfirmInput', 'eyeIcon2')">
                    <i class="bi bi-eye" id="eyeIcon2"></i>
                </span>
            </div>
            <p class="password-hint" id="matchText"></p>
        </div>

        <!-- Pilihan Role -->
<!-- Pilihan Role (Hanya Pembeli) -->
<div class="mb-4">
    <label class="form-label small fw-medium text-dark">Daftar Sebagai</label>
    <div class="d-flex gap-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="rolePembeli" value="pembeli" checked>
            <label class="form-check-label" for="rolePembeli">
                🛒 Pembeli
            </label>
        </div>
        <!-- Pilihan Admin DIHAPUS -->
    </div>
    <small class="text-muted" style="font-size: 12px;">Saat ini hanya pendaftaran untuk pembeli</small>
</div>

        <!-- Tombol Register -->
        <button type="submit" class="btn btn-register btn-dark w-100 text-white mb-3">
            <i class="bi bi-person-plus me-1"></i> Buat Akun
        </button>

        <!-- Divider -->
        <div class="divider mb-3">atau</div>

        <!-- Link Login -->
        <p class="text-center small mb-0">
            Sudah punya akun?
            <a href="index.php?controller=auth&action=login" class="text-dark fw-semibold text-decoration-none">Masuk di sini</a>
        </p>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Show / hide password
    function togglePassword(inputId, iconId) {
        const input  = document.getElementById(inputId);
        const icon   = document.getElementById(iconId);
        const hidden = input.type === 'password';
        input.type   = hidden ? 'text' : 'password';
        icon.className = hidden ? 'bi bi-eye-slash' : 'bi bi-eye';
    }

    // Indikator kekuatan password
    function checkStrength(val) {
        const fill = document.getElementById('strengthFill');
        const text = document.getElementById('strengthText');
        let score  = 0;

        if (val.length >= 6)  score++;
        if (val.length >= 10) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const levels = [
            { pct: '0%',   color: '#e0dfd8', label: 'Masukkan password' },
            { pct: '25%',  color: '#E24B4A', label: 'Lemah' },
            { pct: '50%',  color: '#EF9F27', label: 'Cukup' },
            { pct: '75%',  color: '#639922', label: 'Kuat' },
            { pct: '100%', color: '#1D9E75', label: 'Sangat kuat' },
        ];

        const lvl = levels[Math.min(score, 4)];
        fill.style.width           = lvl.pct;
        fill.style.backgroundColor = lvl.color;
        text.textContent           = lvl.label;
        text.style.color           = lvl.color;

        checkMatch();
    }

    // Cek kecocokan password
    function checkMatch() {
        const pass    = document.getElementById('passwordInput').value;
        const konfirm = document.getElementById('konfirmInput').value;
        const text    = document.getElementById('matchText');

        if (konfirm === '') {
            text.textContent = '';
            return;
        }
        if (pass === konfirm) {
            text.textContent  = '✓ Password cocok';
            text.style.color  = '#1D9E75';
        } else {
            text.textContent  = '✗ Password tidak cocok';
            text.style.color  = '#E24B4A';
        }
    }

    // Cegah submit jika password tidak cocok
    document.getElementById('formRegister').addEventListener('submit', function(e) {
        const pass    = document.getElementById('passwordInput').value;
        const konfirm = document.getElementById('konfirmInput').value;
        if (pass !== konfirm) {
            e.preventDefault();
            document.getElementById('matchText').textContent = '✗ Password tidak cocok, periksa kembali';
            document.getElementById('matchText').style.color = '#E24B4A';
            document.getElementById('konfirmInput').focus();
        }
    });
</script>

</body>
</html>
