<?php

require_once __DIR__ . '/../config/database.php';

$query = "SELECT * FROM mata_pelajaran ORDER BY id_matpel ASC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Mata Pelajaran</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page">

    <h2>Data Mata Pelajaran</h2>

    <a href="create.php">+ Tambah Mata Pelajaran</a>

    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">

        <tr>
            <th>ID</th>
            <th>Nama Mata Pelajaran</th>
            <th>Aksi</th>
        </tr>

        <?php while ($data = mysqli_fetch_assoc($result)) { ?>

            <tr>
                <td><?= $data['id_matpel']; ?></td>

                <td><?= htmlspecialchars($data['nama_matpel']); ?></td>

                <td>
                    <a href="update.php?id=<?= $data['id_matpel']; ?>">
                        Edit
                    </a>

                    |

                    <a href="delete.php?id=<?= $data['id_matpel']; ?>"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">
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