<?php

require_once __DIR__ . '/../config/database.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = (int) $_GET['id'];

$query = "SELECT * FROM mata_pelajaran
          WHERE id_matpel = $id";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data tidak ditemukan.");
}

if (isset($_POST['update'])) {

    $nama_matpel = mysqli_real_escape_string(
        $conn,
        $_POST['nama_matpel']
    );

    $query = "UPDATE mata_pelajaran
              SET nama_matpel = '$nama_matpel'
              WHERE id_matpel = $id";

    if (mysqli_query($conn, $query)) {

        header("Location: index.php");
        exit;
    } else {

        echo "Data gagal diubah: "
            . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Mata Pelajaran</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page">

    <h2>Edit Mata Pelajaran</h2>

    <form method="POST">

        <label>Nama Mata Pelajaran</label>
        <br>

        <input
            type="text"
            name="nama_matpel"
            value="<?= htmlspecialchars($data['nama_matpel']); ?>"
            required>

        <br><br>

        <button type="submit" name="update">
            Update
        </button>

        <a href="index.php">
            Batal
        </a>

    </form>

</body>

</html>