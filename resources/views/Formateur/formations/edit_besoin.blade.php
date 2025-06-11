<div class="card shadow-sm p-4 mb-4">
    <h3 style="text-align: center;">Besoins de la formation</h3>
    <br>
    <div id="besoin1">
        @foreach($formation->besoins as $index => $besoin)
            <div class="form-group row besoin" id="besoin{{ $index + 1 }}">
                <label for="besoin_{{ $index + 1 }}" class="col-md-2 col-form-label text-md-right">{{ __('Besoin n°' . ($index + 1)) }}</label>
                <div class="col-md-8">
                    <input id="besoin_{{ $index + 1 }}" type="text" class="form-control @error('besoin.' . $index) is-invalid @enderror" name="besoin[]" value="{{ old('besoin.' . $index, $besoin['value']) }}" autocomplete="besoin" autofocus>
                    @error('besoin.' . $index)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>

    <div id="newbesoin"></div>

    <div class="form-group row">
        <div class="col-md-12 my-2 d-flex justify-content-center">
            <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewbesoin()" style="margin-right: 10px;"><ion-icon name='add-outline'></ion-icon> Nouveau besoin</button>
            <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deletebesoin()"><ion-icon name='trash-outline'></ion-icon> Supprimer le besoin</button>
        </div>
    </div>
</div>

