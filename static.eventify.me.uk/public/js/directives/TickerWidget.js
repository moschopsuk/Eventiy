app.directive('tickerwidget', ['$timeout', '$q', '$sanitize', '$http', function ($timeout, $q, $sanitize, $http) {
    return {
        templateUrl: '/partials/tickerwidget.html',
        replace: true,
        scope: {
                eventModel: '=',
                number: '=',
        },
        link: function (scope, element, attrs) {
            var socket      = io('http://moscrop.me:3000');
            var id          = scope.eventModel.id;
            var apiUrl      = 'http://eventify.me.uk/api/v1/event/';
            scope.newsItems = [];

            $http.get(apiUrl + id + '/text/7/posts').
            success(function(data) {

                angular.forEach(data, function(post) {
                    scope.newsItems.unshift(post.payload);
                });

            });

            socket.on('post.new.' + id, function (data) {
                var post =  JSON.parse(data);
                console.log('socket: post.new');
                console.log(post);

                if(post.base.payload_type === 'text') {
                    //remove tweet from side
                    scope.newsItems.splice(6, 1);
                    //add tweet to top
                    scope.newsItems.unshift(post.payload);
                    scope.$apply();
                }
            });
        }
    };

}]);