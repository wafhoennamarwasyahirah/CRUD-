<?php
// Mengecek apakah form telah diisi dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $phone = substr(preg_replace("/[^0-9]/", "", $_POST["phone"]), 0, 15);

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "crud_db");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Menyiapkan query untuk memasukkan data ke tabel pendaftar
    $sql = "INSERT INTO pendaftar (name, email, phone) VALUES ('$name', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect ke halaman utama jika berhasil
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Menampilkan pesan kesalahan jika gagal
    }

    // Menutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Tambah Pengguna</title>
</head>
<body>
    <div class="container">
        <h2>Tambah Pengguna</h2>
        <form method="POST" action="">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required><br>

            <label for="phone">Telepon</label>
            <input type="text" id="phone" name="phone" required><br>

            <button type="submit" class="btn-submit">Simpan</button>
        </form>
    </div>
</body>
</html>