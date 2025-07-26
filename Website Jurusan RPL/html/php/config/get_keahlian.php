<?php
header('Content-Type: application/json');

// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_toko';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Connection failed: ' . $conn->connect_error
    ]);
    exit();
}

// Query untuk mengambil data keahlian
$sql = "SELECT * FROM keterampilan_rpl";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $skills = [];
    while($row = $result->fetch_assoc()) {
        $skills[] = $row;
    }
    
    echo json_encode([
        'status' => 'success',
        'data' => $skills
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No skills found'
    ]);
}

$conn->close();
?>