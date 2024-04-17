<?php
require '../vendor/autoload.php';

use App\Callsql;

$uri = $_SERVER['REQUEST_URI'];
//initialise la librairie Whoops
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
// utilisation de la librairie altorouter
$router = new AltoRouter();
$router->map('GET', '/', 'home', 'home');
$router->map('GET', '/connexion', 'connexion', 'connexion');
$router->map('GET', '/accueil', 'accueil', 'accueil');
$router->map('GET', '/groupe', 'groupe', 'groupe');
$router->map('GET', '/lieu', 'lieu', 'lieu');
$router->map('GET', '/date', 'date', 'date');
$router->map('GET', '/addGroup', 'addGroup', 'addGroup');
$router->map('GET', '/addVenue', 'addVenue', 'addVenue');
$router->map('GET', '/addDate', 'addDate', 'addDate');
$match = $router->match();
if (is_array($match)) {
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        $params = $match['params'];
        ob_start();
        require "../templates/{$match['target']}.php";
        $pageContent = ob_get_clean();
    }
    require '../elements/layout.php';
} else {
    echo 'Erreur 404';
}
