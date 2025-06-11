<div class="card shadow-sm p-4 mb-4">
    <h3 style="text-align: center;">Contenus de la formation</h3>
    <br>
    <div id="contenu1">
        @foreach($formation->contenus as $index => $contenu)
            <div class="form-group row contenu" id="contenu{{ $index + 1 }}">
                <label for="contenu_{{ $index + 1 }}" class="col-md-2 col-form-label text-md-right">{{ __('Contenu n°' . ($index + 1)) }}</label>
                <div class="col-md-8">
                    <input id="contenu_{{ $index + 1 }}" type="text" class="form-control @error('contenu.' . $index) is-invalid @enderror" name="contenu[]" value="{{ old('contenu.' . $index, $contenu['value']) }}" autocomplete="contenu" autofocus>
                    @error('contenu.' . $index)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>

    <div id="newcontenu"></div>

    <div class="form-group row">
        <div class="col-md-12 my-2 d-flex justify-content-center">
            <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewcontenu()" style="margin-right: 10px;"><ion-icon name='add-outline'></ion-icon> Nouveau contenu</button>
            <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deletecontenu()"><ion-icon name='trash-outline'></ion-icon> Supprimer le contenu</button>
        </div>
    </div>
</div>


