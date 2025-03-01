<?php

namespace Helpers;

use Models\Categoria;

class Utils
{
    // La función cerrarSesion($nombre) elimina la variable de sesión con 
    // el nombre especificado si existe y devuelve dicho nombre.

    public static function cerrarSesion($nombre)
    {
        if (isset($_SESSION[$nombre])) {
            $_SESSION[$nombre] = null;
            unset($_SESSION[$nombre]);
        }

        return $nombre;
    }

    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: " . base_url);
        } else {
            return true;
        }
    }

    public static function identidad_comprobar()
    {
        if (!isset($_SESSION['identidad'])) {
            header("Location: " . base_url);
        } else {
            return true;
        }
    }

    public static function mostrar_categorias()
    {
        // require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();
        return $categorias;
    }

    public static function Carrito_mostrar(){
        $mostrar = array(
            'count'=>0,
            'total'=>0
        );

        if(isset($_SESSION['carrito'])){
            $mostrar['count'] = count($_SESSION['carrito']);
        
            foreach($_SESSION['carrito'] as $producto){
                $mostrar['total'] += $producto['precio']*$producto['unidades'];
            }

        }

        return $mostrar;
    } 

    public static function Sesion_iniciada()
    {
        if (!isset($_SESSION['identidad'])) {
            header("Location:" . base_url . 'usuario/sesion');
            exit();
        }
    }

    public static function estado($estado){
        $valor='Pendiente';
        if($estado == 'confirm'){
            $valor='Pendiente';
        }elseif($estado == 'preparation'){
            $valor='En preparacion';
        }elseif($estado == 'ready'){
            $valor='Preparado para enviar';
        }elseif($estado == 'sended'){
            $valor='Enviado';
        }

        return $valor;
    }
}
