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
    $NIK        = htmlspecialchars($data['NIK']);
    $nama_anggota = htmlspecialchars($data["nama_anggota"]);
    $alamat     = htmlspecialchars($data["alamat"]);
    $tgl_bergabung    = htmlspecialchars($data["tgl_bergabung"]);
    $no_hp      = htmlspecialchars($data["no_hp"]);

    $query = "INSERT INTO anggota VALUES ('$kode','$NIK', '$nama_anggota', '$alamat', '$tgl_bergabung',  '$no_hp')";

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
    $NIK            = htmlspecialchars($data['NIK']);
    $nama_petugas       = htmlspecialchars($data["nama_petugas"]);
    $password       = htmlspecialchars($data["password"]);
    $alamat     = htmlspecialchars($data["alamat"]);
    $tanggal_bergabung = htmlspecialchars($data["tanggal_bergabung"]);
    $no_hp      = htmlspecialchars($data["no_hp"]);

    // ENKRIPSI password dengan password_hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO petugas VALUES ('$kode', '$username','$NIK', '$nama_petugas', '$password_hash', '$alamat', '$tanggal_bergabung', '$no_hp')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};

function ubah_anggota($data)
{
    global $koneksi;

    $id       = htmlspecialchars($data["id_anggota"]);
    $NIK        = htmlspecialchars($data['NIK']);
    $nama_anggota = htmlspecialchars($data["nama_anggota"]);
    $alamat     = htmlspecialchars($data["alamat"]);
    $tgl_bergabung = htmlspecialchars($data["tgl_bergabung"]);
    $no_hp      = htmlspecialchars($data["no_hp"]);


    $query = "UPDATE anggota SET 
                NIK = '$NIK',
                nama_anggota = '$nama_anggota',
                alamat ='$alamat',
                tgl_bergabung = '$tgl_bergabung',
                no_hp = '$no_hp'
                WHERE id_anggota = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function ubah_petugas($data)
{
    global $koneksi;

    $id       = htmlspecialchars($data["id_petugas"]);
    $NIK        = htmlspecialchars($data['NIK']);
    $nama_petugas = htmlspecialchars($data["nama_petugas"]);
    $alamat     = htmlspecialchars($data["alamat"]);
    $tanggal_bergabung = htmlspecialchars($data["tanggal_bergabung"]);
    $no_hp      = htmlspecialchars($data["no_hp"]);


    $query = "UPDATE petugas SET 
                NIK = '$NIK',
                nama_petugas = '$nama_petugas',
                alamat ='$alamat',
                tanggal_bergabung = '$tanggal_bergabung',
                no_hp = '$no_hp'
                WHERE id_petugas = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
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
    $nama_peminjam = htmlspecialchars($data["nama_peminjam"]);
    $judul_buku = htmlspecialchars($data["judul_buku"]);
    $kode       = htmlspecialchars($data["id_buku"]);
    $pengarang     = htmlspecialchars($data["pengarang"]);
    $jenis_buku    = htmlspecialchars($data["jenis_buku"]);
    $tanggal_peminjaman    = htmlspecialchars($data["tanggal_peminjaman"]);

    // $query = "INSERT INTO buku VALUES ('$nama_peminjam', '$judul_buku', '$kode', '$pengarang', '$jenis_buku','$tanggal_peminjaman')";

    $query = "INSERT INTO buku (nama_peminjam, judul_buku, id_buku, pengarang, jenis_buku, tanggal_peminjaman) 
          VALUES ('$nama_peminjam', '$judul_buku', '$kode', '$pengarang', '$jenis_buku','$tanggal_peminjaman')";

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

function pengembalian_buku($data)
{
    global $koneksi;

    // urutan yang akan ditampilkan di aplikasinya
    $nama_peminjam = htmlspecialchars($data["nama_peminjam"]);
    $judul_buku = htmlspecialchars($data["judul_buku"]);
    $kode       = htmlspecialchars($data["id_buku"]);
    $pengarang     = htmlspecialchars($data["pengarang"]);
    $jenis_buku    = htmlspecialchars($data["jenis_buku"]);
    $tanggal_pengembalian    = htmlspecialchars($data["tanggal_pengembalian"]);

    $query = "INSERT INTO pengembalian VALUES ('$nama_peminjam', '$judul_buku', '$kode', '$pengarang', '$jenis_buku','$tanggal_pengembalian')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};
