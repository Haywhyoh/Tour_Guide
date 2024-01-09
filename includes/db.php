<?php
class Database {
    private $host = '127.0.0.1';
    private $username = 'tour_admin';
    private $password = 'Mydreams@98';
    private $dbname='tour_guide';
    private $conn;


    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }
      public function getConnection() {
        return $this->conn;
    }
  }  

?>
