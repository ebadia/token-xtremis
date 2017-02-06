'use strict';

/**
 * @ngdoc function
 * @name loginappApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the loginappApp
 */
angular.module('loginAppApp')
.controller('MainCtrl', function ($scope, $http, localStorageService, jwtHelper, Alertify, DESTINO) {

	var self = this;

	self.prova = localStorageService.get('token');

	$http.get('config.json')
	.then( function(res){
		self.destino = res.data.url;
		self.welcome = res.data.welcome;
	});

	// self.destino = '';

	// prueba de mensaje externo al que debe reaccionar.
	// viene de $rootScope y lo activamos en el componente de login
	$scope.$on('thetoken', function(evt,args){
		if (args !== null){
			self.destino = self.destino + args;
		}
	});

});
