<?php

require_once __DIR__ . '/../config/database.php';

$siswa = mysqli_query(
    $conn,
    "SELECT *
     FROM siswa
     ORDER BY nama ASC"
);

$ujian = mysqli_query(
    $conn,
    "SELECT
        ujian.id_ujian,
        ujian.nama_ujian,
        ujian.tanggal,
        mata_pelajaran.nama_matpel

     FROM ujian

     INNER JOIN mata_pelajaran
         ON ujian.id_matpel = mata_pelajaran.id_matpel

     ORDER BY ujian.tanggal ASC"
);


if (isset($_POST['simpan'])) {

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

        $query = "INSERT INTO peserta
                  (id_ujian, nis, nilai)

                  VALUES
                  ($id_ujian, '$nis', $nilai)";


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
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Tambah Peserta</title>

    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page">

    <h2>Tambah Peserta Ujian</h2>

    <form method="POST">

        <!-- SISWA -->

        <label>Siswa</label>

        <br>

        <select name="nis" required>

            <option value="">
                -- Pilih Siswa --
            </option>

            <?php while ($data = mysqli_fetch_assoc($siswa)) { ?>

                <option
                    value="<?= htmlspecialchars($data['nis']); ?>">

                    <?= htmlspecialchars($data['nis']); ?>

                    -

                    <?= htmlspecialchars($data['nama']); ?>

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

            <?php while ($data = mysqli_fetch_assoc($ujian)) { ?>

                <option
                    value="<?= $data['id_ujian']; ?>">

                    <?= htmlspecialchars($data['nama_ujian']); ?>

                    -

                    <?= htmlspecialchars($data['nama_matpel']); ?>

                    -

                    <?= $data['tanggal']; ?>

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
            placeholder="Masukkan nilai 0 - 100"
            required>


        <br><br>


        <button type="submit" name="simpan">
            Simpan
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