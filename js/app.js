//Angular App Module and Controller
var app = angular.module('mapsApp', ['ngAnimate','ui.bootstrap']);
//map options

app.controller('MapCtrl', ['$scope', '$http', 'locationService', function($scope, $http, locationService) {


    var mapOptions = {
        zoom: 12,
        center: new google.maps.LatLng(13.073728, 80.225850),
        mapTypeId: google.maps.MapTypeId.TERRAIN,
        disableDefaultUI: true
    }

    var coconut = locationService.getCocunut();
    console.log("text",coconut);

    $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);
    $scope.coconut = 'img/';
    $scope.markers = [];

    $scope.method = 'GET';
    $scope.url    = 'http-hello.html';

    $scope.fetch = function(){
        $http({
              method: 'GET',
                  url: '/someUrl'
              }).then(function successCallback(response) {
                  // this callback will be called asynchronously
                  // when the response is available
                  console.log(response);
              }, function errorCallback(response) {
                  // called asynchronously if an error occurs
                  console.log(response);
                  // or server returns response with an error status.
              });

    }

    var infoWindow = new google.maps.InfoWindow();

    //creating function for marker
    var createMarker = function(info) {

        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(info.lat, info.long),
            title: info.location,
            icon: $scope.coconut + 'coconut.png',
            content: '<div class="infoWindowContent">' + info.desc + '</div>',
            noresult: true
        });

        google.maps.event.addListener(marker, 'click', function() {

            infoWindow.setContent('<h3>' + marker.title + '</h3>' + marker.content);
            infoWindow.open($scope.map, marker);
            $scope.map.setZoom(17);
            $scope.map.setCenter(marker.getPosition());
        });

        $scope.markers.push(marker);

        $scope.isShowing = false;


    }

    //looping for coconut marking
    for (i = 0; i < coconut.length; i++) {
        createMarker(coconut[i]);
    }


    //triggering for selected marker
    $scope.openInfoWindow = function(e, selectedMarker) {
        e.preventDefault();
        google.maps.event.trigger(selectedMarker, 'click');
    }


}]);


