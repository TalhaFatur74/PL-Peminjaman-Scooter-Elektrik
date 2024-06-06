CREATE TABLE pengguna
(
    idPengguna CHAR(10)PRIMARY KEY NOT NULL,
    peran ENUM('Admin', 'Operator', 'Pimpinan Taman') NOT NULL,
    kataSandi VARCHAR(20) NOT NULL
);

CREATE TABLE scooter
(
    nomorScooter CHAR(10) PRIMARY KEY NOT NULL,
    warna VARCHAR(20) NOT NULL,
    tarifPerJam INT
);

CREATE TABLE penyewa
(
    nomorKTP VARCHAR(16) PRIMARY KEY NOT NULL,
    nama VARCHAR(20) NOT NULL,
    kelurahan VARCHAR(20) NOT NULL,
    kecamatan VARCHAR(20) NOT NULL
);

CREATE TABLE penyewaan
(
    nomorPenyewaan CHAR(10) PRIMARY KEY NOT NULL,
    nomorScooter CHAR(10) NOT NULL,
    nomorKTP VARCHAR(16) NOT NULL,
    tanggalPenyewaan DATE NOT NULL,
    waktuMulai TIME NOT NULL,
    FOREIGN KEY(nomorKTP) REFERENCES penyewa(nomorKTP),
    FOREIGN KEY(nomorScooter) REFERENCES scooter(nomorScooter)
);

CREATE TABLE pengembalian
(
    nomorPengembalian CHAR(10) PRIMARY KEY NOT NULL,
    nomorScooter CHAR(10) NOT NULL,
    nomorKTP VARCHAR(16) NOT NULL,
    waktuAkhir TIME NOT NULL,
    tarifTambahan INT NOT NULL,
    FOREIGN KEY(nomorKTP) REFERENCES penyewa(nomorKTP),
    FOREIGN KEY(nomorScooter) REFERENCES scooter(nomorScooter)
);

INSERT INTO pengguna VALUES
(UUID(), "Admin", "Admin123"),
(UUID(), "Operator", "OP123"),
(UUID(), "Pimpinan Taman", "PT123");

INSERT INTO scooter VALUES
(UUID(), 'Merah', 60000),
(UUID(), 'Biru', 70000),
(UUID(), 'Hijau', 10000),
(UUID(), 'Kuning', 20000),
(UUID(), 'Putih', 30000),
(UUID(), 'Hitam', 40000),
(UUID(), 'Abu-abu', 50000),
(UUID(), 'Coklat', 80000),
(UUID(), 'Ungu', 90000),
(UUID(), 'Pink', 65000);

INSERT INTO penyewa VALUES
('1234567890123456', 'Ahmad Yani', 'Bojong Barat', 'Bojong'),
('2345678901234567', 'Siti Aisyah', 'Bojong Barat', 'Bojong'),
('3456789012345678', 'Budi Santoso', 'Bojong Barat', 'Bojong'),
('4567890123456789', 'Rina Permata', 'Babakancikao', 'Babakancikao'),
('5678901234567890', 'Rini Permata', 'Babakancikao', 'Babakancikao'),
('6789012345678901', 'Agus Salim', 'Bungursari', 'Bungursari'),
('7890123456789012', 'Nurul Huda', 'Benteng', 'Campaka'),
('8901234567890123', 'Ridwan Kamil', 'Cibatu', 'Cibatu'),
('9012345678901234', 'Taufik Hidayat', 'Cilingga', 'Darangdan'),
('0123456789012345', 'Rina Wijaya', 'Bunder', 'Jatiluhur');

-- karena ada kolom yang memakai UUID jadi sisa tabel tidak bisa langsung di insert karena
-- UUID ter-generate secara random di setiap komputer
