$(function() {

	// Get the form.
	var form = $('#contact-form');

	// Get the messages div.
    const message_container = $("#form_reponse_container");

	// Set up an event listener for the contact form.
	$(form).submit(function(e) {
		// Stop the browser from submitting the form.
		e.preventDefault();
        $(message_container).addClass('d-none');

		// Serialize the form data.
		var formData = $(form).serialize();

        form.find("button").attr("disabled" , true);

		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData
		})
		.done(function(response) {
			// Make sure that the message_container div has the 'success' class.
			$(message_container).removeClass('d-none');
			$(message_container).removeClass('alert-danger');
			$(message_container).addClass('alert-success');

			// Set the message text.
			$(message_container).text(response.message);

			// Clear the form.
			$('#contact-form input,#contact-form textarea').val('');
            form.find("button").removeAttr("disabled");
		})
		.fail(function(data) {
			// Make sure that the message_container div has the 'error' class.
			$(message_container).removeClass('d-none');
			$(message_container).removeClass('alert-success');
			$(message_container).addClass('alert-danger');
			// Set the message text.
			if (data.responseText !== '') {
                let errorResponse = JSON.parse(data.responseText);
				$(message_container).text(errorResponse.message);
			} else {
				$(message_container).text('Oops! An error occured and your message could not be sent.');
			}
            form.find("button").removeAttr("disabled");
		});
	});

});
