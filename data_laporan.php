<?php
header("Content-Type: application/json");

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "titikbersih";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  http_response_code(500);
  echo json_encode(["error" => "Koneksi gagal: " . $conn->connect_error]);
  exit();
}

// Ambil semua laporan yang sudah valid
$sql = "SELECT id, file, deskripsi, latitude, longitude FROM laporan WHERE status = 'Valid'";
$result = $conn->query($sql);

$data = [];

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}

echo json_encode($data);
$conn->close();
?>
