<div class="card-body">
    <div class="form-group row">
        <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Titre') }}</label>
        <div class="col-md-8">
            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $formation->titre) }}" required autocomplete="title" autofocus>
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>
        <div class="col-md-8">
            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description', $formation->description) }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="photo_type" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>
        <div class="col-md-8">
            <input id="photo_type" type="file" class="form-control @error('photo_type') is-invalid @enderror" name="photo_type" accept="image/*">
            @if($formation->image_url)
                <img src="{{ asset($formation->image_url) }}" alt="Formation Image" style="max-width: 100px; margin-top: 10px;">
            @endif
            @error('photo_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="payante_ou_non" class="col-md-2 col-form-label text-md-right">{{ __('Payante') }}</label>
        <div class="col-md-8">
            <select id="payante_ou_non" class="form-control @error('payante_ou_non') is-invalid @enderror" name="payante_ou_non" required>
                <option value="Oui" {{ old('payante_ou_non', $formation->payante_ou_non) == 'Oui' ? 'selected' : '' }}>Oui</option>
                <option value="Non" {{ old('payante_ou_non', $formation->payante_ou_non) == 'Non' ? 'selected' : '' }}>Non</option>
            </select>
            @error('payante_ou_non')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="prix_formation" class="col-md-2 col-form-label text-md-right">{{ __('Prix formation') }}</label>
        <div class="col-md-8">
            <input id="prix_formation" type="number" class="form-control @error('prix_formation') is-invalid @enderror" name="prix_formation" value="{{ old('prix_formation', $formation->prix_formation) }}">
            @error('prix_formation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="prix_certification" class="col-md-2 col-form-label text-md-right">{{ __('Prix certification') }}</label>
        <div class="col-md-8">
            <input id="prix_certification" type="number" class="form-control @error('prix_certification') is-invalid @enderror" name="prix_certification" value="{{ old('prix_certification', $formation->prix_certification) }}">
            @error('prix_certification')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="duree" class="col-md-2 col-form-label text-md-right">{{ __('Durée') }}</label>
        <div class="col-md-8">
            <input id="duree" type="text" class="form-control @error('duree') is-invalid @enderror" name="duree" value="{{ old('duree', $formation->duree) }}" required>
            @error('duree')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="category_id" class="col-md-2 col-form-label text-md-right">{{ __('Catégorie') }}</label>
        <div class="col-md-8">
            <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required>
                <option value="">{{ __('Sélectionner une catégorie') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $formation->category_id) == $category->id ? 'selected' : '' }}>{{ $category->nom }}</option>
                @endforeach
                <option value="autre" {{ old('category_id') == 'autre' ? 'selected' : '' }}>{{ __('Autre') }}</option>
            </select>
            @error('category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row" id="new_category_field" style="display: {{ old('category_id', $formation->category_id) == 'autre' ? 'block' : 'none' }};">
        <label for="categorie" class="col-md-2 col-form-label text-md-right">{{ __('Nouvelle catégorie') }}</label>
        <div class="col-md-8">
            <input id="categorie" type="text" class="form-control @error('categorie') is-invalid @enderror" name="categorie" value="{{ old('categorie') }}">
            @error('categorie')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="type" class="col-md-2 col-form-label text-md-right">{{ __('Type') }}</label>
        <div class="col-md-8">
            <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required>
                <option value="texte" {{ old('type', $formation->type) == 'texte' ? 'selected' : '' }}>Texte</option>
                <option value="video" {{ old('type', $formation->type) == 'video' ? 'selected' : '' }}>Vidéo</option>
            </select>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>