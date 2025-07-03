<?php
$conn = new mysqli("localhost", "root", "", "titikbersih");

if (isset($_GET['id']) && isset($_GET['aksi'])) {
  $id = $_GET['id'];
  $aksi = $_GET['aksi'] == "valid" ? "Valid" : "Tidak valid";
  $conn->query("UPDATE laporan SET status='$aksi' WHERE id=$id");
}

$result = $conn->query("SELECT * FROM laporan ORDER BY tanggal_lapor DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Validasi | TitikBersih</title>
  <style>
    body { font-family: sans-serif; margin: 20px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
    img { width: 100px; border-radius: 6px; }
    button {
      padding: 6px 10px;
      border: none; border-radius: 6px; cursor: pointer;
    }
    .valid { background-color: #4caf50; color: white; }
    .invalid { background-color: #f44336; color: white; }
  </style>
</head>
<body>

<h2>Daftar Laporan Masuk</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Foto/Video</th>
    <th>Deskripsi</th>
    <th>Latitude</th>
    <th>Longitude</th>
    <th>Status</th>
    <th>Aksi</th>
  </tr>

  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= $row['id'] ?></td>
    <td><img src="<?= $row['file'] ?>" alt="file"></td>
    <td><?= $row['deskripsi'] ?></td>
    <td><?= $row['latitude'] ?></td>
    <td><?= $row['longitude'] ?></td>
    <td><?= $row['status'] ?></td>
    <td>
      <a href="?id=<?= $row['id'] ?>&aksi=valid"><button class="valid">Valid</button></a>
      <a href="?id=<?= $row['id'] ?>&aksi=tidakvalid"><button class="invalid">Tidak valid</button></a>
    </td>
  </tr>
  <?php endwhile; ?>

</table>

</body>
</html>
