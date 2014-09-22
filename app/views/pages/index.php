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
					<a class="option-link" ng-click="update(host)">Disable</a>
				</li>

				<li class="options-item" ng-if="! host.enabled">
					<a class="option-link" ng-click="update(host)">Enable</a>
				</li>

				<li class="options-item" >
					<a class="option-link" ng-click="edit(host)">Edit</a>
				</li>

				<li class="options-item">
					<a href="delete">Delete</a>
				</li>
			</ul>
		</li>
	</ul>
</div>

<div class="col-md-6">

	<h2 class="section-title">Add new Host</h2>

	<form ng-submit="addHost()">
		<div class="form-group">
			<label for="ipaddress">IP Address:</label>
			<input type="text" id="ipaddress" class="form-control" ng-model="processedHost.ipaddress">
			<div class="error">{{ errors.ipaddress[0] }}</div><!-- end error -->
		</div><!-- end form-group -->

		<div class="form-group">
			<label for="subnet">Subnet:</label>
			<input type="text" id="subnet" class="form-control" ng-model="processedHost.subnet">
			<div class="error">{{ errors.subnet[0] }}</div><!-- end error -->
		</div><!-- end form-group -->

		<div class="form-group">
			<label for="desc">Description:</label>
			<textarea name="desc" class="form-control" ng-model="processedHost.desc"></textarea>
			<div class="error">{{ errors.description[0] }}</div><!-- end error -->
		</div><!-- end form-group -->

		<div class="form-group">
			<label for="enabled">Enabled:</label>
			<input type="checkbox" id="enabled" ng-model="processedHost.enabled">
		</div><!-- end form-group -->

		<div class="form-group">
			<input type="submit" class="btn btn-primary" value="Add Host">
		</div><!-- end form-group -->
	</form>

	{{ edit }}

</div>

</div><!-- end container -->

<script type="text/javascript" src="/js/angular.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
</body>
</html>