'use strict';

/**
 * @ngdoc function
 * @name loginappApp.component:loginForm
 * @description
 * # loginForm
 * Component for User login & logout with jwt auth
 */

 angular.module( 'loginAppApp')
 .component( 'loginForm', {
 	templateUrl: 'views/loginForm.html',
 	controllerAs: 'loginForm',
 	bindings: {
 		goto: '@'
 	},
 	controller: [ '$rootScope', '$http', '$window', 'localStorageService', 'jwtHelper', 'Alertify',

        function($rootScope, $http, $window, localStorageService, jwtHelper, Alertify) {

 		var self = this;

	 	/**
	 	 * @property user usuario para el login
	 	 * @property siuser datos del usuario para el signin
	 	 * @property islogged el ususario esta logeado correctamente con token
	 	 * @property islogin toggle para mostrar el formulario de login
	 	 * @property issignin toggle para mostrar el formulario de signin
	 	 * @property apiUrl url de localizacion del API para el login
	 	*/
	 	this.user = {'email': ''};
 		this.siuser = {'email': ''};
 		this.islogged = false;
 		this.islogin = true;
 		this.issignin = false;
 		this.apiUrl = '';

 		this.$onInit = function(){

            // recupera el uerl del API
            $http.get('config.json')
            .then( function(res){
                console.log(res);
                self.apiUrl = res.data.apiUrl;
            });


 			// comprueba si estamos todavia identificados y con token no expirado

 			if ( localStorageService.get('token') !== null && !jwtHelper.isTokenExpired(localStorageService.get('token')) )
 			{
 				self.islogged = true;
 				self.user.email = localStorageService.get('email');
 				$rootScope.$broadcast('thetoken', localStorageService.get('token'));
 			}
	 	};

	 	/**
	 	 * @ngdoc method
	 	 * @name login
	 	 * @methodOf loginappApp.component:loginForm
	 	 * @description
	 	 * realiza el login de un usuario a traves de su email y password
	 	 * puede adpatarse para usa un nobre de usuario en lugar del email
	 	 * Si el login es correcto pone en localstorage el email y el jwt token
	 	 * obtenido del backend para asegurar posteriormente las llamadas al API
	 	 *
	 	 * @param
	 	 * @returns
	 	*/

 		this.login = function(){
 			/**
		 	 * @description
 			 * envia los datos al backend con el metodo POST
 			 * @param API_URL + objeto con los datos del usuario a verificar
 			 * @returns {promise} datos del API
 			*/
 			$http.post(self.apiUrl+'login/user', self.user)
 			.then(
 				/*
 				* @description
 				* retorna correctamente del backend
 				* @returns {string} email email del usuario conectado
 				* @returns {string} token jwt del token con los datos de expiracion
 				*/
 				function(res){
 					// poner el resultado del token en localstorage
          localStorageService.set('email', res.data.email);
 					localStorageService.set('token', res.data.token);
          // cookies
          localStorageService.cookie.set('email', res.data.email,1);
 					localStorageService.cookie.set('token', res.data.token,1);
 					// variables para el UI
 					self.islogged = true;
 					self.user.email = res.data.email;
 					self.expira = jwtHelper.getTokenExpirationDate(res.data.token);
 					$rootScope.$broadcast('thetoken', localStorageService.get('token'));
 					$window.location.href = self.goto+'token/'+res.data.token;
 				},
 				/*
 				* @description
 				* retorna con error
 				* @returns {string} errors descripcion del error
 				*/
 				function(err){
 					// mostramos alerta con el error
 					Alertify.error('Upps... ' + err.data.errors);
 					self.islogged = false;
 				}
 			);
 		};

	 	/**
	 	 * @ngdoc method
	 	 * @name logout
	 	 * @methodOf loginappApp.component:loginForm
	 	 * @description
	 	 * realiza el logout de un usuario
	 	 * destruye el contenido almacenado en localstorage (email, jwt token)
	 	 *
	 	 * @param
	 	 * @returns
	 	*/

 		this.logout = function(){
 			// borra el resultado del token en localstorage
 			self.token = localStorageService.cookie.clearAll();
 			self.token = localStorageService.clearAll();
 			self.user = {'email': ''};
 			self.islogged = false;
 			$rootScope.$broadcast('thetoken', '');
 		};

	 	/**
	 	 * @ngdoc method
	 	 * @name signin
	 	 * @methodOf loginappApp.component:loginForm
	 	 * @description
	 	 * realiza el alta de un nuevo usuario
	 	 *
	 	 * @param
	 	 * @returns
	 	*/

 		this.toggleIssignin = function(){
 			self.issignin = true;
 			self.islogin = false;
 		};

 		this.toggleIslogin = function(){
 			self.issignin = false;
 			self.islogin = true;
 		};


	 	/**
	 	 * @ngdoc method
	 	 * @name signin
	 	 * @methodOf loginappApp.component:loginForm
	 	 * @description
	 	 * realiza el alta de un nuevo usuario
	 	 *
	 	 * @param
	 	 * @returns
	 	*/

 		this.signin = function(){
 			/**
		 	 * @description
 			 * envia los datos al backend con el metodo POST
 			 * @param API_URL + objeto con los datos del usuario a verificar
 			 * @returns {promise} datos ddel API
 			*/
 			$http.post(self.apiUrl+'login/users', self.siuser)
 			.then(
 				/*
 				* @description
 				* retorna correctamente del backend con el usuario creado
 				* @returns {string} email email del usuario conectado
 				*/
 				function(res){
 					// mostramos alerta con exito
 					Alertify.success('Usuario '+ res.data.email +' creado.\n Ya puedes entrar en el sistema.');
 					self.siuser = {};
 					self.islogged = false;
 					self.issignin = false;
 					self.islogin = true;
 				},
 				/*
 				* @description
 				* retorna con error
 				* @returns {string} errors descripcion del error
 				*/
 				function(err){
 					// mostramos alerta con el error
 					console.log(err);
 					Alertify.error('Upps... ' + err.data.errors);
 					self.islogged = false;
 					self.issignin = true;
 					self.islogin = false;
 				}
 			);
 		};

 	}],
});
