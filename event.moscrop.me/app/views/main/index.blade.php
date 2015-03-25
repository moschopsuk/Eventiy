<!doctype html>
<html lang="en" xmlns:ng="http://angularjs.org" ng-app="liveEvent">
    <head>
        <title>Eventify</title>

        <!-- META -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Device Specific Options -->
        <link rel="icon" href="favicon.ico">
        <meta name="msapplication-TileColor" content="#f01d4f">

        <!-- Style sheets -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/angular-motion.min.css">
        <link rel="stylesheet" href="css/video-js.min.css">
        <link rel="stylesheet" href="css/default.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    </head>
    <body>

        <div ng-include="'partials/navbar.html'" ></div>
        
        <!-- Views injected here -->
        <div ui-view></div>

        <!-- Footer -->
        <div class="footer">
            <div class="container text-center">
                <p class="text-muted">Using version <version/></p>
            </div>
        </div>


        <!-- Javascript -->   
        <script src="lib/jquery-2.1.1.min.js"></script>
        <script src="lib/bootstrap.min.js"></script>
        <script src="lib/moment.min.js"></script>
        <script src="lib/socket.io.js"></script>
        <script src="lib/tinycon.min.js"></script>
        <script src="lib/angular/angular.min.js"></script>
        <script src="lib/angular/angular-animate.min.js"></script>
        <script src="lib/angular/angular-ui-router.min.js"></script>
        <script src="lib/angular/angular-sanitize.min.js"></script>
        <script src="lib/angular/angular-file-upload-all.min.js"></script>
        <script src="lib/ui-bootstrap-tpls-0.12.0.min.js"></script>
        <script src="lib/infinite-scroll.js"></script>
        <script src="lib/video.js"></script>

        <!-- App -->
        <script src="js/app.js"></script>

        <script src="js/filters/tweet.js"></script>

        <script src="js/services/AuthService.js"></script>
        <script src="js/services/EventService.js"></script>

        <script src="js/controllers/NavigationController.js"></script>
        <script src="js/controllers/EventsController.js"></script>
        <script src="js/controllers/EventController.js"></script>

        <script src="js/directives/videofix.js"></script>
        <script src="js/directives/Version.js"></script>

        <!-- Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-60173173-1', 'auto');
            ga('send', 'pageview');

        </script>
    </body>
</html>