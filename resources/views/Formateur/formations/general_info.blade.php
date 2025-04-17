  {{-- General info to create  --}}
  
  
  <hr>
  <div class="form-group row">
    <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Titre de la formation') }}</label>
    <div class="col-md-8">
      <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
        @error('title')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
  </div>

<div class="form-group row">
              <label for="task" class="col-md-2 col-form-label text-md-right">{{ __('Type de formation') }}</label>
              <div class="col-md-8">

              <select name="{{'type'}}" value="{{ old('type') }}" class="form-control @error('type') is-invalid @enderror" id="" required autocomplete="type" autofocus rows="2" cols="60">

              <option value="">Choisissez le type de la formation</option>
              <option value="video">Formation de type vidéo</option>
              <option value="texte">Formation de type texte</option>
                </select>
                @error('type')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
          </div>
</div>


  <div class="form-group row">

    <label for="photo_type" class="col-md-2 col-form-label text-md-right">{{ __('Image répresentative de la formation') }}</label>
    
    <div class="col-md-8">
      <input id="photo_type" type="file" class="form-control @error('photo_type') is-invalid @enderror" accept="image/*" required name="photo_type" value="{{ old('photo_type') }}" placeholder="Image représentative de l'exercice">
      <span style="color: red; display: none;" class="text-center" id="message"></span>

      @error('photo_type')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror

    </div>

  </div>
 <div class="form-group row">
    <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Petite description') }}</label>
    <div class="col-md-8">
      <textarea id="formation_description" type="text"  class="form-control @error('description') is-invalid @enderror"
        name="description" value="{{ old('description') }}" required autocomplete="description" autofocus rows="2" cols="60"></textarea>
      @error('description')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  <div class="form-group row">
              <label for="task" class="col-md-2 col-form-label text-md-right">Choisissez la categorie</label>
              <div class="col-md-8">

              <select name="{{'category_id'}}" value="{{ old('category_id') }}" class="form-control @error('category_id') is-invalid @enderror" id="" required autocomplete="category_id" autofocus rows="2" cols="60">
                <option>Choisissez la categorie</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->nom}}</option>
                @endforeach
                <option value="autre">Autre</option>
              </select>
                @error('category_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
          </div>
    </div>

  
  <div class="form-group row" id="autre" style="display:none;">
    <label for="categorie" class="col-md-2 col-form-label text-md-right">{{ __('Categorie de la formation') }}</label>
    <div class="col-md-8">
      <input id="categorie" type="text" class="form-control @error('categorie') is-invalid @enderror" name="categorie" value="{{ old('categorie') }}" autocomplete="categorie" autofocus>
        @error('categorie')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
  </div>

  <div class="form-group row">
    <label for="duree" class="col-md-2 col-form-label text-md-right">{{ __('La durée de la formation') }}</label>
    <div class="col-md-8">
      <input id="duree" type="text" class="form-control @error('duree') is-invalid @enderror" name="duree" value="{{ old('duree') }}" required autocomplete="duree" autofocus>
        @error('duree')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
  </div>


<div class="form-group row">

<label for="description" class="col-md-2 col-form-label text-md-right">{{ __('La formation est payante ?') }}</label>

<div class="col-md-8">
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="payante_ou_non" id="flexRadioDefault1" onclick="checkRadio()" value="Oui">
  <label class="form-check-label" for="inlineCheckbox1">Oui</label>
</div>

  <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="payante_ou_non" id="flexRadioDefault2" onclick="checkRadio()" value="Non">
      <label class="form-check-label" for="inlineCheckbox2">Non</label>
  </div>
      @error('description')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
</div>
</div>

<div class="form-group row" id="prix_formation" style="display: none;">
    <label for="prix_formation" class="col-md-2 col-form-label text-md-right">{{ __('Le prix de la formation') }}</label>
    <div class="col-md-8">
      <input id="prix_formation" type="number" class="form-control @error('prix_formation') is-invalid @enderror" name="prix_formation" value="{{ old('prix_formation') }}"  autocomplete="prix_formation" autofocus>
        @error('prix_formation')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
  </div>

  <div class="form-group row" id="prix_certification" style="display: none;">
    <label for="prix_certification" class="col-md-2 col-form-label text-md-right">{{ __('Le prix de la certification') }}</label>
    <div class="col-md-8">
      <input id="prix_certification" type="number" class="form-control @error('prprix_certificationix') is-invalid @enderror" name="prix_certification" value="{{ old('prix_certification') }}"  autocomplete="prix_certification" autofocus>
        @error('prix_certification')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
  </div>

