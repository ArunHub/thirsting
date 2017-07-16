app.service('services', ['$http', function ($http) {

    this.CMS = getCMS;
    return this;

    function getCMS() {
        return $http({
            method: 'GET',
            url: 'content/content.json'
        });
    }
}]);