<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<meta charset="UTF-8">
	<!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'> -->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<title>Authorised Hosts Administration app</title>
</head>
<body ng-controller="HostsController">
<div class="container">

<div class="col-md-6">

	<div class="overflow-fix">
		<h2 class="section-title hosts">Allowed Hosts</h2>

		<input type="text" id="search" class="form-control" placeholder="Filter hosts" ng-model="search">
	</div>
	<!-- <div style="clear: both";></div> -->

	<ul class="list-group">
		<li  class="list-group-item" ng-repeat="host in hosts | filter:search" data-enabled="{{ host.enabled }}">
			{{ host.ipaddress }} / {{ host.subnet }}
			
			<ul class="options">
				<li class="options-item" ng-if="host.enabled">
					<a class="option-link" ng-click="updateStatus(host)">Disable</a>
				</li>

				<li class="options-item" ng-if="! host.enabled">
					<a class="option-link" ng-click="updateStatus(host)">Enable</a>
				</li>

				<li class="options-item" >
					<a class="option-link" ng-click="showEditForm(host)">Edit</a>
				</li>

				<li class="options-item">
					<a class="option-link" ng-click="deleteHost(host)">Delete</a>
				</li>
			</ul>
		</li>
	</ul>
</div>

<div class="col-md-6">

	<div ng-include="template.url"></div>

</div>

</div><!-- end container -->

<script type="text/javascript" src="/js/angular.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
</body>
</html>