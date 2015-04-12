/**
 * @ngdoc service
 * @name remcoGlobal.factory:viewportSize
 * @requires $window
 * @requires $document
 *
 * @description
 * Based on viewportSize by Tyson Matanich - https://github.com/tysonmatanich/viewportSize
 *
 * Calculates the width and height of the viewport. Used in mqService.
 *
 * Licensed under the MIT license
 **/

angular.module('remcoGlobal').factory('viewportSize', ['$window', '$document', function($window, $document) {
    var document = $document[0],
        documentElement = document.documentElement,
        getSize,
        getWindowSize = function(dimension) {
            return $window["inner" + dimension];
        },
        getDocumentSize = function(dimension) {
            return document.documentElement["client" + dimension];
        },
        getViewportSize = function (Name) {
            if (!getSize) {
                var name = Name.toLowerCase();
                if ($window["inner" + Name] === undefined) {
                    // IE6 & IE7 don't have window.innerWidth or innerHeight
                    getSize = getDocumentSize;
                }
                else if (String($window["inner" + Name]) !== String(documentElement["client" + Name])) {
                    // WebKit doesn't include scrollbars while calculating viewport size so we have to get fancy

                    // Insert markup to test if a media query will match document.doumentElement["client" + Name]
                    var bodyElement = document.createElement("body");
                    bodyElement.id = "vpw-test-b";
                    bodyElement.style.cssText = "overflow:scroll";
                    var divElement = document.createElement("div");
                    divElement.id = "vpw-test-d";
                    divElement.style.cssText = "position:absolute;top:-1000px";
                    // Getting specific on the CSS selector so it won't get overridden easily
                    divElement.innerHTML = "<style>@media(" + name + ":" + documentElement["client" + Name] + "px){body#vpw-test-b div#vpw-test-d{" + name + ":7px!important}}</style>";
                    bodyElement.appendChild(divElement);
                    documentElement.insertBefore(bodyElement, document.head);

                    if (String(divElement["offset" + Name]) === '7') {
                        // Media query matches document.documentElement["client" + Name]
                        getSize = getDocumentSize;
                    }
                    else {
                        // Media query didn't match, use window["inner" + Name]
                        getSize = getWindowSize;
                    }
                    // Cleanup
                    documentElement.removeChild(bodyElement);
                }
                else {
                    // Default to use window["inner" + Name]
                    getSize = getWindowSize;
                }
            }

            return getSize(Name);
        };

    return {
        getHeight: function () {
            return getViewportSize("Height");
        },

        getWidth: function () {
            return getViewportSize("Width");
        }
    };
}]);