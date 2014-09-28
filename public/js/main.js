/**
 * Declaring the AngularJS app 
 */
var app = angular.module("app", [])


/**
 * Relative address to the API
 * @type string
 */
var apiUrl = 'api/v1';


/**
 * HostsController to handle the functionality of the app
 * @param $scope Applies changes to the view
 * @param $http service communicates with the server
 */
app.controller('HostsController', function($scope, $http)
{
	/**
	 * Function used for pagination
	 * @param  { int } limit 
	 * @return { array }
	 */
	$scope.range = function(limit)
	{
		return new Array(limit);
	}

	/**
	 * Current page number
	 * @type { int }
	 */
	$scope.page = 1;

	/**
	 * Load the page contents
	 */
	$scope.loadPage = function(pageNumber)
	{

		pageNumber = pageNumber ? pageNumber : $scope.page;

		/**
	     * Load hosts array using the API
	     * @param  json Response from the server		
	     */
		$http.get(apiUrl + '/hosts?page=' + pageNumber)

		.success(function(response)
		{
			$scope.data = response;
			$scope.hosts = response.data;

			$scope.formValues = {};
		});
	};

	/**
	 * Load previous page
	 */
	$scope.nextPage = function()
	{
		if ($scope.page< $scope.data.last_page)
		{
			$scope.page++;
			$scope.loadPage();
		}
	};

	/**
	 * Load next page
	 */
	$scope.prevPage = function()
	{
		if ($scope.page > 1)
		{
			$scope.page--;
			$scope.loadPage();
		}
	};

	/**
	 * Declaring available forms to use in the app
	 * @type { array }
	 */
	$scope.forms = [ 
		{ name: 'createForm', url: 'partials/_create.php'},
      	{ name: 'editForm', url: 'partials/_edit.php'} 
  	];

  	/**
  	 * Declaring default form to show after page loads
  	 */
    $scope.form = $scope.forms[0];

    /**
     * Declaring the hosts list template
     * @type { object }
     */
  	$scope.listings = {
  		name: '_listings', url: 'partials/_listings.php'
  	};

  	/**
  	 * Initial page load
  	 */
    $scope.loadPage();


	/**
	 * Add a new host to the system
	 */
	$scope.addHost = function() 
	{
		/**
		 * Post form's values to the API
		 */
		$http.post(apiUrl + '/hosts', $scope.formValues)

			.success(function()
			{
				$scope.loadPage();	
				$scope.resetForm();
			})

			.error(function(response) 
			{
				$scope.errors = response.errors;	
			});
	};


	/**
	 * Show edit form and fill it with host's values
	 * @param { array } host 
	 */
	$scope.showEditForm = function(host) 
	{
		$scope.form = $scope.forms[1]; // Change the form currently being displayed to 'Edit a host' form

		/**
		 * Creates a 'deep' copy of provided host, to avoid 
		 * changing the supplied object before submitting the form
		 * (because of the two way data-binding)
		 */
		$scope.formValues = angular.copy(host); 
	};


	/**
	 * Update host's status
	 * @param { object } host
	 */
	$scope.updateStatus = function(host) 
	{
		/**
		 * Create a deep copy of provided host object
		 * @type object
		 */
		var update = angular.copy(host);

		/**
		 * Flip the 'enabled' value for the copy of host
		 */
		update.enabled = update.enabled ? false : true;

		$scope.updateHost(update);
	};


	/**
	 * Post the updated values to the API
	 * @param  { object } host   Object containing new values of host object
	 */
	$scope.updateHost = function(host) 
	{
		/**
		 * If no host object was provided as a parameter, create a new host object
		 * with the current form values
		 * 
		 * @type { object }
		 */
		host = typeof host !== 'undefined' ? host : $scope.formValues;

		/**
		 * Make an HTTP patch request to the API
		 */
		$http({
			url: apiUrl + '/hosts/' + host.id,
			data: host,
			method: "PATCH"
		})

		.success(function(response) {
			$scope.loadPage();
			$scope.resetForm();
		})

		.error(function(response){
			$scope.errors = response.errors;
		});
	};


	/**
	 * Delete a host from the hosts array
	 * @param  { object }  host 
	 */
	$scope.deleteHost = function(host) 
	{
		/**
		 * Find the possition of the host being deleted in hosts array
		 * @type { int }
		 */
		var index = $scope.hosts.indexOf(host);

		/**
		 * Send a Delete HTTP request to the API
		 */
		$http.delete('/api/v1/hosts/' + host.id)
		
			.success(function() 
			{	
				$scope.loadPage();
			})

			.error(function(response)
			{
				$scope.errors = response.errors;
			});
	};


	/**
	 * Reset the form displayed in the view
	 */
	$scope.resetForm = function()
	 {
		$scope.form = $scope.forms[0]; // Change the form to 'Create a host' form
		$scope.errors = {}; // Reset the errors
		$scope.formValues = {};	// Reset the form's values
	};	

});

