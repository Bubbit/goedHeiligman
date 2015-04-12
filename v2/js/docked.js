angular.module('remcoGlobal').directive('rDocked', ['$document', '$window', '$timeout', 'viewportSize', function ($document, $window, $timeout, viewportSize) {
    return {
        restrict: 'A',
        link: function(scope, element) {
            scope.check = false;

            var setDocked = function() {
                // when going from non-docked to docked the footer is included in the calculation of the body height.
                // but we should add the height of the footer when returning from docked to non-docked.
                // so first remove the is-docked class, and add it again when needed.
                element.removeClass('is-docked');
                var heightPage = jQuery('body').outerHeight(true);
                if(heightPage < viewportSize.getHeight()) {
                    element.addClass('is-docked');
                }
            };

            angular.element($window).on('resize', function() {
                setDocked();
            });

            scope.$watch('check', function() {
                $timeout(function() {
                    scope.$apply(function() {
                        scope.check = !scope.check;
                        setDocked();
                    });
                }, 200);
            });

            setDocked();
        }
    }
}]);