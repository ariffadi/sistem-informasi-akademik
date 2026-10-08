<?php
require_once __DIR__ . '/config/database.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem Informasi Akademik</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            <h2>SIAKAD</h2>
            <p>Sistem Akademik</p>
        </div>


        <nav class="menu">

            <a href="index.php" class="menu-item active">
                <span>⌂</span>
                Dashboard
            </a>

            <a href="siswa/index.php" class="menu-item">
                <span>👨‍🎓</span>
                Data Siswa
            </a>

            <a href="matpel/index.php" class="menu-item">
                <span>📚</span>
                Mata Pelajaran
            </a>

            <a href="ujian/index.php" class="menu-item">
                <span>📝</span>
                Data Ujian
            </a>

            <a href="peserta/index.php" class="menu-item">
                <span>👥</span>
                Peserta Ujian
            </a>

            <a href="kelulusan/index.php" class="menu-item">
                <span>🎓</span>
                Kelulusan
            </a>

            <a href="laporan/index.php" class="menu-item">
                <span>📊</span>
                Laporan
            </a>

            <div class="algorithm-menu">

                <button type="button"
                    class="menu-item algorithm-toggle"
                    onclick="toggleAlgorithmMenu()">

                    <span>💻</span>

                    <span class="algorithm-title">
                        Algoritma
                    </span>

                    <span class="arrow">
                        ▾
                    </span>

                </button>


                <!-- SUBMENU -->

                <div class="algorithm-submenu" id="algorithmSubmenu">

                    <a href="algoritma/fibonacci.php">
                        Fibonacci Rekursif
                    </a>

                    <a href="algoritma/sorting.php">
                        Sorting Manual
                    </a>

                    <a href="algoritma/max_min.php">
                        Terbesar / Terkecil
                    </a>

                    <a href="algoritma/umur.php">
                        Menghitung Umur
                    </a>

                </div>

            </div>

        </nav>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- HEADER -->
        <header class="header">

            <div>
                <h1>Dashboard</h1>
                <p>
                    Sistem Informasi Akademik
                </p>
            </div>

        </header>


        <!-- WELCOME -->
        <section class="welcome">

            <div>

                <h2>Selamat Datang 👋</h2>

                <p>
                    Selamat datang di Sistem Informasi Akademik.
                    Silakan pilih menu untuk mengelola data akademik.
                </p>

            </div>

        </section>


        <!-- MENU CARDS -->
        <section class="card-container">


            <!-- SISWA -->
            <a href="siswa/index.php" class="dashboard-card">

                <div class="card-icon">
                    👨‍🎓
                </div>

                <div class="card-content">

                    <h3>Data Siswa</h3>

                    <p>
                        Mengelola data siswa seperti NIS,
                        nama, dan alamat.
                    </p>

                </div>

            </a>


            <!-- MATA PELAJARAN -->
            <a href="matpel/index.php" class="dashboard-card">

                <div class="card-icon">
                    📚
                </div>

                <div class="card-content">

                    <h3>Mata Pelajaran</h3>

                    <p>
                        Mengelola data mata pelajaran
                        yang tersedia.
                    </p>

                </div>

            </a>


            <!-- UJIAN -->
            <a href="ujian/index.php" class="dashboard-card">

                <div class="card-icon">
                    📝
                </div>

                <div class="card-content">

                    <h3>Data Ujian</h3>

                    <p>
                        Mengelola data ujian,
                        mata pelajaran, dan tanggal ujian.
                    </p>

                </div>

            </a>


            <!-- PESERTA -->
            <a href="peserta/index.php" class="dashboard-card">

                <div class="card-icon">
                    👥
                </div>

                <div class="card-content">

                    <h3>Peserta Ujian</h3>

                    <p>
                        Mengelola siswa yang mengikuti
                        suatu ujian.
                    </p>

                </div>

            </a>


        </section>


        <!-- INFORMATION -->
        <section class="information">

            <h2>Informasi Sistem</h2>

            <p>
                Aplikasi ini digunakan untuk mengelola
                data akademik yang terdiri dari siswa,
                mata pelajaran, ujian, dan peserta ujian.
            </p>

        </section>


        <!-- FOOTER -->
        <footer>

            <p>
                © 2026 Sistem Informasi Akademik
            </p>

        </footer>

    </main>


    <script>
        function toggleAlgorithmMenu() {

            const submenu =
                document.getElementById("algorithmSubmenu");

            const button =
                document.querySelector(".algorithm-toggle");


            submenu.classList.toggle("show");

            button.classList.toggle("open");

        }
    </script>
</body>

</html>