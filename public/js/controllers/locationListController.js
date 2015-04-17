angular.module('challengeApp')
	.controller('locationListController', ['$scope', '$location', 'LocationService', 'Locations', 'ValidatorService', 'HierarchyService',
		function($scope, $location, LocationService, Locations, ValidatorService, HierarchyService) {
			$scope.locations = {};
			$scope.inputLocation = {};

			var validatedObj = ValidatorService.getValidLocation(Locations);
			$scope.error = validatedObj.error;

			//If data != Array just ignore it.
			if(validatedObj.locations.constructor === Array) {
				$scope.locations = validatedObj.locations;
			}

			$scope.viewLocation = function(loc_id) {
				//route to view location
				$location.path('/show/'+loc_id);
			};

			$scope.createLocation = function(location) {
				//Set locations level in hierarchy.
				HierarchyService.setLevel(location);

				//Push entry right away!
				$scope.locations.push(location);
				var locIndex = $scope.locations.indexOf(location);
				
				LocationService.createLocation(location)
					.then(function(response) {
						//On Error Delete added entry & set error message
						if(response.error || response.error === undefined) {
							$scope.error = response.message || "An Error occurred while Inserting";
							$scope.locations = $scope.locations.splice(0, locIndex, 1);
						} else {
							//Set previously Pushed entry to real one from backend
							$scope.locations[locIndex] = response.location;
						}
						//Reset input vars
						$scope.inputLocation = {};
					}
				);
			};
		}
	]
);