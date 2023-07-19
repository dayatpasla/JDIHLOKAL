<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $nomor = $_POST['nomor'];
    $tahun = $_POST['tahun'];
    $tentang = $_POST['tentang'];
    $file = $_FILES['file'];

    $nama_file = $file['name'];
    $ukuran_file = $file['size'];
    $tipe_file = $file['type'];
    $tmp_file = $file['tmp_name'];

    // Memindahkan file yang diupload ke folder tujuan
    $folder = 'uploads/';
    move_uploaded_file($tmp_file, $folder . $nama_file);

    // Menyimpan data ke database
    $query = "INSERT INTO data (judul, nomor, tahun, tentang, file_path) VALUES ('$judul', '$nomor', '$tahun', '$tentang', '$folder$nama_file')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: index.php');
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
