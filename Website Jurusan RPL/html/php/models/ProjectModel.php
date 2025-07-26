<?php
class ProjectModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getProjects() {
        $result = $this->conn->query("SELECT * FROM projects");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
