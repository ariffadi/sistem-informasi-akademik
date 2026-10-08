<?php

require_once __DIR__ . '/../config/database.php';

$nis = $_GET['nis'];

$query = "DELETE FROM siswa WHERE nis='$nis'";

$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: index.php");
    exit;
} else {
    echo "Data gagal dihapus";
}
