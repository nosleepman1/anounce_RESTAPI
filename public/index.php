<?php 

define('BASE_PATH', dirname(__DIR__));

$request = $_SERVER['REQUEST_URI'];
$scriptname = $_SERVER['SCRIPT_NAME'];

$url = str_replace($scriptname, '', $request);
$url = trim($url,'/');
$url = strtok($url, '?');




switch ($url) {
    case '':
    case 'accueil':
        echo 'PAGE ACCUEIL';
        break;
    case 'contact':
        echo 'PAGE CONTACT';
        break;
    case 'about':
        echo 'PAGE ABOUT';
        break;
    default:
        echo 'PAGE NON TROUVEE';
        break;
}