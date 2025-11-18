<?php 

    require BASE_PATH . '/src/models/anounces/annonces.model.php';
    require BASE_PATH . '/src/helpers/json.php';
    class annoncesControllers {
        private $anounceModel;

        public function __construct()
        {
            $this->anounceModel = new annoncesModel();
        }

        public function getAll() {
            return $this->anounceModel->get();
        }

        public function createAnounce() {
            $data = json_decode(file_get_contents('php://input') ,true);

            if (!$data['libelle'] || !$data['description'] || !$data['prix']) {
                message::json_message("Veuillez remplir tous les champs", 422);
            }

            if (intval($data['prix']) <= 0) {
                message::json_message("Prix invalide", 422);
            }

            $this->anounceModel->create($data['libelle'], $data['description'], $data['prix']);
        }

        public function updateAnounce($id) {
            $data = json_decode(file_get_contents('php://input'), true);
            $update = $this->anounceModel->update($id, $data['libelle'], $data['description'], $data['prix']);
            if (!$update) {
                return message::json_message("echec de la modification",422);
            }
            return message::json_message('modification reussie', 200);
        }

        public function deleteAnounce($id) {
            $this->anounceModel->delete($id); 
       }
    }