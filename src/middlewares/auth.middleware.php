<?php 
    require_once BASE_PATH . '/src/helpers/json.php';
    class authMiddleware {

      
        public  function checkSession() {
            if(session_status() === PHP_SESSION_NONE) session_start();
            if (!isset($_SESSION['userId'])) {
                message::json_message("acces non autorisé", 401);
            }
        }
    }