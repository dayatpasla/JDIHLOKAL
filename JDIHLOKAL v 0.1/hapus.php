<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menampilkan konfirmasi penghapusan dengan JavaScript
    $confirmation = "<script>if (confirm('Apakah Anda yakin ingin menghapus data ini?')) { window.location.href = 'hapus.php?id=$id&confirmed=true'; } else { window.location.href = 'index.php'; }</script>";
    echo $confirmation;
    exit;
}

if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true') {
    $id = $_GET['id'];

    // Menghapus data dari database
    $query = "DELETE FROM data WHERE id=$id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: index.php');
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}
