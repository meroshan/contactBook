$(document).ready(function() {
	$('.delete').click( function(e) {
		e.preventDefault();
		$delete_url = $( this ).data( "href" );
		bootbox.confirm("Are you sure to delete?", function(okay) {
			if (okay) {
				window.location = $delete_url;
			}
		});
		return false;
	});
});

