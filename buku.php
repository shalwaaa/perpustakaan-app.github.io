<?php
include_once('templates/header.php');
require_once('function.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4" style="font-size: 50px;">Buku</h1>

    <?php
    //jika ada tombol simpan
    if (isset($_POST['simpan'])) {
        if (tambah_buku($_POST) > 0) {
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
                <h2>Buku</h2>
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
                        <span class="text">Data Buku</span>
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
                                <th class="column-title">Judul Buku</th>
                                <th class="column-title">Pengarang</th>
                                <th class="column-title">Tahun terbit</th>
                                <th class="column-title">Penerbit</th>
                                <th class="column-title">Status</th>
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
                            $buku = query("SELECT * FROM buku");
                            foreach ($buku as $bk) : ?>

                                <tr class="odd pointer">
                                    <td class="a-center">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td><?= $no++; ?></td>
                                    <td><?= $bk['judul_buku'] ?></td>
                                    <td><?= $bk['pengarang'] ?></td>
                                    <td><?= $bk['tahun_terbit'] ?></td>
                                    <td><?= $bk['penerbit'] ?></td>
                                    <td><?= $bk['status'] ?></td>
                                    <td>
                                        <a class="btn btn-success" href="edit-buku.php?id=<?= $bk['id_buku'] ?>">Ubah</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

                <?php
                //mengambil data barang dari tabel dengan kode terbesar
                $query = mysqli_query($koneksi, "SELECT max(id_buku) as kodeTerbesar FROM buku");
                $data = mysqli_fetch_array($query);
                $kodebuku = $data['kodeTerbesar'];

                //mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan di ubah ke integer dengan (int)
                $urutan = (int) substr($kodebuku, 2, 3);

                //nomor yang di ambil akan di tambah 1 untuk menentukan nomor urut berikutnya
                $urutan++;


                //membuat kode barang baru

                //angka yang di ambil tadi di gabungkan dengan kode huruf yang kita inginkan, misalnya gt
                $huruf = "bk";
                $kodebuku = $huruf . sprintf('%03s', $urutan);

                ?>

                <!-- Modal -->
                <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahModalLabel">
                                    Tambah Buku
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="">
                                    <input type="hidden" name="id_buku" id="id_buku" value="<?= $kodebuku ?>">
                                    <div class="form-group row">
                                        <label for="judul_buku" class="col-sm-3 col-form-label">Judul Buku</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="judul_buku" class="form-control" name="judul_buku">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pengarang" class="col-sm-3 col-form-label">Pengarang</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="pengarang" class="form-control" name="pengarang">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tahun_terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="tahun_terbit" class="form-control" name="tahun_terbit">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="penerbit" class="form-control" name="penerbit">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="status" name="status">
                                                <option value="tersedia">Tersedia</option>
                                                <option value="dipinjam">Dipinjam</option>
                                                <option value="hilang">Hilang</option>
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

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include_once('templates/footer.php');
?>