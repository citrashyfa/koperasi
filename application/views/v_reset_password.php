<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Koperasi Kita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body, html { height: 100%; margin: 0; font-family: 'Poppins', sans-serif; }
        .bg {
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            height: 100%; display: flex; align-items: center; justify-content: center; padding: 20px;
        }
        .reset-box {
            width: 100%; max-width: 400px; padding: 40px 35px;
            background: #ffffff; box-shadow: 0 10px 25px rgba(0,0,0,0.3); border-radius: 20px; text-align: center;
        }
        .auth-header h3 { font-weight: 700; color: #333; letter-spacing: 1px; }
        .form-control { background: #f4f7f6; border: 1px solid #ddd; border-radius: 10px; padding: 12px 15px; height: auto; transition: 0.3s; }
        .form-control:focus { background: #fff; border-color: #2c5364; box-shadow: 0 0 8px rgba(44, 83, 100, 0.2); outline: none; }
        .input-group-text { background: #f4f7f6; border: 1px solid #ddd; border-radius: 10px 0 0 10px; color: #888; }
        .input-group > .form-control { border-radius: 0 10px 10px 0; }
        .btn-reset { background: #2c5364; border: none; color: white; padding: 14px; font-weight: 600; border-radius: 10px; transition: 0.4s; margin-top: 15px; text-transform: uppercase; }
        .btn-reset:hover { background: #203a43; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); color: white; }
        .auth-footer { margin-top: 25px; font-size: 0.85rem; }
        .auth-footer a { color: #2c5364; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

<div class="bg">
    <div class="reset-box">
        <div class="auth-header mb-4">
            <h3>RESET PASSWORD</h3>
            <p class="text-muted small">Masukkan username dan ulangi password baru Anda</p>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger small p-2"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <form action="<?= base_url('index.php/auth/reset_aksi'); ?>" method="post" onsubmit="return validatePassword()">
            <div class="form-group text-left">
                <label class="small font-weight-bold">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
                    <input type="text" name="username" class="form-control" placeholder="Username Anda" required autofocus>
                </div>
            </div>

            <div class="form-group text-left">
                <label class="small font-weight-bold">Password Baru</label>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                    <input type="password" name="password_baru" id="pw1" class="form-control" placeholder="Buat Password Baru" required>
                </div>
            </div>

            <div class="form-group text-left mb-4">
                <label class="small font-weight-bold">Konfirmasi Password Baru</label>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-check-circle"></i></span></div>
                    <input type="password" id="pw2" class="form-control" placeholder="Ulangi Password Baru" required>
                </div>
                <small id="msg" class="text-danger font-italic" style="display:none;">* Password tidak cocok!</small>
            </div>
            
            <button type="submit" class="btn btn-reset btn-block">Perbarui Password</button>
        </form>

        <div class="auth-footer">
            <a href="<?= base_url('index.php/auth'); ?>"><i class="fas fa-arrow-left"></i> Kembali ke Login</a>
        </div>
    </div>
</div>

<script>
    function validatePassword() {
        var pw1 = document.getElementById("pw1").value;
        var pw2 = document.getElementById("pw2").value;
        var msg = document.getElementById("msg");

        if (pw1 != pw2) {
            msg.style.display = "block";
            return false; // Mencegah form dikirim
        }
        return true;
    }
</script>

</body>
</html>