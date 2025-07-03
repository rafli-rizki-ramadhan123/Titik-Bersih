<?php
$conn = new mysqli("localhost", "root", "", "titikbersih");

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$deskripsi = $_POST['deskripsi'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

$uploadDir = "uploads/";
$uploadFile = $uploadDir . basename($_FILES["foto"]["name"]);
move_uploaded_file($_FILES["foto"]["tmp_name"], $uploadFile);

$stmt = $conn->prepare("INSERT INTO laporan (file, deskripsi, latitude, longitude) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssdd", $uploadFile, $deskripsi, $lat, $lng);

if ($stmt->execute()) {
  header("Location: lapor.html?status=success");
} else {
  header("Location: lapor.html?status=error");
}

$stmt->close();
$conn->close();
?>
