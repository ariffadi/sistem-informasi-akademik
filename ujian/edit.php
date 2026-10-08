<?php

require_once __DIR__ . '/../config/database.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = (int) $_GET['id'];

$query = "SELECT * FROM ujian
          WHERE id_ujian = $id";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data ujian tidak ditemukan.");
}

$matpel = mysqli_query(
    $conn,
    "SELECT * FROM mata_pelajaran
     ORDER BY nama_matpel ASC"
);

if (isset($_POST['update'])) {

    $nama_ujian = mysqli_real_escape_string(
        $conn,
        $_POST['nama_ujian']
    );

    $id_matpel = (int) $_POST['id_matpel'];

    $tanggal = mysqli_real_escape_string(
        $conn,
        $_POST['tanggal']
    );

    $query = "UPDATE ujian SET
              nama_ujian = '$nama_ujian',
              id_matpel = $id_matpel,
              tanggal = '$tanggal'
              WHERE id_ujian = $id";

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
    <title>Edit Ujian</title>
    <link rel="stylesheet" href="../style.css">

</head class="crud-page">

<body>

    <h2>Edit Ujian</h2>

    <form method=" POST">

        <label>Nama Ujian</label>
        <br>

        <input
            type="text"
            name="nama_ujian"
            value="<?= htmlspecialchars($data['nama_ujian']); ?>"
            required>

        <br><br>

        <label>Mata Pelajaran</label>
        <br>

        <select name="id_matpel" required>

            <?php while ($m = mysqli_fetch_assoc($matpel)) { ?>

                <option
                    value="<?= $m['id_matpel']; ?>"
                    <?= ($m['id_matpel'] == $data['id_matpel'])
                        ? 'selected'
                        : ''; ?>>

                    <?= htmlspecialchars($m['nama_matpel']); ?>

                </option>

            <?php } ?>

        </select>

        <br><br>

        <label>Tanggal Ujian</label>
        <br>

        <input
            type="datetime-local"
            name="tanggal"
            value="<?= date(
                        'Y-m-d\TH:i',
                        strtotime($data['tanggal'])
                    ); ?>"
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