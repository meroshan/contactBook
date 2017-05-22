$(document).ready(function() {
	$('.edit').click(function(e) {
		e.preventDefault();
		jQuery.ajax({
			type: 'POST',
			url: $(this).attr('href'),
			success: function(data) {
				bootbox.dialog({
					message: data,
						success: {
							className: "btn-success"
						}

				});
			}
		});
	});
});

