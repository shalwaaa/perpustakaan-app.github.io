<?php
include_once('templates/header.php');
require_once('function.php');
require_once('koneksi.php'); // Pastikan Anda memiliki koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $anggota = $_POST['anggota'];
    $buku = isset($_POST['buku']) ? $_POST['buku'] : [];

    // Memeriksa apakah anggota dan buku dipilih
    if (!empty($anggota) && !empty($buku)) {
        // Memastikan id_peminjaman di-generate otomatis, kita buat data kosong atau NULL untuk $data
        $data = [
            'id_peminjaman' => null // ID ini akan di-generate otomatis oleh database
        ];

        // Memanggil fungsi untuk menyimpan peminjaman
        simpanPeminjaman($anggota, $buku, $data); // Menambahkan parameter ketiga

        // Jika peminjaman berhasil, bisa memberikan respon atau redirect ke halaman lain
        echo "Peminjaman berhasil disimpan!";
    } else {
        echo "Anggota atau buku tidak dipilih.";
    }
}


// Menangani penghapusan data berdasarkan parameter 'hapus' di URL
if (isset($_GET['hapus'])) {
    $id_peminjaman = $_GET['hapus'];
    // Pastikan parameter 'hapus' adalah angka untuk mencegah SQL Injection
    if (is_numeric($id_peminjaman)) {
        // Koneksi ke database dan query untuk menghapus
        $query = "DELETE FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'";

        // Eksekusi query penghapusan
        if (mysqli_query($koneksi, $query)) {
            echo "<div class='alert alert-success' role='alert'>Peminjaman berhasil dihapus!</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Gagal menghapus peminjaman. Coba lagi.</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>ID peminjaman tidak valid.</div>";
    }
}

?>



<div class="container-fluid">
    <h1 class="mt-4">Data Peminjaman Buku</h1>

    <div class="container-fluid">
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
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <h4 id="jumlah-buku">Jumlah Buku Dipinjam: 0</h4> <!-- Menampilkan jumlah buku yang dipinjam -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Action</th> <!-- Kolom Aksi -->
                            </tr>
                        </thead>
                        <tbody id="tabel-peminjaman">
                            <?php
                            $pengembalian = query("SELECT peminjaman.*, anggota.nama_anggota, buku.judul_buku FROM peminjaman JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota JOIN buku ON peminjaman.id_buku = buku.id_buku");

                            foreach ($pengembalian as $pb) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($pb['nama_anggota']); ?></td>
                                    <td><?= htmlspecialchars($pb['judul_buku']); ?></td>
                                    <td><?= htmlspecialchars($pb['tanggal_pinjam']); ?></td>
                                    <td><?= htmlspecialchars($pb['tanggal_kembali']); ?></td>
                                    <td>
                                    <a href="?hapus=<?= htmlspecialchars($pb['id_peminjaman']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <script>
                        // Menghitung jumlah buku yang dipinjam
                        const tabelPeminjaman = document.getElementById('tabel-peminjaman');
                        const jumlahBuku = tabelPeminjaman.getElementsByTagName('tr').length;
                        document.getElementById('jumlah-buku').innerText = 'Jumlah Buku Dipinjam: ' + jumlahBuku;
                    </script>

                    <!-- Link Kembali ke Form Peminjaman -->
                    <a href="peminjaman.php" class="btn btn-primary">Kembali ke Form Peminjaman</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('templates/footer.php'); ?>
