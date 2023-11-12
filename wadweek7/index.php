<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kucing Store</title>
</head>
<body>

<?php
include 'database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaKucing = $_POST['namaKucing'];
    $jenisKucing = $_POST['jenisKucing'];
    $tanggalLahirKucing = $_POST['tanggalLahirKucing'];

    
    $catId = mt_rand(1000, 9999);

    
    $sql = "INSERT INTO tabelkucing (catId, namaKucing, jenisKucing, tanggalLahirKucing) VALUES ('$catId', '$namaKucing', '$jenisKucing', '$tanggalLahirKucing')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


if (isset($_GET['delete'])) {
    $catId = $_GET['delete'];

    
    $sql = "DELETE FROM tabelkucing WHERE catId = '$catId'";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$data = fetchData();

echo '<table>';
echo '<tr><th>Cat ID</th><th>Nama Kucing</th><th>Jenis Kucing</th><th>Tanggal Lahir Kucing</th><th>Action</th></tr>';
foreach ($data as $row) {
    echo '<tr>';
    echo '<td>'.$row['catId'].'</td>';
    echo '<td>'.$row['namaKucing'].'</td>';
    echo '<td>'.$row['jenisKucing'].'</td>';
    echo '<td>'.$row['tanggalLahirKucing'].'</td>';
    echo '<td><a href="edit.php?id='.$row['catId'].'">Edit</a> | <a href="index.php?delete='.$row['catId'].'">Delete</a></td>';
    echo '</tr>';
}
echo '</table>';
?>

<form action="index.php" method="post">
    <label for="namaKucing">Nama Kucing:</label>
    <input type="text" name="namaKucing" required>

    <label for="jenisKucing">Jenis Kucing:</label>
    <input type="text" name="jenisKucing" required>

    <label for="tanggalLahirKucing">Tanggal Lahir Kucing:</label>
    <input type="date" name="tanggalLahirKucing" required>

    <button type="submit">Tambah Data</button>
</form>

</body>
</html>
