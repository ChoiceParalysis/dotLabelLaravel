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

		var host = {
			id: $scope.processedHost.id,
			ipaddress: $scope.processedHost.ipaddress,
			subnet: $scope.processedHost.subnet,
			description: $scope.processedHost.description,
			enabled: $scope.processedHost.enabled
		};

		$http.post('/hosts/' + host.id + '/update', host)
			.success(function(response) {
				console.log(response);
			});

		$scope.resetForm();
	};

	$scope.resetForm = function() {

		$scope.template = $scope.templates[0];

		$scope.processedHost = {};
	};	


	$scope.updateStatus = function(host) {

		host.enabled = host.enabled ? false : true;

		var hostID = host.id;

		$http.post('/hosts/' + hostID + '/update', host)
			.success(function(response) {
			
				$scope.hosts[$scope.hosts.length - hostID] = response;
				
			});
	};

}