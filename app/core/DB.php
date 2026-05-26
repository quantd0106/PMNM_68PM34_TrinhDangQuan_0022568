<?php
    class ConnectDB {
        private $host = "localhost";
        private $port = "3307";
        private $username = "root";
        private $password = "";
        private $database = "68pm34";
        private $conn;

        public function connect() {
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host=" . $this -> host . ";port=" . $this -> port . ";dbname=" . $this -> database, $this -> username, $this -> password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }
            return $this -> conn;
        }
    }