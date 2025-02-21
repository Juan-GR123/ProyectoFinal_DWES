<?php
require_once 'models/usuario.php';

class usuarioController
{
    // Muestra un mensaje simple: "Controlador Usuarios, Acción index". Es una función típica para la acción predeterminada del controlador.
    public function index()
    {
        echo "Controlador Usuarios, Acción index";
    }

    // Carga la vista registro.php, que contiene el formulario para el registro de usuarios.
    public function registro(){
        require_once 'views/usuario/registro.php';
    }

    // Carga la vista sesion.php, donde se espera que esté el formulario de inicio de sesión.
    public function sesion(){
        require_once 'views/usuario/sesion.php';
    }

    // Crea un objeto de la clase Usuario, asigna los valores y llama al método save() del modelo Usuario.

    // Según el resultado, establece una variable de sesión ($_SESSION['registro']) indicando si el registro fue exitoso o fallido.
    public function save(){
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if($nombre && $apellidos && $email && $password){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $save = $usuario->save();
                if($save){
                    $_SESSION['registro'] = "complete";
                }else{
                    $_SESSION['registro'] = "failed";
                }
            }else{
            $_SESSION['registro'] = "failed";
            }
        }else{
            $_SESSION['registro'] = "failed";
        }    
        header("Location:" .base_url.'usuario/registro');
    }

    // Crea un objeto Usuario y llama al método login() del modelo, que verifica si las credenciales son correctas.
    
    // Si la autenticación es exitosa, almacena la información del usuario en la sesión ($_SESSION['identidad']).
    
    // Si el usuario tiene rol de administrador, activa la sesión $_SESSION['admin'].
    
    // Si la autenticación falla, establece $_SESSION['error_login'] y redirige a la página principal.
   
    public  function login(){
        if(isset($_POST)){
            // Identificar al usuario
            // Consulta la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $identidad = $usuario->login(); //devuelve un objeto declarado en usuario

            if($identidad && is_object($identidad)){
                $_SESSION['identidad'] = $identidad;

                if($identidad->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error_login'] = 'Identificación fallida';
            }

        }
        header("Location:" . base_url);
    }

    
// Cierra la sesión del usuario eliminando las variables $_SESSION['identidad'] y $_SESSION['admin] si existen.
//  Redirige a la página principal (base_url).

    public function logout(){

        if(isset($_SESSION['identidad'])){
            unset($_SESSION['identidad']);
        }

        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }

        header("Location: ".base_url);
    }


}//Fin de la clase
