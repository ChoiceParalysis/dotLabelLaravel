var app = angular.module("app", ['ngRoute'])

var api = 'api/v1';

// app.config(function($routeProvider) 
// {

// 	$routeProvider.when('/', {
// 		templateUrl: 'index.php',
// 		controller: 'HostsController'
// 	});

// 	$routeProvider.otherwise({ redirectTo: 'index.php'});

// });

app.controller('HostsController', function($scope, $http)
{
	$scope.forms = [ 
		{ name: 'createForm', url: 'partials/_create.php'},
      	{ name: 'editForm', url: 'partials/_edit.php'} 
  	];

    $scope.form = $scope.forms[0];

	$http.get('api/v1/hosts').success(function(response) {
		$scope.hosts = response.data;
		$scope.formValues = {};

	});


	$scope.addHost = function() {

		$http.post('api/v1/hosts', $scope.formValues)
			.error(function(response) {

				$scope.errors = response.errors;	
					
			})
			.success(function(response){

				host = response.data;
				$scope.hosts.unshift(host);

				$scope.resetForm();

			});	
	};


	$scope.showEditForm = function(host) {

		$scope.form = $scope.forms[1];

		angular.copy(host, $scope.formValues);

		//$scope.formValues = angular.host;

	};


	$scope.updateHost = function() 
	{
		postUpdate($scope.formValues);
	};


	$scope.updateStatus = function(host) 
	{
		host.enabled = host.enabled ? false : true;

		postUpdate(host);
	};


	postUpdate = function(host) 
	{
		var index = $scope.hosts.indexOf(host);

		$http.post('/api/v1/hosts/' + host.id + '/update', host)
			.success(function(response)
			{
				updateHostList(response.data);

				$scope.resetForm();
			})
			.error(function(response) 
			{
				$scope.errors = response.errors;
			});
	};


	$scope.deleteHost = function(host) {

		var index = $scope.hosts.indexOf(host);

		$http.delete('/api/v1/hosts/' + host.id)
			.success(function() 
			{
				$scope.hosts.splice(index, 1);
			});	

	};


	$scope.resetForm = function() {

		$scope.form = $scope.forms[0];
		$scope.errors = [];
		$scope.formValues = {};	

	};	


	updateHostList = function(update) 
	{
		for (var i = 0; i < $scope.hosts.length; i++)
		{
			if ($scope.hosts[i].id == update.id)
			{
				$scope.hosts[i] = update;
			}
		}
	};

});

