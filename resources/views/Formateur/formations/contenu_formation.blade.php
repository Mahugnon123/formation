  {{-- contenu  --}}
  
  
  <hr>
  <div id="contenu1">
 <h3 style="text-align: center;">Mettez ici ce que les apprenants vons apprendrent tout au long de la formation</h3>
 <br>
  <div class="form-group row">
    <label for="Contenu" class="col-md-2 col-form-label text-md-right">{{ __('Contenu n°1') }}</label>
    <div class="col-md-8">
      <input id="contenu" type="text" class="form-control @error('contenu') is-invalid @enderror" name="{{'contenu[]'}}" value="{{ old('contenu') }}"  autocomplete="contenu" autofocus>
    </div>
  </div>

  </div>

  <div id="newcontenu"> </div>

  <div class="form-group row">
  <div class="col-md-12 my-2">
    <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewcontenu()"><ion-icon name='add-outline'></ion-icon> Nouveau contenu</button>
                
    <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deletecontenu()"><ion-icon name='trash-outline'></ion-icon> Supprimer le contenu</button>
  </div>

 </div>
