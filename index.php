<?php 
include "login.php"; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
    <form action="login.php" method="POST">
        <h2>Login</h2>
        <div class="input-field">
        <input type="value" name="idPengguna" required>
        <label>Masukkan ID Anda</label>
        </div>
        <div class="input-field">
        <input type="kataSandi" name="kataSandi" required>
        <label>Masukkan Password Anda</label>
        </div>
        <div class="input-field">
        <select name="pilihanPeran" required>
            <option value="Admin">Admin</option>
            <option value="Pimpinan Taman">Pimpinan Taman</option>
            <option value="Operator">Operator</option>
        </select>
        <label>Masukkan Peran Anda</label>
        </div>
        <button type="submit">Log In</button>
    </form>
    </div>
</body>
</html>