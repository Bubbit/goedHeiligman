/**
 * @ngdoc service
 * @name facebookService
 *
 * @description
 * Facebook service.
 *
 */

var module = angular.module('facebookWallApp');

/**
 * @ngdoc directive
 * @name facebookWall
 * @restrict EA
 *
 * @description
 * Facebook wall directive, creates a feed and a comment box.
 *
 * @param {string} limit Limit of the feed
 *
 * @param {string} feed name of the facebook page
 *
 * @param {boolean} comments be able to comment, default is true
 *
 * @example
 *                  <facebookWall></facebook>
 */

module.directive('facebookWall', function() {
    return {
        restrict:'EA',
        template: '<div >' +
            'wat' +
            '</div>',
        scope: {
            limit: '=',
            feed: '=',
            comments: '@'
        },
        link: function(scope) {
        }
    }
});

module.directive('facebookWallPost', function() {
    return {
        restrict:'EA',
        template: '',
        scope: true,
        link: function(scope) {

        }
    }
});