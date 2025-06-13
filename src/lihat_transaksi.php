<?php
include 'connect.php'; // Koneksi database


// Query untuk menampilkan data pesanan beserta nama pelanggan dan total harga
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
   <title>Daftar Pinjaman</title>
</head>
<body>
   <?php include 'nav.php' ?>
   <div class="container mt-4">
       <h2>Daftar Pinjaman</h2>


       <!-- Tabel Daftar Pesanan -->
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


   <!-- Bootstrap JS -->
   <script 
   src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>