<?php
include('koneksi.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Periksa koneksi database
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet(); 

$sheet->setCellValue('A1', 'No'); 
$sheet->setCellValue('B1', 'NAMA ANGGOTA');
$sheet->setCellValue('C1', 'JUDUL BUKU');
$sheet->setCellValue('D1', 'TANGGAL PEMINJAMAN');
$sheet->setCellValue('E1', 'TANGGAL PENGEMBALIAN');

if (isset($_GET['cari'])) {
    $p_awal = $_GET['p_awal'];
    $p_akhir = $_GET['p_akhir'];
    // Query dengan JOIN untuk menggabungkan data dari anggota, peminjaman, dan buku
    $query = "SELECT anggota.nama_anggota, buku.judul_buku, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali
              FROM peminjaman
              JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
              JOIN buku ON peminjaman.id_buku = buku.id_buku
              WHERE peminjaman.tanggal_pinjam BETWEEN '$p_awal' AND '$p_akhir'";
    $data = mysqli_query($koneksi, $query);
} else {
    // Query default jika tidak ada filter tanggal
    $query = "SELECT anggota.nama_anggota, buku.judul_buku, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali
              FROM peminjaman
              JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
              JOIN buku ON peminjaman.id_buku = buku.id_buku";
    $data = mysqli_query($koneksi, $query);
}

// Periksa apakah query berhasil
if (!$data) {
    die("Query failed: " . mysqli_error($koneksi));
}

$i = 2;
$no = 1;
while ($d = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
    $sheet->setCellValue('A' . $i, $no++); 
    $sheet->setCellValue('B' . $i, isset($d['nama_anggota']) ? $d['nama_anggota'] : 'N/A'); 
    $sheet->setCellValue('C' . $i, isset($d['judul_buku']) ? $d['judul_buku'] : 'N/A'); 
    $sheet->setCellValue('D' . $i, isset($d['tanggal_pinjam']) ? $d['tanggal_pinjam'] : 'N/A');
    $sheet->setCellValue('E' . $i, isset($d['tanggal_kembali']) ? $d['tanggal_kembali'] : 'N/A');
    $i++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('Laporan Buku Peminjaman.xlsx'); 
echo "<script>window.location = 'Laporan Buku Peminjaman.xlsx'</script>";
?>
