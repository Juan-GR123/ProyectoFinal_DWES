
# Proyecto_fin_curso_2

## Portada

**Nombre del Proyecto:** Proyecto_fin_curso_2  
**Autor:** JuanGR  
**Fecha:** Febrero 2025  

## Índice

1. [Descripción de Carpetas y Archivos](#descripción-de-carpetas-y-archivos)
2. [Instalación](#instalación)
3. [Uso](#uso)
4. [Funcionalidades](#funcionalidades)
5. [Breve explicación de lo que hace cada archivo](#breve-explicación-de-lo-que-hace-cada-archivo)
6. [Tecnologías Utilizadas](#tecnologías-utilizadas)


## Descripción por encima de las Carpetas y archivos

- **assets/**: Contiene los archivos estáticos como CSS, JavaScript e imágenes.
- **autoload.php**: Archivo de autoload para cargar automáticamente las clases del proyecto.
- **config.php**: Archivo de configuración principal del proyecto.
- **controllers/**: Contiene los controladores de la aplicación.
- **database/**: Contiene los archivos relacionados con la base de datos.
- **helpers/**: Contiene funciones auxiliares que se utilizan en el proyecto.
- **index.php**: Archivo principal de entrada de la aplicación.
- **lib/**: Contiene librerías y clases auxiliares.
- **models/**: Contiene los modelos de datos de la aplicación.
- **views/**: Contiene las vistas de la aplicación.

## Instalación

1. Clona el repositorio en tu máquina local.
2. Ejecuta `composer install` para instalar las dependencias.
3. Configura el archivo `.env` con tus credenciales de base de datos.
4. Ejecuta las migraciones de la base de datos.

## Uso

1. Inicia el servidor web.
2. Accede a la aplicación a través de tu navegador web en la URL configurada.

## Funcionalidades

- Gestión de usuarios.
- Gestión de productos.
- Gestión de categorias
- Carrito de la compra.
- Gestión de pedidos

## Breve explicación de lo que hace cada archivo

1. assets

    1.1. css
    - Es el archivo el cual contiene todo el css que se utiliza en el resto de la página.

    1.2. img
    - Es una carpeta en la cual se contendrán las imagenes y la carpeta upload
    - En la carpeta upload se guardarán las imagenes que se guarden con el metodo save() de ProductoController, es decir cada vez que se cree o se modifique un producto

2. controllers

    2.1. CarritoController.php

    2.2. CategoriaController.php

    2.3. ErrorController.php

    2.4. PedidoController.php

    2.5. ProductoController.php

    2.6. UsuarioController.php

3. database

    3.1. database.sql


4. helpers

    4.1. utils

5. lib

    5.1. BaseDatos.php

6. models

    6.1. categoria.php

    6.2. producto.php

    6.3. usuario.php

7. views

    7.1. carrito
    - Contiene un index en el que se listan todos los productos que se han añadido al carrito

    7.2. categoria
    - Contiene un index el cual contiene dos botones, uno para crear una categoria y otro para borrarla además en el index se listaran todas las categorias existentes en ese momento
    - Los botones te llevarán a distintas páginas las cuales pediran el nombre de la categoria ya sea para crearla o eliminarla
    - Además en header.php se mostrarán las categorias en el menú gracias a la ayuda de un metodo del archivo utils. 
    - Cuando se pinche en alguna de las categorias se las llevará al archivo ver.php el cual dependiendo del id que se haya puesto en la url mostrará o una imagen por defecto o la imagen asiganda al producto

    7.3. layout
    - Contiene los archivos php que representarán las vistas del header, footer y la barra lateral para que puedan ser llamados en el index posteriormente

    7.4. producto
    - El sidebar contendrá un enlace que llevará a gestion.php el cual es un archivo en el que se listaran los productos que existen actualmente
    - En cada producto te darán la opcion de eliminarlos o editarlos
    - También te darán la opcion de crear un nuevo producto por medio de un boton que te llevará al archivo crear.php en el cual dependiendo de si el producto ya existe o no se utilizara como un formulario para editar o crear un nuevo producto
    - Por último, estara el archivo destacados en donde se mostrarán todos los productos existentes mediante un bucle y este archivo sera el archivo por defecto que se muestre en el index

    7.5. usuario
    - Contiene las vistas relacionadas con la gestión de usuarios.

    7.5.1. sesion.php
    - Muestra el formulario de inicio de sesión para los usuarios.

    7.5.2. registro.php
    - Muestra el formulario de registro para nuevos usuarios.

    7.5.3. listado.php
    - Muestra una lista de todos los usuarios registrados en el sistema (solo accesible para administradores).
    - En el sidebar se da un enlace que llevara a este archivo y en cada usuario si eres admin se dara acceso para editar cada usuario sino eres admin solo podrás modificarte a ti mismo

    7.5.4. modificar.php
    - Se dara un formulario con los datos actuales del usuario y tu solo tendrás que cambiarlos para que se guarden

8. Archivos en la raiz del proyecto

    8.1. autoload.php

    8.2. config.php

    8.3. index.php

    8.4. .htaccess


## Tecnologías Utilizadas

- PHP
- MySQL
- Composer
- HTML
- CSS
- JavaScript