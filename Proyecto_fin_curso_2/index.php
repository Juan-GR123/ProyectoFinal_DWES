<?php

use Lib\BaseDatos;

session_start();
require_once 'autoload.php';
require_once 'config.php';
require_once 'helpers/utils.php';

require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

use Controllers\errorController;

// //Conexión base de datos
// $db = new BaseDatos();

// $db->conectar_datos();


// Muestra la página de error llamando al controlador errorController y su método index().
function show_error()
{
    $error = new errorController();
    $error->index();
}



// Verifica si se ha enviado un controlador por la URL y lo asigna a $nombre_controlador.
// Si no se especifica controlador ni acción, carga el controlador por defecto.
if (isset($_GET['controller'])) {

    $nombre_controlador = 'Controllers\\' . $_GET['controller'] . 'Controller';
    
} else if (!isset($_GET['controller']) && !isset($_GET['action'])) {

    $nombre_controlador ='Controllers\\' . controller_default;
} else {
    show_error();
    exit();
}

// Verifica si la clase del controlador solicitado existe.
if (class_exists($nombre_controlador)) {
    // Crea una instancia del controlador solicitado.
    $controlador = new $nombre_controlador();

// Verifica si la acción solicitada existe en el controlador y la ejecuta.
// Si no hay controlador ni acción, ejecuta la acción por defecto.
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    } else if (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action_default = action_default;
        $controlador->$action_default();
    } else {
        show_error();
    }
} else {
    show_error();
}

require_once 'views/layout/footer.php';
