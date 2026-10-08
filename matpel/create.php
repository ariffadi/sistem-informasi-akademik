<?php

require_once __DIR__ . '/../config/database.php';

if (isset($_POST['simpan'])) {

    $nama_matpel = mysqli_real_escape_string(
        $conn,
        $_POST['nama_matpel']
    );

    if ($nama_matpel == '') {

        echo "Nama mata pelajaran harus diisi.";
    } else {

        $query = "INSERT INTO mata_pelajaran (nama_matpel)
                  VALUES ('$nama_matpel')";

        if (mysqli_query($conn, $query)) {

            header("Location: index.php");
            exit;
        } else {

            echo "Data gagal disimpan: "
                . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Mata Pelajaran</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page">

    <h2>Tambah Mata Pelajaran</h2>

    <form method="POST">

        <label>Nama Mata Pelajaran</label>
        <br>

        <input
            type="text"
            name="nama_matpel"
            required>

        <br><br>

        <button type="submit" name="simpan">
            Simpan
        </button>

        <a href="index.php">
            Batal
        </a>

    </form>

</body>

</html>