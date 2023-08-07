<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KrisnaLTE | Registrasi</title>
  <?php require __DIR__ . "/../layouts/headlinks.php" ?>
</head>
<body class="hold-transition register-page">

<?php
    use Krispachi\KrisnaLTE\App\FlashMessage;
    FlashMessage::flashMessage();
?>

<div class="register-box">
    <div class="register-logo">
        <a><b>Krisna</b>LTE</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
        <p class="login-box-msg">Registrasi akun baru</p>

        <form action="/register" method="post">
            <div class="input-group mb-3">
                <input type="text" name="username" class="form-control" value="<?php if(isset($_GET["username"])) { echo $_GET["username"]; } ?>" placeholder="Username" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" value="<?php if(isset($_GET["email"])) { echo $_GET["email"]; } ?>" placeholder="Email" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="far fa-eye mr-2 eye-icon" onclick="hideShowPassword()"></span>
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Konfirmasi Password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-eye mr-2 eye-icon2" onclick="hideShowConfirmPassword()"></span>
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-4 m-auto">
                    <button type="submit" class="btn btn-primary btn-block mb-3">Registrasi</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="/login" class="text-center">Saya sudah registrasi</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<?php require __DIR__ . "/../layouts/bodyscripts.php" ?>
<script>
    function hideShowPassword() {
        if($("#password").attr("type") === "password") {
            $("#password").attr("type", "text");
            $(".eye-icon").removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            $("#password").attr("type", "password");
            $(".eye-icon").removeClass("fa-eye-slash").addClass("fa-eye");
        }
    };

    function hideShowConfirmPassword() {
        if($("#confirm_password").attr("type") === "password") {
            $("#confirm_password").attr("type", "text");
            $(".eye-icon2").removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            $("#confirm_password").attr("type", "password");
            $(".eye-icon2").removeClass("fa-eye-slash").addClass("fa-eye");
        }
    };
</script>
</body>
</html>
