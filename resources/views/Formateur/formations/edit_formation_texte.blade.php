<div class="card shadow-sm p-4 mb-4" style="display: {{ old('type', $formation->type) == 'texte' ? 'block' : 'none' }};">
    <h3 style="text-align: center;">Chapitres texte de la formation</h3>
    <br>
    <div id="chapitre_texte1">
        @foreach($chapters as $index => $chapter)
            <div class="form-group row chapitre_texte" id="chapitre_texte{{ $index + 1 }}">
                <h4 class="col-md-12 text-center">Chapitre {{ $index + 1 }}</h4>
                <div class="form-group row">
                    <label for="intitule_texte_{{ $index + 1 }}" class="col-md-2 col-form-label text-md-right">{{ __('Intitulé') }}</label>
                    <div class="col-md-8">
                        <input id="intitule_texte_{{ $index + 1 }}" type="text" class="form-control @error('intitule_texte.' . $index) is-invalid @enderror" name="intitule_texte[]" value="{{ old('intitule_texte.' . $index, $chapter['intitule']) }}">
                        @error('intitule_texte.' . $index)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="chapitre_descriptiond_texte_{{ $index + 1 }}" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>
                    <div class="col-md-8">
                        <textarea id="chapitre_descriptiond_texte_{{ $index + 1 }}" class="form-control @error('chapitre_descriptiond_texte.' . $index) is-invalid @enderror" name="chapitre_descriptiond_texte[]">{{ old('chapitre_descriptiond_texte.' . $index, $chapter['chapitre_description']) }}</textarea>
                        @error('chapitre_descriptiond_texte.' . $index)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="editordata_texte_{{ $index + 1 }}" class="col-md-2 col-form-label text-md-right">{{ __('Contenu texte') }}</label>
                    <div class="col-md-8">
                        <textarea id="editordata_texte_{{ $index + 1 }}" class="form-control summernote @error('editordata_texte.' . $index) is-invalid @enderror" name="editordata_texte[]">{{ old('editordata_texte.' . $index, html_entity_decode($chapter['summernote'])) }}</textarea>
                        @error('editordata_texte.' . $index)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="newchapitre_texte"></div>

    <div class="form-group row">
        <div class="col-md-12 my-2 d-flex justify-content-center">
            <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewchapitre_texte()" style="margin-right: 10px;"><ion-icon name='add-outline'></ion-icon> Nouveau chapitre</button>
            <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deletechapitre_texte()"><ion-icon name='trash-outline'></ion-icon> Supprimer le chapitre</button>
        </div>
    </div>
</div>

