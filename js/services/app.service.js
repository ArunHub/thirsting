app.service('locationService', ['$http', function($http) {

    this.getCocunut = getCocunut;
    this.getLocation = getLocation;
    return this;

    function getCocunut() {
       return $http({
              method: 'GET',
                  url: 'content/content.json'
              }).then(function successCallback(response) {
                  // this callback will be called asynchronously
                  // when the response is available
                  console.log(response);
              }, function errorCallback(response) {
                  // called asynchronously if an error occurs
                  console.error(response);
                  // or server returns response with an error status.
              });
    }

    function getLocation() {
        var kerala = [{
            location: 'chennai',
            desc: 'This is the best location in the world!',
            lat: 9.595618,
            long: 76.299873
        }, {
            location: 'New York',
            desc: 'This location is aiiiiite!',
            lat: 9.591217,
            long: 76.520286
        }, {
            location: 'Chicago',
            desc: 'This is the second best location in the world!',
            lat: 9.535727,
            long: 76.443725
        }, {
            location: 'Los Angeles',
            desc: 'This location is live!',
            lat: 9.498142,
            long: 76.338668
        }, {
            location: 'Las Vegas',
            desc: 'Sin location...\'nuff said!',
            lat: 9.629162,
            long: 76.423812
        }];
    }

}])
