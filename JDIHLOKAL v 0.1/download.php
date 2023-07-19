<?php
if (isset($_GET['file'])) {
    $file_path = $_GET['file'];

    // Mengecek apakah file ada
    if (file_exists($file_path)) {
        // Mengirim file sebagai respons unduhan
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
        header('Content-Length: ' . filesize($file_path));

        readfile($file_path);
        exit;
    } else {
        echo "File tidak ditemukan.";
    }
}
