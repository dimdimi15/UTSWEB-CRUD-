<?php
require_once '../koneksi/koneksi.php';
try {
    $sql = 'SELECT * FROM produk';
    $qonnect = $database_connection->prepare($sql);
    $qonnect->execute();

    $data = array();
    while ($row = $qonnect->fetch(PDO::FETCH_ASSOC)) {
        array_push($data, $row);
    }
    echo json_encode($data);
    echo "data berhasil di hapus";
} catch (PDOException $err) {
    die("tidak dapat memuat database $database_name:". $err->getMessage());
}


?>