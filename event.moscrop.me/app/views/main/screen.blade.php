 <!doctype html>
<html lang="en" xmlns:ng="http://angularjs.org" ng-controller="screen">

    <head>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/angular-motion.min.css">
        <link rel="stylesheet" href="/css/video-js.min.css">
        <link rel="stylesheet" href="/css/screen.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    </head>

    <body>
        
        <!-- Main view Injection -->
        <div ng-controller="displayController">
            <div class="debug-text">@{{timeout}}</div>
            
        </div>


        <!-- Javascript -->   
        <script src="/lib/jquery-2.1.1.min.js"></script>
        <script src="/lib/bootstrap.min.js"></script>
        <script src="/lib/moment.min.js"></script>
        <script src="/lib/socket.io.js"></script>
        <script src="/lib/angular/angular.min.js"></script>
        <script src="/lib/angular/angular-animate.min.js"></script>
        <script src="/lib/angular/angular-sanitize.min.js"></script>
        <script src="/lib/ui-bootstrap-tpls-0.12.0.min.js"></script>
        <script src="/lib/video.js"></script>

        <script src="/js/screen.js"></script>

        <script src="/js/controllers/DisplayController.js"></script>
    </body>

</html>