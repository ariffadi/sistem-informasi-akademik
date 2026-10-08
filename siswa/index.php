<?php

require_once __DIR__ . '/../config/database.php';

$query = "SELECT * FROM siswa ORDER BY nis ASC";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Siswa</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="crud-page">

    <h1>Data Siswa</h1>

    <a href="create.php">+ Tambah Siswa</a>

    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) : ?>

            <tr>
                <td><?= htmlspecialchars($row['nis']); ?></td>

                <td><?= htmlspecialchars($row['nama']); ?></td>

                <td><?= htmlspecialchars($row['alamat']); ?></td>

                <td>
                    <a href="update.php?nis=<?= urlencode($row['nis']); ?>">
                        Edit
                    </a>

                    |

                    <a
                        href="delete.php?nis=<?= urlencode($row['nis']); ?>"
                        onclick="return confirm('Yakin ingin menghapus data?')">
                        Hapus
                    </a>
                </td>
            </tr>

        <?php endwhile; ?>

    </table>
    <a href="../index.php" class="btn-back">
        ← Kembali ke Dashboard
    </a>
</body>

</html>