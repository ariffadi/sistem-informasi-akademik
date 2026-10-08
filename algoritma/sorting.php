<?php

$hasil = [];

if (isset($_POST['angka'])) {

    // Mengambil input dari form
    $input = $_POST['angka'];

    // Memisahkan angka berdasarkan koma
    $angka = explode(',', $input);

    // Mengubah setiap nilai menjadi integer
    for ($i = 0; $i < count($angka); $i++) {
        $angka[$i] = intval(trim($angka[$i]));
    }

    // Proses sorting manual
    for ($i = 0; $i < count($angka) - 1; $i++) {

        for ($j = 0; $j < count($angka) - 1 - $i; $j++) {

            // Jika angka sekarang lebih besar dari angka berikutnya
            if ($angka[$j] > $angka[$j + 1]) {

                // Tukar nilai
                $sementara = $angka[$j];
                $angka[$j] = $angka[$j + 1];
                $angka[$j + 1] = $sementara;
            }
        }
    }

    $hasil = $angka;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sorting Manual</title>

    <link rel="stylesheet" href="../style.css">
</head>

<body class="crud-page">

    <h1>Sorting Manual</h1>

    <p>
        Program mengurutkan beberapa angka menggunakan looping
        tanpa menggunakan fungsi sort().
    </p>

    <form method="POST">

        <label>Masukkan angka:</label>

        <input
            type="text"
            name="angka"
            placeholder="Contoh: 8,3,5,1,9"
            required>

        <br><br>

        <button type="submit">
            Urutkan
        </button>

    </form>

    <?php if (!empty($hasil)) { ?>

        <div class="information" style="margin-top:25px;">

            <h2>Hasil Sorting</h2>

            <p>
                <?php echo implode(", ", $hasil); ?>
            </p>

        </div>

    <?php } ?>

    <a href="../index.php" class="btn-back">
        ← Kembali ke Dashboard
    </a>

</body>

</html>