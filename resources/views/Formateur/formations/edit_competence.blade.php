<div class="card shadow-sm p-4 mb-4">
    <h3 style="text-align: center;">Compétences de la formation</h3>
    <br>
    <div id="competence1">
        @foreach($formation->competences as $index => $competence)
            <div class="form-group row competence" id="competence{{ $index + 1 }}">
                <label for="competence_{{ $index + 1 }}" class="col-md-2 col-form-label text-md-right">{{ __('Compétence n°' . ($index + 1)) }}</label>
                <div class="col-md-8">
                    <input id="competence_{{ $index + 1 }}" type="text" class="form-control @error('competence.' . $index) is-invalid @enderror" name="competence[]" value="{{ old('competence.' . $index, $competence['value']) }}" autocomplete="competence" autofocus>
                    @error('competence.' . $index)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>

    <div id="newcompetence"></div>

    <div class="form-group row">
        <div class="col-md-12 my-2 d-flex justify-content-center">
            <button class="btn btn-primary btn-sm col-sm-2 col-5 offset-1" type="button" onclick="addnewcompetence()" style="margin-right: 10px;"><ion-icon name='add-outline'></ion-icon> Nouvelle compétence</button>
            <button class="btn btn-danger btn-sm col-sm-2 col-5" type="button" onclick="deletecompetence()"><ion-icon name='trash-outline'></ion-icon> Supprimer la compétence</button>
        </div>
    </div>
</div>

@section('scripts')
<script>
    let competenceIndex = {{ count($formation->competences) }};

    function addnewcompetence() {
        competenceIndex++;
        const newCompetenceDiv = document.createElement('div');
        newCompetenceDiv.className = 'form-group row competence';
        newCompetenceDiv.id = `competence${competenceIndex}`;
        newCompetenceDiv.innerHTML = `
            <label for="competence_${competenceIndex}" class="col-md-2 col-form-label text-md-right">Compétence n°${competenceIndex}</label>
            <div class="col-md-8">
                <input id="competence_${competenceIndex}" type="text" class="form-control" name="competence[]" autocomplete="competence" autofocus>
            </div>
        `;
        document.getElementById('newcompetence').appendChild(newCompetenceDiv);
    }

    function deletecompetence() {
        const competences = document.getElementsByClassName('competence');
        if (competences.length > 1) {
            competences[competences.length - 1].remove();
            competenceIndex--;
        }
    }
</script>
@endsection