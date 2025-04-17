  {{-- contenu  --}}
  
  
  <hr>
  <div id="competence1">
 <h3 style="text-align: center;">Mettez ici les compétences à acquerir par les apprenants après avoir suivir la formation</h3>
 <br>
  <div class="form-group row">
    <label for="competence" class="col-md-2 col-form-label text-md-right">{{ __('Compétence n°1') }}</label>
    <div class="col-md-8">
      <input id="competence" type="text" class="form-control @error('competence') is-invalid @enderror" name="{{'competence[]'}}" value="{{ old('competence') }}"  autocomplete="competence" autofocus>
    </div>
  </div>

  </div>

  <div id="newcompetence"> </div>

  <div class="form-group row">
  <div class="col-md-12 my-2">
    <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewcompetence()"><ion-icon name='add-outline'></ion-icon> Nouvelle compténce</button>
                
    <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deletecompetence()"><ion-icon name='trash-outline'></ion-icon> Supprimer la compétence</button>
  </div>

 </div>
