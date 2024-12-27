Para ejecutar la aplicacion WEB REACT tiene que descargar la app_web que esta en el drive :
link: https://drive.google.com/drive/folders/1C4daWnFjuyTSjdQP_szN0EcMC7KJ3I-r?usp=sharing

El archivo se llama: front-end.zip
debe ejecutar el comando: npm start 

No tiene que modificar los endpoints o ApisRest ya que estan en diectamente en la nube

------Despliegue del Servicio WEB -----

Recuerde que la credenciales de su Gestor de base de datos debe tener esto, si esta en localhost:

usuario: root
password:      --> No hay contraseña

Pero si va a desplegarlo al Servidor para produccion debe cambiar las credenciales en el archivo .env

0.- Descargar el VENDOR en este LINK: 

https://drive.google.com/drive/folders/1bU2weslMfZHwIJLiJ83VEIpJFUPv0YB3?usp=sharing

1.- Migrar la base de datos y tablas con el comando:

php artisan migrate

con eso se va crear la base de datos automaticamente con la tabla pero la creacion de base de datos para migracion solo funciona en localhost si lo vas hacer en CPANEL
vas a necesitar crear la base de datos de manera manual desde su gestor Mysql o PhpMyAdmin

Nota: No es necesario cambiar el nombre de base de datos del archivo .env

2.- tambien es importante borrar la cache en el framework al momento de desplegar al servidor de produccion:

php artisan config:clear
php artisan cache:clear

Credenciales por defecto, para proteger el API rest.

Usuario: root@outlook.es
Password: 123

3.- Si vas a poner a producción modificar el APP_DEBUG cambiandolo a false

   APP_DEBUG=true  --> cambiarlo por false :  APP_DEBUG=false

4.- Usar postman para localhost o en su Servidor WEB:

  Nota considerar esto: http://localhost/nombre_carpeta/api_rest/public/api/v1/nombre_de_la_ruta


  primero usar la ruta login y colocar las credenciales para obtener el token, recuerde ir a body raw --> Json

  {
  "email": "root@outlook.es",
  "password": "123"
  }

  segundo usar las rutas students que desee usar, pero considerar ingrear el token en la opcion de Autorizathion y seleccionar Bearer Token 


  tercero cuando termine hacer su consulta debe cerrar la sesion con la ruta: logout ingresando el codigo del token para poder finalizar la sesion

5 Usar postman probando directamente de mi Servidor WEB de la Nube con mi dominio: https://evaluacion.desarrolladorhansluyo.com

a) Primero Logear para obtener el token:

  Seleccionar metodo: POST 

  Link: https://evaluacion.desarrolladorhansluyo.com/api/v1/iniciaSesion

  Ir en la opción body ahora va a ver muchas opciones hay que elegir raw y vas a ka última opción a la derecha que es un selector que dice text cambialo por JSON 
  y coloca este codigo:

  {
  "email": "root@outlook.es",
  "password": "123"
  }

  hacer click en el boton Enviar y debe darte esto como ejemplo:

  {
    "token": "8|qJWVjUwrUJhGELCL8yprKqjlbHsL1fHullcJT5aub3faacc2",     --> Este es el Token de Seguridad que te va dar, recuerda que el Token cambia cada vez que das el boton Enviar.
    "user": {
        "id": 1,
        "name": "root",
        "email": "root@outlook.es",
        "email_verified_at": null,
        "created_at": "2024-09-23T06:00:00.000000Z",
        "updated_at": "2024-12-25T21:36:03.000000Z"
    }
}

b) Segundo Consultar la ruta students para listar los datos:

Seleccionar metodo: GET

Link: https://evaluacion.desarrolladorhansluyo.com/api/v1/students

Ir a la opción Authorization, vamos al selector Auth Type para seleccionar Bearer Token con eso va aparecer una caja de texto llamada Token para pegar el token que copiastes

Hacer click en el boton: Enviar

y te dara los datos en JSON:

{
    "students": [
        {
            "id": 2,
            "first_name": "Jose",
            "last_name": "Perez",
            "enrollment_date": "2024-12-26",
            "status": 1
        },
        {
            "id": 1,
            "first_name": "Maria",
            "last_name": "De La Cruz",
            "enrollment_date": "2024-12-25",
            "status": 2
        }
    ]
}

c) Tercero buscar datos de los students por ID:

Seleccionar metodo: GET

link: https://evaluacion.desarrolladorhansluyo.com/api/v1/students/2  --> El numero 2 es el ID a buscar puede cambiar a otro ID si desea

Ir a la opción Authorization, vamos al selector Auth Type para seleccionar Bearer Token con eso va aparecer una caja de texto llamada Token para pegar el token que copiastes

Hacer click en el boton: Enviar

y te dara los datos detallado de los Students en JSON:

{
    "students": [
        {
            "id": 2,
            "first_name": "Jose",
            "last_name": "Perez",
            "email": "jose@example.com",
            "phone": "7952610",
            "birth_date": "1996-12-11",
            "enrollment_date": "2024-12-26",
            "status": 1
        }
    ]
}

b) Cuarto Agregar students 

Seleccionar metodo: POST

link: https://evaluacion.desarrolladorhansluyo.com/api/v1/students

Ir a la opción Authorization, vamos al selector Auth Type para seleccionar Bearer Token con eso va aparecer una caja de texto llamada Token para pegar el token que copiastes

Ir en la opción body ahora va a ver muchas opciones hay que elegir raw y vas a ka última opción a la derecha que es un selector que dice text cambialo por JSON 
  y coloca este codigo:

{
    "first_name": "Nail",  --> cambia a otro nombre porque ya existe
    "last_name": "Ortega", --> cambia de apellido porque ya existe 
    "email": "nail2@example.com", --> el email es Unico y debes poner otro email porque ya esta registrado (Campo Obligatorio)
    "phone": "7252654", --> el phone es Unico y debes poner otro phone porque ya esta registrado (Campo Obligatorio)
    "birth_date": "1992-12-11" --> Aqui tiene validacion para no permitir fecha futura (Campo Obligatorio)
}
   Ahora el campo: enrollment_date  --> Es la fecha de inscripcion y como es fecha de incripcion por logica tiene que ser con la fecha del servidor al momento de registrar,
                                       por ese motivo no se ingresa enrollment_date. 

   Ahora el campo: status  --> No se ingresa ya que internamente se va insertar en automatico el número 1 como Activado, ya que numero es mejor para tener mas velocidad.
    
  Nota: Si la Fecha de nacimiento es futura le dara este mensaje para validar: 

  {
    "message": {
        "birth_date": [
            "No se permite una fecha futura en el campo birth_date"
        ]
    }

  hacer click en el boton Enviar y debe darte esto:

  {
    "message": "Estudiante creado correctamente"
}

c) Quinto Actualizar datos students

Seleccionar metodo: PUT

 link: https://evaluacion.desarrolladorhansluyo.com/api/v1/students/1 --> e numero 1 es el ID que voy a modificar, si quiere modificar otro registro recuerde cambiar el ID

 Ir a la opción Authorization, vamos al selector Auth Type para seleccionar Bearer Token con eso va aparecer una caja de texto llamada Token para pegar el token que copiastes

 Ir en la opción body ahora va a ver muchas opciones hay que elegir raw y vas a ka última opción a la derecha que es un selector que dice text cambialo por JSON 
  y coloca este codigo:

  {
   "first_name": "Maria",     --> modifique el nombre que desea
   "last_name": "De La Cruz", --> modifique el apellido que desea
   "email": "maria@outlook.es", --> modifique el email que desea  --> Tiene validación de email como unico
   "phone": "97120954", --> --> modifique el phone que desea  --> Tiene validación de phone como unico
   "birth_date": "1994-02-14",  --> --> modifique la fecha de nacimiento que desea --> Tiene validacion para no aceptar fechas futuras
   "status": 2  --> Estado 2 para Desactivar y Estado 1 es para activar
}

Si hay problema por fecha futura le dara este mensaje al dar el boton Enviar:

{
    "message": {
        "birth_date": [
            "No se permite una fecha futura en el campo birth_date"
        ]
    }

Si todo esta bien te dara este mensaje:

{
    "message": "Estudiante modificado correctamente"
}


D) Cerrar sesion del Token cuando termines de hacer consultas:

Seleccionar metodo: POST

link: https://evaluacion.desarrolladorhansluyo.com/api/v1/logout

Ir a la opción Authorization, vamos al selector Auth Type para seleccionar Bearer Token con eso va aparecer una caja de texto llamada Token para pegar el token que copiastes

y te dara este mensaje:

{
    "message": "Sesión cerrada en todos los dispositivos"
}

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

   config/session.php

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    cambiar a esto:

     'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'api_rest'), '_').'_session'
    ),



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


   _  Agregar seguridad a la API con sanctum para darle seguridad de autentificacion (Se tomo esta decisión para proteger el API rest de ataque cybernetico)

     comando de instalacion: 

     comando:  composer require laravel/sanctum

    ejecutar el siguiente comando: 

    composer show laravel/sanctum

    ejecutar el otro comando: 

    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

    vamos a modificar el modelo usuario para agregar la clase: HasApiTokens de Sanctum.

   
