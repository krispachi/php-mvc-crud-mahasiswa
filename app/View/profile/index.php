<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KrisnaLTE | Profil</title>
	<?php require __DIR__ . "/../layouts/headlinks.php" ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<?php
    use Krispachi\KrisnaLTE\App\FlashMessage;
    FlashMessage::flashMessage();
?>

<div class="wrapper">
	<?php require __DIR__ . "/../layouts/nav-aside.php" ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Profil</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active">Profil</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-md-6 m-auto">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="<?php __DIR__ ?>/AdminLTE/dist/img/user4-128x128.jpg" alt="User profile picture">
                                </div>

                                <?php
                                    if(!isset($_COOKIE["X-KRISNALTE-SESSION"])) {
                                        $result = [
                                            "id" => "0",
                                            "username" => "N/A",
                                            "email" => "N/A"
                                        ];
                                    }
                                ?>
                                <form action="/users/update/<?= $result["id"] ?>" method="post" id="form-profile">
                                    <ul class="list-group list-group-unbordered my-3">
                                        <li class="list-group-item">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-3">Username</div>
                                                <div class="col-9"><input type="text" name="username" id="username" value="<?= $_SESSION["form-input"]["username"] ?? $result["username"] ?>" class="form-control"></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-3">Email</div>
                                                <div class="col-9"><input type="email" name="email" id="email" value="<?= $_SESSION["form-input"]["email"] ?? $result["email"] ?>" class="form-control"></div>
                                            </div>
                                        </li>
                                    </ul>
                                    <?php
                                        if(isset($_SESSION["form-input"])) {
                                            unset($_SESSION["form-input"]);
                                        }
                                    ?>
                                </form>

                                <a class="btn btn-primary btn-block button-edit-profile"><b>Ubah Profil</b></a>
                                <form action="/users/delete/<?= $result["id"] ?>" method="post" class="form-delete d-block mt-1">
                                    <button type="submit" class="btn btn-danger btn-block button-delete-profile"><b>Hapus Akun</b></button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
				</div>		
			</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<?php require __DIR__ . "/../layouts/footer.php" ?>
</div>
<!-- ./wrapper -->

<?php require __DIR__ . "/../layouts/bodyscripts.php" ?>
<!-- Page specific script -->
<script>
$(document).ready(function() {
	$(".button-delete-profile").click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "kamu tidak bisa kembali setelah ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus akun!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sekali lagi, apakah kamu yakin?',
                    text: "kamu tidak bisa kembali setelah ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus sekarang!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(".form-delete").submit();
                    } else {
                        Swal.fire({
                            title: 'Batal!',
                            text: 'Akun akhirnya tidak jadi dihapus.',
                            icon: 'success',
                            timer: 4000
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Batal!',
                    text: 'Akun tidak jadi dihapus.',
                    icon: 'success',
                    timer: 4000
                });
            }
        });
    });
    
    $(".button-edit-profile").click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "kamu tidak bisa kembali setelah ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ubah akun!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sekali lagi, apakah kamu yakin?',
                    text: "kamu tidak bisa kembali setelah ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, ubah sekarang!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form-profile").submit();
                    } else {
                        Swal.fire({
                            title: 'Batal!',
                            text: 'Akun akhirnya tidak jadi diubah.',
                            icon: 'success',
                            timer: 4000
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Batal!',
                    text: 'Akun tidak jadi diubah.',
                    icon: 'success',
                    timer: 4000
                });
            }
        });
    });
});
</script>
</body>
</html>
