function HostsController($scope, $http) {
	
	$scope.templates = [ 
		{ name: 'createForm', url: 'partials/_create.php'},
      	{ name: 'editForm', url: 'partials/_edit.php'} 
  	];

    $scope.template = $scope.templates[0];

	$http.get('/hosts').success(function(hosts) {
		$scope.hosts = hosts;
		$scope.processedHost = {};
	});

	$scope.addHost = function() {

		var host = {
			id: $scope.hosts.length + 1,
			ipaddress: $scope.processedHost.ipaddress,
			subnet: $scope.processedHost.subnet,
			description: $scope.processedHost.desc,
			enabled: $scope.processedHost.enabled
		}

		$http.post('/hosts', host)
			.error(function(response) {

				$scope.errors = response;
			
			})
			.success(function(response){

				$scope.errors = null;
				$scope.hosts.unshift(host);
				
			});	
	};

	$scope.showEditForm = function(host) {

		$scope.template = $scope.templates[1];

		$scope.processedHost = host;

	};


	$scope.updateHost = function() {

		console.log('posted');

	};

	$scope.cancelEdit = function() {

		$scope.template = $scope.templates[0];

		$scope.processedHost = {};
	};	


	$scope.update = function(host) {

		var hostID = host.id;

		$http({method: 'PATCH', url: '/hosts/' + hostID + '/update'})
			.success(function(response) {
			
				$scope.hosts[$scope.hosts.length - hostID] = response;
				
			});
	};

}