angular.module('imageViewer', []);

angular.module('imageViewer').directive('imageViewerMain', function() {
    return {
        restrict: 'EA',
        template: '<div class="imageViewerContainer" ng-swipe-left="setPrevImage()" ng-swipe-right="setNextImage()"><img src="../Images/uploads/{{activeImage}}" class="imageViewer"/></div>',
        controller: 'imageViewerCtrl'
    }
});

angular.module('imageViewer').directive('imageViewerFilter', function() {
    return {
        restrict: 'EA',
        template: '<div class="imageViewerFilters">' +
                    '<ul>' +
                        '<li ng-repeat="filter in filters" ng-click="toggleFilter(filter.id)" ng-class="{\'activeFilter\': checkIfActiveFilter(\'{{filter.id}}\')}">{{filter.name}}</li>' +
                        '<li ng-click="clearFolderFilters()">Verwijder filters</li>' +
                    '</ul>' +
                  '</div>',
        controller: 'imageViewerCtrl'
    }
});

angular.module('imageViewer').directive('imageViewerCarousel', function() {
    return {
        restrict: 'EA',
        template: '<div class="imageViewerCarousel">' +
                    '<div class="leftButton" ng-click="prevCarousel()" ng-swipe-left="prevCarousel()" ng-swipe-right="nextCarousel()"></div>' +
                    '<ul>' +
                        '<li ng-repeat="image in carouselImages | limitTo:carouselLimit" ng-click="setActiveImage($index)"><img src="../Images/uploads/tn_{{image.name}}"/></li>' +
                    '</ul>' +
                    '<div class="rightButton" ng-click="nextCarousel()"></div>' +
                  '</div>',
        controller: 'imageViewerCtrl'
    }
});

angular.module('imageViewer').directive('imageViewer', function() {
    return {
        restrict: 'EA',
        template: '<image-viewer-filter></image-viewer-filter>' +
                  '<image-viewer-main></image-viewer-main>' +
                  '<image-viewer-carousel></image-viewer-carousel>',
        controller: 'imageViewerCtrl'
    }
});

angular.module('imageViewer').controller('imageViewerCtrl', function($scope, $http) {
    $scope.filterId = undefined;
    $scope.images = [];
    $scope.activeImage = "";
    $scope.activeId = "";

    $scope.filteredImages = [];

    $scope.filterPromise = $http.get("ajax/fotoFolder.php");

    $scope.filterPromise.then(function(folders) {
       $scope.filters = folders.data;
    });

    $scope.imagesPromise = $http.get("ajax/foto.php");

    $scope.imagesPromise.then(function(images) {
       $scope.images = images.data;
       $scope.activeImage = $scope.images[0].name;
       $scope.activeId = 0;
       $scope.setCarouselImages($scope.images);
    });

    $scope.activeFilters = [];
    $scope.currentCarouselIndex = 0;
    $scope.carouselLimit = 20;

    $scope.toggleFilter = function(id) {
        $scope.filterId = id;
        $scope.setCarouselImages($scope.filterImages($scope.images, id));
    };

    $scope.clearFolderFilters = function() {
        $scope.filterId = undefined;
        $scope.setCarouselImages($scope.filterImages($scope.images));
    };

    $scope.checkIfActiveFilter = function(id) {
        return ($scope.filterId === id);
    };

    $scope.setActiveImage = function(imageId) {
        $scope.activeId = imageId;
        $scope.activeImage = $scope.carouselImages[imageId].name;
    };

    $scope.setCarouselImages = function(images) {
        $scope.carouselImages = images.slice($scope.currentCarouselIndex);
    };

    $scope.setNextImage = function() {
        $scope.nextCarousel();
        $scope.setActiveImage($scope.activeId);
    };

    $scope.setPrevImage = function() {
        $scope.prevCarousel();
        $scope.setActiveImage($scope.activeId);
    };

    $scope.nextCarousel = function() {
        if($scope.currentCarouselIndex < $scope.images.length - $scope.carouselLimit) {
            $scope.currentCarouselIndex += 1;
            $scope.setCarouselImages($scope.filterImages($scope.images, $scope.filterId));
        }
    };

    $scope.prevCarousel = function() {
        if($scope.currentCarouselIndex > 0) {
            $scope.currentCarouselIndex -= 1;
            $scope.setCarouselImages($scope.filterImages($scope.images, $scope.filterId));
        }
    };

    $scope.filterImages = function(items, filterId) {
        var filtered = [];

        if(filterId) {
            angular.forEach(items, function (item) {
                if (item.folder === filterId) {
                    filtered.push(item);
                }
            });
        } else {
            filtered = items;
        }
        return filtered;
    };
});