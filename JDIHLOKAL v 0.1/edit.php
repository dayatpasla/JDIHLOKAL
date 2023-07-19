<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $nomor = $_POST['nomor'];
    $tahun = $_POST['tahun'];
    $tentang = $_POST['tentang'];

    // Mengupdate data di database
    $query = "UPDATE data SET judul='$judul', nomor='$nomor', tahun='$tahun', tentang='$tentang' WHERE id=$id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: index.php');
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($koneksi);
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data yang akan diedit dari database
    $query = "SELECT * FROM data WHERE id=$id";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Data</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Edit Data</h1>

    <form method="post" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <label>Judul:</label>
        <input type="text" name="judul" value="<?php echo $data['judul']; ?>" required><br><br>

        <label>Nomor:</label>
        <input type="text" name="nomor" value="<?php echo $data['nomor']; ?>" required><br><br>

        <label>Tahun:</label>
        <input type="number" name="tahun" value="<?php echo $data['tahun']; ?>" required><br><br>

        <label>Tentang:</label>
        <textarea name="tentang" required><?php echo $data['tentang']; ?></textarea><br><br>

        <input type="submit" value="Simpan">
    </form>
    <!-- Tombol Kembali -->
    <a href="index.php">Kembali</a>
</body>

</html>