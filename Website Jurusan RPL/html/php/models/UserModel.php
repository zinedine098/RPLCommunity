<?php
class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getProfile() {
        $query = "SELECT * FROM user LIMIT 1";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }
}
