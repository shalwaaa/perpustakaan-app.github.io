    <?php
    include_once('templates/header.php');
    require_once('function.php');

    // Query data buku dan anggota
    $query_buku = mysqli_query($koneksi, "SELECT * FROM buku");
    $query_anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
    ?>

    <div class="container-fluid">
        <h1 class="mt-4">Peminjaman Buku</h1>

        <!-- Form Input -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form method="POST" action="simpan_peminjaman.php">
                <!-- Input Nama Member -->
                <div class="form-group">
                    <label for="anggota">Nama Member:</label>
                    <select name="anggota" class="form-control" required>
                        <option value="">Pilih Anggota</option>
                        <?php while ($row = mysqli_fetch_assoc($query_anggota)) : ?>
                            <option value="<?= htmlspecialchars($row['id_anggota']); ?>"><?= htmlspecialchars($row['nama_anggota']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Panel Daftar Buku -->
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Buku</h2>
                        <div class="clearfix"></div>
                    </div>

                    <!-- Input Pencarian Buku -->
                    <div class="form-group">
                        <label for="searchBuku">Cari Buku:</label>
                        <input type="text" name="searchBuku" class="form-control" placeholder="Cari buku berdasarkan judul, pengarang, atau tahun terbit...">
                    </div>

                    <!-- Tabel Pilihan Buku -->
                    <div class="form-group">
                        <label for="buku">Pilih Buku:</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Pilih</th>
                                    <th>ID Buku</th>
                                    <th>Judul Buku</th>
                                    <th>Pengarang</th>
                                    <th>Tahun Terbit</th>
                                </tr>
                            </thead>
                            <tbody id="buku">
                                <?php while ($row = mysqli_fetch_assoc($query_buku)) : ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="buku[]" value="<?= htmlspecialchars($row['id_buku']); ?>">
                                        </td>
                                        <td><?= htmlspecialchars($row['id_buku']); ?></td>
                                        <td><?= htmlspecialchars($row['judul_buku']); ?></td>
                                        <td><?= htmlspecialchars($row['pengarang']); ?></td>
                                        <td><?= htmlspecialchars($row['tahun_terbit']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Pinjam Buku</button>
            </form>
        </div>
    </div>

    <?php include_once('templates/footer.php'); ?>