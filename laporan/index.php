<?php
require_once __DIR__ . '/../config/database.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Akademik</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../style.css">
</head>

<body class="crud-page laporan-page">

    <div class="page-header">
        <h1>Laporan Akademik</h1>

        <p>
            Pilih laporan yang ingin ditampilkan.
        </p>
    </div>


    <div class="report-container">

        <!-- LAPORAN 3A -->
        <div class="report-card">

            <h2>Ujian Berdasarkan Tanggal</h2>

            <p>
                Menampilkan daftar ujian berdasarkan tanggal pelaksanaan.
            </p>

            <a href="ujian_tanggal.php" class="btn">
                Lihat Laporan
            </a>

        </div>


        <!-- LAPORAN 3B -->
        <div class="report-card">

            <h2>Jumlah Peserta Ujian</h2>

            <p>
                Menampilkan nama ujian, mata pelajaran,
                tanggal, dan jumlah peserta.
            </p>

            <a href="jumlah_peserta.php" class="btn">
                Lihat Laporan
            </a>

        </div>


        <!-- LAPORAN 3C -->
        <div class="report-card">

            <h2>Jumlah Siswa Lulus</h2>

            <p>
                Menampilkan jumlah siswa yang mendapatkan
                nilai lulus.
            </p>

            <a href="siswa_lulus.php" class="btn">
                Lihat Laporan
            </a>

        </div>


        <!-- LAPORAN 3D -->
        <div class="report-card">

            <h2> Siswa Tidak Lulus</h2>

            <p>
                Menampilkan siswa yang tidak lulus
                beserta mata pelajaran yang gagal.
            </p>

            <a href="siswa_tidak_lulus.php" class="btn">
                Lihat Laporan
            </a>

        </div>

    </div>


    <a href="../index.php">Kembali ke Menu</a>

</body>

</html>