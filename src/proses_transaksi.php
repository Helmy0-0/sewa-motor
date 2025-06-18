<?php
include 'connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $conn->begin_transaction();
   try {
       $id_pelanggan = $_POST['pelanggan_id'];
       $tanggal_pinjaman = date('Y-m-d');
       $harga = 0;

       $stmt = $conn->prepare("INSERT INTO pinjaman (tanggal_pinjaman, id_pelanggan, harga) VALUES (?, ?, ?)");
       $stmt->bind_param("sid", $tanggal_pinjaman, $id_pelanggan, $harga);
       $stmt->execute();
       $id_pinjaman = $conn->insert_id;

       foreach ($_POST['motor'] as $motor) {
           $id_motor = $motor['id'];

           $stmt = $conn->prepare("SELECT harga, status FROM motor WHERE id_motor = ?");
           $stmt->bind_param("i", $id_motor);
           $stmt->execute();
           $stmt->bind_result($hargapinjam, $status);
           $stmt->fetch();
           $stmt->close();


           if ($status == 'Tidak Tersedia') {
               throw new Exception("Motor ID $id_motor tidak tersedia.");
           }

           $stmt = $conn->prepare("INSERT INTO detailpinjam (id_pinjaman, id_motor, status, hargapinjam) VALUES (?, ?, ?, ?)");
           $stmt->bind_param("iisd", $id_pinjaman, $id_motor, $status, $hargapinjam);
           $stmt->execute();
           
           $harga += $hargapinjam;

           $stmt = $conn->prepare("UPDATE motor SET status = 'Tidak Tersedia' WHERE id_motor = ?");
           $stmt->bind_param("i", $id_motor);
           $stmt->execute();
       }

       $stmt = $conn->prepare("UPDATE pinjaman SET harga = ? WHERE id_pinjaman = ?");
       $stmt->bind_param("di", $harga, $id_pinjaman);
       $stmt->execute();


       $conn->commit();
       header("Location: transaksi.php?message=" . urlencode("Pinjaman berhasil dibuat."));
       exit;
   } catch (Exception $e) {
       $conn->rollback();
       header("Location: transaksi.php?message=" . urlencode("Gagal membuat pinjaman: " . $e->getMessage()));
       exit;
   }
}
?>
