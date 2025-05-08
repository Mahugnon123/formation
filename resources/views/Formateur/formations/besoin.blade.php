
{{-- contenu  --}}
  
  
   <hr>
   <div id="besoin1">
  <h3 style="text-align: center;">Mettez ici ce dont les apprenants auronts besoin pour pouvoir suivre la formation</h3>
  <br>
   <div class="form-group row">
     <label for="besoin" class="col-md-2 col-form-label text-md-right">{{ __('Besoin n°1') }}</label>
     <div class="col-md-8">
       <input id="besoin" type="text" class="form-control @error('besoin') is-invalid @enderror" name="{{'besoin[]'}}" value="{{ old('besoin') }}"  autocomplete="besoin" autofocus>
     </div>
   </div>
 
   </div>
 
   <div id="newbesoin"> </div>
 
   <div class="form-group row">
   <div class="col-md-12 my-2 d-flex justify-content-center" >
     <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewbesoin()" style="margin-right: 10px;"><ion-icon name='add-outline'></ion-icon> Nouveau besoin</button>
                 
     <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deletebesoin()"><ion-icon name='trash-outline'></ion-icon> Supprimer le besoin</button>
   </div>
 
  </div>
 
