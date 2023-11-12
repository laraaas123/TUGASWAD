<?php
include 'database.php';

if (isset($_GET['id'])) {
    $catIdToEdit = $_GET['id'];

    
    $sql = "SELECT * FROM tabelkucing WHERE catId = '$catIdToEdit'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rowToEdit = $result->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $catIdToUpdate = $_POST['catId'];
    $namaKucing = $_POST['namaKucing'];
    $jenisKucing = $_POST['jenisKucing'];
    $tanggalLahirKucing = $_POST['tanggalLahirKucing'];

    
    $sql = "UPDATE tabelkucing SET namaKucing='$namaKucing', jenisKucing='$jenisKucing', tanggalLahirKucing='$tanggalLahirKucing' WHERE catId='$catIdToUpdate'";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Kucing</title>
</head>
<body>

<?php
if (isset($rowToEdit)) {
    echo '<form action="edit.php" method="post">';
    echo '<input type="hidden" name="catId" value="'.$rowToEdit['catId'].'">';
    echo '<label for="namaKucing">Nama Kucing:</label>';
    echo '<input type="text" name="namaKucing" value="'.$rowToEdit['namaKucing'].'" required>';

    echo '<label for="jenisKucing">Jenis Kucing:</label>';
    echo '<input type="text" name="jenisKucing" value="'.$rowToEdit['jenisKucing'].'" required>';

    echo '<label for="tanggalLahirKucing">Tanggal Lahir Kucing:</label>';
    echo '<input type="date" name="tanggalLahirKucing" value="'.$rowToEdit['tanggalLahirKucing'].'" required>';

    echo '<button type="submit">Update Data</button>';
    echo '</form>';
} else {
    echo 'Data not found.';
}
?>

</body>
</html>
