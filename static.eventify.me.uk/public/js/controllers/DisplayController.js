app.controller('displayController', ['$scope', '$http', '$interval', '$location',
	function($scope, $http, $interval, $location) {
	$scope.apiUrl			= 'http://eventify.me.uk/api/v1/screen';	

	$scope.displayId 		= $location.search().display;
	$scope.layout 			= "unavailable";
	$scope.timeout 			= 60;
	$scope.event			= null;

	/*
	 *==================[ Timming functions] ======================
	 */


	fetchEventDetails();
	var promise;
	

	// stops the interval
	$scope.stop = function() {
		$interval.cancel(promise);
	};

	$scope.start = function() {
		// stops any running interval to avoid two intervals running at the same time
		$scope.stop(); 
		// store the interval promise
		promise = $interval(wait, 1000);
	};
	$scope.start(); 

	//This will function as a timeout to
	//Listen for event data to be sent.
	function wait() {
		if($scope.timeout == 60) {
			$scope.timeout = 0;

			fetchEventDetails();
		} else {
			++$scope.timeout ;
		}
	}

	function fetchEventDetails() {
		$http.put($scope.apiUrl, {
        	display_id    :  $scope.displayId,
    	}).success(function(data){
    		$scope.layout = data.layout;
    		$scope.event = data.event;
    	});
	}
}]);