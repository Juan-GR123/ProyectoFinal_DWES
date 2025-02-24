<?php

namespace Controllers;

use Models\Usuario;
use Helpers\Utils;


class usuarioController
{
    // Muestra un mensaje simple: "Controlador Usuarios, Acción index". Es una función típica para la acción predeterminada del controlador.
    public function index()
    {
        echo "Controlador Usuarios, Acción index";
    }

    // Carga la vista registro.php, que contiene el formulario para el registro de usuarios.
    public function registro()
    {
        require_once 'views/usuario/registro.php';
    }

    // Carga la vista sesion.php, donde se espera que esté el formulario de inicio de sesión.
    public function sesion()
    {
        require_once 'views/usuario/sesion.php';
    }

    public function listado(){
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getUsuarios(); // Supongamos que este método obtiene todos los usuarios
        
        require_once 'views/usuario/listado.php';
    }

    // Crea un objeto de la clase Usuario, asigna los valores y llama al método save() del modelo Usuario.

    // Según el resultado, establece una variable de sesión ($_SESSION['registro']) indicando si el registro fue exitoso o fallido.
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : 'user';

            if ($nombre && $apellidos && $email && $password && $rol) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $usuario->setRol($rol);


                $save = $usuario->save();
                if ($save) {
                    $_SESSION['registro'] = "complete";
                } else {
                    $_SESSION['registro'] = "failed";
                }
            } else {
                $_SESSION['registro'] = "failed";
            }
        } else {
            $_SESSION['registro'] = "failed";
        }
        header("Location:" . base_url . 'usuario/registro');
    }

    // Crea un objeto Usuario y llama al método login() del modelo, que verifica si las credenciales son correctas.

    // Si la autenticación es exitosa, almacena la información del usuario en la sesión ($_SESSION['identidad']).

    // Si el usuario tiene rol de administrador, activa la sesión $_SESSION['admin'].

    // Si la autenticación falla, establece $_SESSION['error_login'] y redirige a la página principal.

    public  function login()
    {
        if (isset($_POST)) {
            // Identificar al usuario
            // Consulta la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $identidad = $usuario->login(); //devuelve un objeto declarado en usuario

            if ($identidad && is_object($identidad)) {
                $_SESSION['identidad'] = $identidad;

                if ($identidad->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = 'Identificación fallida';
            }
        }
        header("Location:" . base_url);
    }


    // Cierra la sesión del usuario eliminando las variables $_SESSION['identidad'] y $_SESSION['admin] si existen.
    //  Redirige a la página principal (base_url).

    public function logout()
    {

        if (isset($_SESSION['identidad'])) {
            unset($_SESSION['identidad']);
        }

        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }

        header("Location: " . base_url);
    }


    public function editar()
    {
        // Verifica si el usuario está logueado
        Utils::Sesion_iniciada();

        // Solo admin puede editar a cualquiera, el user solo a sí mismo
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Si no es admin y quiere editar a otro, redirige
            if (!isset($_SESSION['admin']) && $id != $_SESSION['identidad']->id) {
                header("Location:" . base_url);
                exit();
            }

            $usuario = new Usuario();
            $usuario->setId($id); // Establecemos el ID del usuario que queremos editar
            $usuarioDatos = $usuario->get_id_editar(); // Llamamos a getOne para obtener los datos de ese usuario

            require_once 'views/usuario/modificar.php'; //Aqui llama al formulario de modificar.php en donde
            //se llama a $usuarioDatos
        } else {
            header("Location:" . base_url . 'usuario/listado');
        }
    }

    public function update()
    {
        Utils::Sesion_iniciada();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : 'user';

            // Verifica que solo los admins puedan cambiar el rol
            if (!isset($_SESSION['admin'])) {
                $rol = $_SESSION['identidad']->rol;
            }

            $usuario = new Usuario();
            $usuario->setId($id);
            $usuario->setNombre($nombre);
            $usuario->setApellidos($apellidos);
            $usuario->setEmail($email);
            $usuario->setRol($rol);

            if ($usuario->update()) {
                $_SESSION['update'] = 'complete';
            } else {
                $_SESSION['update'] = 'failed';
            }
        }
        header("Location:" . base_url . 'usuario/listado');
    }
}//Fin de la clase
