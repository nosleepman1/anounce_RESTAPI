<?php 

    require_once BASE_PATH . '/src/models/users/user.model.php';
    require_once BASE_PATH . '/src/helpers/json.php';
    class userControllers {

        private $userModel;

        public function __construct() {
            $this->userModel = new user();
            if(session_status() === PHP_SESSION_NONE) session_start();
        }

        public function register () {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (
            !$data['username'] || 
            !$data['firstname'] || 
            !$data['lastname'] || 
            !$data['email'] || 
            !$data['password'] ||
            !$data['password2']
            
            ) {
                message::json_message("Veuillez remplir tous les champs", 422);
            }

            if ($data['password'] !== $data['password2']) {
                message::json_message("Les deux mot de passes doivent correspondre", 400);
            }

            if($this->userModel->findByEmail($data['email'])) {
                message::json_message("Ce compte existe deja", 409);
            }

           $hashedPass = password_hash($data['password'], PASSWORD_DEFAULT);

            $created = $this->userModel->create($data['username'],
                $data['firstname'], 
                $data['lastname'], 
                $data['email'],
                $hashedPass);
            if ($created) {
                message::json_message("Inscription reussie");            
            }else {
                message::json_message("Echec lors de l inscription", 500);            
            }
        }

        public function login () {
            $data = json_decode(file_get_contents('php://input'), true);
        
            if ( (!$data['email'] && !$data['username']) || !$data['password']) {
                message::json_message("Veuillez remplir tous les champs", 422);
            }
            $User = $this->userModel->findByEmail($data['email']);
            
            if (!$User) message::json_message("Email ou mot de passe incorrect", 409);

           if (!password_verify($data['password'], $User['password'])) 
                message::json_message("Email ou mot de passe incorrect",  409);
        
           $_SESSION['userId']  = $User['id'];
           $_SESSION['firstname']  = $User['firstname'];
           $_SESSION['lastname']  = $User['lastname'];
           $_SESSION['email']  = $User['email'];
            message::json_message("Connexion reussie");
        }
        public function logout() {
            session_unset();
            session_destroy();
            message::json_message(['message' => 'Déconnecté']);
        }

        public function me(){
            if(!isset($_SESSION['userId'])) message::json_message("acces non autorisé", 404);

            $User = $this->userModel->findById($_SESSION['userId']);
            message::json_datas($User);
        }


    }