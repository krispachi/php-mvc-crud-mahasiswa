<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KrisnaLTE | Mata Kuliah</title>
    <?php require __DIR__ . "/../layouts/headlinks.php" ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">

<?php
    use Krispachi\KrisnaLTE\App\FlashMessage;
    FlashMessage::flashMessage();
?>
    
<div class="wrapper">
    <?php require __DIR__ . "/../layouts/nav-aside.php"; ?>

    <!-- Modal -->
    <div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
        <!-- form start -->
        <form action="/subjects" method="post" id="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subjectModalLabel">Tambah Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="kode">Kode Mata Kuliah</label>
                                <input type="text" name="kode" class="form-control" id="kode" placeholder="Masukkan Kode Mata Kuliah" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Mata Kuliah</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Mata Kuliah" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_sks">Jumlah SKS</label>
                                <input type="number" name="jumlah_sks" class="form-control" id="jumlah_sks" placeholder="Masukkan Jumlah SKS" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="create_subject" class="btn btn-success button-save">Tambah</button>
                </div>
            </div>
        </form>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mata Kuliah</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Mata Kuliah</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
								<h3 class="card-title">Tabel Daftar Mata Kuliah</h3>
								<a class="btn btn-success ml-auto button-create" data-toggle="modal" data-target="#subjectModal">Tambah Mata Kuliah</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Mata Kuliah</th>
                                    <th>Mata Kuliah</th>
                                    <th>Jumlah SKS</th>
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
                                        <td><?= $iteration ?></td>
                                        <td><?= $row["kode"] ?></td>
                                        <td><?= $row["nama"] ?></td>
                                        <td><?= $row["jumlah_sks"] ?></td>
                                        <td>
                                            <button data-id="<?= $row["id"] ?>" class="btn btn-sm btn-warning button-edit">Ubah</button>
                                            <form action="/subjects/delete/<?= $row["id"] ?>" method="post" class="form-delete d-inline-block">
												<button type="submit" class="btn btn-sm btn-danger button-delete">Hapus</button>
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
                                    <th>Kode Mata Kuliah</th>
                                    <th>Mata Kuliah</th>
                                    <th>Jumlah SKS</th>
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
    <!-- /.content-wrapper -->
    <?php require __DIR__ . "/../layouts/footer.php"; ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php require __DIR__ . "/../layouts/bodyscripts.php" ?>
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

    $(".form-delete").one("submit", function(e) {
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
                $(this).submit();
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

    $(".button-create").click(function() {
        $(".button-save").text("Tambah").removeClass("btn-warning").addClass("btn-success").attr("name", "create_subject");
        $("#subjectModalLabel").text("Tambah Mata Kuliah");
    });

    $(".button-edit").click(function() {
        $.get("/subjects/" + $(this).data("id"), function(response) {
            let data;
            try {
                data = JSON.parse(response);
                if(data.error) {
                    // Jika ada error
                } else {
                    // Set value dan action form
                    $("#modal-form").attr("action", "/subjects/" + data.id);
                    $("#kode").val(data.kode);
                    $("#nama").val(data.nama);
                    $("#jumlah_sks").val(data.jumlah_sks);
                }
            } catch (exception) {
                // Jika tidak ada respon dari server
            }
            $(".button-save").text("Ubah").removeClass("btn-success").addClass("btn-warning").attr("name", "edit_subject");
            $("#subjectModalLabel").text("Ubah Mata Kuliah");
            $("#subjectModal").modal("show");
        });
    });

    // Clear form saat modal edit close dan cek atribut name button-save
    $("#subjectModal").on('hidden.bs.modal', function() {
        if($(".button-save").attr("name") == "edit_subject") {
            $("#modal-form").attr("action", "/subjects");
            $("#kode").val("");
            $("#nama").val("");
            $("#jumlah_sks").val("");
        }
    });
});
</script>
</body>
</html>
