function HostsController($scope, $http) {

	$http.get('/hosts').success(function(hosts) {
		$scope.hosts = hosts;
	});

	$scope.addHost = function() {
		
		var host = {
			id: $scope.hosts.length + 1,
			ipaddress: $scope.ipaddress,
			subnet: $scope.subnet,
			description: $scope.desc,
			enabled: $scope.enabled
		};

		$http.post('/hosts', host)
			.error(function(response) {

				$scope.errors = response;
			
			})
			.success(function(response){

				$scope.errors = null;
				$scope.hosts.unshift(host);
				
			});	
	};

	$scope.update = function(host) {

		var hostID = host.id;

		$http({method: 'PATCH', url: '/hosts/' + hostID + '/update'})
			.success(function(response) {
				
				$scope.hosts[$scope.hosts.length - hostID] = response;
				
			});
	};

	// invertStatus = function(hostID) {
	// 	return $scope.hosts[$scope.hosts.length - hostID].enabled ? false : true;
	// };

}