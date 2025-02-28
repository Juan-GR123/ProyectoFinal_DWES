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

    public function listado()
    {
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->getUsuarios(); // Supongamos que este método obtiene todos los usuarios

        require_once 'views/usuario/listado.php';
    }

    // Crea un objeto de la clase Usuario, asigna los valores y llama al método save() del modelo Usuario.

    // Según el resultado, establece una variable de sesión ($_SESSION['registro']) indicando si el registro fue exitoso o fallido.
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
            $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : false;
            $email = isset($_POST['email']) ? trim($_POST['email']) : false;
            $password = isset($_POST['password']) ? trim($_POST['password']) : false;
            $rol = isset($_POST['rol']) ? trim($_POST['rol']) : 'user';


            // Validaciones
            $errores = [];

            // Validar nombre y apellidos (solo letras y espacios)
            if (!$nombre || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,50}$/", $nombre)) {
                $errores[] = "El nombre no es válido.";
            }

            if (!$apellidos || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,50}$/", $apellidos)) {
                $errores[] = "Los apellidos no son válidos.";
            }

            // Validar email
            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores[] = "El email no es válido.";
            }

            // Validar contraseña (mínimo 6 caracteres, al menos una letra y un número)
            if (!$password || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$/", $password)) {
                $errores[] = "La contraseña debe tener al menos 5 caracteres, una letra y un número.";
            }

            // Validar rol
            if ($rol !== 'user' && $rol !== 'admin') {
                $errores[] = "El rol no es válido.";
            }

            if (empty($errores)) {
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

            // Inicializar variables
            $email = isset($_POST['email']) ? trim($_POST['email']) : false;
            $password = isset($_POST['password']) ? trim($_POST['password']) : false;
            $remember = isset($_POST['remember']); // Verifica si el checkbox fue marcado

            // Validar email
            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_login'] = 'El email proporcionado no es válido.';
                header("Location: " . base_url . 'usuario/sesion');
                exit();
            }

            // Validar contraseña
            if (!$password) {
                $_SESSION['error_login'] = 'La contraseña no puede estar vacía.';
                header("Location: " . base_url . 'usuario/sesion');
                exit();
            }


            // Identificar al usuario
            // Consulta la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($email);
            $usuario->setPassword($password);

            $identidad = $usuario->login(); //devuelve un objeto declarado en usuario

            if ($identidad && is_object($identidad)) {
                $_SESSION['identidad'] = $identidad;

                if ($identidad->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }

                // Si el usuario marcó "Recuérdame", creamos la cookie
                if ($remember) {
                    setcookie("user_login", $identidad->id, time() + (7 * 24 * 60 * 60), "/"); // 7 días
                }
            } else {
                $_SESSION['error_login'] = 'Identificación fallida';
            }
        } else {
            $_SESSION['error_login'] = 'Por favor, complete los campos correctamente.';
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

        // Borrar la cookie "user_login"
        if (isset($_COOKIE['user_login'])) {
            setcookie("user_login", "", time() - 3600, "/"); // Expira en el pasado
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
            $id = isset($_POST['id']) ? $_POST['id'] : false;
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
            $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : false;
            $password = isset($_POST['password']) ? trim($_POST['password']) : false;
            $email = isset($_POST['email']) ? trim($_POST['email']) : false;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : 'user';


            // Verificar si el id es válido
            if (!$id || !is_numeric($id)) {
                $_SESSION['update'] = 'failed';
                header("Location:" . base_url . 'usuario/listado');
                exit();
            }

            // Validar nombre
            if (!$nombre || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,50}$/", $nombre)) {
                $_SESSION['update'] = 'failed';
                $_SESSION['error_update'] = 'El nombre debe tener al menos 3 caracteres.';
                header("Location:" . base_url . 'usuario/listado');
                exit();
            }

            // Validar apellidos
            if (!$apellidos || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,50}$/", $apellidos)) {
                $_SESSION['update'] = 'failed';
                $_SESSION['error_update'] = 'Los apellidos deben tener al menos 3 caracteres.';
                header("Location:" . base_url . 'usuario/listado');
                exit();
            }

            // Validar email
            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['update'] = 'failed';
                $_SESSION['error_update'] = 'El email proporcionado no es válido.';
                header("Location:" . base_url . 'usuario/listado');
                exit();
            }


            // Verifica que solo los admins puedan cambiar el rol
            if (!isset($_SESSION['admin'])) {
                $rol = $_SESSION['identidad']->rol;
            }

            $usuario = new Usuario();
            $usuario->setId($id);

            $usuarioDatos = $usuario->get_id_editar(); // Obtenemos los datos actuales

            $rolAntiguo = $usuarioDatos->rol;

            $usuario->setNombre($nombre);
            $usuario->setApellidos($apellidos);
            $usuario->setEmail($email);
            $usuario->setRol($rol);

            // Si la contraseña fue proporcionada, la encriptamos
            if (!empty($_POST['password']) && preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$/", $password)) {
                $usuario->setPassword(password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]));
            }elseif(!empty($_POST['password'])){
                $usuario->setPassword($password);
            }

            // if ($usuario->update()) {
            //     $_SESSION['update'] = 'complete';
            // } else {
            //     $_SESSION['update'] = 'failed';
            // }

            // Si la actualización es exitosa
            if ($usuario->update()) {
                $_SESSION['update'] = 'complete';

                // Verificar si un admin se cambió a 'user' y es su propia cuenta
                if (isset($_SESSION['admin']) && $_SESSION['identidad']->id == $id && $rolAntiguo == 'admin' && $rol == 'user') {
                    unset($_SESSION['admin']);
                    unset($_SESSION['identidad']);
                    session_destroy(); // Cerrar la sesión
                    header("Location:" . base_url . 'usuario/sesion');
                    exit();
                }
            } else {
                $_SESSION['update'] = 'failed';
            }
        }
        header("Location:" . base_url . 'usuario/listado');
    }
}//Fin de la clase
