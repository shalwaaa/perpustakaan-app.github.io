<?php
include_once('templates/header.php');
require_once('function.php');
// jika ada id_petugas di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // ambil data petugas yang sesuai dengan id_petugas
    $data = query("SELECT * FROM petugas WHERE id_petugas =  '$id'")[0];
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data petugas</h1>

    <?php
    // jika ada tombol simpan
    if (isset($_POST['simpan'])) {
        if (ubah_petugas($_POST) > 0) {
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
                <input type="hidden" name="id_petugas" id="id_petugas" value="<?= $id ?>">
                <div class="form-group row">
                    <label for="nama_petugas" class="col-sm-3 col-form-label">Nama petugas</label>
                    <div class="col-sm-8">
                        <input type="text" id="nama_petugas" class="form-control" name="nama_petugas" value="<?= $data['nama_petugas'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <textarea id="alamat" class="form-control" name="alamat"><?= $data['alamat'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal_bergabung" class="col-sm-3 col-form-label">Tanggal Bergabung</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" value="<?= $data['tanggal_bergabung'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_hp" class="col-sm-3 col-form-label">No Telp/Hp</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $data['no_hp'] ?>">
                    </div>
                </div>
                <div class="from-group row">
                    <label for="" class="col-sm-3 col-from-label"></label>
                    <div class="col-sm-8 d-flex justify-content-end">
                        <div>
                            <a type="button" class="btn btn-danger btn-icon-split" href="petugas.php">
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