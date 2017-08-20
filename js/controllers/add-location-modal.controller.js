app.controller('addLocationModal', ['$uibModalInstance', 'items', function($uibModalInstance, items) {
    var $ctrl = this;
    console.log("text",$uibModalInstance);
    $ctrl.items = items;
    $ctrl.selected = {
        item: $ctrl.items[0]
    };

    $ctrl.ok = function() {
        $uibModalInstance.close($ctrl.selected.item);
    };

    $ctrl.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
}]);