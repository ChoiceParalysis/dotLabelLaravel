<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="UTF-8">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<title>dotLabel Authorised Hosts app</title>
</head>
<body ng-controller="HostsController">
<div class="container">

	<div class="col-md-6">

		<div ng-include="listings.url"></div>

	</div><!-- end col-md-6 -->

	<div class="col-md-6">

		<div ng-include="form.url"></div>

	</div><!-- end col-md-6 -->

	<div class="alert" role="alert"></div>

</div><!-- end container -->


<script type="text/javascript" src="/js/angular.min.js"></script>
<script type="text/javascript" src="js/angular-route.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
</body>
</html>