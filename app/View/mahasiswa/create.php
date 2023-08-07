<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KrisnaLTE | Tambah</title>
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
						<h1 class="m-0">Tambah Data Mahasiswa</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
							<li class="breadcrumb-item active">Tambah Data Mahasiswa</li>
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
					<div class="col">
						<!-- general form elements -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Data Mahasiswa</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/mahasiswas/create" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nim">NIM</label>
                                        <input type="number" name="nim" class="form-control" id="nim" value="<?= $_SESSION["form-input"]["nim"] ?? "" ?>" placeholder="Masukkan NIM" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $_SESSION["form-input"]["nama"] ?? "" ?>" placeholder="Masukkan Nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan</label>
                                        <input type="number" name="id_jurusan" class="form-control" id="jurusan" value="<?= $_SESSION["form-input"]["id_jurusan"] ?? "" ?>" placeholder="Masukkan Jurusan">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" id="alamat" value="<?= $_SESSION["form-input"]["alamat"] ?? "" ?>" placeholder="Masukkan Alamat" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="number" name="telepon" class="form-control" id="telepon" value="<?= $_SESSION["form-input"]["telepon"] ?? "" ?>" placeholder="Masukkan Telepon" required>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Kirim</button>
                                    <a href="/" class="btn btn-secondary">Kembali</a>
                                </div>
                                <?php
                                    if(isset($_SESSION["form-input"])) {
                                        unset($_SESSION["form-input"]);
                                    }
                                ?>
                            </form>
                        </div>
                        <!-- /.card -->
					</div>
				</div>		
			</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<?php require __DIR__ . "/../layouts/footer.php" ?>
</div>
<!-- ./wrapper -->

<?php require __DIR__ . "/../layouts/bodyscripts.php" ?>
</body>
</html>
