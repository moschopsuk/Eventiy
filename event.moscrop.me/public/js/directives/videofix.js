app.directive('videofix', function () {
    var vp; // video player object to overcome one of the angularjs issues in #1352 (https://github.com/angular/angular.js/issues/1352).
            
    return {
        restrict: "A",

        link: function (scope, element, attrs) {
            attrs.id = attrs.id || "videojs";
            element.attr('id', attrs.id);

            vp = videojs(attrs.id, { responsive: true });
            
            scope.$on('$destroy', function () {   
                vp.pause();
                vp.dispose();
                console.log("Removing ");
            });
        }
    };
});