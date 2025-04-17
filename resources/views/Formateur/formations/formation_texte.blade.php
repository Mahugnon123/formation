<div id="chapitre_texte1">
  

  <div class="form-group row">
    <label for="intitule" class="col-md-2 col-form-label text-md-right">{{ __('Intitulé du chapitre') }}</label>
    <div class="col-md-8">
      <input id="intitule" type="text" class="form-control @error('intitule') is-invalid @enderror" name="{{'intitule_texte[]'}}" value="{{ old('intitule') }}"  autocomplete="intitule" autofocus>
        
    </div>
  </div>

 <div class="form-group row">
    <label for="task" class="col-md-2 col-form-label text-md-right">{{ __('Petite description') }}</label>
    <div class="col-md-8">
      <textarea id="chapitre_description" type="text" class="form-control @error('description') is-invalid @enderror"
        name="{{'chapitre_descriptiond_texte[]'}}" value="{{ old('description') }}"  autocomplete="description" autofocus rows="2" cols="60"></textarea>
     
    </div>
  </div>
 
    <div class="form-group row">
    
    <label for="task" class="col-md-12 col-form-label text-md-center">{{ __('Rediger le contenu du chapitre ici') }}</label>

  </div>

  <div class="form-group row">
    
    <div class="col-md-12">
      <textarea id="summernote" name="editordata_texte[]"></textarea>
      
    </div>

  </div>

  </div>
  <div id="newchapitre_text"> </div>
  <div class="form-group row">
  <div class="col-md-12 my-2">
    <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewChapter_texte()"><ion-icon name='add-outline'></ion-icon> Nouveau chapitre</button>
                
    <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deleteChapter()"><ion-icon name='trash-outline'></ion-icon> Supprimer le chapitre</button>
  </div>

 </div>


  

