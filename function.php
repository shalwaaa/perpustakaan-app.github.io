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
};

function tambah_anggota($data)
{
    global $koneksi;

    $kode       = htmlspecialchars($data["id_anggota"]);
    $nama_anggota = htmlspecialchars($data["nama_anggota"]);
    $alamat     = htmlspecialchars($data["alamat"]);
    $tgl_kedatangan    = date("Y-m-d");
    $no_hp      = htmlspecialchars($data["no_hp"]);

    $query = "INSERT INTO anggota VALUES ('$kode', '$nama_anggota', '$alamat', '$tgl_kedatangan',  '$no_hp')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};

// function hapus data tamu
function hapus_anggota($id)
{
    global $koneksi;

    $query = "DELETE FROM anggota WHERE id_anggota = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};

function tambah_petugas($data)
{
    global $koneksi;

    $kode       = htmlspecialchars($data["id_petugas"]);
    $username       = htmlspecialchars($data["username"]);
    $nama_petugas       = htmlspecialchars($data["nama_petugas"]);
    $password       = htmlspecialchars($data["password"]);
    $alamat     = htmlspecialchars($data["alamat"]);
    $no_hp      = htmlspecialchars($data["no_hp"]);

    // ENKRIPSI password dengan password_hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO petugas VALUES ('$kode', '$username', '$nama_petugas', '$password_hash', '$alamat', '$no_hp')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};

// function hapus data petugas
function hapus_petugas($id)
{
    global $koneksi;

    $query = "DELETE FROM petugas WHERE id_petugas = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};

function tambah_buku($data)
{
    global $koneksi;

    // urutan yang akan ditampilkan di aplikasinya
    $judul = htmlspecialchars($data["judul"]);
    $kode       = htmlspecialchars($data["id_buku"]);
    $pengarang     = htmlspecialchars($data["pengarang"]);
    $jenis_buku    = htmlspecialchars($data["jenis_buku"]);

    $query = "INSERT INTO buku VALUES ('$judul', '$kode', '$pengarang', '$jenis_buku')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};

// function hapus data tamu
function hapus_buku($id)
{
    global $koneksi;

    $query = "DELETE FROM buku WHERE id_buku = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};
