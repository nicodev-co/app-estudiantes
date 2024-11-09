# Proyecto Laravel 11

Este es un proyecto desarrollado con Laravel 11. A continuación, se detallan las instrucciones para la instalación y configuración del proyecto.

## Requisitos

- PHP >= 8.2
- Composer
- MySQL
- Node.js y npm

## Instalación

1. Clonar el repositorio:

    ```bash
    git clone https://github.com/nicodev-co/app-estudiantes.git
    cd app-estudiantes
    ```

2. Instalar las dependencias de PHP:

    ```bash
    composer install
    ```

3. Copiar el archivo de configuración de entorno y configurar las variables de entorno:

    ```bash
    cp .env.example .env
    ```

    Editar el archivo `.env` y configurar la base de datos y otras variables necesarias.

4. Generar la clave de la aplicación:

    ```bash
    php artisan key:generate
    ```

5. Ejecutar las migraciones y seeders para la base de datos:

    ```bash
    php artisan migrate --seed
    ```

6. Instalar las dependencias de Node.js y compilar los assets:

    ```bash
    npm install
    npm run dev
    ```

## Servidor de desarrollo

Para iniciar el servidor de desarrollo, ejecutar:

```bash
php artisan serve
```

El proyecto estará disponible en `http://localhost:8000`.

## Licencia

Este proyecto está licenciado bajo la [MIT License](LICENSE).
