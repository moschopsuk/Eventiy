/**
 *      This service handles the communication between the backend
 *      Auth and the frontend login/register system.
 */
 app.factory('Auth', ['$rootScope', '$http', '$q', function($rootScope, $http, $q) {
    var authenticated    = false;
    var user             = {};


    return {
        isAuthenticated: function () {
            return authenticated;
        },

        getUser: function() {
            return user;
        },

        checkSession: function() {
            var promise = $http.get("/api/v1/auth/session");
            promise.success(function(data) {
                if (data.logged) {
                    authenticated = data.logged;
                    angular.copy(data.user, user);
                    //Broadcast change as user has logged in
                    $rootScope.$broadcast('loginStatusChanged', data);
                }
            });
            return true;
        },

        logout: function() {
            var promise = $http.get("/api/v1/auth/logout");
            promise.success(function(data) {
                if (!data.logged) {
                    authenticated = false;
                    user = {};
                    console.log("Session ended");
                    //Broadcast change as user has logged in
                    $rootScope.$broadcast('loginStatusChanged', data);
                }
            });
            return true;
        },

        login: function(user) {
            var promise = $http.post("/api/v1/auth/login", user);
            var deferred = $q.defer();

            promise.success(function(data) {  
                /*
                * Check if the server had confirmed they have indeed
                * been logged in as success may return a user error
                */

                if (data.logged) {
                    console.log("Session created");
                    authenticated = data.logged;
                    angular.copy(data.user, user);
                    //Broadcast change as user has logged in
                    $rootScope.$broadcast('loginStatusChanged', data); 
                    deferred.resolve(data.user);
                } else {
                    //Forward error from server
                    deferred.reject(data.errorMessage);
                }
            });

            promise.error(function(response, status) {  
                deferred.reject("The request failed with response " + response + " and status code " + status);
            });

            return deferred.promise;
        },
    };
 }]);