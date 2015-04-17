angular.module('challengeApp')
	.service('MapService', ['$http', 'LocationService',
		function($http, LocationService) {
			//Set Location API url
			var urlBase = 'api/v1/location';

			var mapConfig =  {
				1	:	"country_name",
				2	:	"state_name",
				3	:	"city_name",
				4	:	"street_number",
				5	:	"street_name",
				6	:	"room_number"
			};

			this.buildMap = function(location) {
				var out = "";
				angular.forEach(mapConfig, function(child, index) {
					if(location[child]) {
						out = out + location[child] + " ";
					}
				});
				return out;
			};

			this.getMap = function(map) {
				return LocationService.getCoordinates(map)
					.then(processMapResponse());
			};

			this.getCoordinates = function(location) {
				var map = this.buildMap(location);
				return this.getMap(map)
					.then(function(response) {
						location.coordinates = {
							"lat" : response.geometry.location.lat,
							"lng" : response.geometry.location.lng
						};
					}, function(rejection) {
						location.coordinates = false;
					});
			};

			//Delete a Location
			//param: {integer} location_id  
			this.deleteLocation = function deleteLocation(location_id) {
				return $http.delete(urlBase + '/' + location_id)
					.then(processResponse());
			};

			var processMapResponse = function() {
				return function(response) {
					if(response) {
						if(response.data){
							response = response.data;
							if(response.results.constructor === Array) {
								return response.results[0];
							}
						}
					}
					return undefined;
				};
			};
			return this;
		}
	]
);