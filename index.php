
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>CRUD System</title>
</head>
<body>
    <div class="container">
        <h2>Daftar Pengguna</h2>
        <form method="GET" action="index.php">
    <input type="text-center" name="search" placeholder="Cari nama pengguna">
    <button type="submit">Cari</button>
</form>
<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "crud_db");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query dengan kondisi pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';
if ($search) {
    $sql = "SELECT * FROM pendaftar WHERE name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM pendaftar";
}

$result = $conn->query($sql);
?>

<!-- Tampilkan Data Pengguna -->
<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Telepon</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Tidak ada hasil ditemukan</td></tr>";
    }
    ?>
</table>


        <a href="create.php" class="btn">Tambah Pengguna Baru</a>
        <div class="table-container">
            <table>
                
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi ke database
                    $conn = new mysqli("localhost", "root", "", "crud_db");
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Mengambil data dari tabel
                    $sql = "SELECT * FROM pendaftar";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["phone"] . "</td>
                                <td>
                                    <a href='update.php?id=" . $row["id"] . "' class='btn-edit'>Edit</a>
                                    <a href='delete.php?id=" . $row["id"] . "' class='btn-delete'>Hapus</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            
        </div>
    </div>
</body>
</html>