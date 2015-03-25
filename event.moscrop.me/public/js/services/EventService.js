 app.service('EventService', ['$http', '$q', function($http, $q) {

 	this.all = function() {
 		var d = $q.defer();

 		$http.get("/api/v1/events")
 			.success(function(data) {
        		d.resolve(data);
    		}
    	);

 		return d.promise;
 	}

 	this.archived = function() {
 		 var d = $q.defer();

 		$http.get("/api/v1/archived")
 			.success(function(data) {
        		d.resolve(data);
    		}
    	);

 		return d.promise;
 	}

 	this.addPost = function(post) {
 		console.log("Adding post:");
 		console.log(post);
 		
 		var promise = $http.post("/api/v1/post/new", post);
 		var d = $q.defer();

 		promise.success(function(data) {
 			d.resolve(data);
 		});

 		promise.error(function(response, status) {
 		 	d.reject("Error Occured");
 		});

 		return d.promise;
 	}

}]);