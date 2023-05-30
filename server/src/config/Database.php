<?php 
namespace Src\Config;

class Database {
    private $host;
    private $db;
    private $user;
    private $password;
    private $connection;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->db = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->connection = null;
    }

    /**
     * Initiates the Database Connection
     *
     * @return object - database connection
     */
    public function connect() {
        $dsn = "mysql:host=$this->host;dbname=$this->db";

        try {
            $this->connection = new \PDO($dsn, $this->user, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            
            // Debug - Remove Later
            // echo 'DB Connected Succesfully!';

            return $this->connection;
        } catch (\PDOException $error) {
            die("DB Connection Error: " . $error->getMessage());
        }
    }
}