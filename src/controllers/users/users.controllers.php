<?php 

    require_once BASE_PATH . '/src/models/users/user.model.php';
    require_once __DIR__ .'/../../repositories/UserRepository.php';
    require_once __DIR__ .'/../../middlewares/auth.middleware.php';
    require_once BASE_PATH . '/src/helpers/json.php';
   
   
    class UserController {

        private $db;

        public function __construct() {
            $this->db = new UserRepository();
        }

        public function register() {
            
           try {

                header('Content-Type: application/json');
                $data = json_decode(file_get_contents('php://input'), true);

                AuthMiddleware::RegisterValidation($data['name'], $data['email'], $data['password']);
                
                $password_hashed = password_hash($data['password'], PASSWORD_DEFAULT);

                $user = new User($data['name'], $data['email'], $password_hashed);

                $this->db->create($user);

                message::json_datas(
                    [
                        'status' => 201,
                        'message'   => 'Inscription reussie',
                        'datas' => $user
                    ]
                );
            
           } catch (Exception $e) {
                message::json_datas(
                    [
                        'status' => 400,
                        'message'   => 'Erreur lors de l\'inscription',
                        'error' => $e->getMessage()
                    ]
                );
            //throw $th;
           }
        }

        public function login()  {
            
            try {

                header('Content-Type: application/json');
                $data = json_decode(file_get_contents('php://input'), true);

                $user = $this->db->findByEmail($data['email']);

                if (!$user || !password_verify($data['password'], $user['password'])) {
                    
                    return message::json_datas(
                        [
                            'status' => 401,
                            'message'   => 'Email ou mot de passe incorrect',
                        ]
                    );
                
                }

                return message::json_datas(
                    [
                        'status' => 200,
                        'message'   => 'Connexion reussie',
                        'datas' => $user
                    ]
                );

            } catch (Exception $e) {
                message::json_datas(
                    [
                        'status' => 400,
                        'message'   => 'Erreur lors de la connexion',
                        'error' => $e->getMessage()
                    ]
                );
            }
        }
    }