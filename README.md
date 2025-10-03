
# Plantilla de Laravel

Este repositorio corresponde a Nahui, una aplicación desarrollada en Laravel que integra un panel de administración moderno y funcional, lo que permite contar con una interfaz limpia, responsiva y fácil de usar.
El objetivo de Nahui es servir como base sólida para el desarrollo del sistema.


## Características

- Estructura de carpetas predefinida para una organización eficiente del código.
- Vistas predefinidas para páginas comunes como inicio, perfil, etc.
- Formularios predefinidos con validaciones básicas para una rápida implementación.
- Autenticación de usuario lista para usar con páginas de inicio de sesión y registro.


## Requisitos Previos

Antes de comenzar a utilizar esta plantilla, asegúrate de tener instalado:

- [PHP](https://www.php.net/) >= 8.2
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [npm](https://www.npmjs.com/)

## Instalación

1. Clona este repositorio en tu máquina local:

    ```bash
    git clone https://github.com/giligan0/nahui.git
    ```

2. Navega a la carpeta del proyecto:

    ```bash
    cd nahui
    ```

3. Instala las dependencias PHP usando Composer:

    ```bash
    composer install
    ```

4. Instala las dependencias:

    ```bash
    npm install
    ```

5. Copia el archivo de configuración de ejemplo y configura tu entorno:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```


6. Ejecuta las migraciones de la base de datos y los seeders (si es necesario):

    ```bash
    php artisan migrate --seed
    ```

7. Inicia el servidor de desarrollo:

    ```bash
    php artisan serve
    ```

