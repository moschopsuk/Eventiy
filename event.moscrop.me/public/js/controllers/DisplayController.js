app.controller('displayController', ['$scope', '$http', '$interval',
	function($scope, $http, $interval) {

		var promise;

		console.log("test");

		$scope.timeout = 60;

		$scope.start = function() {
			// stops any running interval to avoid two intervals running at the same time
			$scope.stop(); 
			// store the interval promise
			promise = $interval(wait, 1000);
		};

		// stops the interval
		$scope.stop = function() {
			$interval.cancel(promise);
		};
  
		// starting the interval by default
		$scope.start();

		function wait() {
			if($scope.timeout == 60) {
				$scope.timeout = 0;
			} else {
				++$scope.timeout ;
			}
		}

}]);