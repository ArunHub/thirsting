app.controller('MapCtrl', ['$scope', '$http', 'services', '$uibModal', '$log', '$document', function($scope, $http, services, $uibModal, $log, $document) {
    // variables
    var
        MAP_OPTIONS = {
            zoom: 12,
            center: new google.maps.LatLng(13.073728, 80.225850),
            mapTypeId: google.maps.MapTypeId.TERRAIN,
            disableDefaultUI: true
        },
        IMG_PATH = 'img/',
        MAP = new google.maps.Map(document.getElementById('map'), MAP_OPTIONS),
        INFO_WINDOW = new google.maps.InfoWindow();

    // scopes
    $scope.markers = [];

    //creating function for marker
    function createMarker(locationObj) {

        var marker = new google.maps.Marker({
            map: MAP,
            position: new google.maps.LatLng(locationObj.lat, locationObj.long),
            title: locationObj.area,
            icon: IMG_PATH + 'coconut.png',
            content: '<div class="infoWindowContent">' + locationObj.desc + '</div>',
            noresult: true
        });

        google.maps.event.addListener(marker, 'click', function() {
            INFO_WINDOW.setContent('<h3>' + marker.title + '</h3>' + marker.content);
            INFO_WINDOW.open(MAP, marker);
            MAP.setZoom(17);
            MAP.setCenter(marker.getPosition());
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
        // this callback will be called asynchronously when the response is available

        var locations = response.data.locations;
        locations.forEach(function(location) {
            createMarker(location);
        });

    }, function errorCallback(error) {
        // called asynchronously if an error occurs or server returns response with an error status.
        console.error(error);
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

}]);