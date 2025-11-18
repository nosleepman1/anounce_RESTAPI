<?php 

    require_once BASE_PATH . '/src/controllers/users/users.controllers.php';
    require_once BASE_PATH . '/src/controllers/annonces/annonces.controllers.php';

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = str_replace('/annonce_website/public', '', $uri);
    $uri = str_replace('index.php', '', $uri);
    $uri = trim($uri, '/');
    $uri = '/' . $uri;
    
    $User = new userControllers();
    $Annonce = new annoncesControllers();

    if ($uri === '/api/user/register' && $method === 'POST') {
        $User->register();
    } elseif ($uri === '/api/user/login' && $method === 'POST') {
        $User->login();
    } elseif ($uri === '/api/user/me' && $method === 'GET') {
        $User->me();
    } elseif ($uri === '/api/user/logout' && $method === 'POST') {
        $User->logout();
    } elseif ($uri === '/api/anounces/all' && $method = 'GET'){
        $Annonce->getAll();
    } elseif ($uri === '/api/anounces/create' && $method = 'POST') {
       $Annonce->createAnounce();    
    } elseif ($uri === preg_match('#^/api/anounces/update/(\d+)$#', $uri, $matches) && $method = 'POST') {
        $id = $matches[1];
       $Annonce->updateAnounce($id);    
    }
    
    
    
    
    else {
        http_response_code(404);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['error' => 'Route non trouvée', 'uri' => $uri, 'method' => $method]);
    }

