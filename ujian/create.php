<?php

require_once __DIR__ . '/../config/database.php';

$matpel = mysqli_query(
    $conn,
    "SELECT * FROM mata_pelajaran
     ORDER BY nama_matpel ASC"
);

if (isset($_POST['simpan'])) {

    $nama_ujian = mysqli_real_escape_string(
        $conn,
        $_POST['nama_ujian']
    );

    $id_matpel = (int) $_POST['id_matpel'];

    $tanggal = mysqli_real_escape_string(
        $conn,
        $_POST['tanggal']
    );

    $query = "INSERT INTO ujian
              (nama_ujian, id_matpel, tanggal)
              VALUES
              ('$nama_ujian', $id_matpel, '$tanggal')";

    if (mysqli_query($conn, $query)) {

        header("Location: index.php");
        exit;
    } else {

        echo "Data gagal disimpan: "
            . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Ujian</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page>

    <h2>Tambah Ujian</h2>

    <form method=" POST">

    <label>Nama Ujian</label>
    <br>

    <input
        type="text"
        name="nama_ujian"
        required>

    <br><br>

    <label>Mata Pelajaran</label>
    <br>

    <select name="id_matpel" required>

        <option value="">
            -- Pilih Mata Pelajaran --
        </option>

        <?php while ($data = mysqli_fetch_assoc($matpel)) { ?>

            <option value="<?= $data['id_matpel']; ?>">

                <?= htmlspecialchars($data['nama_matpel']); ?>

            </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Tanggal Ujian</label>
    <br>

    <input
        type="datetime-local"
        name="tanggal"
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