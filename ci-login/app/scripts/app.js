'use strict';

/**
 * @ngdoc overview
 * @name loginappApp
 * @description
 * # loginappApp
 *
 * Main module of the application.
 */
angular
  .module('loginAppApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'ngMessages',
    'LocalStorageModule',
    'angular-jwt',
    'Alertify'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl',
        controllerAs: 'main'
      })
      .when('/about', {
        templateUrl: 'views/about.html',
        controller: 'AboutCtrl',
        controllerAs: 'about'
      })
      .otherwise({
        redirectTo: '/'
      });
  })
  .constant('DESTINO', 'http://google.es')

;
