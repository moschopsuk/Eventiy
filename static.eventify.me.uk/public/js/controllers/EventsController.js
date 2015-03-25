app.controller('EventsController', ['$scope','$http', 'EventService', function($scope, $http, EventService) 
{

	EventService.all().then(function(data)
	{
		$scope.events = data;
	});

	EventService.archived().then(function(data)
	{
		$scope.archived = data;
	});
	
}]);
