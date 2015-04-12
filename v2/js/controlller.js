//Define an angular module for our app
var app = angular.module('myApp', []);

app.controller('tasksController', function($scope, $http) {
    getFacebookInfo(); // Load all available tasks
    function getFacebookInfo() {
        $http.get("ajax/facebook.php").success(function (data) {
            for (var i = 0; i < data.length; i++) {
                console.log(data[i]);
            }
            $http.get('https://graph.facebook.com/oauth/access_token? client_id=' + data['app_id'] + '&client_secret=' + data['app_secret'] + '&grant_type=client_credentials').success(function (data) {
                $scope.accessToken = data.split('=')[1];
                console.log($scope.accessToken);
            });
        });
    }
});