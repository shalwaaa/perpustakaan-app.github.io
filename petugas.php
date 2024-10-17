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
        if (tambah_petugas($_POST) > 0) {
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
    };
    ?>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Petugas Perpustakaan</h2>
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
                        <span class="text">Data Petugas</span>
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
                                <th class="column-title">Nama</th>
                                <th class="column-title">Alamat</th>
                                <th class="column-title">Tanggal Bergabung</th>
                                <th class="column-title">No. Telp</th>
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
                            // query untuk memanggil semua data dari table petugas
                            $petugas = query("SELECT * FROM petugas");
                            foreach ($petugas as $ptg) : ?>

                                <tr class="odd pointer">
                                    <td class="a-center">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td><?= $no++; ?></td>
                                    <td><?= $ptg['username'] ?></td>
                                    <td><?= $ptg['nama_petugas'] ?></td>
                                    <td><?= $ptg['alamat'] ?></td>
                                    <td><?= $ptg['tanggal_bergabung'] ?></td>
                                    <td><?= $ptg['no_hp'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#gantiPassword" data-id="<?= $ptg['id_petugas'] ?>">
                                            <span class="text">Ganti Password</span>
                                        </button>
                                        <a onclick="confirm('Yakin nih mau dihapus?')" class="btn btn-danger" href="hapus-petugas.php?id=<?= $ptg['id_petugas'] ?>">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

                <?php
                //mengambil data barang dari tabel dengan kode terbesar
                $query = mysqli_query($koneksi, "SELECT max(id_petugas) as kodeTerbesar FROM petugas");
                $data = mysqli_fetch_array($query);
                $kodePetugas = $data['kodeTerbesar'];

                //mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan di ubah ke integer dengan (int)
                $urutan = (int) substr($kodePetugas, 3, 2);

                //nomor yang di ambil akan di tambah 1 untuk menentukan nomor urut berikutnya
                $urutan++;

                //membuat kode barang baru

                //angka yang di ambil tadi di gabungkan dengan kode huruf yang kita inginkan, misalnya gt
                $huruf = "tg";
                $kodePetugas = $huruf . sprintf('%02s', $urutan);
                ?>

                <!-- Modal -->
                <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahModalLabel">Tambah Petugas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="">
                                    <input type="hidden" name="id_petugas" id="id_petugas" value="<?= $kodePetugas ?>">
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="username" class="form-control" name="username">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama_petugas" class="col-sm-3 col-form-label">Nama Petugas</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="nama_petugas" class="form-control" name="nama_petugas">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" id="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-8">
                                            <textarea id="alamat" class="form-control" name="alamat"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal_bergabung" class="col-sm-3 col-form-label">Tanggal Bergabung</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_hp" class="col-sm-3 col-form-label">No Hp</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="no_hp" name="no_hp">
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
                                    <input type="hidden" name="id_petugas" id="id_petugas">
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

                <!-- /.container-fluid -->
            </div>
        </div>
    </div>
</div>
<?php
include_once('templates/footer.php');
?>