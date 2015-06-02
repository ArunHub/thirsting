<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Local Shop</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
      <!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
      <!--script src="js/less-1.3.3.min.js"></script-->
      <!--append ‘#!watch’ to the browser URL, then refresh the page. -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
      <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <![endif]-->
      <!-- Fav and touch icons -->
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
      <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
      <link rel="shortcut icon" href="img/favicon.png">
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
      <script type="text/javascript" src="js/scripts.js"></script>
      <script src="http://maps.googleapis.com/maps/api/js?key=&sensor=false&extension=.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
<style>
.infoWindowContent {
    font-size:  14px !important;
    border-top: 1px solid #ccc;
    padding-top: 10px;
}
h2 {
    margin-bottom:0;
    margin-top: 0;
}
body { padding-top: 60px; }
</style>

<script>
var cities = [
    {
        city : 'Toronto',
        desc : 'This is the best city in the world!',
        lat : 13.050015,
        long : 80.251444
    },
    {
        city : 'New York',
        desc : 'This city is aiiiiite!',
        lat : 13.040231,
        long : 80.233248
    },
    {
        city : 'Chicago',
        desc : 'This is the second best city in the world!',
        lat : 13.059630,
        long : 80.242432
    },
    {
        city : 'Los Angeles',
        desc : 'This city is live!',
        lat : 13.055282,
        long : 80.258139
    },
    {
        city : 'Las Vegas',
        desc : 'Sin City...\'nuff said!',
        lat : 13.060299,
        long : 80.285433
    }
];


var kerala = [
    {
        city : 'chennai',
        desc : 'This is the best city in the world!',
        lat : 9.595618,
        long : 76.299873
    },
    {
        city : 'New York',
        desc : 'This city is aiiiiite!',
        lat : 9.591217,
        long : 76.520286
    },
    {
        city : 'Chicago',
        desc : 'This is the second best city in the world!',
        lat : 9.535727,
        long : 76.443725
    },
    {
        city : 'Los Angeles',
        desc : 'This city is live!',
        lat : 9.498142, 
        long : 76.338668
    },
    {
        city : 'Las Vegas',
        desc : 'Sin City...\'nuff said!',
        lat : 9.629162,
        long : 76.423812
    }
];

//Angular App Module and Controller
angular.module('mapsApp', []).controller('MapCtrl', function ($scope) {

    var mapOptions = {
        zoom: 6,
        center: new google.maps.LatLng(13.084210, 80.276507),
        mapTypeId: google.maps.MapTypeId.TERRAIN,
		disableDefaultUI: true

    }

    $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);
	$scope.coconut = 'img/';
    $scope.markers = [];
    $scope.kermarkers = [];
    
    var infoWindow = new google.maps.InfoWindow();
    
    var createMarker = function (info){
        
        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(info.lat, info.long),
            title: info.city,
			icon: $scope.coconut + 'maps.png'
        });
		
        marker.content = '<div class="infoWindowContent">' + info.desc + '</div>';
        
        google.maps.event.addListener(marker, 'click', function(){
            infoWindow.setContent('<h2>' + marker.title + '</h2>' + marker.content);
            infoWindow.open($scope.map, marker);
			$scope.map.setZoom(16);
            $scope.map.setCenter(marker.getPosition());                             
        });		
		
        $scope.markers.push(marker);        
    } 

	var kerMarker = function (info){
        
        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(info.lat, info.long),
            title: info.city,
			icon: $scope.coconut + 'coc.png'
        });
		
        marker.content = '<div class="infoWindowContent">' + info.desc + '</div>';
        
        google.maps.event.addListener(marker, 'click', function(){
            infoWindow.setContent('<h2>' + marker.title + '</h2>' + marker.content);
            infoWindow.open($scope.map, marker);
			$scope.map.setZoom(16);
            $scope.map.setCenter(marker.getPosition());                             
        });		
		
        $scope.kermarkers.push(marker);
        
    }
    
    for (i = 0; i < cities.length; i++){
        createMarker(cities[i]);
    }

	for (i = 0; i < kerala.length; i++){
        kerMarker(kerala[i]);
    }
	
    $scope.openInfoWindow = function(e, selectedMarker){
        e.preventDefault();
        google.maps.event.trigger(selectedMarker, 'click');
    }

});
</script>
   </head>
   <body ng-app="mapsApp">
      <div class="container">
         <div class="row clearfix">
            <div class="col-md-12 column">
               <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                  <div class="navbar-header">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> 
					 <a class="navbar-brand" href="#">Local shops</a>
                  </div>
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <ul class="nav navbar-nav">
                        <li class="active">
                           <a href="#">About site</a>
                        </li>
                        <li>
                           <a href="#">Add your local shop</a>
                        </li>
                        <!-- <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
                           <ul class="dropdown-menu">
                           <li>
                           	<a href="#">Action</a>
                           </li>
                           <li>
                           	<a href="#">Another action</a>
                           </li>
                           <li>
                           	<a href="#">Something else here</a>
                           </li>
                           <li class="divider">
                           </li>
                           <li>
                           	<a href="#">Separated link</a>
                           </li>
                           <li class="divider">
                           </li>
                           <li>
                           	<a href="#">One more separated link</a>
                           </li>
                           </ul>
                           </li> -->
                     </ul>
                     <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                           <input class="form-control" type="text">
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                     </form>
                     <ul class="nav navbar-nav navbar-right">
                        <!-- <li>
                           <a href="#">Link</a>
                           </li>
                           <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
                           <ul class="dropdown-menu">
                           	<li>
                           		<a href="#">Action</a>
                           	</li>
                           	<li>
                           		<a href="#">Another action</a>
                           	</li>
                           	<li>
                           		<a href="#">Something else here</a>
                           	</li>
                           	<li class="divider">
                           	</li>
                           	<li>
                           		<a href="#">Separated link</a>
                           	</li>
                           </ul>
                           </li> -->
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="row clearfix">
            <div class="col-xs-12 col-md-9 column">
               <div id="map" style="width:100%; height:600px"></div>
            </div>
            <div class="col-md-3 column" ng-controller="MapCtrl">
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
                  <div class="panel panel-warning">
                     <div class="panel-heading">
                        <a class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion" href="#chetpet">Nungambakkam #2</a>
                     </div>
                     <div id="chetpet" class="panel-collapse collapse">
                        <div class="panel-body" ng-repeat="marker in kermarkers | orderBy : 'title'">
                           <a href="#" ng-click="openInfoWindow($event, marker)">{{marker.title}}</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row clearfix">
            <div class="col-md-4 column">
               
            </div>
            <div class="col-md-4 column">
            </div>
            <div class="col-md-4 column">
            </div>
         </div>
      </div>
   </body>
</html>
