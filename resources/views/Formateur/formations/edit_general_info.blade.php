<div class="card-body">
    <hr>
    <div class="form-group row">
        <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Titre de la formation') }}</label>
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
        <label for="type_display" class="col-md-2 col-form-label text-md-right">{{ __('Type de formation') }}</label>
        <div class="col-md-8">
            <input type="hidden" name="type" value="video">
            <input id="type_display" type="text" class="form-control" value="Formation de type vidéo" disabled>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="photo_type" class="col-md-2 col-form-label text-md-right">{{ __('Image représentative de la formation') }}</label>
        <div class="col-md-8">
            <input id="photo_type" type="file" class="form-control @error('photo_type') is-invalid @enderror" accept="image/*" name="photo_type">
            @if($formation->image_url)
                <div class="mt-2">
                    
                    <img src="{{ asset($formation->image_url) }}" alt="Aperçu de l'image actuelle" id="current_image" style="max-width: 300px; max-height: 300px; display: block;">
                </div>
            @endif
            <span style="color: red; display: none;" class="text-center" id="message"></span>
            @error('photo_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="mt-2">
                <p id="new_photo_name" style="display: none;">Nouvelle photo : <span id="new_photo_filename"></span></p>
                <img id="image_preview" src="#" alt="Aperçu de la nouvelle image" style="max-width: 300px; max-height: 300px; display: none;">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Petite description') }}</label>
        <div class="col-md-8">
            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" rows="2" cols="60">{{ old('description', $formation->description) }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="category_id" class="col-md-2 col-form-label text-md-right">{{ __('Choisissez la catégorie') }}</label>
        <div class="col-md-8">
            <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required autocomplete="category_id">
                <option value="">Choisissez la catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $formation->category_id) == $category->id ? 'selected' : '' }}>{{ $category->nom }}</option>
                @endforeach
                <option value="autre" {{ old('category_id') == 'autre' ? 'selected' : '' }}>Autre</option>
            </select>
            @error('category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row" id="autre" style="display: {{ old('category_id') == 'autre' ? 'block' : 'none' }};">
        <label for="categorie" class="col-md-2 col-form-label text-md-right">{{ __('Catégorie de la formation') }}</label>
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
            <input id="duree" type="text" class="form-control @error('duree') is-invalid @enderror" name="duree" value="{{ old('duree', $formation->duree) }}" required autocomplete="duree" autofocus>
            @error('duree')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="payante_ou_non" class="col-md-2 col-form-label text-md-right">{{ __('La formation est payante ?') }}</label>
        <div class="col-md-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="payante_ou_non" id="flexRadioDefault1" onclick="checkPayante()" value="Oui" {{ old('payante_ou_non', $formation->payante_ou_non) == 'Oui' ? 'checked' : '' }} required>
                <label class="form-check-label" for="flexRadioDefault1">Oui</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="payante_ou_non" id="flexRadioDefault2" onclick="checkPayante()" value="Non" {{ old('payante_ou_non', $formation->payante_ou_non) == 'Non' ? 'checked' : '' }}>
                <label class="form-check-label" for="flexRadioDefault2">Non</label>
            </div>
            @error('payante_ou_non')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row" id="prix_formation" style="display: {{ old('payante_ou_non', $formation->payante_ou_non) == 'Oui' ? 'block' : 'none' }};">
        <label for="prix_formation" class="col-md-2 col-form-label text-md-right">{{ __('Prix de la formation') }}</label>
        <div class="col-md-8">
            <input id="prix_formation" type="number" class="form-control @error('prix_formation') is-invalid @enderror" name="prix_formation" value="{{ old('prix_formation', $formation->prix_formation) }}" autocomplete="prix_formation" autofocus>
            @error('prix_formation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row" id="prix_certification" style="display: {{ old('payante_ou_non', $formation->payante_ou_non) == 'Non' || old('payante_ou_non', $formation->payante_ou_non) == 'Oui' ? 'block' : 'none' }};">
        <label for="prix_certification" class="col-md-2 col-form-label text-md-right">{{ __('Prix de la certification') }}</label>
        <div class="col-md-8">
            <input id="prix_certification" type="number" class="form-control @error('prix_certification') is-invalid @enderror" name="prix_certification" value="{{ old('prix_certification', $formation->prix_certification) }}" autocomplete="prix_certification" autofocus>
            @error('prix_certification')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

@section('scripts')
<script>
    const photoTypeInput = document.getElementById('photo_type');
    const imagePreview = document.getElementById('image_preview');
    const currentImage = document.getElementById('current_image');
    const currentPhotoName = document.getElementById('current_photo_name');
    const newPhotoName = document.getElementById('new_photo_name');
    const newPhotoFilename = document.getElementById('new_photo_filename');

    photoTypeInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            // Afficher le nom de la nouvelle photo
            newPhotoFilename.textContent = file.name;
            newPhotoName.style.display = 'block';

            // Afficher l'aperçu de la nouvelle photo
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                if (currentImage) {
                    currentImage.style.display = 'none'; // Masquer l'image actuelle
                }
                if (currentPhotoName) {
                    currentPhotoName.parentElement.style.display = 'none'; // Masquer le nom actuel
                }
            }
            reader.readAsDataURL(file);
        } else {
            // Réinitialiser si aucun fichier n'est sélectionné
            newPhotoName.style.display = 'none';
            imagePreview.style.display = 'none';
            if (currentImage) {
                currentImage.style.display = 'block'; // Réafficher l'image actuelle
            }
            if (currentPhotoName) {
                currentPhotoName.parentElement.style.display = 'block'; // Réafficher le nom actuel
            }
        }
    });

    // Gérer l'affichage du champ "autre" catégorie
    document.getElementById('category_id').addEventListener('change', function() {
        const autreDiv = document.getElementById('autre');
        autreDiv.style.display = this.value === 'autre' ? 'block' : 'none';
    });

    // Gérer l'affichage des champs de prix
    function checkPayante() {
        const payanteOui = document.getElementById('flexRadioDefault1').checked;
        document.getElementById('prix_formation').style.display = payanteOui ? 'block' : 'none';
        document.getElementById('prix_certification').style.display = 'block'; // Toujours visible
    }

    // Appeler checkPayante au chargement pour garantir l'état initial
    document.addEventListener('DOMContentLoaded', checkPayante);

   

    $(document).ready(function () {
        var navListItems = $('div.setup-panel div a');
        var allWells = $('.setup-content');
        var allNextBtn = $('.nextBtn');

        allWells.hide(); // Cacher toutes les étapes

        // Lorsqu'on clique sur un lien de la barre de navigation
        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href'));
            var $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
            }
        });

        // Bouton Suivant
        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content");
            var curStepId = curStep.attr("id");
            var nextStepWizard = $('div.setup-panel div a[href="#' + curStepId + '"]').parent().next().children("a");

            // Activer l'étape suivante
            nextStepWizard.removeClass('disabled');

            // Aller à l'étape suivante automatiquement
            nextStepWizard.trigger('click');
        });

        // Lancer à la première étape au chargement
        $('div.setup-panel div a.btn-primary').trigger('click');
    });


</script>
@endsection

