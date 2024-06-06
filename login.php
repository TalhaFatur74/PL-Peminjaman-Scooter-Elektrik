<?php 
include "config.php"; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
$peran = $_POST['pilihanPeran'];
$kataSandi = $_POST['kataSandi'];
$idPengguna = $_POST['idPengguna'];

$sql = "SELECT * FROM pengguna WHERE peran = '$peran' AND kataSandi = '$kataSandi' AND idPengguna = '$idPengguna'";
$query = mysqli_query($db, $sql);

    if (mysqli_num_rows($query) == 1)
    {
        $pengguna = mysqli_fetch_assoc($query);

        if ($pengguna['peran'] == 'Admin' && $pengguna['kataSandi'] == $kataSandi && $pengguna['idPengguna'] == $idPengguna)
        {
            header("Location: menu-admin.php");
        }
        else if ($pengguna['peran'] == 'Pimpinan Taman'  && $pengguna['kataSandi'] == $kataSandi && $pengguna['idPengguna'] == $idPengguna)
        {
            header("Location: menu-pimpinan-taman.php");
        }
        else if ($pengguna['peran'] == 'Operator'  && $pengguna['kataSandi'] == $kataSandi && $pengguna['idPengguna'] == $idPengguna)
        {
            header("Location: menu-operator.php");
        }
        exit;
    }
    else
    {
        echo "Peran atau password yang anda masukkan salah!";
    }
}
?>