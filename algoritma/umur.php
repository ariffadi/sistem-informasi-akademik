<?php

$hasil = null;

if (isset($_POST['tanggal_lahir'])) {

    $tanggal_lahir = $_POST['tanggal_lahir'];

    // Format input: mm-dd-yyyy
    $bagian = explode('-', $tanggal_lahir);

    $bulan_lahir = intval($bagian[0]);
    $hari_lahir = intval($bagian[1]);
    $tahun_lahir = intval($bagian[2]);

    // Mengambil tanggal hari ini
    $hari_sekarang = intval(date('d'));
    $bulan_sekarang = intval(date('m'));
    $tahun_sekarang = intval(date('Y'));

    // Menghitung umur awal
    $umur_tahun = $tahun_sekarang - $tahun_lahir;
    $umur_bulan = $bulan_sekarang - $bulan_lahir;
    $umur_hari = $hari_sekarang - $hari_lahir;

    // Jika jumlah hari negatif
    if ($umur_hari < 0) {
        $umur_bulan--;

        // Menentukan jumlah hari pada bulan sebelumnya
        if ($bulan_sekarang == 1) {
            $bulan_sebelumnya = 12;
            $tahun_bulan_sebelumnya = $tahun_sekarang - 1;
        } else {
            $bulan_sebelumnya = $bulan_sekarang - 1;
            $tahun_bulan_sebelumnya = $tahun_sekarang;
        }

        // Menentukan jumlah hari bulan sebelumnya
        if (
            $bulan_sebelumnya == 1 ||
            $bulan_sebelumnya == 3 ||
            $bulan_sebelumnya == 5 ||
            $bulan_sebelumnya == 7 ||
            $bulan_sebelumnya == 8 ||
            $bulan_sebelumnya == 10 ||
            $bulan_sebelumnya == 12
        ) {
            $jumlah_hari_bulan_sebelumnya = 31;
        } elseif (
            $bulan_sebelumnya == 4 ||
            $bulan_sebelumnya == 6 ||
            $bulan_sebelumnya == 9 ||
            $bulan_sebelumnya == 11
        ) {
            $jumlah_hari_bulan_sebelumnya = 30;
        } else {

            // Februari
            if (
                ($tahun_bulan_sebelumnya % 400 == 0) ||
                (($tahun_bulan_sebelumnya % 4 == 0) &&
                    ($tahun_bulan_sebelumnya % 100 != 0))
            ) {
                $jumlah_hari_bulan_sebelumnya = 29;
            } else {
                $jumlah_hari_bulan_sebelumnya = 28;
            }
        }

        $umur_hari += $jumlah_hari_bulan_sebelumnya;
    }

    // Jika jumlah bulan negatif
    if ($umur_bulan < 0) {
        $umur_tahun--;
        $umur_bulan += 12;
    }

    // Menghitung tahun kabisat yang sudah dilewati
    $jumlah_kabisat = 0;

    for ($tahun = $tahun_lahir; $tahun <= $tahun_sekarang; $tahun++) {

        if (
            ($tahun % 400 == 0) ||
            (($tahun % 4 == 0) && ($tahun % 100 != 0))
        ) {
            $jumlah_kabisat++;
        }
    }

    $hasil = [
        'tahun' => $umur_tahun,
        'bulan' => $umur_bulan,
        'hari' => $umur_hari,
        'kabisat' => $jumlah_kabisat
    ];
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Hitung Umur</title>

    <link rel="stylesheet" href="../style.css">

</head>

<body class="crud-page">

    <h1>Menghitung Umur</h1>

    <p>
        Masukkan tanggal lahir dengan format
        <strong>mm-dd-yyyy</strong>.
    </p>

    <form method="POST">

        <label>Tanggal Lahir:</label>

        <input
            type="text"
            name="tanggal_lahir"
            placeholder="Contoh: 05-20-2000"
            required>

        <br><br>

        <button type="submit">
            Hitung Umur
        </button>

    </form>

    <?php if ($hasil !== null) { ?>

        <div class="information" style="margin-top:25px;">

            <h2>Hasil Perhitungan</h2>

            <p>
                Umur:
                <strong>
                    <?php echo $hasil['tahun']; ?> tahun,
                    <?php echo $hasil['bulan']; ?> bulan,
                    <?php echo $hasil['hari']; ?> hari
                </strong>
            </p>

            <p>
                Jumlah tahun kabisat yang dilewati:
                <strong>
                    <?php echo $hasil['kabisat']; ?> tahun
                </strong>
            </p>

        </div>

    <?php } ?>

    <a href="../index.php" class="btn-back">
        ← Kembali ke Dashboard
    </a>

</body>

</html>