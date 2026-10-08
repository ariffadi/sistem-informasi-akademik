<?php

require_once __DIR__ . '/../config/database.php';


// ==========================================
// MENGAMBIL DATA SISWA YANG LULUS
// ==========================================

$query = "SELECT
            siswa.nis,
            siswa.nama,
            ujian.nama_ujian,
            mata_pelajaran.nama_matpel,
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

          WHERE peserta.nilai >= 75

          ORDER BY siswa.nama ASC";


$result = mysqli_query($conn, $query);


// ==========================================
// MENGHITUNG JUMLAH SISWA LULUS
// ==========================================

$jumlah_lulus = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Siswa Lulus</title>

    <link rel="stylesheet" href="../style.css">

</head>


<body class="crud-page">


    <h1>Siswa yang Lulus</h1>

    <p>
        Daftar siswa yang mendapatkan nilai minimal 75.
    </p>


    <!-- JUMLAH SISWA LULUS -->

    <div class="information" style="margin-top: 25px;">

        <h2>
            Jumlah Siswa Lulus
        </h2>

        <p style="font-size: 30px; font-weight: bold; color: #2563eb;">

            <?php echo $jumlah_lulus; ?>

            <span style="font-size: 16px; color: #64748b;">
                siswa
            </span>

        </p>

    </div>


    <!-- DATA SISWA LULUS -->

    <h2 style="margin-top: 30px;">
        Data Siswa Lulus
    </h2>


    <table>

        <thead>

            <tr>

                <th>No</th>

                <th>NIS</th>

                <th>Nama Siswa</th>

                <th>Nama Ujian</th>

                <th>Mata Pelajaran</th>

                <th>Nilai</th>

                <th>Status</th>

            </tr>

        </thead>


        <tbody>

            <?php

            $no = 1;

            if (mysqli_num_rows($result) > 0) {

                while ($data = mysqli_fetch_assoc($result)) {

            ?>

                    <tr>

                        <td>
                            <?php echo $no++; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['nis']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['nama']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['nama_ujian']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['nama_matpel']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['nilai']); ?>
                        </td>

                        <td>
                            <strong style="color: green;">
                                <?php echo htmlspecialchars($data['status']); ?>
                            </strong>
                        </td>

                    </tr>

                <?php

                }
            } else {

                ?>

                <tr>

                    <td colspan="7" style="text-align: center;">

                        Belum ada siswa yang lulus.

                    </td>

                </tr>

            <?php

            }

            ?>

        </tbody>

    </table>


    <a href="index.php" class="btn-back">
        ← Kembali ke Laporan
    </a>


</body>

</html>