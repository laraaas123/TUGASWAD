<?php
$sname = "localhost:3308";
$uname = "root";
$password = "";
$db_name = "kucing_store";

$conn = new mysqli($sname, $uname, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function fetchData() {
    global $conn;
    $sql = "SELECT * FROM tabelkucing";
    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}
?>