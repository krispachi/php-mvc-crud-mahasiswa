<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KrisnaLTE | Log in</title>
    <?php require __DIR__ . "/../layouts/headlinks.php" ?>
</head>
<body class="hold-transition login-page">

<?php
    use Krispachi\KrisnaLTE\App\FlashMessage;
    FlashMessage::flashMessage();
?>

<div class="login-box">
    <div class="login-logo">
        <a><b>Krisna</b>LTE</a>
    </div>

    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Log In untuk melanjutkan ke aplikasi</p>

            <form action="/login" method="post">
                <div class="input-group mb-3">
                    <input type="username" name="username" class="form-control" placeholder="Username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
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
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4 offset-4"><button type="submit" name="button-login" class="btn btn-primary btn-block mb-3">Log In</button></div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="m-0">Belum punya akun? <a href="/register" class="text-center">buat akun baru</a></p>
            <p class="m-0"><a href="/forgot-password" class="text-center">Lupa Password?</a></p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

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
</script>
</body>
</html>
