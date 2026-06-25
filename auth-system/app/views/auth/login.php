<?php
// app/views/auth/login.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Toko Tas</title>
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
        .card-login {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 420px;
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
        .btn-login {
            background-color: #3d3d3a;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.2s;
        }
        .btn-login:hover {
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

<div class="card-login card p-4 p-md-5 mx-3">

    <!-- Brand -->
    <div class="text-center mb-4">
        <div class="brand-icon">
            <i class="bi bi-bag-heart-fill text-white fs-4"></i>
        </div>
        <h5 class="fw-semibold mb-1">Masuk ke Akun</h5>
        <p class="text-muted small mb-0">Toko Tas — Temukan tas impianmu</p>
    </div>

    <!-- Alert error -->
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger d-flex align-items-center gap-2 py-2 px-3 mb-3" style="border-radius:10px; font-size:14px;">
            <i class="bi bi-exclamation-circle-fill"></i>
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Alert success (dari register) -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success d-flex align-items-center gap-2 py-2 px-3 mb-3" style="border-radius:10px; font-size:14px;">
            <i class="bi bi-check-circle-fill"></i>
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Form Login -->
    <form action="index.php?controller=auth&action=login" method="POST">

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
                autofocus
            >
        </div>

        <!-- Password -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label class="form-label small fw-medium text-dark mb-0">Password</label>
            </div>
            <div class="input-group">
                <input
                    type="password"
                    name="password"
                    id="passwordInput"
                    class="form-control"
                    placeholder="Masukkan password"
                    required
                >
                <span class="input-group-text" onclick="togglePassword()">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </span>
            </div>
        </div>

        <!-- Tombol Login -->
        <button type="submit" class="btn btn-login btn-dark w-100 text-white mb-3">
            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
        </button>

        <!-- Divider -->
        <div class="divider mb-3">atau</div>

        <!-- Link Register -->
        <p class="text-center small mb-0">
            Belum punya akun?
            <a href="index.php?controller=auth&action=register" class="text-dark fw-semibold text-decoration-none">Daftar sekarang</a>
        </p>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const input   = document.getElementById('passwordInput');
        const icon    = document.getElementById('eyeIcon');
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
    }
</script>

</body>
</html>