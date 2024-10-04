<?php
// panggil file koneksi
require_once('koneksi.php');

// membuat query dari database
function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_anggota($data)
{
    global $koneksi;

    $kode       = htmlspecialchars($data["id_anggota"]);
    $nama_anggota = htmlspecialchars($data["nama_anggota"]);
    $alamat     = htmlspecialchars($data["alamat"]);
    $tgl_lahir    = date("Y-m-d");
    $no_hp      = htmlspecialchars($data["no_hp"]);

    $query = "INSERT INTO anggota VALUES ('$kode', '$nama_anggota', '$alamat', '$tgl_lahir',  '$no_hp')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
