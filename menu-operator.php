<?php
include "config.php";

if (isset($_POST['keluar_menu_admin']))
{
    header("Location: index.php");
    exit();
}

$tampilkanPesanBerhasil = false;
$tampilkanPesanGagal = false;

if (isset($_POST['action_penyewaan_belum_terdaftar']))
{
    $nomorKTP = $_POST['nomorKTP'];
    $nomorScooter = $_POST['nomorScooter'];
    $nama = $_POST['nama'];
    $kelurahan = $_POST['kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $tanggalPenyewaan = $_POST['tanggalPenyewaan'];
    $waktuMulai = $_POST['waktuMulai'];

    $sql = "INSERT INTO penyewa VALUES('$nomorKTP', '$nama', '$kelurahan', '$kecamatan')";
    $query = mysqli_query($db, $sql);

    $sql2 = "INSERT INTO penyewaan VALUES(UUID(), '$nomorScooter', '$nomorKTP', '$tanggalPenyewaan', '$waktuMulai')";
    $query2 = mysqli_query($db, $sql2);

    if($query && $query2)
    {
        $tampilkanPesanBerhasil = true;
    }
    else
    {
        $tampilkanPesanGagal = true;
    }
}
else if (isset($_POST['action_penyewaan_terdaftar']))
{
    $nomorKTP = $_POST['nomorKTP'];
    $nomorScooter = $_POST['nomorScooter'];
    $tanggalPenyewaan = $_POST['tanggalPenyewaan'];
    $waktuMulai = $_POST['waktuMulai'];

    $sql = "INSERT INTO penyewaan VALUES(UUID(), '$nomorScooter', '$nomorKTP', '$tanggalPenyewaan', '$waktuMulai')";
    $query = mysqli_query($db, $sql);

    if($query)
    {
        $tampilkanPesanBerhasil = true;
    }
    else
    {
        $tampilkanPesanGagal = true;
    }
}
else if (isset($_POST['insert_pengembalian']))
{
    $nomorKTP = $_POST['nomorKTP'];
    $nomorScooter = $_POST['nomorScooter'];
    $waktuAwal = $_POST['waktuAwal'];
    $waktuAkhir = $_POST['waktuAkhir'];
    $tarifAwal = $_POST['tarifAwal'];

    $waktuPenyewaan = DateTime::createFromFormat('H:i:s', $waktuAwal);
    $waktuPengembalian = DateTime::createFromFormat('H:i:s', $waktuAkhir);

    $selisihWaktu = $waktuPenyewaan->diff($waktuPengembalian);

    $totalJam = $selisihWaktu->h;
    $totalMenit = $selisihWaktu->i;
    $totalDetik = $selisihWaktu->s;

    $jamLebih = ($totalMenit / 60) + ($totalDetik / 3600);

    if ($jamLebih > 0) 
    {
        $totalJam += 1;
    }

    $totalJamTambahan = intval(max(0, $totalJam - 1));

    $tarifTambahan = $totalJamTambahan * $tarifAwal;

    $sql = "INSERT INTO pengembalian VALUES(UUID(), '$nomorScooter', '$nomorKTP', '$waktuAkhir ', $tarifTambahan)";
    $query = mysqli_query($db, $sql);

    if($query)
    {
        $tampilkanPesanBerhasil = true;
    }
    else
    {
        $tampilkanPesanGagal = true;
    }
}
