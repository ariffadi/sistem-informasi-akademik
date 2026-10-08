<?php

require_once __DIR__ . '/../config/database.php';

$query = "SELECT
            siswa.nis,
            siswa.nama,
            mata_pelajaran.nama_matpel,
            ujian.nama_ujian,
            peserta.nilai

          FROM peserta

          INNER JOIN siswa
              ON peserta.nis = siswa.nis

          INNER JOIN ujian
              ON peserta.id_ujian = ujian.id_ujian

          INNER JOIN mata_pelajaran
              ON ujian.id_matpel = mata_pelajaran.id_matpel

          WHERE peserta.nilai < 75

          ORDER BY siswa.nama ASC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Siswa Tidak Lulus</title>

    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page">

    <h2>Siswa yang Tidak Lulus</h2>

    <p style="margin-bottom: 20px; color: #64748b;">
        Menampilkan siswa dengan nilai di bawah 75
        beserta mata pelajaran yang tidak lulus.
    </p>

    <table>

        <tr>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Mata Pelajaran</th>
            <th>Ujian</th>
            <th>Nilai</th>
        </tr>

        <?php while ($data = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>
                    <?= htmlspecialchars($data['nis']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['nama']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['nama_matpel']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['nama_ujian']); ?>
                </td>

                <td>
                    <?= $data['nilai']; ?>
                </td>

            </tr>

        <?php } ?>

    </table>

    <a href="index.php" class="btn-back">
        ← Kembali ke Laporan
    </a>

</body>

</html>