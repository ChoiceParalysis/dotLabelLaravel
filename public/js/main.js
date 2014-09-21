$(document).ready(function() {

	function postLink() {
		$('.post-link').on('click', function(e) {

			$hostId = $(this).parent().data('hostid');

			$.ajax({
		    	type: "POST",
				url: 'hosts/' + $hostId + '/change-state',
				success: function(data) {
					console.log(data);
				}
		  	});

		e.preventDefault();
		});
	}

	postLink();
});