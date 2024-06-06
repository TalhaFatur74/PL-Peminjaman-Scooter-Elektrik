<?php
include "config.php";

$tampilkanPesanBerhasil = false;
$tampilkanPesanGagal = false;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    #MENU PENGELOLAAN DATA PENGGUNA
    if (isset($_POST['action_pengguna'])) 
    {
        $action = $_POST['action_pengguna'];

        if ($action == 'insert_pengguna')
        {
            $peran = $_POST['pilihanPeran'];
            $kataSandi = $_POST['kataSandi'];

            $sql = "INSERT INTO pengguna VALUES(UUID(), '$peran', '$kataSandi')";
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
        else if($action == 'update_pengguna')
        {
            if (isset($_POST['update_filter'])) 
            {
                $update_filter = $_POST['update_filter'];

                if($update_filter == 'update_id_pengguna')
                {
                    $idBaru = $_POST['id_baru'];
                    $idPengguna = $_POST['idPengguna'];

                    $sql = "UPDATE pengguna SET idPengguna = '$idBaru' WHERE idPengguna = '$idPengguna'"; 
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

                  else if($update_filter == 'update_peran')
                {
                    $peranBaru = $_POST['pilihanPeran'];
                    $idPengguna = $_POST['idPengguna'];

                    $sql = "UPDATE pengguna SET peran = '$peranBaru' WHERE idPengguna = '$idPengguna'"; 
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
                else if($update_filter == 'update_password')
                {
                    $passwordBaru = $_POST['password_baru'];
                    $idPengguna = $_POST['idPengguna'];

                    $sql = "UPDATE pengguna SET kataSandi = '$passwordBaru' WHERE idPengguna = '$idPengguna'"; 
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
            }  
        }
        else if($action == 'delete_pengguna')
        {
            $idPengguna = $_POST['idPengguna'];

            $sql = "DELETE FROM pengguna WHERE idPengguna = '$idPengguna'";
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
    }

      #MENU PENGELOLAAN DATA SCOOTER
    if(isset($_POST['action_scooter']))
    {
        $action = $_POST['action_scooter'];

        if ($action == 'insert_scooter')
        {
            $warna = $_POST['warna'];
            $tarifPerJam = intval($_POST['tarif']);

            $sql = "INSERT INTO scooter VALUES(UUID(), '$warna', $tarifPerJam)";
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
