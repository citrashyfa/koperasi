<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | Koperasi Kita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body, html { height: 100%; margin: 0; font-family: 'Segoe UI', sans-serif; }
        .bg {
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            height: 100%; display: flex; align-items: center; justify-content: center;
        }
        .register-box {
            width: 100%; max-width: 450px; padding: 40px;
            background: white; box-shadow: 0 15px 35px rgba(0,0,0,0.4); border-radius: 20px; text-align: center;
        }
        .form-control { background: #f1f3f5; border: 1px solid #ddd; border-radius: 10px; padding: 12px; height: auto; }
        .input-group-text { background: #f1f3f5; border: 1px solid #ddd; border-radius: 10px 0 0 10px; color: #555; }
        .input-group .form-control { border-radius: 0 10px 10px 0; }
        .eye-icon { border-radius: 0 10px 10px 0 !important; cursor: pointer; border-left: none; }
        .password-field { border-radius: 0 !important; }
        .btn-register { background-color: #2c5364; border: none; color: white; padding: 12px; font-weight: bold; border-radius: 10px; transition: 0.3s; margin-top: 10px; }
        .btn-register:hover { background-color: #203a43; transform: scale(1.02); color: white; }
    </style>
</head>
<body>
<div class="bg">
    <div class="register-box">
        <h3 class="mb-4 font-weight-bold" style="color: #2d3436; letter-spacing: 1px;">DAFTAR AKUN BARU</h3>
        
        <form action="<?= base_url('index.php/auth/register_aksi'); ?>" method="post" onsubmit="return validateRegister()">
            <div class="form-group text-left">
                <label class="small font-weight-bold">Nama Lengkap</label>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-id-card"></i></span></div>
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Anda" required>
                </div>
            </div>
            
            <div class="form-group text-left">
                <label class="small font-weight-bold">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
                    <input type="text" name="username" class="form-control" placeholder="Buat Username" required>
                </div>
            </div>

            <div class="form-group text-left">
                <label class="small font-weight-bold">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                    <input type="password" name="password" id="reg_pw" class="form-control password-field" placeholder="Buat Password" required>
                    <div class="input-group-append" onclick="toggleView('reg_pw', 'eye_reg')">
                        <span class="input-group-text eye-icon"><i class="fas fa-eye-slash" id="eye_reg"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group text-left">
                <label class="small font-weight-bold">Ulangi Password</label>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-check-double"></i></span></div>
                    <input type="password" id="reg_pw2" class="form-control password-field" placeholder="Konfirmasi Password" required>
                    <div class="input-group-append" onclick="toggleView('reg_pw2', 'eye_reg2')">
                        <span class="input-group-text eye-icon"><i class="fas fa-eye-slash" id="eye_reg2"></i></span>
                    </div>
                </div>
                <small id="reg_msg" class="text-danger font-italic" style="display:none;">* Password tidak cocok!</small>
            </div>

            <button type="submit" class="btn btn-register btn-block shadow-sm">DAFTAR SEKARANG</button>
        </form>
        
        <div class="mt-4">
            <a href="<?= base_url('index.php/auth'); ?>" style="color: #2c5364; text-decoration: none; font-weight: 600;"><i class="fas fa-arrow-left"></i> Kembali ke Login</a>
        </div>
    </div>
</div>

<script>
    function toggleView(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace("fa-eye-slash", "fa-eye");
        } else {
            input.type = "password";
            icon.classList.replace("fa-eye", "fa-eye-slash");
        }
    }

    function validateRegister() {
        const p1 = document.getElementById("reg_pw").value;
        const p2 = document.getElementById("reg_pw2").value;
        if (p1 !== p2) {
            document.getElementById("reg_msg").style.display = "block";
            return false;
        }
        return true;
    }
</script>
</body>
</html>