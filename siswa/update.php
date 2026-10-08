<?php

require_once __DIR__ . '/../config/database.php';

$nis = $_GET['nis'];

$query = "SELECT * FROM siswa WHERE nis='$nis'";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data siswa tidak ditemukan");
}

if (isset($_POST['update'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $queryUpdate = "UPDATE siswa
                    SET nama='$nama',
                        alamat='$alamat'
                    WHERE nis='$nis'";

    $resultUpdate = mysqli_query($conn, $queryUpdate);

    if ($resultUpdate) {
        header("Location: index.php");
        exit;
    } else {
        echo "Data gagal diubah";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page">

    <h1>Edit Siswa</h1>

    <form method="POST">

        <label>NIS</label><br>

        <input
            type="text"
            value="<?= htmlspecialchars($data['nis']); ?>"
            disabled>

        <br><br>

        <label>Nama</label><br>

        <input
            type="text"
            name="nama"
            value="<?= htmlspecialchars($data['nama']); ?>"
            required>

        <br><br>

        <label>Alamat</label><br>

        <textarea name="alamat" required><?= htmlspecialchars($data['alamat']); ?></textarea>

        <br><br>

        <button type="submit" name="update">
            Update
        </button>

        <a href="index.php">
            Kembali
        </a>

    </form>

</body>

</html>