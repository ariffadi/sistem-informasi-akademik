<?php

require_once __DIR__ . '/../config/database.php';

if (isset($_POST['simpan'])) {

    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO siswa (nis, nama, alamat)
              VALUES ('$nis', '$nama', '$alamat')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: index.php");
        exit;
    } else {
        echo "Data gagal disimpan";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="crud-page">

    <h1>Tambah Siswa</h1>

    <form method="POST">

        <label>NIS</label><br>
        <input type="text" name="nis" required>

        <br><br>

        <label>Nama</label><br>
        <input type="text" name="nama" required>

        <br><br>

        <label>Alamat</label><br>
        <textarea name="alamat" required></textarea>

        <br><br>

        <button type="submit" name="simpan">
            Simpan
        </button>

        <a href="index.php">
            Kembali
        </a>

    </form>

</body>

</html>