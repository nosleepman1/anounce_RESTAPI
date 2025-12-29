<?php 

    require_once __DIR__ ."/../models/users";
    require_once __DIR__ ."/../config/db.php";

    class UserRepository {

        private $db;

        public function __construct() {
            $this->db = dataBase::getInstance();
        }

        public function create(User $user) {

            $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (?,?,?)" );
            $stmt->execute([
                $user->getName(),
                $user->getEmail(),
                $user->getPassword()
            ]);
        }

        public function find($id) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([
                'id' => $id
            ]);
        }

    }