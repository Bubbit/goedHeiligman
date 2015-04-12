angular.module('goedheiligmanApp').directive('agenda', function() {
   return {
       restrict: 'EA',
       template: '<p>' +
                    '<div ng-repeat="data in agendaData">' +
                        '<h1>{{data[0].date}}</h1>' +
                        '<div class="event" ng-repeat="event in data">' +
                            '<span class="event_time">{{event.tijd}}</span><span class="event_place">{{event.plaats}}</span>' +
                        '</div>' +
                    '</div>' +
                  '</p>',
       link: function(scope) {
//           function initialize() {
//               var mapCanvas = document.getElementById('map_canvas');
//               var map = new google.maps.Map(mapCanvas);
//           }
//
//           initialize();
           scope.formatDateNL = function(date) {

           }
       },
       controller: 'agendaCtrl'
   }
});

angular.module('goedheiligmanApp').controller('agendaCtrl', function($scope, $http) {
    $scope.rawData = {};
//    $scope.promise = $http.get("ajax/agenda.php");
//
//    $scope.promise.then(function(agenda) {
//       $scope.rawData = agenda.data;
//    });

    $scope.rawData = [{"0":"1","1":"11:00","2":"2014-11-15","3":"Winkelcentrum het Paradijs Hoofddorp","4":"","id":"1","tijd":"11:00","date":"2014-11-15","plaats":"Winkelcentrum het Paradijs Hoofddorp","extra":""},{"0":"7","1":"13:30","2":"2014-11-15","3":"Sierplein Amsterdam","4":"","id":"7","tijd":"13:30","date":"2014-11-15","plaats":"Sierplein Amsterdam","extra":""},{"0":"8","1":"16:00","2":"2014-11-15","3":"Intocht Zwaanshoek","4":"","id":"8","tijd":"16:00","date":"2014-11-15","plaats":"Intocht Zwaanshoek","extra":""},{"0":"2","1":"13:00","2":"2014-11-16","3":"Intocht Haarlem Centrum","4":"","id":"2","tijd":"13:00","date":"2014-11-16","plaats":"Intocht Haarlem Centrum","extra":""},{"0":"10","1":"13:15","2":"2014-11-22","3":"Winkelcentrum Symphonie Nieuw-Vennep","4":"","id":"10","tijd":"13:15","date":"2014-11-22","plaats":"Winkelcentrum Symphonie Nieuw-Vennep","extra":""},{"0":"11","1":"14:45","2":"2014-11-22","3":"Winkelcentrum Getsewoud Nieuw-Vennep","4":"","id":"11","tijd":"14:45","date":"2014-11-22","plaats":"Winkelcentrum Getsewoud Nieuw-Vennep","extra":""},{"0":"12","1":"16:30","2":"2014-11-22","3":"Jan van Goyenstraat Heemstede","4":"","id":"12","tijd":"16:30","date":"2014-11-22","plaats":"Jan van Goyenstraat Heemstede","extra":""},{"0":"18","1":"11:00","2":"2014-11-22","3":"Winkelstraat Ophelialaan te Aalsmeer","4":"","id":"18","tijd":"11:00","date":"2014-11-22","plaats":"Winkelstraat Ophelialaan te Aalsmeer","extra":""},{"0":"4","1":"11:00","2":"2014-11-23","3":"UWV (besloten)","4":"","id":"4","tijd":"11:00","date":"2014-11-23","plaats":"UWV (besloten)","extra":""},{"0":"13","1":"13:30","2":"2014-11-23","3":"Belastingdienst Amsterdam (besloten)","4":"","id":"13","tijd":"13:30","date":"2014-11-23","plaats":"Belastingdienst Amsterdam (besloten)","extra":""},{"0":"14","1":"16:00","2":"2014-11-23","3":"O.G. (besloten)","4":"","id":"14","tijd":"16:00","date":"2014-11-23","plaats":"O.G. (besloten)","extra":""},{"0":"5","1":"10:30","2":"2014-11-29","3":"Transavia Schiphol (besloten)","4":"Paspoort of ID-kaart meenemen","id":"5","tijd":"10:30","date":"2014-11-29","plaats":"Transavia Schiphol (besloten)","extra":"Paspoort of ID-kaart meenemen"},{"0":"15","1":"13:00","2":"2014-11-29","3":"Winkelcentrum Kerkelanden Hilversum","4":"","id":"15","tijd":"13:00","date":"2014-11-29","plaats":"Winkelcentrum Kerkelanden Hilversum","extra":""},{"0":"16","1":"15:45","2":"2014-11-29","3":"Heineken Amsterdam (besloten)","4":"","id":"16","tijd":"15:45","date":"2014-11-29","plaats":"Heineken Amsterdam (besloten)","extra":""},{"0":"6","1":"11:00","2":"2014-11-30","3":"Sinterklaasbrunch Hotel Haarlem-Zuid","4":"","id":"6","tijd":"11:00","date":"2014-11-30","plaats":"Sinterklaasbrunch Hotel Haarlem-Zuid","extra":""},{"0":"17","1":"14:00","2":"2014-11-30","3":"Ondernemersvereniging Houtzuid","4":"","id":"17","tijd":"14:00","date":"2014-11-30","plaats":"Ondernemersvereniging Houtzuid","extra":""}];

    $scope.agendaData = {};
    for(event in $scope.rawData) {
        var date = $scope.rawData[event].date;

        if(!$scope.agendaData[date]) {
            $scope.agendaData[date] = [$scope.rawData[event]];
        } else {
            $scope.agendaData[date].push($scope.rawData[event]);
        }

    }

    console.log($scope.agendaData);
});