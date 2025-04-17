@extends("Apprenant.app")
@section("content")


<!-- section -->
<span class="d-none" id="sum">5</span>
<section class="section-sm" id="chapitre" style="display:block">
  <div class="container mt-3">
    <div class="row">
      <div class="col-8 mb-4 contenu" id="contenu">
      <h3 class="text text-center mt-2 d-flex"><span id="menu" onclick="menu();"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg></span></h3>
        <h3>Intitiler</h3>
        <!-- course thumb -->
       
        
       
        <video width="90%" height="400"  controls >
          <source src="http://127.0.0.1:8000/Video/W3dCMxATl6-1662409967.mp4" type=video/ogg> <source src="/build/videos/arcnet.io(7-sec).mp4" type=video/mp4>
        </video>   
       
        <div class="row mt-3">
          <div class="col-12 mb-4">
            <h3>Description</h3>
            <p> sfvsd </p>
          </div>
          <div class="col-12 mb-4">
            <h3>Contenu</h3>
            <p> cvd </p>
          </div>

        </div>
        <div class="d-flex justify-content-center">
      
              <div class="col" id="precedent"  onclick="precedent();">
                <form action="/suivi" method="post" class="col">
                    <input type="hidden" name="id" id="id_chpt" value="">
                    <input type="hidden" name="id_formation" id="id_formation" value="1">
                  <button type="submit" class="btn btn-secondary mb-2">
                  <i class="bi bi-chevron-compact-left" ></i> Chapitre precedent</button>
                </form>    
              </div>
          
              <div class="col" id="suivant" onclick="suivant();">
                <form action="/suivi" method="post" class="col">
                  <input type="hidden" name="id" id="id_chpt" value="">
                  <input type="hidden" name="id_formation" id="id_formation" value="1">
                <button type="submit" class="btn btn-primary mb-2" >  Chapitre suivant
                  <i class="bi bi-chevron-right"></i>
                </button>
                </form>   
              </div>
        </div>
        
      
    </div>
      <div class="col-4 mb-5 note-class"  style="height:50%">
      <input type="hidden" name="id_fmt" id="id_fmt" value="1">
          <input type="hidden" name="id_chapitre" id="id_chapitre" value="1">
        <div  id="note">
        <h3 class="text text-center mt-2">Prendre Note </h3>
          <div class="mb-3">
              <label for="titre" class="form-label">Titre </label>
              <input type="text" class="form-control" id="titre" placeholder="mon resume de chapitre">
          </div>
          <div class="mb-3">
              <label for="description" class="form-label">Description </label>
              <textarea class="form-control" id="description" rows="5"></textarea>
          </div>
          <div class="mb-3">
              <label for="commentaire" class="form-label">Commentaire </label>
              <textarea class="form-control" id="commentaire" rows="12" cols="8"></textarea>
          </div>
          
          <div class="mt-3">
          <button type="submit" class="btn btn-success" id="btn-save"> Enregistrer</button>
          </div>
        </div>
        
      </div>
    </div>
    
  </div>
</section>

<script>
   $(document).ready( function () {

$.ajaxSetup({
 headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 }
  });

        
         $('body').on('click', '#btn-save', function (event) {

      
          var id_fmt = $("#id_fmt").val();
          var id = $("#id_chapitre").val();
          var titre = $(".titre").val();
          var description = $(".description").val();
          var commentaire = $(".commentaire").val();
          var commentaire = $(".commentaire").val();


          $("#btn-save").html('Patienter...');
          $("#btn-save"). attr("disabled", true);

         
          // ajax
          $.ajax({
            type:"POST",
            url: "{{ url('/note') }}",
            data: {
              id:id,
              titre:titre,
              description:description,
              commentaire:commentaire
             
            },
            dataType: 'json',
            success: function(res){
            $("#btn-save").html('Sauvegarder');
            $("#btn-save"). attr("disabled", false);
            window.location.replace('/home');

                     }

                  });

              });

          });
</script>
<script type="text/javascript">
  var id_all = document.getElementById("sum").innerHTML;
  var id=1;
  function menu(){

    var menu_class = document.getAttribute('note-class');
    var contenu_class = document.getAttribute('contenu');

    var contenu = document.getElementById("contenu");

    if( menu_class.classList.contains('d-none')){
      menu_class.classList.remove('d-none')
      contenu_class.classList.remove('col-12')
      contenu_class.classList.add('col-8')



    }else{
      menu_class.classList.add('d-none')
      contenu_class.classList.remove('col-8')
      contenu_class.classList.add('col-12')

    }
  }
    function suivant(){
      id++;
      document.getElementById("id_chpt").value=id;
    if(id_all == id){
      var suivant = document.getElementById("suivant");
      suivant.style.display = 'none';
      id=1;
      document.getElementById("id_chpt").value=id;

    }
  }
  function precedent(){
    id--;
    document.getElementById("id_chpt").value=id;
    if(id == 1){
      var suivant = document.getElementById("precedent");
      suivant.style.display = 'none';
      id=1;
      document.getElementById("id_chpt").value=id;
    }
  }
  console.log(id);
</script>
@endsection
