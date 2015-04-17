angular.module('challengeApp')
	.controller('ancestorController', ['$scope', '$location', 'LocationService', 'Ancestors', 'ValidatorService', 'HierarchyService',
		function($scope, $location, LocationService, Ancestors, ValidatorService, HierarchyService) {
			$scope.ancestors = Ancestors.ancestors;
			$scope.location = Ancestors.location;
			//Get and Validate Resolved obj
			var validatedObj = ValidatorService.getValidLocation(Ancestors);
			$scope.error = validatedObj.message;

			$scope.back = function(loc_id) {
				//route to view location
				$location.path('/show/'+loc_id);
			};

			$scope.getCommonAncestor = function(commonLoc) {
				$location.path('/show/ancestors/common/'+$scope.location.location_id);
			};
		}
	]
);