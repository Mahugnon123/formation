function arrayEquals(a, b) {
return Array.isArray(a) &&
  Array.isArray(b) &&
  a.length === b.length &&
  a.every((val, index) => val === b[index]);
}

function randomize( array ) {
        return array.sort(function() {
            return 0.8 - Math.random();
        });
  }

function refreshContent()
{

  $('#sectionrefresh').load(location.href + '#sectionrefresh');

}

var error_message = "";

function check_image_size(idimage)
{

    var imgpath = document.getElementById('photo_type');
    var file = $('#photo_type').val();
    var file_ext = file.substr(file.lastIndexOf('.')+1,file.length);

    if (!imgpath.value==""){

      var img=imgpath.files[0].size;
      var imgsize=img/1024; 

      if (file_ext!='JPG' & file_ext!='PNG' & file_ext!='png' & file_ext!='jpg') {

        error_message = "Choisissez un fichier image ";
        $('#message').html(error_message);
        $('#message').css('display', '');
        return false;

      }else if (imgsize >5000) {

        error_message = "Choisissez une image de taille inférieure à 5Mo";
        $('#message').html(error_message);
        $('#message').css('display', '');
        return false;
        
      }else{
        return true;
      }

    }
}

/*function imageControl()
 {
  idimage
  
 }*/
