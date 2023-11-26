<?php
require_once '../koneksi/koneksi.php';

// Periksa apakah 'id' telah diatur dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = 'DELETE FROM produk WHERE id=?';
        $qonnect = $database_connection->prepare($sql);
        $qonnect->execute([$id]);

        echo json_encode(["message" => "Barang berhasil dihapus"]);
    } catch (PDOException $err) {
        echo json_encode(["error" => "Database error: " . $err->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Parameter 'id' tidak diatur dalam URL"]);
}
?>
