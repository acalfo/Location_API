angular.module('challengeApp')
	.service('LocationService', ['$http',
		function($http) {
			//Set Location API url
			var urlBase = 'api/v1/location';

			//Get All user Locations
			this.getLocations = function getLocations() {
				return $http.get(urlBase)
					.then(processResponse());
			};

			//Get a single location
			//param: {integer} location_id
			this.getLocation = function getLocation(location_id) {
				return $http.get(urlBase + '/' + location_id)
					.then(processResponse());
			};

			//Get a location & and all its ancestors
			//param: {integer} location_id
			this.getAllAncestors = function getAllAncestors(location_id) {
				var data = {
					ancestor : "all"
				};
				return $http.get(urlBase + '/' + location_id, {params:{"ancestor": "all"}})
					.then(processResponse());
			};

			//Get the Closest Common Ancestor between 2 locations
			//param: {integer} location_id
			this.getCommonAncestor = function getAllAncestors(location_id, parent_id) {
				return $http.get(urlBase + '/' + location_id, {params:{"ancestor": "common", "id": parent_id}})
					.then(processResponse());
			};

			//Create a Location
			//param: {obj} location  -> Location Object
			this.createLocation = function createLocation(location) {
				return $http.post(urlBase, stripNullValues(location))
					.then(processResponse());
			};

			//Update a Location
			//param: {obj} location  -> Location Object
			this.updateLocation = function updateLocation(location) {
				return $http.put(urlBase + '/' + location.location_id, location)
					.then(processResponse());
			};

			//Delete a Location
			//param: {integer} location_id  
			this.deleteLocation = function deleteLocation(location_id) {
				return $http.delete(urlBase + '/' + location_id)
					.then(processResponse());
			};

			this.getCoordinates = function getCoordinates(address) {
				return $http.get('http://maps.google.com/maps/api/geocode/json?address='+address+'&sensor=false');
			};

			var processResponse = function() {
				return function(response) {
					if(response.data) {
						if(response.data) {
							return response.data.data;
						}
					}
					return false;
				};
			};

			var stripNullValues = function(location) {
				if(typeof location === 'object') {
					Object.keys(location).forEach(function(child, index) {
						if(child === null || child === undefined || child === false) {
							delete location[child];
						}
					});
				}
				return location;
			};


			return this;
		}
	]
);