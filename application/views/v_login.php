<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Koperasi Kita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body, html { 
            height: 100%; 
            margin: 0; 
            font-family: 'Poppins', sans-serif; 
        }
        
        /* Background baru menggunakan Gradient Biru-Gelap yang elegan */
        .bg {
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            height: 100%; 
            display: flex; 
            align-items: center; 
            justify-content: center;
        }

        .login-box {
            width: 100%; 
            max-width: 400px; 
            padding: 45px 35px;
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3); 
            border-radius: 20px; 
            text-align: center;
        }

        .auth-header h3 {
            font-weight: 700;
            color: #333;
            letter-spacing: 1px;
        }

        .form-control { 
            background: #f4f7f6; 
            border: 1px solid #ddd; 
            border-radius: 10px; 
            padding: 12px 15px; 
            height: auto; 
            transition: 0.3s;
        }
        
        .form-control:focus { 
            background: #fff; 
            border-color: #2c5364; 
            box-shadow: 0 0 8px rgba(44, 83, 100, 0.2);
        }

        .input-group-text { 
            background: #f4f7f6; 
            border: 1px solid #ddd; 
            border-radius: 10px 0 0 10px;
            color: #888;
        }

        /* Perbaikan untuk lengkungan input group */
        .input-group > .form-control {
            border-radius: 0 10px 10px 0;
        }
        
        .input-group > .password-input {
            border-radius: 0;
        }

        .eye-box {
            border-radius: 0 10px 10px 0 !important;
            cursor: pointer;
        }

        .btn-login { 
            background: #2c5364; 
            border: none; 
            color: white; 
            padding: 14px; 
            font-weight: 600; 
            border-radius: 10px;
            transition: 0.4s; 
            margin-top: 10px;
        }

        .btn-login:hover { 
            background: #203a43; 
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
        }

        .auth-footer { margin-top: 30px; font-size: 0.85rem; color: #777; }
        .auth-footer a { color: #2c5364; text-decoration: none; font-weight: 600; }
        .auth-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="bg">
    <div class="login-box">
        <div class="auth-header mb-4">
            <h3>SELAMAT DATANG</h3>
            <p class="text-muted small">Silakan masuk ke sistem koperasi</p>
        </div>

        <form action="<?= base_url('index.php/auth/login_aksi'); ?>" method="post">
            <div class="form-group text-left">
                <label class="small font-weight-bold">Username / Kode Anggota</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required autofocus>
                </div>
            </div>
            
            <div class="form-group mb-4 text-left">
                <label class="small font-weight-bold">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" name="password" id="password" class="form-control password-input" placeholder="Masukkan Password" required>
                    <div class="input-group-append" onclick="togglePassword()">
                        <span class="input-group-text eye-box">
                            <i class="fas fa-eye-slash" id="eye-icon"></i>
                        </span>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-login btn-block">MASUK SEKARANG</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="<?= base_url('index.php/auth/register'); ?>">Daftar Anggota</a> 
            <br>
            <a href="<?= base_url('index.php/auth/reset_password'); ?>" class="text-muted d-inline-block mt-2">Lupa Password?</a>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");
        
        if (passwordInput.type === "password") {
            // Munculkan huruf
            passwordInput.type = "text";
            // Icon berubah jadi mata terbuka (sedang melihat)
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        } else {
            // Jadi titik-titik lagi
            passwordInput.type = "password";
            // Icon berubah jadi mata dicoret
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        }
    }
</script>
</body>
</html>