<?php
include 'connect.php'; 
include 'nav.php';


$query = "
   SELECT pinjaman.id_pinjaman AS Pinjaman_ID, pelanggan.nama AS Nama_Pelanggan, pinjaman.tanggal_pinjaman, pinjaman.harga AS Total_Harga
   FROM pinjaman
   JOIN pelanggan ON pinjaman.id_pelanggan = pelanggan.id_pelanggan
";
$result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Data Transaksi</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
   <div class="container mt-4; card shadow p-4; card-body; p-5">
       <h2>Data Transaksi</h2>
       <table class="table table-striped">
           <thead>
               <tr>
                   <th>ID Pinjaman</th>
                   <th>Nama Pelanggan</th>
                   <th>Tanggal Pinjaman</th>
                   <th>Harga Pinjam</th>
               </tr>
           </thead>
           <tbody>
               <?php while ($row = $result->fetch_assoc()): ?>
               <tr>
                   <td><?= $row['Pinjaman_ID'] ?></td>
                   <td><?= htmlspecialchars($row['Nama_Pelanggan']) ?></td>
                   <td><?= $row['tanggal_pinjaman'] ?></td>
                   <td>Rp<?= number_format($row['Total_Harga'], 2) ?></td>
               </tr>
               <?php endwhile; ?>
           </tbody>
       </table>
   </div>


</body>
</html>