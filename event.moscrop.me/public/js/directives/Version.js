app.directive('version', ['config', function (config) {          
    return function(scope, elm, attrs) {
        elm.text(config.VERSION);
    };
}]);