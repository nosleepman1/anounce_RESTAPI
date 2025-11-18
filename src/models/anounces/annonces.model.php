<?php 
    require_once BASE_PATH . '/src/config/db.php';

    class annoncesModel {
        private $db;

        public function __construct() {
            $this->db = dataBase::getInstance();
        }

        public function get(){
            $stmt = $this->db->prepare('SELECT * FROM annonces ORDER BY DESC');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getById($id){
            $stmt = $this->db->prepare('SELECT * FROM annonces WHERE id = ?');
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        
        public function delete($id) {
            $stmt = $this->db->prepare('DELETE FROM annonces WHERE id = ?');
            $stmt->execute([$id]);
        }

        public function update($id, $libelle, $description, $prix) {
            $stmt = $this->db->prepare("UPDATE annonces SET libelle = ?, description = ?, prix = ? WHERE id = ?");
            return $stmt->execute([$libelle, $description, $prix ,$id]);
        }

        public function create($libelle, $description, $prix) {
            $stmt = $this->db->prepare("INSERT INTO annonce(libelle, description,prix) VALUES  (?,?,?");
            return $stmt->execute([$libelle, $description,$prix]);
        }
    }