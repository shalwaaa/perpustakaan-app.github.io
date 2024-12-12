<?php
include_once('templates/header.php');
require_once('function.php');
// jika ada id_anggota di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // ambil data anggota yang sesuai dengan id_anggota
    $data = query("SELECT * FROM anggota WHERE id_anggota =  '$id'")[0];
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data anggota</h1>

    <?php
    // jika ada tombol simpan
    if (isset($_POST['simpan'])) {
        if (ubah_anggota($_POST) > 0) {
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
            <form method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="id_anggota" id="id_anggota" value="<?= $id ?>">
                <input type="hidden" name="gambarLama" id="gambarLama" value="<?= $data['gambar']; ?>">
                <div class="form-group row">
                    <label for="NIK" class="col-sm-3 col-form-label">NIK</label>
                    <div class="col-sm-8">
                        <input type="text" id="nik" class="form-control" name="nik" value="<?= $data['nik'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_anggota" class="col-sm-3 col-form-label">Nama anggota</label>
                    <div class="col-sm-8">
                        <input type="text" id="nama_anggota" class="form-control" name="nama_anggota" value="<?= $data['nama_anggota'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <textarea id="alamat" class="form-control" name="alamat"><?= $data['alamat'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_hp" class="col-sm-3 col-form-label">No Telp/Hp</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $data['no_hp'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gambar" class="col-sm-3 col-form-label">Photo</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="gambar" name="gambar" value="<?= $data['gambar'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="status" name="status">
                            <option value="aktif" <?= $data['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                            <option value="non-aktif" <?= $data['status'] == 'non-aktif' ? 'selected' : ''; ?>>Non-aktif</option>
                        </select>
                    </div>
                </div>
                <div class="from-group row">
                    <label for="" class="col-sm-3 col-from-label"></label>
                    <div class="col-sm-8 d-flex justify-content-end">
                        <div>
                            <a type="button" class="btn btn-danger btn-icon-split" href="anggota.php">
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