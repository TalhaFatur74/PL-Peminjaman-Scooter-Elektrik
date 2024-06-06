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
        else if($action == 'update_scooter')
        {
            if (isset($_POST['update_filter']))
            {
                $update_filter = $_POST['update_filter'];
                
                if ($update_filter == 'update_nomor_scooter')
                {
                    $nomorScooterBaru = $_POST['nomor_scooter_baru'];
                    $nomorScooter = $_POST['nomor_scooter_lama'];

                    $sql = "UPDATE scooter SET nomorScooter = '$nomorScooterBaru' WHERE nomorScooter = '$nomorScooter'"; 
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
         else if ($update_filter == 'update_warna')
                {
                    $warna = $_POST['warna'];
                    $nomorScooter = $_POST['nomorScooter'];

                    $sql = "UPDATE scooter SET warna = '$warna' WHERE nomorScooter = '$nomorScooter'"; 
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
        else if ($update_filter == 'update_tarif')
                {
                    $tarifPerJam = $_POST['tarifPerJam'];
                    $nomorScooter = $_POST['nomorScooter'];

                    $sql = "UPDATE scooter SET tarifPerJam = '$tarifPerJam' WHERE nomorScooter = '$nomorScooter'"; 
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
          else if($action == 'delete_scooter')
        {
            $nomorScooter = $_POST['nomorScooter'];

            $sql = "DELETE FROM scooter WHERE nomorScooter = '$nomorScooter'";
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
        
            if (isset($_POST['keluar_menu_admin']))
            {
                header("Location: index.php");
                exit();
            }
            
        }
        ?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            margin: 0;
            background-color: #f8f8f8;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            display: flex;
            flex-direction: column;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            min-height: 250vh;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar button {
            background-color: #34495e;
            border: none;
            padding: 15px;
            margin: 10px 0;
            color: #ecf0f1;
            cursor: pointer;
            text-align: left;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
        }

        .sidebar button:hover {
            background-color: #1abc9c;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .content-section {
            width: 80%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
        width: 100%;
        margin: 20px 0;
        border-collapse: collapse;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
    
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    
        tr:hover {
            background-color: #f1f1f1;
        }
    
        td:hover {
            background-color: #d4d4d4;
        }
        label {
        color: black;
    }


        #admin_read_data, #admin_input_data, #admin_update_data, #update_id, #update_peran, 
        #update_password, #admin_delete_data, #data_pengguna, #data_scooter,
        #admin_read_scooter, #admin_input_scooter, #admin_update_scooter, #admin_delete_scooter,
        #update_nomor_scooter, #update_warna, #update_tarif {
            display: none;
        }

        form {
            margin-bottom: 20px;
        }

        input, select, button {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #3498db;
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #2980b9;
        }
