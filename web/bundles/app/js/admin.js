$(function() {
	
	//generate a different button depending on the actual state of the observation
	function generateStateBtn(state, id, admin_url) {
		var button;

		switch (state) {
			//bootstrap == verbose
			case 'valid':
				button = $('<button class="btn btn-success"><span class="glyphicon glyphicon-ok-circle"></span> Validée</button><button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button><ul class="dropdown-menu"><li><a href="'+admin_url+'obs/await/'+id+'" class="alert-warning"><span class="glyphicon glyphicon-refresh"></span> Mettre en attente</a></li><li><a href="'+admin_url+'obs/refuse/'+id+'" class="alert-danger"><span class="glyphicon glyphicon-remove-circle"></span> Refuser</a></li></ul>');
				break;

			case 'refused':
				button = $('<button class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Refusée</button><button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button><ul class="dropdown-menu"><li><a href="'+admin_url+'obs/validate/'+id+'" class="alert-success"><span class="glyphicon glyphicon-ok-circle"></span> Valider</a></li><li><a href="'+admin_url+'obs/await/'+id+'" class="alert-warning"><span class="glyphicon glyphicon-refresh"></span> Mettre en attente</a></li></ul>');
				break;

			default:
				button = $('<button class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> En attente</button><button class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button><ul class="dropdown-menu"><li><a href="'+admin_url+'obs/validate/'+id+'" class="alert-success"><span class="glyphicon glyphicon-ok-circle"></span> Valider</a></li><li><a href="'+admin_url+'obs/refuse/'+id+'" class="alert-danger"><span class="glyphicon glyphicon-remove-circle"></span> Refuser</a></li></ul>');
				break;
		}

		return button;
	}

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
		var observations = $('#observations .observation-row');

        observations.each(function(index, elmt) {
            $(elmt).on('click', function(e) {
            	e.preventDefault();

            	//get the observation data
            	var image = $(this).data('image') ? $(this).data('image') : null,
            		state = $(this).data('state'),
            		id = $(this).data('id'),
            		admin_url = $(this).data('url'),
            		name = $(this).data('name'),
            		date = $(this).data('date'),
            		country = $(this).data('country'),
            		comment = $(this).data('comment') ? $(this).data('comment') : null,
            		lat = $(this).data('lattitude'),
            		lng = $(this).data('longitude');

            	//modal window elements
            	var modal = $('#admin_obs-modal'),
            		modal_state = $('#admin_obs-modal-state'),
            		modal_left = modal.find('.admin_obs-modal-left-panel'),
            		modal_right = $('#gmaps_canvas'),
            		modal_comment = modal.find('.admin_obs-modal-comment-panel'),
            		ul = $('<ul></ul>'),
            		obsDiv = $(e.target);

            	//we reset everything in case the modal has been opened and is filled with content already
            	modal_state.html('');
            	modal_left.html('');
            	modal_right.html('');
            	modal_comment.html('');

            	var state_btn = generateStateBtn( state, id, admin_url );
            	state_btn.appendTo(modal_state);

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
					 	initMap( {lat: parseFloat(lat), lng: parseFloat(lng)} );
					}
				});
            });
        });
	}




	//manage the route the confirm delete button is gonna point to
	function manageUserDeleteConfirm() {
		var buttons = $('.user_button-row .btn-danger'),
			confirm = $('#admin_user-delete-modal-confirm'),
			current_href = confirm.attr('href'),
			new_href;

		//if current href already is the full need href, we cut the ID at the end
		if ( current_href.indexOf('user/delete') !== -1 ) {
			current_href = current_href.substring( 0, current_href.lastIndexOf('/') + 1 );
		}
		//else we complete the href with user/delete/
		else {
			current_href = current_href+'user/delete/';
		}

		//for each of the "delete" buttons
		buttons.each(function(index, elmt) {
			$(elmt).on('click', function(e) {
				//on click we assign the user id to the path
				//and we update the href of the confirmation button
				new_href = current_href+''+$(e.target).data('id');
				confirm.attr('href', new_href);
			});
		});
	}




	//load correct user edit form into the modal
	function manageUserEditModal() {
		var buttons = $('.user_button-row .btn-warning'),
			modal_body = $('#admin_user-edit-modal-body'),
			confirm = $('#admin_user-edit-modal-confirm'),
			current_href = $(confirm).data('href'),
			new_href;

		//if current href already is the full need href, we cut the ID at the end
		if ( current_href.indexOf('user/edit') !== -1 ) {
			current_href = current_href.substring( 0, current_href.lastIndexOf('/') + 1 );
		}
		//else we complete the href with user/edit/
		else {
			current_href = current_href+'user/edit/';
		}

		//for each of the "edit" buttons
		buttons.each(function(index, elmt) {
			$(elmt).on('click', function(e) {
				//on click we assign the user id to the path
				//and we update the href of the confirmation button
				new_href = current_href+''+$(e.target).data('id');
		
				//and we load the correct form inside the modal
				modal_body.load(new_href, function() {

				});
			});
		});
	}





	$.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyCEL05YUkkeIBtLXDKcrZyM4kIkgbEOYS8");

	manageObservationModal();
	manageUserDeleteConfirm();
	manageUserEditModal();
});
