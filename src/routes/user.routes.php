<?php 

    require_once BASE_PATH . '/src/controllers/users/users.controllers.php';
    require_once BASE_PATH . '/src/controllers/annonces/annonces.controllers.php';

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = str_replace('/annonce_website/public', '', $uri);
    $uri = str_replace('index.php', '', $uri);
    $uri = trim($uri, '/');
    $uri = '/' . $uri;
    
    $User = new Users_controller();
    $Annonce = new annoncesControllers();

    switch ($$uri) {
        case '/':
        case '/home':
            
            break;
        
        default:
            # code...
            break;
    }