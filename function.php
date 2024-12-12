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

// function tambah_anggota($data) {
//     global $koneksi;

//     $nik = htmlspecialchars($data['nik']);
//     $nama_anggota = htmlspecialchars($data['nama_anggota']);
//     $password = password_hash($data['password'], PASSWORD_DEFAULT);
//     $alamat = htmlspecialchars($data['alamat']);
//     $no_hp = htmlspecialchars($data['no_hp']);
//     $email = htmlspecialchars($data['email']);
//     $status = htmlspecialchars($data['status']);

//     // Proses upload gambar
//     $gambar = $_FILES['gambar']['name'];
//     $tmp_name = $_FILES['gambar']['tmp_name'];
//     $error = $_FILES['gambar']['error'];

//     // Cek apakah ada error saat upload
//     if ($error === 0) {
//         // Tentukan folder tujuan
//         $folder = 'assets/upload_gambar'; // Pastikan folder ini ada dan memiliki izin yang tepat
//         $gambar_baru = uniqid() . '-' . $gambar; // Menghindari nama file yang sama
//         move_uploaded_file($tmp_name, $folder . $gambar_baru); // Pindahkan file ke folder tujuan
//     } else {
//         return false; // Jika ada error, kembalikan false
//     }

//     // Simpan data ke database
//     $query = "INSERT INTO anggota (nik, nama_anggota, password, alamat, no_hp, email, gambar, status) 
//               VALUES ('$nik', '$nama_anggota', '$password', '$alamat', '$no_hp', '$email', '$gambar_baru', '$status')";

//     mysqli_query($koneksi, $query);

//     return mysqli_affected_rows($koneksi);
// }
function tambah_anggota($data)
{
    global $koneksi;

    $kode       = htmlspecialchars($data["id_anggota"]); // Jika auto-increment, ini tidak diperlukan
    $nik        = htmlspecialchars($data['nik']);
    $nama_anggota = htmlspecialchars($data["nama_anggota"]);
    $password       = htmlspecialchars($data["password"]);
    $alamat     = htmlspecialchars($data["alamat"]);
    $no_hp      = htmlspecialchars($data["no_hp"]);
    $email      = htmlspecialchars($data["email"]);
    $status      = htmlspecialchars($data["status"]);

    // ENKRIPSI password dengan password_hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);




    // Eksekusi query dan cek error
    // Ubah query untuk tidak menyertakan id_anggota
    $query = "INSERT INTO anggota (id_anggota, nik, nama_anggota, password, alamat, no_hp, email, status) 
          VALUES ('$kode', '$nik', '$nama_anggota', '$password_hash', '$alamat', '$no_hp', '$email', '$status')";

    mysqli_query($koneksi, $query);


    return mysqli_affected_rows($koneksi);
}

// function hapus data tamu
function hapus_anggota($id)
{
    global $koneksi;

    $query = "DELETE FROM anggota WHERE id_anggota = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};

function tambah_users($data)
{
    global $koneksi;

    $kode       = htmlspecialchars($data["id_user"]);
    $username       = htmlspecialchars($data["username"]);
    $password       = htmlspecialchars($data["password"]);
    $user_role      =  htmlspecialchars($data["user_role"]);


    // ENKRIPSI password dengan password_hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users VALUES ('$kode', '$username', '$password_hash', '$user_role')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};

function ubah_anggota($data)
{
    global $koneksi;

    $id       = htmlspecialchars($data["id_anggota"]);
    $nik        = htmlspecialchars($data['nik']);
    $nama_anggota = htmlspecialchars($data["nama_anggota"]);
    $alamat     = htmlspecialchars($data["alamat"]);
    $no_hp      = htmlspecialchars($data["no_hp"]);
    $email    = htmlspecialchars($data["email"]);
    $gambarLama    = htmlspecialchars($data["gambarLama"]);
    $status    = htmlspecialchars($data["status"]);


    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    } else {
        $gambar = uploadGambar();
    }

    $query = "UPDATE anggota SET 
                NIK = '$nik',
                nama_anggota = '$nama_anggota',
                alamat ='$alamat',
                no_hp = '$no_hp',
                gambar = '$gambar',
                email = '$email',
                status = '$status'
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
    $id = htmlspecialchars($data["id_buku"]);
    $judul_buku = htmlspecialchars($data["judul_buku"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $tahun_terbit       = htmlspecialchars($data["tahun_terbit"]);
    $penerbit     = htmlspecialchars($data["penerbit"]);
    $status    = htmlspecialchars($data["status"]);

    // $query = "INSERT INTO buku VALUES ('$nama_peminjam', '$judul_buku', '$kode', '$pengarang', '$jenis_buku','$tanggal_peminjaman')";

    $query = "INSERT INTO buku (id_buku, judul_buku, pengarang, tahun_terbit, penerbit, status) 
          VALUES ( '$id','$judul_buku', '$pengarang', '$tahun_terbit', '$penerbit', '$status')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};
function ubah_buku($data)
{
    global $koneksi;

    $id       = htmlspecialchars($data["id_buku"]);
    $judul_buku       = htmlspecialchars($data['judul_buku']);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $tahun_terbit     = htmlspecialchars($data["tahun_terbit"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $status      = htmlspecialchars($data["status"]);


    $query = "UPDATE buku SET 
                judul_buku = '$judul_buku',
                pengarang = '$pengarang',
                tahun_terbit ='$tahun_terbit',
                penerbit = '$penerbit',
                status = '$status'
                WHERE id_buku = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
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

function tambah_peminjaman($data)
{
    global $koneksi;

    // urutan yang akan ditampilkan di aplikasinya
    $id_pinjam = htmlspecialchars($data["id_pinjam"]);
    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $tahun_terbit     = htmlspecialchars($data["tahun_terbit"]);
    $penerbit    = htmlspecialchars($data["penerbit"]);

    // $query = "INSERT INTO buku VALUES ('$nama_peminjam', '$judul_buku', '$kode', '$pengarang', '$jenis_buku','$tanggal_peminjaman')";

    $query = "INSERT INTO peminjaman
          VALUES ( '$id_pinjam','$judul', '$pengarang', '$tahun_terbit', '$penerbit')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};

function hapus_pinjaman($id)
{
    global $koneksi;

    $query = "DELETE FROM peminjaman WHERE id_pinjam = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};

// function tambah_peminjaman($data) {
//     global $koneksi;

//     $id_buku = $data['id_buku'];
//     $nama_peminjam = $data['nama_peminjam'];
//     $tanggal_pinjam = $data['tanggal_pinjam'];
//     $tanggal_kembali = $data['tanggal_kembali'];

//     // Query untuk menambahkan data peminjaman
//     $query_peminjaman = "INSERT INTO peminjaman (id_buku, nama_peminjam, tanggal_pinjam, tanggal_kembali) VALUES ('$id_buku', '$nama_peminjam', '$tanggal_pinjam', '$tanggal_kembali')";

//     mysqli_query($koneksi, $query_peminjaman);

//     // Cek apakah query berhasil
//     if (mysqli_affected_rows($koneksi) > 0) {
//         // Update status buku menjadi "Dipinjam"
//         $query_update_buku = "UPDATE buku SET status = 'Dipinjam' WHERE id_buku = '$id_buku'";
//         mysqli_query($koneksi, $query_update_buku);
        
//         return mysqli_affected_rows($koneksi);
//     } else {
//         return 0;
//     }
// }

function peminjaman($data)
{
    global $koneksi;

    // urutan yang akan ditampilkan di aplikasinya
    $id_pinjam = htmlspecialchars($data["id_pinjam"]);
    $id_buku = htmlspecialchars($data["id_buku"]);
    $batas_waktu = htmlspecialchars($data["batas_waktu"]);
    $tanggal_kembali     = htmlspecialchars($data["tanggal_kembali"]);

    $query = "INSERT INTO detail_peminjaman
          VALUES ( '$id_pinjam', '$id_buku','$batas_waktu','$tanggal_kembali')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
};


function simpanPeminjaman($anggota, $buku) {
    // Koneksi ke database
    global $koneksi;

    // Mendapatkan tanggal pinjam dan tanggal kembali
    $tanggal_pinjam = date("Y-m-d");
    $lama_pinjam = 7; // Lama pinjam dalam hari
    $tanggal_kembali = date("Y-m-d", strtotime("+$lama_pinjam days"));

    // Simpan data peminjaman ke database
    foreach ($buku as $id_buku) {
        $query = "INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, tanggal_kembali) VALUES ('$anggota', '$id_buku', '$tanggal_pinjam', '$tanggal_kembali')";
        mysqli_query($koneksi, $query);
    }
}



function uploadGambar()
{
    // Ambil data file gambar dari variable $_FILES
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang diunggah
    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // Cek apakah yang diunggah adalah file gambar
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('File yang diunggah harus berupa gambar!');
              </script>";
        return false;
    }

    // Cek jika ukuran file terlalu besar
    if ($ukuranFile > 1000000) { // 1MB
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    // Cek apakah folder tujuan ada, jika tidak buat foldernya
    $folderUpload = 'assets/upload_gambar/';
    if (!is_dir($folderUpload)) {
        mkdir($folderUpload, 0755, true);
    }

    // Generate nama file baru dengan uniqid()
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

    // Pindahkan file ke folder tujuan
    if (move_uploaded_file($tmpName, $folderUpload . $namaFileBaru)) {
        return $namaFileBaru; // Kembalikan nama file baru jika berhasil
    } else {
        echo "<script>
                alert('Gagal mengunggah gambar!');
              </script>";
        return false;
    }
}
