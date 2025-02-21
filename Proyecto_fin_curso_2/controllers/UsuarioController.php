<?php
require_once 'models/usuario.php';

class usuarioController
{
    public function index()
    {
        echo "Controlador Usuarios, Acción index";
    }

    public function registro(){
        require_once 'views/usuario/registro.php';
    }

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
