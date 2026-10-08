<?php

$hasil = null;
$jenis = "";

if (isset($_POST['angka']) && isset($_POST['pilihan'])) {

    // Mengambil input angka
    $input = $_POST['angka'];

    // Memisahkan angka berdasarkan koma
    $angka = explode(',', $input);

    // Mengubah input menjadi integer
    for ($i = 0; $i < count($angka); $i++) {
        $angka[$i] = intval(trim($angka[$i]));
    }

    // Mengambil pilihan
    $pilihan = $_POST['pilihan'];

    // Nilai awal menggunakan angka pertama
    $hasil = $angka[0];

    // Mencari nilai terbesar
    if ($pilihan == "A") {

        $jenis = "Nilai Terbesar";

        for ($i = 1; $i < count($angka); $i++) {

            if ($angka[$i] > $hasil) {
                $hasil = $angka[$i];
            }
        }

        // Mencari nilai terkecil
    } elseif ($pilihan == "B") {

        $jenis = "Nilai Terkecil";

        for ($i = 1; $i < count($angka); $i++) {

            if ($angka[$i] < $hasil) {
                $hasil = $angka[$i];
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nilai Terbesar dan Terkecil</title>

    <link rel="stylesheet" href="../style.css">
</head>

<body class="crud-page">

    <h1>Nilai Terbesar dan Terkecil</h1>

    <p>
        Program mencari nilai terbesar atau terkecil
        menggunakan looping secara manual.
    </p>

    <form method="POST">

        <label>Masukkan beberapa angka:</label>

        <input
            type="text"
            name="angka"
            placeholder="Contoh: 10,25,7,40,15"
            required>

        <br><br>

        <label>Pilih operasi:</label>

        <select name="pilihan" required>

            <option value="">-- Pilih --</option>

            <option value="A">
                A - Nilai Terbesar
            </option>

            <option value="B">
                B - Nilai Terkecil
            </option>

        </select>

        <br><br>

        <button type="submit">
            Proses
        </button>

    </form>

    <?php if ($hasil !== null) { ?>

        <div class="information" style="margin-top:25px;">

            <h2>Hasil</h2>

            <p>
                <?php echo $jenis; ?>:
                <strong><?php echo $hasil; ?></strong>
            </p>

        </div>

    <?php } ?>

    <a href="../index.php" class="btn-back">
        ← Kembali ke Dashboard
    </a>

</body>

</html>