"use strict";
var app = angular.module('liveEvent', ['ui.router', 'ui.bootstrap', 'ngAnimate', 'ngSanitize', 'angularFileUpload']);

app.constant('config', {
    VERSION:    '0.1.1',
    APIURL:     '/ap1/v1'
});

app.config(function ($sceProvider) {
  $sceProvider.enabled(false);
});

app.filter('dateToISO', function() {
  return function(badTime) {
    var goodTime = badTime.replace(/(.+) (.+)/, "$1T$2Z");
    return goodTime;
  };
});

app.run(['$http', 'Auth', function($http, Auth) {
    var token =  $('meta[name=csrf-token]').attr('content');
    console.log("csrf-token:" + token);
    $http.defaults.headers.common['X-CSRF-Token'] = token;

    Auth.checkSession();

    videojs.options.flash.swf = "video-js.swf";
}]);

app.filter('fromNow', function() {
	return function(date) {
		return moment(date).fromNow();
	}
});

app.config(['$urlRouterProvider', '$stateProvider', function($urlRouterProvider, $stateProvider) {
    $urlRouterProvider.otherwise('/home');

    $stateProvider
     	.state('Home', {
        	url: '/home',
        	templateUrl: 'partials/event.list.html',
        	controller: 'EventsController',
    	})
     	.state('Event', {
        	url: '/event/{id:int}',
        	templateUrl: 'partials/event.html',
            controller: 'EventController',
    	});
}]);
