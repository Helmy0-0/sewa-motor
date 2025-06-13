<?php
include 'connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $con->begin_transaction();
   try {
       $id_pelanggan = $_POST['id_pelanggan'];
       $tanggal_pinjaman = date('Y-m-d');
       $harga = 0;


       // Insert ke tabel Pesanan
       $stmt = $con->prepare("INSERT INTO pinjaman (tanggal_pinjaman, id_pelanggan, harga) VALUES (?, ?, ?)");
       $stmt->bind_param("sid", $tanggal_pinjaman, $id_pelanggan, $harga);
       $stmt->execute();
       $id_pinjaman = $con->insert_id;


       // Loop buku
       foreach ($_POST['motor'] as $motor) {
           $id_motor = $motor['id'];




           // Ambil harga dan status
           $stmt = $con->prepare("SELECT harga, status FROM motor WHERE ID = ?");
           $stmt->bind_param("i", $id_motor);
           $stmt->execute();
           $stmt->bind_result($hargapinjam, $status);
           $stmt->fetch();
           $stmt->close();


           if ($status == 'tidak tersedia') {
               throw new Exception("Motor ID $id_motor tidak tersedia.");
           }


           // Insert detail
           $stmt = $con->prepare("INSERT INTO detailpinjam (id_pinjaman, id_motor, status, hargapinjam) VALUES (?, ?, ?, ?)");
           $stmt->bind_param("iied", $id_pinjaman, $id_motor, $status, $hargapinjam);
           $stmt->execute();
           
           $harga += $hargapinjam;


           // Update stok
           $stmt = $con->prepare("UPDATE motor SET 'status' = 'Tidak Tersedia' WHERE ID = ?");
           $stmt->bind_param("i", $id_motor);
           $stmt->execute();
       }


       // Update total harga
       $stmt = $con->prepare("UPDATE pinjaman SET harga = ? WHERE ID = ?");
       $stmt->bind_param("di", $harga, $id_pinjaman);
       $stmt->execute();


       $con->commit();
       header("Location: transaksi.php?message=" . urlencode("Pinjaman berhasil dibuat."));
       exit;
   } catch (Exception $e) {
       $con->rollback();
       header("Location: transaksi.php?message=" . urlencode("Gagal membuat pinjaman: " . $e->getMessage()));
       exit;
   }
}
?>
