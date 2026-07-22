## TechSolutions

Proyecto en Laravel 12 para la gestión de proyectos.

Desarrollado por Johhan Urrutia y Kevin Escobar.

## Instalación desde cero

1. Instalar dependencias de PHP:
   ```bash
   composer install
   ```
2. Crear el archivo de entorno y la clave de la aplicación:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Crear el archivo de base de datos SQLite:
   ```bash
   touch database/database.sqlite
   ```
4. Ejecutar las migraciones:
   ```bash
   php artisan migrate
   ```
5. Levantar el proyecto con Laragon (`http://techsolutions.test`) o con Artisan:
   ```bash
   php artisan serve
   ```

## Pruebas

Ejecutar las pruebas automatizadas:
```bash
php artisan test
```