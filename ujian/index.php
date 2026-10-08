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
<html>

<head>
    <title>Data Ujian</title>
    <link rel="stylesheet" href="../style.css">

</head class="crud-page>

<body>

    <h2>Data Ujian</h2>

    <a href=" create.php">+ Tambah Ujian</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">

    <tr>
        <th>ID</th>
        <th>Nama Ujian</th>
        <th>Mata Pelajaran</th>
        <th>Tanggal</th>
        <th>Aksi</th>
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
                <?= $data['tanggal']; ?>
            </td>

            <td>

                <a href="update.php?id=<?= $data['id_ujian']; ?>">
                    Edit
                </a>

                |

                <a
                    href="delete.php?id=<?= $data['id_ujian']; ?>"
                    onclick="return confirm('Yakin ingin menghapus ujian ini?')">
                    Hapus
                </a>

            </td>

        </tr>

    <?php } ?>

</table>

<br>

<a href="../index.php">Kembali ke Menu</a>

</body>

</html>