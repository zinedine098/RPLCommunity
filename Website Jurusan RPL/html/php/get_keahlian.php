<?php
require_once 'db_koneksi.php';

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

class KeahlianController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getKeahlian($kategori = '') {
        try {
            if (!empty($kategori) && !preg_match('/^[a-zA-Z0-9_\s-]+$/', $kategori)) {
                throw new InvalidArgumentException('Kategori tidak valid');
            }

            if (!empty($kategori)) {
                $stmt = $this->conn->prepare("SELECT * FROM keahlian_db WHERE kategori = ?");
                $stmt->bind_param("s", $kategori);
            } else {
                $stmt = $this->conn->prepare("SELECT * FROM keahlian_db");
            }

            if (!$stmt->execute()) {
                throw new RuntimeException('Gagal mengeksekusi query');
            }

            $result = $stmt->get_result();
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $sanitizedRow = [];
                foreach ($row as $key => $value) {
                    $sanitizedRow[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                }
                $data[] = $sanitizedRow;
            }

            $stmt->close();

            http_response_code(200);
            return [
                'status' => 'success',
                'data' => $data
            ];
        } catch (Exception $e) {
            http_response_code(500);
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}

$keahlianController = new KeahlianController($conn);
$kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';
$response = $keahlianController->getKeahlian($kategori);

$conn->close();
echo json_encode($response, JSON_PRETTY_PRINT);
?>