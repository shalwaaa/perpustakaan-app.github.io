<?php
include_once('templates/header.php');
require_once('function.php');
// jika ada id_anggota di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // ambil data anggota yang sesuai dengan id_anggota
    $data = query("SELECT * FROM buku WHERE id_buku =  '$id'")[0];
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Buku</h1>

    <?php
    // jika ada tombol simpan
    if (isset($_POST['simpan'])) {
        if (ubah_buku($_POST) > 0) {
    ?>
            <div class="alert alert-success" role="alert">
                Data berhasil diubah!
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Data gagal diubah!
            </div>
    <?php
        }
    }
    ?>


    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="">
                <input type="hidden" name="id_buku" id="id_buku" value="<?= $id ?>">
                <div class="form-group row">
                    <label for="judul_buku" class="col-sm-3 col-form-label">Judul Buku</label>
                    <div class="col-sm-8">
                        <input type="text" id="judul_buku" class="form-control" name="judul_buku" value="<?= $data['judul_buku'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pengarang" class="col-sm-3 col-form-label">Pengarang</label>
                    <div class="col-sm-8">
                        <input type="text" id="pengarang" class="form-control" name="pengarang" value="<?= $data['pengarang'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun_terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
                    <div class="col-sm-8">
                        <input type="text" id="tahun_terbit" class="form-control" name="tahun_terbit" value="<?= $data['tahun_terbit'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                    <div class="col-sm-8">
                        <input type="text" id="penerbit" class="form-control" name="penerbit" value="<?= $data['penerbit'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="status" name="status">
                            <option value="tersedia" <?= $data['status'] == 'tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                            <option value="dipinjam" <?= $data['status'] == 'dipinjam' ? 'selected' : ''; ?>>Di Pinjam</option>
                            <option value="hilang" <?= $data['status'] == 'hilang' ? 'selected' : ''; ?>>Hilang</option>
                        </select>
                    </div>
                </div>
                <div class="from-group row">
                    <label for="" class="col-sm-3 col-from-label"></label>
                    <div class="col-sm-8 d-flex justify-content-end">
                        <div>
                            <a type="button" class="btn btn-danger btn-icon-split" href="buku.php">
                                <span class="text">Kembali</span>
                            </a>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once('templates/footer.php');
?>