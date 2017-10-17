$("form").on("submit",function(e) {
	e.preventDefault();
	var form = $('form')[0];
	var formData = new FormData(form);
	$.ajax({
		url : pathControllerObservation,
		type : 'POST', 
		data : formData,
		contentType: false, 
		processData: false,
		success :function(data) {
			if(data.result == 0) {
                for (var key in data.data) {
                	   console.log(data);
                    $("form").find('[name*="'+key+'"]')[0].before(''+data.data[key]+'');
            }} else {
				$('#containerObservation').animate({ height: '0px' }, 1000, function() {
					$(this).hide(0, function() {
						$('#thanks').animate({ height: '0px' }, 1000, function() {
							$(this).show(function() {
								$('#thanks').animate({ height: '400px' }, 1000);
							});
						});
					});
				});
  			}    
        }
    });
});
