var app = angular.module("app", ['ngRoute'])

var api = 'api/v1';

app.config(function($routeProvider) 
{

	$routeProvider.when('/', {
		templateUrl: 'index.php',
		controller: 'HostsController'
	});

	$routeProvider.otherwise({ redirectTo: 'index.php'});

});

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

	sendHost = function(host, action) {

		$http.post('/api/v1/hosts', host)
			.error(function(response) {
				$scope.errors = response;
			})
			.success(function(response) {
				resetForm();

				if (action == 'create') {
					$scope.hosts.push(host);
				}
			});

	};

	$scope.addHost = function() {

		var host = {
			ipaddress: $scope.formValues.ipaddress,
			subnet: $scope.formValues.subnet,
			description: $scope.formValues.desc,
			enabled: $scope.formValues.enabled
		}

		$http.post('api/v1/hosts', host)
			.error(function(response) {

				$scope.error = response.error.errors;	
				console.log($scope.error.errors);		
			})
			.success(function(response){

				host = response.data;

				$scope.hosts.push(host);
				
			});	
	};


	$scope.showEditForm = function(host) {

		$scope.form = $scope.forms[1];

		$scope.formValues = host;

	};


	$scope.updateHost = function() {

		var host = {
			id: $scope.formValues.id,
			ipaddress: $scope.formValues.ipaddress,
			subnet: $scope.formValues.subnet,
			description: $scope.formValues.description,
			enabled: $scope.formValues.enabled
		};

		postUpdate(host);
	};


	$scope.updateStatus = function(host) {

		host.enabled = host.enabled ? false : true;

		postUpdate(host);
	};


	postUpdate = function(host) {

		var index = $scope.hosts.indexOf(host);

		$http.post('api/v1/hosts/' + host.id + '/update', host)
			.success(function() {
				$scope.resetForm();
			})
			.error(function(response) {
				$scope.errors = response.error.errors;
			});

	};


	$scope.deleteHost = function(host) {

		var index = $scope.hosts.indexOf(host);

		$http.delete('api/v1/hosts/' + host.id)
			.success(function() {
				$scope.hosts.splice(index, 1);
			});	

	};


	$scope.resetForm = function() {

		$scope.form = $scope.forms[0];
		$scope.errors = [];
		$scope.formValues = {};	

	};	
});

