angular.module('challengeApp')
	.service('HierarchyService', ['ValidatorService',
		function(ValidatorService) {

			var config =  {
				1	:	"country_name",
				2	:	"state_name",
				3	:	"city_name",
				4	:	"street_name",
				5	:	"street_number",
				6	:	"room_number"
			};


			this.setLevel = function setLevel(location) {
				location.level = this.getLevel(location);
			};

			//Validate GET single loc
			this.getLevel = function getLevel(location) {
				var current_level = 6;

				while(current_level > 0) {
					var current_field = config[current_level];

					if(!ValidatorService.isFalsy(location[current_field])) {
						return current_level;
					}

					current_level--;
				}
				return 0;
			};

			return this;
		}
	]
);