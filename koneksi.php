<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "27_Putra_Perdana_Kurniawan";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>