angular.module('challengeApp')
	.controller('locationController', ['$scope', '$location', 'Location', 'LocationService', 'ValidatorService', 'HierarchyService', 'MapService',
		function($scope, $location, Location, LocationService, ValidatorService, HierarchyService, MapService) {
			
			//Get and Validate Resolved obj
			var validatedObj = ValidatorService.getValidLocation(Location);
			$scope.error = validatedObj.error;

			//Get location
			if(validatedObj.location) {
				$scope.location = validatedObj.location;
			}
			
			MapService.getCoordinates($scope.location);

			$scope.delete = function(location_id) {
				LocationService.deleteLocation(location_id).then(function(response) {
					if(response.error) {
						$scope.error = response.message || "An Error has Occured while deleting";
					} else {
						$location.path('/');
					}
				});
			};

			$scope.update = function(location) {
				HierarchyService.setLevel(location);
				LocationService.updateLocation(location).then(function(response) {
					if (response.error) {
						$scope.error = response.message || "An Error has Occurred while Updating";
					} else {
						$location.path('/');
					}
				});
			};

			/*
				Routing
			*/
			$scope.goHome = function() {
				//route home
				$location.path('/');
			};

			$scope.viewAncestors = function(loc_id) {
				//route to view location
				$location.path('/show/ancestors/'+loc_id);
			};
		}
	]
);