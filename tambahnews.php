<?php
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-cache, no-store, max-age=0, must-revalidate");
header("X-Content-Type-Options: nosniff");
include 'con.php';

$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$gambar = $_FILES['url_image']['name'];
$timestamp = time();

$uploadDir = 'upload/';
$uploadedFileName = $uploadDir . '/' . $timestamp . basename($_FILES['url_image']['name']);
$imageFileType = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));

try {
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo json_encode(['status' => 'error', 'message' => 'Hanya file gambar JPG, JPEG, PNG, dan GIF yang diizinkan.']);
        die("Hanya file gambar JPG, JPEG, PNG, dan GIF yang diizinkan.");
    }
    if (move_uploaded_file($_FILES['url_image']['tmp_name'], $uploadedFileName)) {
        $sql = "INSERT INTO news_catalog (id, title, `desc`,img) VALUES (?, ?, ?, ?)";
        $statement = $database_connection->prepare($sql);
        $statement->execute([null, $judul, $deskripsi, $timestamp . $gambar]);

        if ($statement->rowCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Item berhasil diupload dan data berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error menambah data']);
        }
    } else {
        $sql = "INSERT INTO news_catalog (id, title, `desc`, img) VALUES (?, ?, ?, ?)";
        $statement = $database_connection->prepare($sql);
        $statement->execute([null, $judul, $deskripsi, null]);

        if ($statement->rowCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'data berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error menambah data']);
        }
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'General error' . $e->getMessage()]);
}
