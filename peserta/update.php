<?php

require_once __DIR__ . '/../config/database.php';


/*
 * Cek ID
 */

if (!isset($_GET['id'])) {

    die("ID peserta tidak ditemukan.");
}


$id = (int) $_GET['id'];


/*
 * Ambil data peserta
 */

$query = "SELECT *
          FROM peserta
          WHERE id_peserta = $id";

$result = mysqli_query($conn, $query);

if (!$result) {

    die("Query gagal: " . mysqli_error($conn));
}


$data = mysqli_fetch_assoc($result);


if (!$data) {

    die("Data peserta tidak ditemukan.");
}


/*
 * Ambil data siswa
 */

$query_siswa = "SELECT *
                FROM siswa
                ORDER BY nama ASC";

$result_siswa = mysqli_query(
    $conn,
    $query_siswa
);

if (!$result_siswa) {

    die("Query siswa gagal: "
        . mysqli_error($conn));
}


/*
 * Ambil data ujian
 */

$query_ujian = "SELECT

                    ujian.id_ujian,
                    ujian.nama_ujian,
                    ujian.tanggal,
                    mata_pelajaran.nama_matpel

                FROM ujian

                INNER JOIN mata_pelajaran
                    ON ujian.id_matpel =
                       mata_pelajaran.id_matpel

                ORDER BY ujian.tanggal ASC";


$result_ujian = mysqli_query(
    $conn,
    $query_ujian
);


if (!$result_ujian) {

    die("Query ujian gagal: "
        . mysqli_error($conn));
}


/*
 * Proses UPDATE
 */

if (isset($_POST['update'])) {

    $nis = mysqli_real_escape_string(
        $conn,
        $_POST['nis']
    );

    $id_ujian = (int) $_POST['id_ujian'];

    $nilai = (int) $_POST['nilai'];


    /*
     * Validasi nilai
     */

    if ($nilai < 0 || $nilai > 100) {

        echo "Nilai harus berada antara 0 sampai 100.";
    } else {

        $query_update = "UPDATE peserta

                         SET
                             nis = '$nis',
                             id_ujian = $id_ujian,
                             nilai = $nilai

                         WHERE id_peserta = $id";


        if (mysqli_query($conn, $query_update)) {

            header("Location: index.php");

            exit;
        } else {

            echo "Data gagal diubah: "
                . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Edit Peserta</title>

    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page">

    <h2>Edit Peserta Ujian</h2>


    <form method="POST">


        <!-- SISWA -->

        <label>Siswa</label>

        <br>

        <select name="nis" required>

            <option value="">
                -- Pilih Siswa --
            </option>

            <?php while (
                $siswa = mysqli_fetch_assoc($result_siswa)
            ) { ?>

                <option
                    value="<?= htmlspecialchars($siswa['nis']); ?>"

                    <?= ($siswa['nis'] == $data['nis'])
                        ? 'selected'
                        : ''; ?>>

                    <?= htmlspecialchars($siswa['nis']); ?>

                    -

                    <?= htmlspecialchars($siswa['nama']); ?>

                </option>

            <?php } ?>

        </select>


        <br><br>


        <!-- UJIAN -->

        <label>Ujian</label>

        <br>

        <select name="id_ujian" required>

            <option value="">
                -- Pilih Ujian --
            </option>

            <?php while (
                $ujian = mysqli_fetch_assoc($result_ujian)
            ) { ?>

                <option
                    value="<?= $ujian['id_ujian']; ?>"

                    <?= ($ujian['id_ujian']
                        == $data['id_ujian'])
                        ? 'selected'
                        : ''; ?>>

                    <?= htmlspecialchars(
                        $ujian['nama_ujian']
                    ); ?>

                    -

                    <?= htmlspecialchars(
                        $ujian['nama_matpel']
                    ); ?>

                    -

                    <?= $ujian['tanggal']; ?>

                </option>

            <?php } ?>

        </select>


        <br><br>


        <!-- NILAI -->

        <label>Nilai</label>

        <br>

        <input
            type="number"
            name="nilai"
            min="0"
            max="100"
            value="<?= $data['nilai']; ?>"
            required>


        <br><br>


        <button type="submit" name="update">
            Update
        </button>

        <a href="index.php">
            Batal
        </a>

    </form>


    <a href="../index.php" class="btn-back">
        ← Kembali ke Dashboard
    </a>

</body>

</html>