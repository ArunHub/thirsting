app.filter('searchFilter', function() {
    return function(markers, searhPlace) {
        if (!searhPlace) {
            return markers;
        }

        var result = [];

        searhPlace = searhPlace.toLowerCase();

        angular.forEach(markers, function(marker) {
            if (marker.title.toLowerCase().indexOf(searhPlace) !== -1) {
                result.push(marker);
            }
        });

        return result;
    };
})
