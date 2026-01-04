<?php 
    
    require_once __DIR__ ."/../models/users";
    require_once __DIR__ ."/../models/anounces";
    require_once __DIR__ ."/../config/db.php";

    class AnounceRepository {

        private $db;

        public function __construct() {
            $this->db = dataBase::getInstance();
        }

        public function new($id, annoncesModel $annonce) {
            $stmt = $this->db->prepare("INSERT INTO annonces (title, description, price, user_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $annonce->getTitle(),
                $annonce->getDescription(),
                $annonce->getPrice(),
                $id
            ]);  
        }

        public function getAll() {
            $stmt = $this->db->prepare("SELECT * FROM annonces");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getById($id) {
            $stmt = $this->db->prepare("SELECT * FROM annonces WHERE id = ?");
            $stmt->execute([$id]);
        }

        public function update($id, annoncesModel $annonce) {
            $stmt = $this->db->prepare("UPDATE annonces SET title = ?, description = ?, price = ? WHERE id = ?");
            $stmt->execute([
                $annonce->getTitle(),
                $annonce->getDescription(),
                $annonce->getPrice(),
                $id
            ]);
        }

        public function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM annonces WHERE id = ?");
            $stmt->execute([$id]);
        }

        

    }