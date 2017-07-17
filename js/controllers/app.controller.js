app.controller('MapCtrl', ['$scope', '$http', 'services', '$uibModal', '$log', '$document', function($scope, $http, services, $uibModal, $log, $document) {
    // variables
    var
        mapOptions = {
            zoom: 12,
            center: new google.maps.LatLng(13.073728, 80.225850),
            mapTypeId: google.maps.MapTypeId.TERRAIN,
            disableDefaultUI: true
        },
        imgPath = 'img/',
        map = new google.maps.Map(document.getElementById('map'), mapOptions),
        infoWindow = new google.maps.InfoWindow();

    // scopes
    $scope.markers = [];
    // $scope.markersss = [];

    //creating function for marker
    function createMarker(locationObj) {

        var marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(locationObj.lat, locationObj.long),
            title: locationObj.area,
            icon: imgPath + 'coconut.png',
            content: '<div class="infoWindowContent">' + locationObj.desc + '</div>',
            noresult: true
        });

        google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent('<h3>' + marker.title + '</h3>' + marker.content);
            infoWindow.open(map, marker);
            map.setZoom(17);
            map.setCenter(marker.getPosition());
        });

        $scope.markers.push(marker);
    }

    //triggering for selected marker
    function openInfoWindow(e, selectedMarker) {
        e.preventDefault();
        google.maps.event.trigger(selectedMarker, 'click');
    };

    // call CMS services
    services.CMS().then(function successCallback(response) {
        // this callback will be called asynchronously
        // when the response is available
        var locations = response.data.locations;
        locations.forEach(function(location) {
            createMarker(location);
        });
        // $scope.markersss = services.markerList();

    }, function errorCallback(error) {
        // called asynchronously if an error occurs
        console.error(error);
        // or server returns response with an error status.
    });

    // Add location modal
    var addLocationModal = {};

    addLocationModal.open = function(size, parentSelector) {
        var parentElem = parentSelector ?
            angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
            console.log("text",$uibModal);
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'template/add-your-location.html',
            controller: 'addLocationModal',
            controllerAs: 'addLocation',
            size: 'lg',
            appendTo: parentElem,
            resolve: {
                items: function() {
                    return 'addLocationModal.items';
                }
            }
        });

        modalInstance.result.then(function(selectedItem) {
            addLocationModal.selected = selectedItem;
        }, function() {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };

    $scope.openInfoWindow = openInfoWindow;
    $scope.addLocationModal = addLocationModal;
    // $scope.addLocationModal = addLocationModal;


}]);