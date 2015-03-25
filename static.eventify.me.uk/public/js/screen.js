"use strict";
var app = angular.module('screenApp', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.config(['$locationProvider', function($locationProvider) {
	$locationProvider.html5Mode(true);
}]);