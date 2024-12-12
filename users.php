<?php
include_once('templates/header.php');
require_once('function.php')
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4" style="font-size: 50px;">Perpustakaan Sekolah RPL</h1>

    <?php
    //jika ada tombol simpan
    if (isset($_POST['simpan'])) {
        if (tambah_users($_POST) > 0) {
    ?>
            <div class="alert alert-success" role="alert">
                Data kesimpen yey!
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Ih, ga kesimpen tau!
            </div>
    <?php
        }
    }
    ?>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Pengurus Perpustakaan</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="card-header py-3">
                    <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal" style="margin-bottom:20px;">
                        <span class="icon text-white-50">
                            <b>+</b>
                        </span>
                        <span class="text">Data Pengurus</span>
                    </button>
                </div>


                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">No</th>
                                <th class="column-title">Username</th>
                                <th class="column-title">Role</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>
                                <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Select All ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            //penomoran auto-increment
                            $no = 1;
                            // query untuk memanggil semua data dari table users
                            $users = query("SELECT * FROM users");
                            foreach ($users as $usr) : ?>

                                <tr class="odd pointer">
                                    <td class="a-center">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td><?= $no++; ?></td>
                                    <td><?= $usr['username'] ?></td>
                                    <td><?= $usr['user_role'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#gantiPassword" data-id="<?= $usr['id_user'] ?>">
                                            <span class="text">Ganti Password</span>
                                        </button>
                                        <a class="btn btn-success" href="edit-users.php?id=<?= $usr['id_user'] ?>">Ubah</a>
                                        <a onclick="return confirm('Yakin nih mau dihapus?')" class="btn btn-danger" href="hapus-users.php?id=<?= $usr['id_user'] ?>">Hapus</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

                <?php
                //mengambil data barang dari tabel dengan kode terbesar
                $query = mysqli_query($koneksi, "SELECT max(id_user) as kodeTerbesar FROM users");
                $data = mysqli_fetch_array($query);
                $kodeuser = $data['kodeTerbesar'];

                //mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan di ubah ke integer dengan (int)
                $urutan = (int) substr($kodeuser, 2, 3);

                //nomor yang di ambil akan di tambah 1 untuk menentukan nomor urut berikutnya
                $urutan++;

                //membuat kode barang baru

                //angka yang di ambil tadi di gabungkan dengan kode huruf yang kita inginkan, misalnya gt
                $huruf = "gt";
                $kodeuser = $huruf . sprintf('%03s', $urutan);
                ?>

                <!-- Modal -->
                <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahModalLabel">
                                    Tambah users
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="">
                                    <input type="text" name="id_user" id="id_user" value="<?= $kodeuser ?>">
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="username" class="form-control" name="username">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" id="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="user_role" class="col-sm-3 col-form-label">User Role</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="user_role" name="user_role">
                                                <option value="admin">Admin</option>
                                                <option value="petugas">Petugas</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- /.container-fluid -->

                <!-- Modal GAnti Password-->
                <div class="modal fade" id="gantiPassword" tabindex="-1" aria-labelledby="gantiPasswordLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="gantiPasswordLabel">Ganti Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="">
                                    <input type="hidden" name="id_user" id="id_user">
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-4 col-form-label">Password Baru</label>
                                        <div class="col-sm-7">
                                            <input type="password" id="password" class="form-control" name="password">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                <button type="submit" name="ganti_password" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
include_once('templates/footer.php');
?>