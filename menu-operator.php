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
