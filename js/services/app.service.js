app.service('services', ['$http', function($http) {

    this.CMS = getCMS;
    // this.createMarker = createMarker;
    // this.getMarkerList = getMarkerList;
    // this.markerList = [];
    return this;



    function getCMS() {
        return $http({
            method: 'GET',
            url: 'content/content.json'
        });
    }

    // function createMarker(locationObj) {
    //     var mapOptions = {
    //             zoom: 12,
    //             center: new google.maps.LatLng(13.073728, 80.225850),
    //             mapTypeId: google.maps.MapTypeId.TERRAIN,
    //             disableDefaultUI: true
    //         },
    //         imgPath = 'img/',
    //         map = new google.maps.Map(document.getElementById('map'), mapOptions),
    //         infoWindow = new google.maps.InfoWindow();

    //     var marker = new google.maps.Marker({
    //         map: map,
    //         position: new google.maps.LatLng(locationObj.lat, locationObj.long),
    //         title: locationObj.area,
    //         icon: imgPath + 'coconut.png',
    //         content: '<div class="infoWindowContent">' + locationObj.desc + '</div>',
    //         noresult: true
    //     });

    //     google.maps.event.addListener(marker, 'click', function() {
    //         infoWindow.setContent('<h3>' + marker.title + '</h3>' + marker.content);
    //         infoWindow.open(map, marker);
    //         map.setZoom(17);
    //         map.setCenter(marker.getPosition());
    //     });
    //     this.markerList.push(marker);
    // }

    // function getMarkerList() {
    //     return this.markerList;
    // }
}]);