<?php
class SkillModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getSkills() {
        $result = $this->conn->query("SELECT * FROM skills");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
