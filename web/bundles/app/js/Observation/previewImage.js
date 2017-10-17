
function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
              $('#aperçuImage').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
      }
  }
  
$("#observation_image_file").change(function(){
    readURL(this);
});
