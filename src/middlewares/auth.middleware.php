<?php 
    require_once BASE_PATH . '/src/helpers/json.php';
    require_once __DIR__ . '/../';
    class AuthMiddleware {

      
        public static function checkSession() {
            if(session_status() === PHP_SESSION_NONE) session_start();
            if (!isset($_SESSION['userId'])) {
                message::json_message("acces non autorisé", 401);
            }
        }

        public static function RegisterValidation(string $name,string $email, string $password) {

            if(empty(trim($name) || empty($email) || empty($password))) {
                message::json_message("Veuillez remplir tous les champs", 422);
            }

            if(!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                message::json_message("Veuillez saisir un mail valide",422);
            }
        }
    }