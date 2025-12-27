<?php 
    class dataBase {
        private static $instance = null;
        private $conn;
        private $dbname= "annonce_api";
        private $username = 'root';
        private $pwd = '';
        private $server = 'localhost';

        private function __construct() {
            try {
                $this->conn = new PDO("mysql:host={$this->server};dbname={$this->dbname}", $this->username, $this->pwd);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }

        public static function getInstance (){
            if (!self::$instance) {
                self::$instance = new dataBase();
                return self::$instance->conn;
            }
        }
    }

?>