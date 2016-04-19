
    //Angular App Module and Controller
    var app = angular.module('mapsApp', []);
    //map options

    app.controller('MapCtrl', function ($scope) {
        

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
        icon: $scope.coconut + 'coconut.png',
        content : '<div class="infoWindowContent">' + info.desc + '</div>'
    });    
            
    google.maps.event.addListener(marker, 'click', function(){

        infoWindow.setContent('<h3>' + marker.title + '</h3>' + marker.content);
        infoWindow.open($scope.map, marker);
        $scope.map.setZoom(17);
        $scope.map.setCenter(marker.getPosition());
    });
        
    $scope.markers.push(marker);

    }

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


    app.filter('searchFilter',function(){
        return function(markers,searhPlace) {
            if (!searhPlace) {
                return markers;
            }

            var result = [];

            searhPlace = searhPlace.toLowerCase();
            angular.forEach(markers,function(marker){                
                if (marker.title.toLowerCase().indexOf(searhPlace) !== -1) {
                    console.log(marker.title.toLowerCase());
                    result.push(marker);
                }
            });

            return result;
          };
    }) 

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