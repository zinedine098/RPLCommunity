<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "keahlian_db";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            header('Content-Type: application/json');
            die(json_encode([
                'status' => 'error',
                'message' => 'Koneksi database gagal: ' . $this->conn->connect_error
            ]));
        }

        if (!$this->conn->set_charset("utf8mb4")) {
            header('Content-Type: application/json');
            die(json_encode([
                'status' => 'error',
                'message' => 'Gagal mengatur charset: ' . $this->conn->error
            ]));
        }
    }
}

$db = new Database();
$conn = $db->conn;
?>