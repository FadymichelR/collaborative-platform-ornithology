	$('#form_mySearch').keyup(function() {
	  var value = $(this).val();
	  	if(value === '' || value.length < 3) {
	  		$('#results').empty();
  		}
  		else {
	      $.ajax({
	         url : '', 
	         type : 'GET', 
	         data : 'search=' + value,
	         success: function(reponse) { 
	     		$('#results').empty();
	     	    if (reponse.error) {
     	    		$('#results').prepend('<p>{{ 'core.find.msg.nofind'|trans }}</p>');
	     	    }
	     	    else {
					Object.keys(reponse).forEach(function(key) {
					    $('#results').prepend('<a href="'+ reponse[key].link +'" class="list-group-item theFind">'+ reponse[key].name +'</a>');
					});
	     	    }
	          },
             error: function() { 
                $('#results').empty();
                $('#results').html('<p>{{ 'core.find.msg.error'|trans }}</p>');
                }
	      });
  		}
	});

$("#results").on("click", "a.theFind", function(){
	var href = $(this).attr('href');
    $('#container_find,.nao_title').hide('slow');
    $('#container_fiche').load(href);
    $('#container_fiche').show('slow');
    return false;
});