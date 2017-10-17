$(function() {
	
	//Manage AJAX for modal display with Forgotten Password feature
	function modalOpening() {
		var modal_body = $('#login_forgotten-pass-modal-body'),
			form = $('#login_forgotten-pass-modal-form');

		//when clicking on the Forgotten Password link
		$('#login_forgotten-link').on('click', function(e){
			
			//just load the reset request form into the modal body
			modal_body.load($(e.target).data('action'), function() {
				
				//add a submit event to the modal form that was just loaded inside the body
				form.on('submit', function(e){
					e.preventDefault();

					//we change the submit button to loading state
					$('#login_forgotten-pass-modal-button').button('loading');
					$('#login_forgotten-pass-modal-button>span:first-child').addClass('btn-loading');

					var data = new FormData($(e.target));

					//AJAX call using POST
					$.post( $(e.target).attr('action'), data, function( response ) {
					  	modal_body.html( response );
					});
				});
			});
		});
	}







	modalOpening();
});
