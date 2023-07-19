<?php
include 'koneksi.php';

// Fungsi untuk mendapatkan semua data dari tabel
function getData()
{
    global $koneksi;
    $query = "SELECT * FROM data";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

// Memanggil fungsi untuk mendapatkan data
$data = getData();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Aplikasi CRUD</title>
    <link rel="stylesheet" href="DataTables/datatables.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>JDIH LOKAL</h1>

    <!-- Form untuk menambah data -->
    <h2>Tambah Data</h2>
    <form method="post" action="simpan.php" enctype="multipart/form-data">
        <label>Judul:</label>
        <input type="text" name="judul" required><br><br>

        <label>Nomor:</label>
        <input type="text" name="nomor" required><br><br>

        <label>Tahun:</label>
        <input type="number" name="tahun" required><br><br>

        <label>Tentang:</label>
        <textarea name="tentang" required></textarea><br><br>

        <label>File:</label>
        <input type="file" name="file" required><br><br>

        <input type="submit" value="Simpan">
    </form>

    <!-- Tabel untuk menampilkan data -->
    <h2>Data</h2>
    <table id="data-table" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Nomor</th>
                <th>Tahun</th>
                <th>Tentang</th>
                <th>File</th>
                <th>Unduh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($data)) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['nomor']; ?></td>
                    <td><?php echo $row['tahun']; ?></td>
                    <td><?php echo $row['tentang']; ?></td>
                    <td><?php echo $row['file_path']; ?></td>
                    <td><a href="download.php?file=<?php echo urlencode($row['file_path']); ?>">Unduh</a></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="DataTables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable();
        });
    </script>
</body>

</html>