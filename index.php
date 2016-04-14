<!DOCTYPE html>
<html lang="en" ng-app="mapsApp">
  <head>
    <meta charset="utf-8">
    <title>Local Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--append ‘#!watch’ to the browser URL, then refresh the page. -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="img/favicon.png">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="js/scripts.js"></script> -->
    <script src="http://maps.googleapis.com/maps/api/js?key=&sensor=false&extension=.js"></script>
    <script src="js/angular.min.js"></script>
    <script>
    // coconut name,desc,lat,lang
    var coconut = [
    {
    location : 'Sterling Road',
    desc : 'Landmarks : Mexican griller , Maplai restaurant',
    lat : 13.063578,
    long : 80.236258
    },
    {
    location : 'Valluvar Kottam High Road',
    desc : 'Landmarks : Opposite to Amma Unavagam, Specmakers',
    lat : 13.060341,
    long : 80.242795
    },
    {
    location : 'Chicago',
    desc : 'This is the second best location in the world!',
    lat : 13.059630,
    long : 80.242432
    },
    {
    location : 'Los Angeles',
    desc : 'This location is live!',
    lat : 13.055282,
    long : 80.258139
    },
    {
    location : 'Las Vegas',
    desc : 'Sin location...\'nuff said!',
    lat : 13.060299,
    long : 80.285433
    }
    ];
    var kerala = [
    {
    location : 'chennai',
    desc : 'This is the best location in the world!',
    lat : 9.595618,
    long : 76.299873
    },
    {
    location : 'New York',
    desc : 'This location is aiiiiite!',
    lat : 9.591217,
    long : 76.520286
    },
    {
    location : 'Chicago',
    desc : 'This is the second best location in the world!',
    lat : 9.535727,
    long : 76.443725
    },
    {
    location : 'Los Angeles',
    desc : 'This location is live!',
    lat : 9.498142,
    long : 76.338668
    },
    {
    location : 'Las Vegas',
    desc : 'Sin location...\'nuff said!',
    lat : 9.629162,
    long : 76.423812
    }
    ];
    //Angular App Module and Controller
    angular.module('mapsApp', []).controller('MapCtrl', function ($scope) {
    //map options
    var mapOptions = {
    zoom: 12,
    center: new google.maps.LatLng(13.073728, 80.225850),
    mapTypeId: google.maps.MapTypeId.TERRAIN,
        disableDefaultUI: true
    }
    $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);
      $scope.coconut = 'img/';
    $scope.markers = [];
    $scope.kermarkers = [];
    
    var infoWindow = new google.maps.InfoWindow();
    
      //creating function for marker
    var createMarker = function (info){
    
    var marker = new google.maps.Marker({
    map: $scope.map,
    position: new google.maps.LatLng(info.lat, info.long),
    title: info.location,
          icon: $scope.coconut + 'coconut.png'
    });
        
    marker.content = '<div class="infoWindowContent">' + info.desc + '</div>';
    
    google.maps.event.addListener(marker, 'click', function(){
    infoWindow.setContent('<h3>' + marker.title + '</h3>' + marker.content);
    infoWindow.open($scope.map, marker);
          $scope.map.setZoom(17);
    $scope.map.setCenter(marker.getPosition());
        });
        
    $scope.markers.push(marker);
    }
      // var kerMarker = function (info){
    
    // var marker = new google.maps.Marker({
    // map: $scope.map,
    // position: new google.maps.LatLng(info.lat, info.long),
    // title: info.location,
          // icon: $scope.coconut + 'coc.png'
    // });
        
    // marker.content = '<div class="infoWindowContent">' + info.desc + '</div>';
    
    // google.maps.event.addListener(marker, 'click', function(){
    // infoWindow.setContent('<h3>' + marker.title + '</h3>' + marker.content);
    // infoWindow.open($scope.map, marker);
          // $scope.map.setZoom(16);
    // $scope.map.setCenter(marker.getPosition());
        // });
        
    // $scope.kermarkers.push(marker);
    
    // }
    
      //looping for coconut marking
    for (i = 0; i < coconut.length; i++){
    createMarker(coconut[i]);
    }
      // for (i = 0; i < kerala.length; i++){
    // kerMarker(kerala[i]);
    // }
      
      //triggering for selected marker
    $scope.openInfoWindow = function(e, selectedMarker){
    e.preventDefault();
    google.maps.event.trigger(selectedMarker, 'click');
    }
    });
    </script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body ng-controller="MapCtrl">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Local shops</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active">
              <a href="#">About site</a>
            </li>
            <li>
              <a href="#">Add your local shop</a>
            </li>
          </ul>
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
          </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        <aside>
          <div class="panel-group" id="accordion">
            <div class="panel panel-info">
              <div class="panel-heading">
                <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion" href="#nungai">Nungambakkam #1</a>
              </div>
              <div id="nungai" class="panel-collapse collapse">
                <div class="panel-body" ng-repeat="marker in markers | orderBy : 'title'">
                  <a href="#" ng-click="openInfoWindow($event, marker)">{{marker.title}}</a>
                </div>
              </div>
            </div>
          </div>
        </aside>
        <main>
        <div id="map" style="width:100%; height:600px"></div>
        </main>
      </body>
    </html>