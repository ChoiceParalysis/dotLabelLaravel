function HostsController($scope, $http) {
	
	$scope.forms = [ 
		{ name: 'createForm', url: 'partials/_create.php'},
      	{ name: 'editForm', url: 'partials/_edit.php'} 
  	];

  // 	$scope.options = [
		// { method: }
  // 	];

    $scope.form = $scope.forms[0];

	$http.get('/hosts').success(function(response) {
		$scope.hosts = response.data.reverse();
		$scope.formValues = {};

	});

	sendHost = function(host, action) {

		$http.post('/hosts', host)
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

		$http.post('/hosts', host)
			.error(function(response) {

				
			
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

		postToServer(host);
	};


	$scope.updateStatus = function(host) {

		host.enabled = host.enabled ? false : true;

		postToServer(host);
	};


	postToServer = function(host) {

		var index = $scope.hosts.indexOf(host);

		$http.post('/hosts/' + host.id + '/update', host)
			.success(function() {
				$scope.resetForm();
			})
			.error(function(response) {
				$scope.errors = response.error.errors;
			});

	};


	$scope.deleteHost = function(host) {

		var index = $scope.hosts.indexOf(host);

		$http.delete('/hosts/' + host.id)
			.success(function() {
				$scope.hosts.splice(index, 1);
			});	

	};


	$scope.resetForm = function() {

		$scope.form = $scope.forms[0];
		$scope.errors = [];
		$scope.formValues = {};	

	};	

}