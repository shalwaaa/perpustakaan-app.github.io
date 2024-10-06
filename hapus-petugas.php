<?php
// panggil file function.php
require_once('function.php');

// jika ada id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (hapus_petugas($id) > 0) {
        // jika data berhasil di hapus maka akan muncul alert
        echo "<script>alert('ilangkan?, ya lagian ngapain pake diapus sih')</script>";
        // redirect ke halaman petugas.php
        echo "<script>window.location.href='petugas.php'</script>";
    } else {
        // jika gagal di hapus
        echo "<script>alert('yaudah sih ngapain pake dihapus, sysmtem aja nolak')</script>";
    }
}
