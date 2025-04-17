@extends("Formateur.app")
@section("content")

  <style>body {
    margin-top:40px;
}
.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}</style>

<div class="container my-5" style="min-height: 63vh">
  
<div class="row justify-content-center">
<div class="col-md-12">
<div class="card shadow-lg p-3 mb-5 bg-white rounded">

<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step mb-4">
        <a href="#step-1" type="button" class="btn btn-circle btn-default btn-primary">1</a>
        <p class="fw-bold "><h5 >Informations générales</h5></p>
      </div>
      <div class="stepwizard-step mb-4">
        <a href="#step-2" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">2</a>
        <p class="fw-bold "><h5 >Contenu de la formation</h5></p>
      </div>

      <div class="stepwizard-step mb-4">
        <a href="#step-3" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">3</a>
        <p class="fw-bold "><h5 >Compétence à acquerir</h5></p>
      </div> 

      <div class="stepwizard-step mb-4">
        <a href="#step-4" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">4</a>
        <p class="fw-bold "><h5 >Bésoin </h5></p>
      </div> 

      <div class="stepwizard-step mb-4">
        <a href="#step-5" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">5</a>
        <p class="fw-bold "><h5 >A propos de la formation</h5></p>
      </div>

      <div class="stepwizard-step mb-4">
        <a href="#step-6" type="button" class="btn btn-default btn-circle" style="pointer-events: none;">6</a>
        <p class="fw-bold "><h5 >Création de la formation</h5></p>
      </div>
    </div>
 </div>
  <div class="card-body">
  <form role="form" action="/formations" method="post" enctype="multipart/form-data">
  	@csrf
    @method('post')
    <div class="row setup-content" id="step-1" style="display: block;">
      <div class="col-xs-12 col-md">
        <div class="col-md-12">

            @include('Formateur.formations.general_info')
          
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
        </div>
        
      </div>
    </div>

    <div class="row setup-content" id="step-2" style="display: block;">
      <div class="col-xs-12 col-md">
        <div class="col-md-12">

            @include('Formateur.formations.contenu_formation')
          <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
        </div>
      </div>
    </div>

     <div class="row setup-content" id="step-3" style="display: block;">
      <div class="col-xs-12 col-md">
        <div class="col-md-12">

            @include('Formateur.formations.competence')
          <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
        </div>
      </div>
    </div>

     <div class="row setup-content" id="step-4" style="display: block;">
      <div class="col-xs-12 col-md" id="">
        <div class="col-md-12">
           @include('Formateur.formations.besoin')
          <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
        </div>
      </div>
    </div> 

    <div class="row setup-content" id="step-5" style="display: block;">
      <div class="col-xs-12 col-md" id="">
        <div class="col-md-12">
           @include('Formateur.formations.a_propos')
          <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="suivant">Suivant</button>
        </div>
      </div>
    </div>
    <div class="row setup-content" id="step-6" style="display: none;">
      <div class="col-xs-12 col-md" id="texte">
        <div class="col-md-12">
           @include('Formateur.formations.formation_texte')
          <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit">Envoyer</button>
        </div>
      </div>

     <div class="col-xs-12 col-md" id="video">
            <div class="col-md-12">
               @include('Formateur.formations.formation_video')
              <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Retour</button>
              <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit">Envoyer</button>
            </div>
          </div>

    </div>
  </form>
  
</div>

</div>

</div>
</div>

</div>

 <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>

  <script>


$('select[name="type"]').change(function(){

  if ($(this).val()=="video") {
    $('#texte').hide();
     $('#video').show();
  }else if ($(this).val()=="texte") {
    $('#texte').show();
     $('#video').hide();
  }
   
});

$('select[name="category_id"]').change(function(){

  if ($(this).val()=="autre") {
    $('#autre').css('display','block');
  }
  else
  {
   $('#autre').css('display','none');
  }
   
});

    var line = 1;
    var contenu_line =1;
    var competence_line = 1;
    var besoin_line = 1;
    var chapitre_texte_line = 1;

    // ---------------------- Ajout d'un nouveau chapitre --------------------------//
    function addnewChapter()
      {
        line+=1;
        var cardfield = "<div id='line"+line+"'> <div class='form-group row'><label for='intitule' class='col-md-2 col-form-label text-md-right'>{{ __('Intitulé du chapitre') }}</label><div class='col-md-8'> <input id='intitule' type='text' class='form-control @error('intitule') is-invalid @enderror' name='{{'intitule[]'}}' value='{{ old('intitule') }}' required autocomplete='intitule' autofocus></div></div><div class='form-group row'><label for='task' class='col-md-2 col-form-label text-md-right'>{{ __('Petite description') }}</label><div class='col-md-8'><textarea id='description' name='{{'chapitre_description[]'}}' type='text' class='form-control' value='{{ old('description') }}' required autocomplete='description' autofocus rows='2' cols='60'></textarea></div></div><div class='form-group row'><label for='photo_type' class='col-md-2 col-form-label text-md-right'>{{ __('Video répresentative du chapitre') }}</label><div class='col-md-8'><input id='photo_type' type='file' class='form-control' accept='video/mp4,video/x-m4v,video/*' name='{{'video[]'}}' value='{{ old('photo_type') }}' placeholder='video représentative du chapitre'><span style='color: red; display: none;' class='text-center' id='message'></span></div></div></div>";
        var ajout = $("#newcard");
        ajout.append(cardfield);
       }

// ---------------------- Suppression d'un chapitre --------------------------//
        function deleteChapter()
      {
      if (line > 1) {


          var line_id = "#line"+line+"";
          var card_line = $(line_id);
          card_line.remove();
          line -=1;

        }
       }

  // ---------------------- Ajout d'un nouveau chapitre de type texte --------------------------//
    function addnewChapter_texte()
      {
        chapitre_texte_line+=1;
        var cardfield = "<div class='form-group row'><label for='intitule' class='col-md-2 col-form-label text-md-right'>{{ __('Intitulé du chapitre') }}</label><div class='col-md-8'><input id='intitule' type='text' class='form-control @error('intitule') is-invalid @enderror' name='{{'intitule'}} value='{{ old('intitule') }}' autocomplete='intitule' autofocus></div></div> <div class='form-group row'><label for='task' class='col-md-2 col-form-label text-md-right'>{{ __('Petite description') }}</label><div class='col-md-8'><textarea id='chapitre_description' type='text' class='form-control @error('description') is-invalid @enderror' name='{{'chapitre_descriptiond'}}' value='{{ old('description') }}'  autocomplete='description' autofocus rows='2' cols='60'></textarea></div></div> <div class='form-group row'><label for='task' class='col-md-12 col-form-label text-md-center'>{{ __('Rediger le contenu du chapitre ici') }}</label></div>  <div class='form-group row'><div class='col-md-12'><textarea id='summernote' name='editordata'></textarea></div></div>";
        var ajout = $("#newchapitre_text");
        ajout.append(cardfield);
       }

 // ---------------------- Suppression d'un chapitre de type texte--------------------------//
        function deleteChapter_texte()
      {
      if (chapitre_texte_line > 1) {


          var line_id = "#chapitre_texte"+chapitre_texte_line+"";
          var card_line = $(line_id);
          card_line.remove();
          chapitre_texte_line -=1;

        }
       }

// ---------------------- Ajout d'un nouveau contenu --------------------------//
      function addnewcontenu()
      {
        contenu_line+=1;
        var cardfield = "<div id='contenu"+contenu_line+"'> <div class='form-group row'><label for='contenu' class='col-md-2 col-form-label text-md-right'>Contenu n°"+contenu_line+"</label><div class='col-md-8'> <input id='contenu' type='text' class='form-control @error('contenu') is-invalid @enderror' name='{{'contenu[]'}}' value='{{ old('contenu') }}' required autocomplete='contenu' autofocus></div></div>";
        var ajout = $("#newcontenu");
        ajout.append(cardfield);
       }


// ---------------------- Suppression d'un contenu --------------------------//
   function deletecontenu()
      {
      if (contenu_line > 1) {


          var line_id = "#contenu"+contenu_line+"";
          var card_line = $(line_id);
          card_line.remove();
          contenu_line -=1;

        }
       }


// ---------------------- Ajout d'une nouvelle competence --------------------------//
      function addnewcompetence()
      {
        competence_line+=1;
        var cardfield = "<div id='competence"+competence_line+"'> <div class='form-group row'><label for='competence' class='col-md-2 col-form-label text-md-right'>Competence n°"+competence_line+"</label><div class='col-md-8'> <input id='competence' type='text' class='form-control @error('competence') is-invalid @enderror' name='{{'competence[]'}}' value='{{ old('competence') }}' required autocomplete='competence' autofocus></div></div>";
        var ajout = $("#newcompetence");
        ajout.append(cardfield);
       }


// ---------------------- Suppression d'une competence --------------------------//
   function deletecompetence()
      {
      if (competence_line > 1) {


          var line_id = "#competence"+competence_line+"";
          var card_line = $(line_id);
          card_line.remove();
          competence_line -=1;

        }
       }

// ---------------------- Ajout d'un nouveau besoin --------------------------//
      function addnewbesoin()
      {
        besoin_line+=1;
        var cardfield = "<div id='besoin"+besoin_line+"'> <div class='form-group row'><label for='besoin' class='col-md-2 col-form-label text-md-right'>Competence n°"+besoin_line+"</label><div class='col-md-8'> <input id='besoin' type='text' class='form-control @error('besoin') is-invalid @enderror' name='{{'besoin[]'}}' value='{{ old('besoin') }}' required autocomplete='besoin' autofocus></div></div>";
        var ajout = $("#newbesoin");
        ajout.append(cardfield);
       }


// ---------------------- Suppression d'une competence --------------------------//
   function deletebesoin()
      {
      if (besoin_line > 1) {


          var line_id = "#besoin"+besoin_line+"";
          var card_line = $(line_id);
          card_line.remove();
          besoin_line -=1;

        }
       }



       function checkRadio()
       {

        if ($('#flexRadioDefault1').prop('checked')) {
        $('#prix_formation').css('display', 'block');
        $('#prix_certification').css('display', 'none');
        }

        if ($('#flexRadioDefault2').prop('checked')) {
        $('#prix_certification').css('display', 'block');
        $('#prix_formation').css('display', 'none');
        }


       }







  $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn'),
  		  allPrevBtn = $('.prevBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });
  
  allPrevBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

          prevStepWizard.removeAttr('disabled').trigger('click');
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url'],input[type='file'],select,textarea"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});
  </script>
  

 
@endsection

