function HostsController($scope, $http) {

	$http.get('/hosts').success(function(hosts) {
		$scope.hosts = hosts;
	});

	$scope.addHost = function() {
		
		var host = {
			ipaddress: $scope.ipaddress,
			subnet: $scope.subnet,
			description: $scope.desc,
			enabled: $scope.enabled
		};

		$http.post('/hosts', host)
			.error(function(response) {
				console.log(response);
				$scope.errors = response;
			})
			.success(function(response){
				$scope.errors = null;
				$scope.hosts.unshift(host);
			});	

			
	};

}