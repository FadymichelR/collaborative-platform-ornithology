$(function() {
	
	//init google maps
	function initMap(param = null) {
		//default parameter if non given
		if (param == null) {
			param = {lat: 36.8451807, lng: 10.1031312};
		}
	  	
	  	//generate the map
	  	var map = new google.maps.Map(document.getElementById('gmaps_canvas'), {
	    	zoom: 8,
	    	center: param
	  	});
	  	
	  	//responsive map
	  	google.maps.event.trigger(map, "resize");
	  	
	  	//generate the marker at the right position
	  	var marker = new google.maps.Marker({
	    	position: param,
	    	map: map
	  	});
	}

	//manage the observation modal display
	function manageObservationModal() {
		var observations = $('#profile_block2-content .observation-row');

        observations.each(function(index, elmt) {
            $(elmt).on('click', function(e) {
            	e.preventDefault();

            	//get the observation data
            	var image = $(this).data('image') ? $(this).data('image') : null,
            		name = $(this).data('name'),
            		date = $(this).data('date'),
            		country = $(this).data('country'),
            		comment = $(this).data('comment') ? $(this).data('comment') : null,
            		lat = $(this).data('lattitude'),
            		lng = $(this).data('longitude');

            	//modal window elements
            	var modal = $('#profile_obs-modal'),
            		modal_left = modal.find('.profile_obs-modal-left-panel'),
            		modal_right = $('#gmaps_canvas'),
            		modal_comment = modal.find('.profile_obs-modal-comment-panel'),
            		ul = $('<ul></ul>'),
            		obsDiv = $(e.target);

            	//we reset everything in case the modal has been opened and is filled with content already
            	modal_left.html('');
            	modal_right.html('');
            	modal_comment.html('');

            	//add the image if there is one
            	if (image !== null) {
	            	$('<img src="'+image+'" alt="'+name+'" />').appendTo(modal_left);
	            }

	            //add the informations list
	            $('<li>'+name+'</li>').appendTo(ul);
	            $('<li>'+date+'</li>').appendTo(ul);
	            $('<li>'+country+'</li>').appendTo(ul);
	            ul.appendTo(modal_left);

	            //add the comment if there is one
            	if (comment !== null) {
	            	//<br> obligatoire, sinon le commentaire ne s'affiche pas
	            	$('<hr />'+comment+'<br />').appendTo(modal_comment);
	            }

				//initialise the map once the modal is fully loaded and visible after a click on an observation
				modal.on('shown.bs.modal', function () {
					if (typeof google === 'object' && typeof google.maps === 'object') {
					 	initMap( {lat: parseFloat(lng), lng: parseFloat(lat)} );
					}
				});
            });
        });
	}







	//"Changing email" modal management
	function emailModal() {
		//when clicking on the Edit icon
		$('#profile_email-link').on('click', function(e){
			var url_path = $(e.target).data('action');

			//just load the email edit form into the modal body
			$('#profile_email-modal-body').load(url_path, function() {
				
				//add a submit event to the modal form that was just loaded inside the body
				$('#profile_email-modal-body form').on('submit', function(e){
					e.preventDefault();

					//we change the submit button to loading state
					$('#profile_email-modal-button').button('loading');
					$('#profile_email-modal-button>span:first-child').addClass('btn-loading');

					//AJAX call using POST
					//we fetch the data using FormData and send it as it is
	                var formData = new FormData(e.target);
	                
	                //processData needs to be set to false to prevent jQuery from trying to convert it to string
	                //contentType needs to be set to false so jQuery doesn't add a Content-type header (otherwise boundary string will be missing)
	                $.ajax({
	                    type: 'POST',
	                    url: url_path,
	                    data: formData,
	                    processData: false,
	                    contentType: false
	                })
	                .done(function(data, textStatus, jqXHR) {
	                    //if there is an error with the form, it is added to data
	                    //as a div with class='alert alert-danger'
	                    if ( data.indexOf('alert alert-danger col-xs-12 form-error-custom') !== -1 )
	                    	$('#profile_email-modal-body').html(data);
	                   	else
	                   		location.reload(true);
	                });
				});
			});
		});
	}

	//"Changing password" modal management
	function passwordModal() {
		//when clicking on the Edit icon
		$('#profile_pass-link').on('click', function(e){
			var url_path = $(e.target).data('action');

			//just load the reset request form into the modal body
			$('#profile_pass-modal-body').load(url_path, function() {
				
				//add a submit event to the modal form that was just loaded inside the body
				$('#profile_pass-modal-body form').on('submit', function(e){
					e.preventDefault();

					//we change the submit button to loading state
					$('#profile_pass-modal-button').button('loading');
					$('#profile_pass-modal-button>span:first-child').addClass('btn-loading');

					//AJAX call using POST
					//we fetch the data using FormData and send it as it is
	                var formData = new FormData(e.target);
	                
	                //processData needs to be set to false to prevent jQuery from trying to convert it to string
	                //contentType needs to be set to false so jQuery doesn't add a Content-type header (otherwise boundary string will be missing)
	                $.ajax({
	                    type: 'POST',
	                    url: url_path,
	                    data: formData,
	                    processData: false,
	                    contentType: false
	                })
	                .done(function(data, textStatus, jqXHR) {
	                    //if there is an error with the form, it is added to data
	                    //as a div with class='alert alert-danger col-xs-12 form-error-custom'
	                    //so we check for that
	                    if ( data.indexOf('alert alert-danger col-xs-12 form-error-custom') !== -1 )
	                    	$('#profile_pass-modal-body').html(data);
	                   	else
	                   		location.reload(true);
	                });
				});
			});
		});
	}

	//Manage AJAX for modal displays throughout the profile page
	function modalOpening() {
		emailModal();
		passwordModal();
	}







	//initialise la galerie photos
	function initGallery() {
		$('ul.gallery').bsPhotoGallery({
		    "classes" : "col-xs-6 col-sm-4 col-md-3",
		    "hasModal" : true
		});
	}





	$.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyCEL05YUkkeIBtLXDKcrZyM4kIkgbEOYS8");

	manageObservationModal();
	modalOpening();
	initGallery();
});
