<?php 
include "config.php"; 
if (isset($_POST['keluar_menu_admin']))
{
    header("Location: index.php");
    exit();
}
?>
