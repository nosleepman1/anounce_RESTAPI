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

        public function update( $id, User $user) {
            $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
            $stmt->execute([
                $user->getName(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getId()
            ]);
        }


        public function findAll() {
            $stmt = $this->db->prepare("SELECT * FROM users");
            $stmt->execute();
        }

        public function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute([
                'id' => $id
            ]);
        }

        public function find($id) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([
                'id' => $id
            ]);
        }

        public function findByEmail($email) {
            $stmt = $this->db->prepare("SELECT * FROM annonces WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    }