<?php

require_once __DIR__ . '/../config/database.php';

$query = "SELECT
            peserta.id_peserta,
            siswa.nis,
            siswa.nama,
            ujian.nama_ujian,
            mata_pelajaran.nama_matpel,
            ujian.tanggal,
            peserta.nilai,

            CASE
                WHEN peserta.nilai >= 75
                THEN 'Lulus'
                ELSE 'Tidak Lulus'
            END AS status

          FROM peserta

          INNER JOIN siswa
              ON peserta.nis = siswa.nis

          INNER JOIN ujian
              ON peserta.id_ujian = ujian.id_ujian

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

    <title>Data Peserta Ujian</title>

    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page">

    <h2>Data Peserta Ujian</h2>

    <a href="create.php">
        + Tambah Peserta
    </a>

    <br><br>

    <table>

        <tr>
            <th>ID</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Ujian</th>
            <th>Mata Pelajaran</th>
            <th>Tanggal</th>
            <th>Nilai</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php while ($data = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>
                    <?= $data['id_peserta']; ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['nis']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['nama']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['nama_ujian']); ?>
                </td>

                <td>
                    <?= htmlspecialchars($data['nama_matpel']); ?>
                </td>

                <td>
                    <?= $data['tanggal']; ?>
                </td>

                <td>
                    <?= $data['nilai']; ?>
                </td>

                <td>

                    <?php if ($data['status'] == 'Lulus') { ?>

                        <strong style="color: green;">
                            Lulus
                        </strong>

                    <?php } else { ?>

                        <strong style="color: red;">
                            Tidak Lulus
                        </strong>

                    <?php } ?>

                </td>

                <td>

                    <a href="update.php?id=<?= $data['id_peserta']; ?>">
                        Edit
                    </a>

                    |

                    <a
                        href="delete.php?id=<?= $data['id_peserta']; ?>"
                        onclick="return confirm('Yakin ingin menghapus peserta ini?')">
                        Hapus
                    </a>

                </td>

            </tr>

        <?php } ?>

    </table>

    <br>

    <a href="../index.php" class="btn-back">
        ← Kembali ke Dashboard
    </a>

</body>

</html>