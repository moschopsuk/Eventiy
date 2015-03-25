app.directive('twitterwidget', ['$timeout', '$q', '$sanitize', '$http', function ($timeout, $q, $sanitize, $http) {
    return {
        templateUrl: '/partials/twitterwidget.html',
        replace: true,
        scope: {
                eventModel: '=',
                number: '=',
        },
        link: function (scope, element, attrs) {
            var socket      = io('http://moscrop.me:3000');
            var id          = scope.eventModel.id;
            var apiUrl      = 'http://eventify.me.uk/api/v1/event/';
            scope.tweets = [];

            $http.get(apiUrl + id + '/tweet/4/posts').
            success(function(data) {

                angular.forEach(data, function(post) {
                    scope.tweets.unshift(post.payload);
                });

            });

            socket.on('post.new.' + id, function (data) {
                var post =  JSON.parse(data);
                console.log('socket: post.new');
                console.log(post);

                if(post.base.payload_type === 'tweet') {
                    //remove tweet from side
                    scope.tweets.splice(3, 1);
                    //add tweet to top
                    scope.tweets.unshift(post.payload);
                    scope.$apply();
                }
            });
        }
    };

}]);