<div id="chapitre_texte1">
  <div class="form-group row">
      <label for="intitule_1" class="col-md-2 col-form-label text-md-right">{{ __('Intitulé du chapitre') }}</label>
      <div class="col-md-8">
          <input id="intitule_1" type="text" class="form-control @error('intitule_texte') is-invalid @enderror" name="intitule_texte[]" value="{{ old('intitule_texte') }}" autocomplete="intitule" autofocus>
      </div>
  </div>
  <div class="form-group row">
      <label for="chapitre_description_1" class="col-md-2 col-form-label text-md-right">{{ __('Petite description') }}</label>
      <div class="col-md-8">
          <textarea id="chapitre_description_1" class="form-control @error('chapitre_description_texte') is-invalid @enderror" name="chapitre_description_texte[]" autocomplete="description" autofocus rows="2" cols="60"></textarea>
      </div>
  </div>
  <div class="form-group row">
      <label for="summernote_1" class="col-md-12 col-form-label text-md-center">{{ __('Rédiger le contenu du chapitre ici') }}</label>
  </div>
  <div class="form-group row">
      <div class="col-md-12">
          <textarea id="summernote_1" name="editordata_texte[]"></textarea>
      </div>
  </div>
</div>
<div id="newchapitre_text"></div>
<div class="form-group row">
  <div class="col-md-12 my-2 d-flex justify-content-center">
      <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewChapter_texte()" style="margin-right: 10px;"><ion-icon name='add-outline'></ion-icon> Nouveau chapitre</button>
      <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deleteChapter_texte()"><ion-icon name='trash-outline'></ion-icon> Supprimer le chapitre</button>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#summernote_1').summernote({
      height: 50,
      toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
      ]
  });
});
</script>