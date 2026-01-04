<?php 

define('BASE_PATH', dirname(__DIR__));

$request = $_SERVER['REQUEST_URI'];
$scriptname = $_SERVER['SCRIPT_NAME'];

$url = str_replace($scriptname, '', $request);
$url = trim($url,'/');
$url = strtok($url, '?');


require_once __DIR__ .'/../vendor/autoload.php';
use Dotenv\Dotenv;
Dotenv::createImmutable(__DIR__ .'/../')->load();

require_once __DIR__ . '../src/controllers/annonces/annonces.controllers.php';
require_once __DIR__ . '../src/controllers/users/users.controllers.php';

$userControler = new UserController();
$annonceControler = new annoncesControllers();



switch ($url) {
    case '':
    case 'accueil':
        $annonceControler->All();
        break;
    case 'login':
        $userControler->login();
        break;
    case 'register':
        $userControler->register();
        break;
    default:
        echo 'PAGE NON TROUVEE';
        break;
}