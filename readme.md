Install Steps:

In Root of project directory:
1) Git Pull
2) Composer Install
3) Bower Install

Now Set up Database in app->config-> database.php w/ your local database info

Migration/Seeding:
Migration & seeds should be ready to go, just run:

php artisan migrate
php artisan db:seed

If Migration throws an error run this command
php artisan migrate:make create_users --create --table=user
php artisan migrate:make create_locations --create --table=location

Then replace those newly created files in app->database->migrations w/ the ones provided.
Then rerun migration/seeding commands

APPS:
LARAVEL APP =  app folder
ANGULARJS APP = public folder

AUTH:
use the following authentication information
username: firstuser
password: first_password


API DOCUMENTATION
All APIS expect & return JSON

DATA FIELDS. Can UPDATE or CREATE any of these fields
data: {
	country_name,
	state_name,
	city_name,
	street_name,
	street_number,
	room_number	
}

RETURN FORMAT
data {
	locations : "",
	location : "",
	ancestors : "",
	ancestor : "",
}

IF ERROR OCCURS or on DELETE:
data {
	error : true if error occurred
	message : error_message (or success msg for DELETE)
}

******METHODS*****

API ROOT
	/api/v1/location

GET ALL
		url : /api/v1/location
		method: GET

		--doesnt expect data

		RETURNS data.locations

GET ONE (SHOW)
		url : /api/v1/location/{location_id}
		method: GET

		--doesnt expect data

		RETURNS data.location

GET ALL ANCESTORS 
		url : /api/v1/location/{location_id}
		method: GET
		params: 
			1:  "ancestor" = "all"

		--doesnt expect data

		RETURNS data.ancestors & data.location

GET COMMON ANCESTOR
		url : /api/v1/location/{location_id}
			method: GET
			params: 
				1:  "ancestor" = "all"
				2: "id" = location2_id

			param.2 = the 2nd location to find the common ancestor for
			--doesnt expect data

		RETURNS data.ancestor & data.location
CREATE
		url : /api/v1/location
		method: POST
		data : data

		RETURNS data.locatioin

UPDATE
		url : /api/v1/location/{location_id}
		method: PUT,
		data : data

		RETURNS data.location

DELETE url : /api/v1/locations/{location_id},
			method : DELETE

			returns error data object 

TESTING 
	Already pretty late on the project (FRIDAY) and havn't had a chance to do unit testing.
	Planning on turning in like this and do testing over weekend if needed

	TESTING W/ CURL EXAMPLE:
	CREATE
		curl -i --user firstuser:first_password -d 'state_name=1' -d 'city_name=San Francisco'  -d 'country_name=1' -d 'street_ name=Hello World Lane' localhost:8888/challenge_api/public/index.php/api/v1/location

	READ
		curl -i --user firstuser:first_password localhost:8888/challenge_api/public/index.php/api/v1/location/{{loc_id}}

	DELETE
		curl -i -X DELETE --user firstuser:first_password localhost:8888/challenge_api/public/index.php/api/v1/location/39



