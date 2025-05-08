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

@section('scripts')
<script>
    let chapitreTexteIndex = {{ count($chapters) }};

    function addnewchapitre_texte() {
        chapitreTexteIndex++;
        const newChapitreDiv = document.createElement('div');
        newChapitreDiv.className = 'form-group row chapitre_texte';
        newChapitreDiv.id = `chapitre_texte${chapitreTexteIndex}`;
        newChapitreDiv.innerHTML = `
            <h4 class="col-md-12 text-center">Chapitre ${chapitreTexteIndex}</h4>
            <div class="form-group row">
                <label for="intitule_texte_${chapitreTexteIndex}" class="col-md-2 col-form-label text-md-right">Intitulé</label>
                <div class="col-md-8">
                    <input id="intitule_texte_${chapitreTexteIndex}" type="text" class="form-control" name="intitule_texte[]">
                </div>
            </div>
            <div class="form-group row">
                <label for="chapitre_descriptiond_texte_${chapitreTexteIndex}" class="col-md-2 col-form-label text-md-right">Description</label>
                <div class="col-md-8">
                    <textarea id="chapitre_descriptiond_texte_${chapitreTexteIndex}" class="form-control" name="chapitre_descriptiond_texte[]"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="editordata_texte_${chapitreTexteIndex}" class="col-md-2 col-form-label text-md-right">Contenu texte</label>
                <div class="col-md-8">
                    <textarea id="editordata_texte_${chapitreTexteIndex}" class="form-control summernote" name="editordata_texte[]"></textarea>
                </div>
            </div>
        `;
        document.getElementById('newchapitre_texte').appendChild(newChapitreDiv);
        $(`#editordata_texte_${chapitreTexteIndex}`).summernote();
    }

    function deletechapitre_texte() {
        const chapitres = document.getElementsByClassName('chapitre_texte');
        if (chapitres.length > 1) {
            chapitres[chapitres.length - 1].remove();
            chapitreTexteIndex--;
        }
    }

    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endsection