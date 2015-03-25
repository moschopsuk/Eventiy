app.controller('NavigationController', ['$rootScope', '$scope', '$http', 'Auth',
	function($rootScope, $scope, $http, Auth) {

	$scope.isLoggedIn = Auth.isAuthenticated();
	$scope.username = Auth.getUser().email;

  	$scope.$on('loginStatusChanged', function (event, data) {
  		$scope.isLoggedIn = data.logged;
  		$scope.username = Auth.getUser().email;
  	});
	
	$scope.signin = function(credentials) {
		//Clear previous error
		$scope.error = "";

		Auth.login(credentials).then(
			function(user) {
				$scope.username = user.email;
			},
			function(error) {
				$scope.error = error;
			}
		);
    };

    $scope.logout = function() {
    	Auth.logout();
    }

}]);