<?php
include 'connect.php';

$motorr = $conn->query("SELECT id_motor, nama_motor FROM motor");
$pelangganr = $conn->query("SELECT id_pelanggan, nama FROM pelanggan");
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Buat Pinjaman</title>
</head>
<body>
<div class="container mt-4">
   <h2>Buat Pinjaman Baru</h2>
   <?php if (isset($_GET['message'])): ?>
       <div class="alert alert-info"><?= htmlspecialchars($_GET['message']) ?></div>
   <?php endif; ?>


   <form method="post" action="proses_transaksi.php">
       <div class="mb-3">
           <label for="pelanggan_id" class="form-label">Pilih Pelanggan</label>
           <select class="form-select" name="pelanggan_id" id="pelanggan_id" required>
               <option value="">Pilih Pelanggan</option>
               <?php while ($row = $pelangganr->fetch_assoc()): ?>
                   <option value="<?= $row['id_pelanggan'] ?>"><?= $row['Nama'] ?></option>
               <?php endwhile; ?>
           </select>
       </div>


       <h3>Daftar Motor</h3>
       <div class="mb-3">
           <label for="buku_id" class="form-label">Pilih Motor</label>
           <select class="form-select" name="buku[1][id]" id="buku_id" required>
               <option value="">Pilih Motor</option>
               <?php while ($row = $motorr->fetch_assoc()): ?>
                   <option value="<?= $row['id_motor'] ?>"><?= $row['nama_motor'] ?></option>
               <?php endwhile; ?>
           </select>
       </div>
       <button type="submit" class="btn btn-primary">Buat Pinjaman</button>
   </form>
</div>
</body>
</html>
