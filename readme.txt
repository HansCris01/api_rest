------Despliegue del Servicio WEB -----

Recuerde que la credenciales de su Gestor de base de datos debe tener esto, si esta en localhost:

usuario: root
password:      --> No hay contraseña

Pero si va a desplegarlo al Servidor para produccion debe cambiar las credenciales en el archivo .env


1.- Migrar la base de datos y tablas con el comando:

php artisan migrate

con eso se va crear la base de datos automaticamente con la tabla pero la creacion de base de datos para migracion solo funciona en localhost si lo vas hacer en CPANEL
vas a necesitar crear la base de datos de manera manual desde su gestor Mysql o PhpMyAdmin

Nota: No es necesario cambiar el nombre de base de datos del archivo .env

Credenciales por defecto, para proteger el API rest.

Usuario: root@outlook.es
Password: 123

4.- Si vas a poner a producción modificar el APP_DEBUG cambiandolo a false

   APP_DEBUG=true  --> cambiarlo por false :  APP_DEBUG=false

3.- Usar postman:

  Nota considerar esto: http://localhost/nombre_carpeta/api_rest/public/api/v1/nombre_de_la_ruta


  primero usar la ruta login y colocar las credenciales para obtener el token, recuerde ir a body raw --> Json

  {
  "email": "root@outlook.es",
  "password": "123"
  }

  segundo usar las rutas students que desee usar, pero considerar ingrear el token en la opcion de Autorizathion y seleccionar Bearer Token 


  tercero cuando termine hacer su consulta debe cerrar la sesion con la ruta: logout ingresando el codigo del token para poder finalizar la sesion

  ----------------------------------------------------------------------------------------------------------------
  ------------------------Documentacion de configuración para Desarrollo el API Rest-----------------------------------------
  ----------------------------------------------------------------------------------------------------------------

  _ Primer paso crear el proyecto Laravel 11, con este comando:

  composer create-project laravel/laravel:^11.0 api_rest

  _ Segundo paso creacion del archivo para la migracion de base de datos 

  php artisan make:migration bd_prueba_tecnica

  _ Tercer paso crear el archivo para la migracion de las tablas: 

   php artisan make:controller Api/V1/StudentController --api --model=student

   php artisan make:controller Api/V1/UserController --api --model=User

 _ Al terminar de programar los archivos de migracion, ejecutar este comando:

    usar el comando: php artisan migrate
    en la consola te dira yes o no
    escribir yes  
    dar enter

 _ Configuracion de las fechas y zona horaria para America/lima 
 
   Configurar la fecha de zona horaria y del proyecto
 para el registro de fecha:


    ir config/app.php

    buscar a: 
    'timezone' => env('APP_TIMEZONE', 'UTC'),

    cambiarlo por:

    'timezone' => env('APP_TIMEZONE', 'America/Lima'),

    ir a: env.

    APP_TIMEZONE=UTC

    pasar a esto:

    APP_TIMEZONE=America/Lima



_Se va configurar el nombre de la aplicacion

    config/app.php 

    cambiar esto:

    'name' => env('APP_NAME', 'laravel'),

    lo modificamos asi:

    'name' => env('APP_NAME', 'api_rest'),

    config/cache.php

    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), 

    '_').'_cache_'),

    cambiar a esto:

    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'api_rest'), 

    '_').'_cache_'),

    config/database.php

    'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), 

    '_').'_database_'),

    cambiar a esto:

    'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'api_rest'), 

    '_').'_database_'),

_ Se va crear el modelo:

   comando: 
   php artisan make:model student -m
   
   El modelo User ya biene por defecto

 _ Crear el archivo api.php dentro de la carpeta routes/

   comando: php artisan install:api

   En caso no llegue a crear va tener que crear el archivo manualmente y programar.

    Recuerde programar las rutas

   _ comando para crear el archivo en el provider:
  
     php artisan make:provider RouteServiceProvider 

     Recuerda programar el archivo 


   _  Agregar seguridad a la API con sanctum para darle seguridad de autentificacion

     comando de instalacion: 

     comando:  composer require laravel/sanctum

    ejecutar el siguiente comando: 

    composer show laravel/sanctum

    ejecutar el otro comando: 

    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

    vamos a modificar el modelo usuario para agregar la clase: HasApiTokens de Sanctum.

   





