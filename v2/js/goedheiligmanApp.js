angular.module('goedheiligmanApp', ['loginApp', 'remcoGlobal', 'imageViewer', 'ngTouch']);

angular.module('goedheiligmanApp').controller('appCtrl', function($scope, loginService) {
    $scope.loginService = loginService;
    console.log(loginService);

    $scope.openMenu = false;

    $scope.toggleMenu = function() {
        $scope.openMenu = !$scope.openMenu;
    }
});