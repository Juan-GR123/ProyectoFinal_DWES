<?php 

namespace Helpers;

class Utils{
    // La función cerrarSesion($nombre) elimina la variable de sesión con 
    // el nombre especificado si existe y devuelve dicho nombre.

    public static function cerrarSesion($nombre){
        if(isset($_SESSION[$nombre])){
             $_SESSION[$nombre] = null;
            unset($_SESSION[$nombre]);
        }

        return $nombre;
    }

    public static function Admin_Correc(){
        if(!isset($_SESSION['admin'])){
            header("Location: " . base_url);
        }else{
            return true;
        }
    }
}

?>