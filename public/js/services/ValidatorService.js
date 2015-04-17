angular.module('challengeApp')
	.service('ValidatorService', [
		function() {

			//Validate GET single loc
			this.getValidLocation = function getValidLocation(Location) {
				var out = {
					error : undefined
				};

				if (!Location) {
					out.error = "A fatal error has occurred";
				}
				else if(Location.error) {
					out.error = Location.message;
				} else if(Location.locations) {
					if(Location.locations.constructor === Array) {
						out.locations = Location.locations;
						out.error = undefined;
					}
				} else if(Location.location) {
					out.location = Location.location;
					out.error = undefined;
				} else {
					out.error = "An unknown error has occurred";
				}
				return out;
			};

			this.isFalsy = function isFalsy(value) {
				if(value !== null && value !== undefined && value !== "" && (value !== false || value === 0)) {
					return false;
				}
				return true;
			};

			return this;
		}
	]
);