<?php 
include "config.php"; 
if (isset($_POST['keluar_menu_admin']))
{
    header("Location: index.php");
    exit();
}
?>
    
<!DOCTYPE html>
<html>
<head>
    <title>Menu Pimpinan Taman</title>
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
            margin-bottom: 1px;
        }

        .sidebar button {
            background-color: #34495e;
            border: none;
            padding: 15px;
            margin: 1px 0;
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

        #PT_cari_data, #PT_filter_scooter, #PT_filter_pengguna{
            display: none;
        }

        form {
            margin-bottom: 1px;
        }

        input, select, button {
            margin: 5px 0;
            padding: 10px;
            width: 90%;
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
    </style>
