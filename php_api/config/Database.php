<?php
class Database {

    /**
     * Database params
     */
    private $host = '127.0.0.1';
    private $db_name = 'php_api';
    private $db_user = 'root';
    private $db_pass = 'Odesk121!';
    private $conn;

    /**
     * Database connection function
     *
     * @return db_connection
     */
    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO( "mysql:host=$this->host; dbname=$this->db_name", $this->db_user, $this->db_pass );
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            echo "Connection error " . $e->getMessage();
        }

        return $this->conn;
    }
}