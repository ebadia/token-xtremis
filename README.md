# token-xtremis
Sistema de login con API que proporciona un token para su posterior uso seguro en API externo.

Contiene:

##api_auth.sql

Archivo SQL para la creación de la BBDD necesaria para el API de  login.
En el servidor MySQL ejecutar el archivo SQL para crear la tabla necesaria.

Una vez instalada la BBDD hay que editar el archivo `/ci-rest/application/config/database.php`para poner los datos correctos de acceso a la BBDD:

`'hostname' => 'localhost', // nombre del Host de la BBDD`

`'username' => 'root', // nombre del usuario de aaceso a la BBDD`

`'password' => '', // password del usuario de acceso a la BBDD`

`'database' => 'api_auth', // nombre de la tabla de la BBDD` 






##/ci-login
Frontend para el login de los usuarios (AngularJS 1.6)

Uso:

* se proporciona el codigo fuente en AngularJS
* para la generación de los archivos a servir finales hay que hacer `grunt build` en el directorio principal
* colocar posteriormente el directorio `dist` en el servidor




Los archivos en la carpeta `/ci-login/dist` pueden utilizarse directamente para colocar en el servidor para la visualización del Frontend. Solo hay que editar el archivo `config.json`para ser utilizado. (Ver debajo las variables configurables y sus valores),



##/ci-rest
Backend con el API necesario para el login y generacion de los jwt tokens (Codeigniter 3)

Uso:

* colocar la carpeta `/ci-rest` en el servidor


En el fichero ``/ci-example/application/config/jwt.php` se encuentra la clave secreta de codificación del token.

El token esta definido para expirar a las 4 horas de haberse solicitado. (Podria cambiarse de forma dinamica)



## /ci-example

Ejemplo de uso del token con un API externo (Codeigniter 3)

El ejemplo de uso se encuentra en el archivo `/ci-example/application/controllers/Clientes.php`

Para su uso en otros entornos hay que incluir en el php de lectura de la BBDD (API):

`/ci-example/application/helpers/jwt_helper.php`

``/ci-example/application/config/jwt.php` (archivo que contiene la clave secreta de decodificación del token. Ha de ser la misma usada para la codificación)

El esquema de funcionamiento es:

- leemos el token que viene en la URI
- abrimos un bloque try
- decodificamos la clave
- si la decodifica correctamente leemos los datos solicitados al API i devolvemos los valores o mostramos los resultados en una pagina
- en el bloque catch se recogen las excepciones de lectura del token y devolvemos un error 400 con el texto del error





# Instalación y configuración

Para configurar la apliación correctamente hay que editar el archivo `config.json` situado en la carpeta `/ci-login/app` **previamente** a la generación de la aplicación angular con `grunt build`.



Las variables configurables en `config.json` son:

* **welcome** :  Mensaje que aparece en la pantalla de login
* **url**: "URL de la página a la que se redirige un usuario identificado cirrectamente por el API
* **apiUrl**: URL del servidor en el que se instala el API de login. Al URL hay que añadir siempre el camino `/api/v1`

