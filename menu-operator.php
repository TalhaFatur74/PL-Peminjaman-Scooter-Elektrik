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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Menu Operator</title>
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
        #OP_input_penyewaan, #penyewa_belum_terdaftar, #penyewa_terdaftar, #cari_penyewa, #insert_pengembalian{
            display: none;
        }

        form {
            margin-bottom: 1px;
        }

        input, select, button {
            margin: 1px 0;
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
        
        <script>
        function toggleButton(divID)
        {
            var div = document.getElementById(divID)

            if (div.style.display === "none")
            {
                div.style.display = "block";
            }
            else
            {
                div.style.display = "none";
            }
        }
        </script>
    </head>

    <body>
        <div class="sidebar">
            <h2>Menu Operator</h2><br>
            <button onclick="toggleButton('OP_input_penyewaan')" class="button">Masukkan Data Penyewaan</button><br>
            <div class="content-section" id="OP_input_penyewaan">
                <button onclick="toggleButton('penyewa_belum_terdaftar')">Masukkan Data Penyewaan (penyewa belum terdaftar)</button><br><br>
                <div id="penyewa_belum_terdaftar" class="content-section">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="action_penyewaan_belum_terdaftar" value="insert_penyewaan_belum_terdaftar"> 
                        <label for="nomorKTP">Nomor KTP (maks: 16 karakter): </label><br>
                        <input type="text" name="nomorKTP" placeholder="Masukkan Nomor KTP" required><br><br>

                        <label for="nama">Nama Penyewa: </label><br>
                        <input type="text" name="nama" placeholder="Masukkan Nama Penyewa" required><br><br>

                        <label for="kelurahan">Kelurahan: </label><br>
                        <input type="text" name="kelurahan" placeholder="Masukkan Kelurahan" required><br><br>

                        <label for="kecamatan">Kecamatan: </label><br>
                        <input type="text" name="kecamatan" placeholder="Masukkan Kecamatan" required><br><br>

                        <label for="nomorScooter">Nomor Scooter: </label><br>
                        <input type="text" name="nomorScooter" placeholder="Masukkan Nomor Scooter" required><br><br>

                        <label for="tanggalPenyewaan">Tanggal Mulai: </label>
                        <input type="date" name="tanggalPenyewaan" required><br><br>

                        <label for="waktuMulai">Waktu Mulai (00:00:00): </label>
                        <input type="text" name="waktuMulai"><br><br>

                        <button type="submit" class="btn">Submit</button><br><br>
                    </form>
                </div>

                <button onclick="toggleButton('penyewa_terdaftar')" class="button">Masukkan Data Penyewaan (penyewa terdaftar)</button><br><br>
                <div id="penyewa_terdaftar" class="content-section">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="action_penyewaan_terdaftar" value="insert_penyewaan_terdaftar"> 
                        <label for="nomorKTP">Nomor KTP (maks: 16 karakter): </label><br>
                        <input type="text" name="nomorKTP" placeholder="Masukkan Nomor KTP" required><br><br>

                        <label for="nomorScooter">Nomor Scooter: </label><br>
                        <input type="text" name="nomorScooter" placeholder="Masukkan Nomor Scooter" required><br><br>

                        <label for="tanggalPenyewaan">Tanggal Mulai: </label>
                        <input type="date" name="tanggalPenyewaan" required><br><br>

                        <label for="waktuMulai">Waktu Mulai (00:00:00): </label>
                        <input type="text" name="waktuMulai"><br><br>

                        <button type="submit" class="btn">Submit</button><br><br>
                    </form>
                </div> 
            </div>
             <button onclick="toggleButton('insert_pengembalian')" class="button">Masukkan Data Pengembalian</button><br>
            <div id="insert_pengembalian" class="content-section">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="insert_pengembalian" value="insert_pengembalian"> 

                    <label for="nomorScooter">Nomor Scooter: </label><br>
                    <input type="text" name="nomorScooter" placeholder="Masukkan Nomor Scooter" required><br><br>

                    <label for="nomorKTP">Nomor KTP (maks: 16 karakter): </label><br>
                    <input type="text" name="nomorKTP" placeholder="Masukkan Nomor KTP" required><br><br>

                    <label for="waktuAwal">Waktu Penyewaan: </label><br>
                    <input type="text" name="waktuAwal" placeholder="Masukkan Waktu Penyewaan" required><br><br>

                    <label for="waktuAkhir">Waktu Pengembalian: </label><br>
                    <input type="text" name="waktuAkhir" placeholder="Masukkan Waktu Pengembalian" required><br><br>

                    <label for="tarifAwal">Tarif untuk 1 Jam Pertama: </label><br>
                    <input type="text" name="tarifAwal" placeholder="Masukkan Tarif Awal" required><br><br>

                    <button type="submit" class="btn">Submit</button><br><br>
                </form>
            </div>

            <div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <button type="submit" class="button">Lihat Data Pengembalian</button><br><br>
                <input type="hidden" name="lihat_data_pengembalian">
                </form>
            </div>

            <div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="keluar_menu_admin">
                    <button type="submit" class="button">Kembali ke Menu Utama</button>
                </form>
            </div>
        </div>

        <button onclick="toggleButton('insert_pengembalian')" class="button">Masukkan Data Pengembalian</button><br>
            <div id="insert_pengembalian" class="content-section">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="insert_pengembalian" value="insert_pengembalian"> 

                    <label for="nomorScooter">Nomor Scooter: </label><br>
                    <input type="text" name="nomorScooter" placeholder="Masukkan Nomor Scooter" required><br><br>

                    <label for="nomorKTP">Nomor KTP (maks: 16 karakter): </label><br>
                    <input type="text" name="nomorKTP" placeholder="Masukkan Nomor KTP" required><br><br>

                    <label for="waktuAwal">Waktu Penyewaan: </label><br>
                    <input type="text" name="waktuAwal" placeholder="Masukkan Waktu Penyewaan" required><br><br>

                    <label for="waktuAkhir">Waktu Pengembalian: </label><br>
                    <input type="text" name="waktuAkhir" placeholder="Masukkan Waktu Pengembalian" required><br><br>

                    <label for="tarifAwal">Tarif untuk 1 Jam Pertama: </label><br>
                    <input type="text" name="tarifAwal" placeholder="Masukkan Tarif Awal" required><br><br>

                    <button type="submit" class="btn">Submit</button><br><br>
                </form>
            </div>

            <div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <button type="submit" class="button">Lihat Data Pengembalian</button><br><br>
                <input type="hidden" name="lihat_data_pengembalian">
                </form>
            </div>

            <div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="keluar_menu_admin">
                    <button type="submit" class="button">Kembali ke Menu Utama</button>
                </form>
            </div>
        </div>
        <div class="main-content">
            <h1>Data Peminjaman Scooter Elektrik</h1>
            <?php
            if($tampilkanPesanBerhasil == true)
            {
                echo "<h1>Inputan berhasil :)</h1>";
                $tampilkanPesanBerhasil = false;
            }
            else if($tampilkanPesanGagal == true)
            {
                echo "<h1>Inputan gagal :(</h1>";
                $tampilkanPesanGagal = false;
            }

            if(isset($_POST['cari_penyewa']))
            {
                $nama = $_POST['nama'];
                $nomorKTP = $_POST['nomorKTP'];

                $sql = "SELECT DISTINCT(penyewa.nomorKTP), nama, kelurahan, kecamatan, scooter.nomorScooter, warna, tarifPerJam
                        FROM penyewa
                        INNER JOIN penyewaan ON penyewa.nomorKTP = penyewaan.nomorKTP
                        INNER JOIN scooter ON penyewaan.nomorScooter = scooter.nomorScooter
                        WHERE nama = '$nama' AND penyewa.nomorKTP = '$nomorKTP'";
                            
                $query = mysqli_query($db, $sql);

                echo "<table border='1'>
                        <thead>
                            <tr>
                                <th>Nomor KTP</th>
                                <th>Nama</th>
                                <th>Kelurahan</th>
                                <th>Kecamatan</th>
                                <th>Nomor Scooter</th>
                                <th>Warna</th>
                                <th>Tarif Per Jam</th>
                            </tr>
                        </thead>
                        <tbody>";
                while($penyewaan = mysqli_fetch_assoc($query)) 
                {
                    echo "<tr>";
                    echo "<td>".$penyewaan['nomorKTP']."</td>";
                    echo "<td>".$penyewaan['nama']."</td>";
                    echo "<td>".$penyewaan['kelurahan']."</td>";
                    echo "<td>".$penyewaan['kecamatan']."</td>";
                    echo "<td>".$penyewaan['nomorScooter']."</td>";
                    echo "<td>".$penyewaan['warna']."</td>";
                    echo "<td>".$penyewaan['tarifPerJam']."</td>";
                    echo "</tr>";
                }
                echo "</tbody>
                    </table>";
                
            }
 else if (isset($_POST['lihat_data_pengembalian']))
            {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Nomor Pengembalian</th>";
                echo "<th>Nomor Scooter</th>";
                echo "<th>Nomor KTP</th>";
                echo "<th>Waktu Akhir</th>";
                echo "<th>Tarif Tambahan</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                $sql = "SELECT * FROM pengembalian";
                $query = mysqli_query($db, $sql);
                while($pengembalian = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>".$pengembalian['nomorPengembalian']."</td>";
                    echo "<td>".$pengembalian['nomorScooter']."</td>";
                    echo "<td>".$pengembalian['nomorKTP']."</td>";
                    echo "<td>".$pengembalian['waktuAkhir']."</td>";
                    echo "<td>".$pengembalian['tarifTambahan']."</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            }
 ?>
        </div>
    </body>
</html>
