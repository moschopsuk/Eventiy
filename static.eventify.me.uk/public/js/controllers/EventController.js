app.controller('EventController', ['$scope',  '$modal', '$stateParams', '$http', '$window', '$document', 'Auth',
    function($scope,  $modal, $stateParams, $http, $window, $document, Auth) {

    //Grab the event ID
    var eventId     = $stateParams.id;
    //init the socket
    var socket      = io('http://moscrop.me:3000');
    //list of posts
    $scope.posts    = [];

    //Defualt login status
    $scope.isLoggedIn = Auth.isAuthenticated();
    $scope.user 	  = Auth.getUser();

    //Handle any changes caused by the user
  	$scope.$on('loginStatusChanged', function (event, data) {
  		$scope.isLoggedIn = data.logged;
  		$scope.user = data.user;
  	});

    $scope.addPost = function()
    {
        var modalInstance = $modal.open(
        {
            templateUrl: '/partials/postDialog.html',
            controller: 'newPostDialogController',
            resolve: {
                eventId: function () {
                    return $stateParams.id;
                },
                user: function () {
                    return $scope.user;
                },
            }
        });
    }

    $scope.radioPlayer = function() {
        $window.open('http://player.bailriggfm.co.uk/','playerWindow','top=165,left=190,height=660,width=380');
    }

    $http.get("/api/v1/event/" + eventId + "/posts")
        .success(function(data) {
            $scope.posts = data;
        }
    );

    socket.on('post.new.' + eventId, function (data) {
        var post =  JSON.parse(data);
        console.log('socket: post.new');

        $scope.posts.unshift(post);
        $scope.$apply()
    });
    
    
    if(!$document.prop('hidden')) {

    }
}]);

app.controller('newPostDialogController', ['$scope', '$modalInstance', '$http', '$upload', 'eventId', 'EventService', 'user',
    function($scope, $modalInstance, $http, $upload, eventId, EventService, user) {

    $scope.event_id     = eventId;
    $scope.user_id      = user.id;
    $scope.tweets       = {};
    $scope.progress     = 0;


    $scope.changeTab = function(tab) {
        console.log('changeTab');
        $scope.view_tab = tab;
    }

    $scope.addPost = function(post) {
        EventService.addPost(post).then(
            function(data) {
                $modalInstance.dismiss();
            },
            function(error) {
                $scope.error = error;
            }
        );
    }

    $scope.searchHastag = function(hashtag) {
        $http.post("/api/v1/tweets", hashtag)
            .success(function(data) {
                console.log(data);
                $scope.tweets = {};
                $scope.tweets = data.statuses;
            }
        );
    }

    $scope.addTweet = function(tweet) {
        var postData = {
            payload_type    : 'tweet',
            user_id         : $scope.user_id,
            event_id        : eventId,
            tid             : tweet.id,
            tuid            : tweet.user.id,
            name            : tweet.user.name,
            screen_name     : tweet.user.screen_name,
            avatar          : tweet.user.profile_image_url,
            text            : tweet.text,
        };

        EventService.addPost(postData).then(
            function(data) {
                $modalInstance.dismiss();
            },
            function(error) {
                $scope.error = error;
            }
        );
    }

    $scope.addPhoto = function (photo, $file) {

        console.log(photo);

        $upload.upload({
            url:            '/api/v1/post/new',
            data:           photo,
            file:           $file[0],
            headers:        {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')},

        }).progress(function (evt) {
            $scope.progress =  parseInt(100.0 * evt.loaded / evt.total);
        }).success(function (data, status, headers, config) {
            $modalInstance.dismiss();
        }).error(function (err) {
            console.log('Error occured during upload');
        });

    }


}]);