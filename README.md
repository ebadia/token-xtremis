# token-xtremis
Sistema de login con API que proporciona un token para su posterior uso seguro en API externo.

Contiene:

##api_auth.sql

Archivo SQL para la creación de la BBDD necesaria para el API de  login.
En el servidor MySQL ejecutar el archivo SQL para crear la tabla necesaria.

##/ci-login
Frontend para el login de los usuarios (AngularJS 1.6)

Uso:

* se proporciona el codigo fuente en AngularJS
* para la generación de los archivos a servir finales hay que hacer `grunt build` en el directorio principal
* colocar posteriormente el directorio `dist` en el servidor


##/ci-rest
Backend con el API necesario para el login y generacion de los jwt tokens (Codeigniter 3)

Uso:

* colocar la carpeta `/ci-rest` en el servidor


# Instalación y configuración

Para configurar la apliación correctamente hay que editar el archivo `config.json` situado en la carpeta `/ci-login/app` **previamente** a la generación de la aplicación angular con `grunt build`.



Las variables configurables en `config.json` son:

* **welcome** :  Mensaje que aparece en la pantalla de login
* **url**: "URL de la página a la que se redirige un usuario identificado cirrectamente por el API
* **apiUrl**: URL del servidor en el que se instala el API de login. Al URL hay que añadir siempre el camino `/api/v1`

