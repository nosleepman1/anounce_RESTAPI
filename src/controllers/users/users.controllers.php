<?php 

    require_once BASE_PATH . '/src/models/users/user.model.php';
    require_once __DIR__ .'/../../repositories/UserRepository.php';
    require_once __DIR__ .'/../../middlewares/auth.middleware.php';
    require_once BASE_PATH . '/src/helpers/json.php';
   
   
    class Users_controller {

        private $db;

        public function __construct() {
            $this->db = new UserRepository();
        }

        public function register() {
            $data = json_decode(file_get_contents('php://input'), true);

            AuthMiddleware::RegisterValidation($data['name'], $data['email'], $data['password']);
            
            $user = new User($data['name'], $data['email'], $data['password']);

            $this->db->create($user);

            message::json_datas(
                [
                    'status' => 201,
                    'message'   => 'Inscription reussie',
                    'datas' => $user
                ]
            );
        }
    }