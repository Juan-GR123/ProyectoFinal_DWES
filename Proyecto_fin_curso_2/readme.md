
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


## Descripción de Carpetas y Archivos

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

## Tecnologías Utilizadas

- PHP
- MySQL
- Composer
- HTML
- CSS
- JavaScript