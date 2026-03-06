<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota | Koperasi Kita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body, html { height: 100%; margin: 0; font-family: 'Segoe UI', sans-serif; }
        .bg {
            background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1350&q=80');
            height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover;
            display: flex; align-items: center; justify-content: center;
        }
        .register-box {
            width: 100%; max-width: 450px; padding: 40px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); border-radius: 15px; text-align: center;
        }
        .logo-koperasi { width: 80px; margin-bottom: 15px; }
        .form-control { background: #f1f3f5; border: none; border-radius: 5px; padding: 12px; height: auto; }
        .btn-register { background-color: #00b894; border: none; color: white; padding: 12px; font-weight: bold; transition: 0.3s; }
        .btn-register:hover { background-color: #009678; transform: scale(1.02); color: white; }
        .input-group-text { background: #f1f3f5; border: none; cursor: pointer; }
        .auth-footer a { color: #00b894; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
<div class="bg">
    <div class="register-box shadow-lg">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ee/Logo_Koperasi_Indonesia_%282015%29.svg/1200px-Logo_Koperasi_Indonesia_%282015%29.svg.png" class="logo-koperasi">
        <h4 class="mb-4 font-weight-bold" style="color: #2d3436;">DAFTAR ANGGOTA BARU</h4>
        
        <form action="<?= base_url('index.php/auth/register_aksi'); ?>" method="post">
            <div class="form-group text-left">
                <label class="small font-weight-bold">Nama Lengkap</label>
                <input type="text" name="nama_admin" class="form-control" placeholder="Masukkan Nama Lengkap" required>
            </div>
            
            <div class="form-group text-left">
                <label class="small font-weight-bold">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Buat Username" required>
            </div>

            <div class="form-group text-left">
                <label class="small font-weight-bold">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Buat Password" required>
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword('password', 'eye-icon')">
                            <i class="fas fa-eye" id="eye-icon"></i>
                        </span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-register btn-block shadow mt-4">DAFTAR SEKARANG</button>
        </form>
        
        <div class="auth-footer mt-4">
            <a href="<?= base_url('index.php/auth'); ?>"><i class="fas fa-arrow-left"></i> Sudah punya akun? Login</a>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
        }
    }
</script>
</body>
</html>