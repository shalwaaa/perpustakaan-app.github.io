
<?php
// panggil file function.php
require_once 'function.php';

// jika ada id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (hapus_pinjaman($id) > 0) {
        // jika data berhasil di hapus maka akan muncul alert
        echo "<script>alert('Okay kalau itu mau kamu')</script>";
        // redirect ke halaman anggota.php
        echo "<script>window.location.href='peminjaman.php'</script>";
    } else {
        // jika gagal di hapus
        echo "<script>alert('ya lagian ngapain pake diapus sih')</script>";
    }
}
