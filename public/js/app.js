// Declare app level module 
angular.module('challengeApp', [
    'ngRoute'
], function($interpolateProvider) {
      $interpolateProvider.startSymbol('[{[');
      $interpolateProvider.endSymbol(']}]');
})


.config(function($routeProvider) {
    $routeProvider.when('/', {
      templateUrl : 'views/locationList.html',
      controller: 'locationListController',
      resolve: {
        Locations: function(LocationService){
            return LocationService.getLocations();
        }
      }
    });

    $routeProvider.when('/show/:locationId', {
      templateUrl : 'views/location.html',
      controller: 'locationController',
      resolve: {
        Location: function(LocationService, $route){
            return LocationService.getLocation($route.current.params.locationId);
        }
      }
    });

    $routeProvider.when('/show/ancestors/:locationId', {
      templateUrl : 'views/ancestors.html',
      controller: 'ancestorController',
      resolve: {
        Ancestors: function(LocationService, $route){
          
            return LocationService.getAllAncestors($route.current.params.locationId);
        }
      }
    });

    $routeProvider.when('/show/ancestors/common/:locationId', {
      templateUrl : 'views/commonAncestor.html',
      controller: 'commonAncestorController',
      resolve: {
        Locations: function(LocationService){
            return LocationService.getLocations();
        },
        locId: function($route){
          return $route.current.params.locationId;
        }
      }
    });

    $routeProvider.otherwise({
      redirectTo: '/'
    });
 });
