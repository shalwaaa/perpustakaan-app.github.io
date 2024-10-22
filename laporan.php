<?php
include_once('templates/header.php');
require_once('function.php'); // tambahkan titik koma
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Laporan perpustakaan</h1>
    <div class="row mx-auto d-flex justify-content-center">
        <!-- Periode Awal -->
        <div class="col-xl-8 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <form method="post" action="">
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                            <div class="font-weight-bold text-primary text-uppercase mb-1">Periode</div>
                                        </div>
                                        <div class="col-auto">
                                            <input type="date" class="form-control mb-2" id="p_awal" name="p_awal" required>
                                        </div>
                                        <div class="col-auto">
                                            <div class="font-weight-bold text-primary mb-1">s.d</div>
                                        </div>
                                        <div class="col-auto">
                                            <input type="date" class="form-control mb-2" id="p_akhir" name="p_akhir" required>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" name="tampilkan" class="btn btn-primary mb-2">Tampilkan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <span class="text">Tabel Histori perpustakaan</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['tampilkan'])) {
                        $p_awal = $_POST['p_awal'];
                        $p_akhir = $_POST['p_akhir'];

                        // penomoran auto-increment
                        $no = 1;

                        // query untuk memanggil semua data dari table buku_perpustakaan
                        $buku = query("SELECT * FROM buku WHERE tanggal_peminjaman BETWEEN '$p_awal' AND '$p_akhir'");

                        if ($buku) { // pastikan ada data
                            foreach ($buku as $bk) {
                                // Mengambil data pengembalian berdasarkan id_buku dari peminjaman
                                $pengembalian = query("SELECT * FROM pengembalian WHERE id_buku = '{$bk['id_buku']}'");

                                // Jika ada data pengembalian, tampilkan tanggal pengembaliannya
                                if (count($pengembalian) > 0) {
                                    $pg = $pengembalian[0]; // Ambil data pengembalian
                                    $tanggal_pengembalian = date("d-m-Y", strtotime($pg['tanggal_pengembalian']));
                                } else {
                                    // Jika tidak ada pengembalian, tampilkan "belum kembali"
                                    $tanggal_pengembalian = "belum kembali";
                                }
                    ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $bk['nama_peminjam'] ?></td>
                                    <td><?= $bk['tanggal_peminjaman'] ?></td>
                                    <td><?= $tanggal_pengembalian ?></td> <!-- menampilkan tanggal pengembalian atau status -->
                                </tr>
                    <?php
                            }
                        }
                    }
                    ?>
                </tbody>


            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include_once('templates/footer.php');
?>