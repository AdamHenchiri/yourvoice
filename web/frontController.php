<?php
use App\Covoiturage\Controller\ControllerQuestion ;
require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';

// instantiate the loader
$loader = new App\Covoiturage\Lib\Psr4AutoloaderClass();
// register the base directories for the namespace prefix
$loader->addNamespace('App\Covoiturage', __DIR__ .'/../src');
// register the autoloader
$loader->register();


if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    $controllerClassName = "App\Covoiturage\Controller\Controller" . ucfirst($controller);
}else{
    $controllerClassName="App\Covoiturage\Controller\ControllerQuestion";
}
if (class_exists($controllerClassName)){
    //verif si action a été initialisée
    if (isset($_GET['action'])){
        // On recupère l'action passée dans l'URL
        $action = $_GET['action'];
        if (in_array($action, get_class_methods("$controllerClassName"))) {
            // Appel de la méthode statique $action de ControllerQuestion
            $controllerClassName::$action();
        }else{
            ControllerQuestion::error("l'action ".htmlspecialchars($action)." n'existe pas !!");
        }
    }
    else{
        $controllerClassName::readAll();
    }

}else{
    ControllerQuestion::error("le controller ". htmlspecialchars($controller) ." n'existe pas !!");
}



?>