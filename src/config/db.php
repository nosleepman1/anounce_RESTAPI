<?php 
    class dataBase {
        private static ?PDO $instance = null;

        private function __construct() {}

        public static function getInstance(): PDO | null {
            if (self::$instance === null) {
                
                $dbname = $_ENV["DB_NAME"];
                $username = $_ENV["DB_USERNAME"];
                $password = $_ENV["DB_PASSWORD"];
                $port = $_ENV["DB_PORT"];
                $host = $_ENV["DB_HOST"];

                $dns = "pgsql:host=$host;port=$port;dbname=$dbname;";

                self::$instance = new PDO($host, $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            }
            return self::$instance;
        }
    }

?>