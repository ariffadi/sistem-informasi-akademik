<?php

function fibonacci($n)
{
    // Kondisi dasar
    if ($n == 0) {
        return 0;
    }

    if ($n == 1) {
        return 1;
    }

    // Fungsi memanggil dirinya sendiri
    return fibonacci($n - 1) + fibonacci($n - 2);
}


// input

$hasil = [];

if (isset($_POST['jumlah'])) {

    $jumlah = intval($_POST['jumlah']);

    for ($i = 0; $i <= $jumlah; $i++) {

        $hasil[] = fibonacci($i);
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Fibonacci Rekursif</title>

    <link rel="stylesheet" href="../style.css">

</head>


<body class="crud-page">

    <h1>Deret Fibonacci</h1>

    <p>
        Menampilkan deret Fibonacci menggunakan fungsi rekursif.
    </p>


    <form method="POST">

        <label>
            Masukkan angka:
        </label>

        <input
            type="number"
            name="jumlah"
            min="0"
            required>

        <br><br>

        <button type="submit">
            Hitung Fibonacci
        </button>

    </form>


    <?php if (!empty($hasil)) { ?>

        <div class="information" style="margin-top: 25px;">

            <h2>Hasil</h2>

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