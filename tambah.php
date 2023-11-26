<?php
require_once '../koneksi/koneksi.php';

// Menangkap atau mengunggah data
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$harga = isset($_POST['harga']) ? $_POST['harga'] : '';
$stok = isset($_POST['stok']) ? $_POST['stok'] : '';

// Simpan data barang   
if (empty($_POST['id'])) {
    try {
        $sql = 'INSERT INTO `produk` (`nama`, `harga`, `stok`) VALUES (?, ?, ?)';
        $qonnect = $database_connection->prepare($sql);
        $qonnect->execute([$nama, $harga, $stok]);

        echo "Data berhasil ditambah";
    } catch (PDOException $err) {
        die("Error: " . $err->getMessage());
    }
} else {
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    try {
        $sql = 'UPDATE `produk` SET `nama` = ?, `harga` = ?, `stok` = ? WHERE id = ?';
        $qonnect = $database_connection->prepare($sql);
        $qonnect->execute([$nama, $harga, $stok, $id]);

        echo "Data berhasil diupdate";
    } catch (PDOException $err) {
        die("Error: " . $err->getMessage());
    }
}
?>
