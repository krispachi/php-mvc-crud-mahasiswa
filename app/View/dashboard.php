<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KrisnaLTE | Dashboard</title>
	<?php require __DIR__ . "/layouts/headlinks.php" ?>
	<!-- DataTables -->
	<link rel="stylesheet" href="AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<?php
    use Krispachi\KrisnaLTE\App\FlashMessage;
    FlashMessage::flashMessage();
?>

<div class="wrapper">
	<?php require __DIR__ . "/layouts/nav-aside.php" ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Dashboard</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item active">Dashboard</li>
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
						<div class="card">
							<div class="card-header d-flex align-items-center">
								<h3 class="card-title">Tabel Mahasiswa</h3>
								<a href="/mahasiswas/create" class="btn btn-success ml-auto">Tambah Mahasiswa</a>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive">
								<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>#</th>
									<th>NIM</th>
									<th>Nama</th>
									<th>Jurusan</th>
									<th>Matkul (Kode)</th>
									<th>Jumlah SKS</th>
									<th>Alamat</th>
									<th>Telepon</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
									<?php
										$iteration = 0;
										foreach($model as $row) :
											$iteration++;
									?>
									<tr>
										<td><?= $iteration ?? "-" ?></td>
										<td><?= $row["nim"] ?? "-" ?></td>
										<td><?= $row["nama"] ?? "-" ?></td>
										<td><?= $row["id_jurusan"] == 0 ? "-" : $row["id_jurusan"]; ?></td>
										<td>a</td>
										<td>a</td>
										<td><?= $row["alamat"] ?? "-" ?></td>
										<td><?= $row["telepon"] ?? "-" ?></td>
										<td style="white-space: nowrap;">
											<a href="/mahasiswas/update/<?= $row["id"] ?>" class="btn btn-sm btn-warning">Edit</a>
											<form action="/mahasiswas/delete/<?= $row["id"] ?>" method="post" class="form-delete d-inline-block">
												<button type="submit" class="btn btn-sm btn-danger button-delete">Delete</button>
											</form>
										</td>
									</tr>
									<?php
										endforeach;
									?>
								</tbody>
								<tfoot>
								<tr>
									<th>#</th>
									<th>NIM</th>
									<th>Nama</th>
									<th>Jurusan</th>
									<th>Matkul (Kode)</th>
									<th>Jumlah SKS</th>
									<th>Alamat</th>
									<th>Telepon</th>
									<th>Aksi</th>
								</tr>
								</tfoot>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				</div>		
			</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<?php require __DIR__ . "/layouts/footer.php" ?>
</div>
<!-- ./wrapper -->

<?php require __DIR__ . "/layouts/bodyscripts.php" ?>
<!-- DataTables  & Plugins -->
<script src="AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="AdminLTE/plugins/jszip/jszip.min.js"></script>
<script src="AdminLTE/plugins/pdfmake/pdfmake.min.js"></script>
<script src="AdminLTE/plugins/pdfmake/vfs_fonts.js"></script>
<script src="AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
$(function () {
	$("#example1").DataTable({
		"responsive": true, "lengthChange": false, "autoWidth": false, "responsive": true,
		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
	}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	$('#example2').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"responsive": true,
	});

	$(".button-delete").click(function(e) {
		e.preventDefault();
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$(".form-delete").submit();
			} else {
				Swal.fire({
					title: 'Batal!',
					text: 'Data tidak jadi dihapus.',
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
