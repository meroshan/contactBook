$(document).ready(function() {
	$('.show').click(function(e) {
		e.preventDefault();
		jQuery.ajax({
			type: 'POST',
			url: $(this).attr('href'),
			success: function(data) {
				bootbox.dialog({
					message: data,
					buttons: {
						success: {
							label: "Close",
							className: "btn-success"
						}
					}
				});
			}
		});
	});
});

