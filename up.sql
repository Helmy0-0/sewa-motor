CREATE TABLE motor (
  id_motor int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nama_motor varchar(100) NOT NULL,
  merek varchar(100) NOT NULL,
  tipe varchar(100) DEFAULT NULL,
  harga decimal(12,2) DEFAULT NULL,
  gambar varchar(255) DEFAULT NULL,
  status enum('Tersedia','Tidak Tersedia') DEFAULT 'Tersedia',
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE pelanggan (
  id_pelanggan int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nama varchar(255) DEFAULT NULL,
  alamat varchar(255) DEFAULT NULL,
  telepon varchar(20) DEFAULT NULL,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE pinjaman (
  id_pinjaman int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  tanggal_pinjaman date DEFAULT NULL,
  id_pelanggan int DEFAULT NULL,
  harga decimal(10,2) DEFAULT NULL,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_pelanggan) REFERENCES pelanggan (id_pelanggan)
);

CREATE TABLE detailpinjam (
  id_detailpinjam int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id_pinjaman int DEFAULT NULL,
  id_motor int DEFAULT NULL,
  status enum('Tersedia','Tidak Tersedia') DEFAULT NULL,
  hargapinjam decimal(10,2) DEFAULT NULL,
  FOREIGN KEY (id_pinjaman) REFERENCES pinjaman (id_pinjaman),
  FOREIGN KEY (id_motor) REFERENCES motor (id_motor)
);

CREATE TABLE pengguna (
  id int AUTO_INCREMENT PRIMARY KEY,
  username varchar(50) NOT NULL,
  password varchar(100) NOT NULL
);

-- Insert default user
INSERT INTO pengguna (username, password) VALUES ('DB_USER', 'DB_PASSWORD');