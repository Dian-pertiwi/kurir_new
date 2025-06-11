<?php
include 'config/koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM tbl_data_kurir WHERE id_kurir = '$id'";
mysqli_query($conn, $query);

header("Location: data_kurir.php");
?>