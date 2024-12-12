<?php
include_once('templates/header.php');
require_once('function.php');


$peminjamanData = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $peminjamanData = query("SELECT anggota.nama_anggota, buku.judul_buku, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali 
FROM peminjaman 
JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota 
JOIN buku ON peminjaman.id_buku = buku.id_buku 
WHERE peminjaman.tanggal_pinjam BETWEEN '$start_date' AND '$end_date'");

    
    $_SESSION['peminjamanData'] = $peminjamanData;
} else {
    if (isset($_SESSION['peminjamanData'])) {
        $peminjamanData = $_SESSION['peminjamanData'];
    }
}

if (isset($_POST['tampilkan'])) {
    $p_awal = $_POST['p_awal'];
    $p_akhir = $_POST['p_akhir'];

    $link = "export-laporan.php?cari=true&p_awal=$p_awal&p_akhir=$p_akhir"; 
   
    $buku = query("SELECT * FROM buku WHERE judul_buku BETWEEN '$p_awal' AND '$p_akhir'");
} else {

    $buku = query("SELECT * FROM buku ORDER BY judul_buku DESC");
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Perpustakaan</h1>
    <div class="row mx-auto d-flex justify-content-center">
        <div class="col-xl-8 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label class="font-weight-bold text-primary text-uppercase mb-1">Tanggal Periode</label>
                            </div>
                            <div class="col-auto" style="padding-top: 10px;">
                                <input type="date" class="form-control mb-2" name="start_date" required>
                            </div>
                            <div class="col-auto" style="padding-top: 20px;">
                                <input type="date" class="form-control mb-2" name="end_date" required>
                            </div>
                            <div class="col-auto" style="padding-top: 20px;">
                                <button type="submit" class="btn btn-primary mb-2">Tampilkan</button>
                                <a href="<?= isset($_POST['tampilkan']) ? $link : 'export-laporan.php' ; ?>" target="_blank" class="btn btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-file-excel"></i>
                                    </span>
                                    <span class="text"> Export</span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Nama Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
    <?php if (empty($peminjamanData)): ?>
        <tr>
            <td colspan="4" class="text-center">Belum ada data</td>
        </tr>
    <?php else: ?>
        <?php 
            $no = 1;
            foreach ($peminjamanData as $index => $pb): ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= isset($pb['nama_anggota']) ? $pb['nama_anggota'] : 'N/A'; ?></td>
                <td><?= isset($pb['judul_buku']) ? $pb['judul_buku'] : 'N/A'; ?></td>
                <td><?= isset($pb['tanggal_pinjam']) ? $pb['tanggal_pinjam'] : 'N/A'; ?></td>
                <td><?= isset($pb['tanggal_kembali']) ? $pb['tanggal_kembali'] : 'N/A'; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>

            </table>
        </div>
    </div>
</div>

<?php include_once('templates/footer.php'); ?>