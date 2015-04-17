<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Challenge API</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="container" ng-app="challengeApp">
	      	<div class="header">
	      		<h1>
	      			My Locations
	      		</h1>
	      	</div>

			<div ng-view class="ang-app"></div>

			<div class="footer" style="margin-top:20px;">
		    	<p><span class="glyphicon glyphicon-heart"></span> by Alex Calfo</p>
		    </div>
	</div>
	<script src="js/components/angular/angular.min.js"></script>
	<script src="js/components/angular-route/angular-route.min.js"></script>
	<script src="js/app.js"></script>
	<script src="js/services/LocationService.js"></script>
	<script src="js/services/ValidatorService.js"></script>
	<script src="js/services/HierarchyService.js"></script>
	<script src="js/services/MapService.js"></script>
	<script src="js/controllers/locationController.js"></script>
	<script src="js/controllers/locationListController.js"></script>
	<script src="js/controllers/ancestorController.js"></script>
	<script src="js/controllers/commonAncestorController.js"></script>
</body>
</html>
