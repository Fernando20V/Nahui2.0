@echo off
setlocal enabledelayedexpansion

REM Mostrar solo mensajes claros y la salida de los comandos principales,
REM sin imprimir cada línea de comando interno del script.

REM Verificar carpeta de destino
REM C:\laragon\www o C:\xampp\htdocs
REM Mostrar alerta si no esta en la carpeta correcta y confirmar si desea continuar
set "current_path=%CD%"

set "allowed1=C:\laragon\www"
set "allowed2=C:\xampp\htdocs"

if /i not "%current_path%"=="%allowed1%" if /i not "%current_path%"=="%allowed2%" (
    set /p confirm="No estás en la carpeta correcta (%allowed1% o %allowed2%). ¿Deseas continuar? (s/n): "
    if /i not "!confirm!"=="s" exit /b
)

REM 1) Clona el repositorio
echo.
echo [1/6] Clonando el repositorio...
git clone https://github.com/Fernando20V/Nahui2.0.git --progress
if errorlevel 1 (
    echo Error: git clone falló.
    exit /b 1
)

REM 2) Navega a la carpeta del proyecto
cd Nahui2.0 || (echo No se pudo entrar a la carpeta Nahui2.0 & exit /b 1)

REM 3) Instala las dependencias PHP usando Composer
echo.
echo [2/6] Instalando dependencias PHP (composer)...
call composer install --no-interaction
if errorlevel 1 (
    echo Error: composer install falló.
    exit /b 1
)

REM 4) Instala las dependencias de Node.js
echo.
echo [3/6] Instalando dependencias de Node.js (npm)...
call npm install --loglevel=info
if errorlevel 1 (
    echo Error: npm install falló.
    exit /b 1
)

REM 5) Copia el archivo de configuración de ejemplo si no existe .env
echo.
echo [4/6] Copiando .env.example a .env (si no existe)...
if not exist .env copy .env.example .env

REM 6) Genera la clave de la aplicación Laravel
echo.
echo [5/6] Generando clave de aplicación...
call php artisan key:generate

echo.
echo [6/6] Por favor, modifica el archivo .env con la configuración de tu base de datos
echo Instalación completada.
pause
endlocal
exit /b 0