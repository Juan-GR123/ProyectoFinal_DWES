<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
</head>

<body>
    <div id="contenedor">
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/icono-libro-256px.jpg" alt="Logo libro">
                <a href="<?=base_url?>">
                    Tienda de libros
                </a>
            </div>
        </header>

        <nav id="menu">
            <ul>
                <li>
                    <a href="<?=base_url?>">Inicio</a>
                </li>
                <li>
                    <a href="#">Categoria 1</a>
                </li>
                <li>
                    <a href="#">Categoria 2</a>
                </li>
                <li>
                    <a href="#">Categoria 3</a>
                </li>
                <li>
                    <a href="#">Categoria 4</a>
                </li>
                <!--<li>
                    <a href="#">Categoria 5</a>
                </li>-->
            </ul>
            <ul>
                <li>
                <a href="<?=base_url?>usuario/sesion"> Iniciar sesion</a>
                </li>

                <li>
                <a href="<?=base_url?>usuario/registro"> Registrarse</a>
                </li>
            </ul>
        </nav>

        <div id="contenido">