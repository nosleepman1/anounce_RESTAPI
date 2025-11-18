<?php 

    require_once BASE_PATH . '/src/config/db.php';
    class user {
        private $db;
        public function __construct() {
            $this->db = dataBase::getInstance();
        }

        public function create($username, $firstname, $lastname, $email, $password) {
            $stmt = $this->db->prepare("INSERT INTO users(username, firstname, lastname, email, password) VALUES (?,?,?,?,?)");
            return $stmt->execute([$username, $firstname, $lastname, $email, $password]);
        }

        public function findByEmail($email) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function findById($id){
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function findByUsername($username){
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

    }