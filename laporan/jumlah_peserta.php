<?php

require_once __DIR__ . '/../config/database.php';

$query = "SELECT
            ujian.nama_ujian,
            mata_pelajaran.nama_matpel,
            ujian.tanggal,
            COUNT(peserta.id_peserta) AS jumlah_peserta,

            SUM(
                CASE
                    WHEN peserta.nilai < 75 THEN 1
                    ELSE 0
                END
            ) AS jumlah_tidak_lulus

          FROM ujian

          INNER JOIN mata_pelajaran
              ON ujian.id_matpel = mata_pelajaran.id_matpel

          LEFT JOIN peserta
              ON ujian.id_ujian = peserta.id_ujian

          GROUP BY
              ujian.id_ujian,
              ujian.nama_ujian,
              mata_pelajaran.nama_matpel,
              ujian.tanggal

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

    <title>Jumlah Peserta Ujian</title>

    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page">

    <h2>Jumlah Peserta Setiap Ujian</h2>

    <p style="margin-bottom: 20px; color: #64748b;">
        Menampilkan jumlah siswa yang mengikuti setiap ujian.
    </p>

    <table>

        <tr>
            <th>Nama Ujian</th>
            <th>Mata Pelajaran</th>
            <th>Tanggal</th>
            <th>Jumlah Peserta</th>
            <th>Jumlah Peserta tidak lulus</th>
        </tr>

        <?php while ($data = mysqli_fetch_assoc($result)) { ?>

            <tr>

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

                <td>
                    <?= $data['jumlah_peserta']; ?> siswa
                </td>

                <td>
                    <?= $data['jumlah_tidak_lulus']; ?> siswa
                </td>

            </tr>

        <?php } ?>

    </table>

    <a href="index.php" class="btn-back">
        ← Kembali ke Laporan
    </a>

</body>

</html>