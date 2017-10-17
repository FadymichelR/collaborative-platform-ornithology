
  $('#observation_birdName').autocomplete({
    source : function(requete, reponse){
      var value = $('#observation_birdName').val();
      if(value === '' || value.length < 3) {
      $('#observation_birdName').empty();
    } else {
      $.ajax({
        type:"GET",
        url : pathControllerSearch,
        data : 'search=' + value,
        success : function(donnee){
        reponse($.map(donnee, function(objet){
            return {
                    label: objet.name,
                    value: objet.id
                }
        }));
        }
      });
    }
  },

  select: function( event, ui){
    $('#observation_birdName').val(ui.item.label);
    $('#observation_birdId').val(ui.item.value);
    return false;
  }
  });




