<?php
class Database {
    private $host = '127.0.0.1';
    private $username = 'root';
    private $database = 'resume';
    private $password = '';
    private $db = null;

    function __construct() {
        $this->db = new mysqli($this->host, $this->username, $this->password, $this->database);
        
        // Check connection
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function connect() {
        return $this->db;
    }

    // Add this method for better error handling
    public function query($sql) {
        $result = $this->db->query($sql);
        if (!$result) {
            throw new Exception("Database error: " . $this->db->error);
        }
        return $result;
    }
}

$db = new Database();
$db = $db->connect();