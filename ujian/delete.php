<?php

require_once __DIR__ . '/../config/database.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = (int) $_GET['id'];

$query = "DELETE FROM ujian
          WHERE id_ujian = $id";

if (mysqli_query($conn, $query)) {

    header("Location: index.php");
    exit;
} else {

    echo "Data gagal dihapus: "
        . mysqli_error($conn);
}
