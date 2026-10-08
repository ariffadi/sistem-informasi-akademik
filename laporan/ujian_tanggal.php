<?php

require_once __DIR__ . '/../config/database.php';

$query = "SELECT
            ujian.id_ujian,
            ujian.nama_ujian,
            mata_pelajaran.nama_matpel,
            ujian.tanggal

          FROM ujian

          INNER JOIN mata_pelajaran
              ON ujian.id_matpel = mata_pelajaran.id_matpel

          ORDER BY ujian.tanggal ASC";

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

    <title>Ujian Berdasarkan Tanggal</title>

    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page">

    <h2>Ujian Berdasarkan Tanggal</h2>

    <p style="margin-bottom: 20px; color: #64748b;">
        Daftar ujian diurutkan berdasarkan tanggal ujian.
    </p>

    <table>

        <tr>
            <th>ID Ujian</th>
            <th>Nama Ujian</th>
            <th>Mata Pelajaran</th>
            <th>Tanggal</th>
        </tr>

        <?php while ($data = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>
                    <?= $data['id_ujian']; ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['nama_ujian']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['nama_matpel']); ?>
                </td>

                <td>
                    <?= date(
                        'd-m-Y H:i',
                        strtotime($data['tanggal'])
                    ); ?>
                </td>

            </tr>

        <?php } ?>

    </table>

    <a href=index.php class="btn-back">
        ← Kembali ke Laporan
    </a>

</body>

</html>