angular.module('loginApp', []);

angular.module('loginApp').directive('login', ['loginService', function(loginService) {
    return {
        restrict:'EA',
        template:
            '<div class="overlay" ng-class="{active: loginService.loginState.open}">' +
                '<div class="backdrop" ng-click="loginService.loginToggle()">' +
                '</div>' +
                '<div class="login">' +
                    '<header>' +
                        '<h1>Login</h1>' +
                    '</header>' +
                    '<form method="post" action="ajax/login_check.php">' +
                        '<div class="login-block">' +
                            '<label for="account">Account</label>' +
                            '<input id="account" name="account" type="text" placeholder="Account" ng-model="credentials.username">' +
                        '</div>' +
                        '<div class="login-block">' +
                            '<label for="password">Password</label>' +
                            '<input id="password" name="password" type="password" placeholder="Password" ng-model="credentials.password">' +
                        '</div>' +
                        '<button type="submit">Login</button>' +
                    '</form>' +
                '</div>' +
            '</div>',
        scope: true,
        controller: 'loginCtrl',
        link: function(scope) {
            scope.loginService = loginService;
        }
    }
}]);

angular.module('loginApp').service('loginService', function() {
    loginState = {
        open: false,
        loggedIn: false
    };

    return {
        loginToggle: function() {
            loginState.open = !loginState.open;
            console.log(loginState.open);
        },
        loginState: loginState
    }
});

angular.module('loginApp').controller('loginCtrl', ['$scope', '$rootScope', 'AUTH_EVENTS', 'AuthService', function ($scope, $rootScope, AUTH_EVENTS, AuthService) {
    $scope.credentials = {
        username: '',
        password: ''
    };
    $scope.login = function (credentials) {
        AuthService.login(credentials).then(function (user) {
            $rootScope.$broadcast(AUTH_EVENTS.loginSuccess);
            $scope.setCurrentUser(user);
        }, function () {
            $rootScope.$broadcast(AUTH_EVENTS.loginFailed);
        });
    };
}]);

angular.module('loginApp').constant('AUTH_EVENTS', {
    loginSuccess: 'auth-login-success',
    loginFailed: 'auth-login-failed',
    logoutSuccess: 'auth-logout-success',
    sessionTimeout: 'auth-session-timeout',
    notAuthenticated: 'auth-not-authenticated',
    notAuthorized: 'auth-not-authorized'
});

angular.module('loginApp').constant('USER_ROLES', {
    all: '*',
    admin: 'admin',
    editor: 'editor',
    guest: 'guest'
});

angular.module('loginApp').factory('AuthService', function ($http, Session) {
    var authService = {};

    authService.login = function (credentials) {
        return $http
            .post('ajax/login.php', credentials)
            .then(function (res) {
                Session.create(res.data.id, res.data.user.id,
                    res.data.user.role);
                return res.data.user;
            });
    };

    authService.isAuthenticated = function () {
        return !!Session.userId;
    };

    authService.isAuthorized = function (authorizedRoles) {
        if (!angular.isArray(authorizedRoles)) {
            authorizedRoles = [authorizedRoles];
        }
        return (authService.isAuthenticated() &&
            authorizedRoles.indexOf(Session.userRole) !== -1);
    };

    return authService;
});

angular.module('loginApp').service('Session', function () {
    this.create = function (sessionId, userId, userRole) {
        this.id = sessionId;
        this.userId = userId;
        this.userRole = userRole;
    };
    this.destroy = function () {
        this.id = null;
        this.userId = null;
        this.userRole = null;
    };
    return this;
});



