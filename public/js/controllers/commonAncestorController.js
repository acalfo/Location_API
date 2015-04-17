angular.module('challengeApp')
	.controller('commonAncestorController', ['$scope', '$location', 'LocationService', 'Locations', 'ValidatorService', 'HierarchyService', 'locId',
		function($scope, $location, LocationService, Locations, ValidatorService, HierarchyService, locId) {
			var validatedObj = ValidatorService.getValidLocation(Locations);
			$scope.error = validatedObj.error;

			//If data != Array just ignore it.
			if(validatedObj.locations.constructor === Array) {
				$scope.locations = validatedObj.locations;
			}

			$scope.children = [];
			angular.forEach($scope.locations, function($child, $index) {
				if($child.location_id == locId) {
					$scope.commonLocation = $child;
					$scope.children[0] = $child;
				}
			});

			$scope.back = function() {
				//route to view location
				$location.path('/show/ancestors/'+locId);
			};

			$scope.getCommonAncestor = function(commonLoc) {
				$scope.children[1] = commonLoc;
				LocationService.getCommonAncestor(locId, commonLoc.location_id)
					.then(function(success) {
						$scope.commonAncestor = success.ancestor;
					}
				);
			};
		}
	]
);