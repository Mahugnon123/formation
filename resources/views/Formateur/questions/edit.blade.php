@extends('Formateur.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Modifier la Question : {{ $question->titre }}</h4>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Modifier la Question</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('formateur.questions.update', [$formation->slug, $question->id]) }}" method="POST" id="question-form">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="type" class="form-label">Type de Question</label>
                        <select name="type" id="type" class="form-control" onchange="toggleFields()" required>
                            <option value="Vrai/Faux" {{ $question->type === 'Vrai/Faux' ? 'selected' : '' }}>Vrai/Faux</option>
                            <option value="QCM" {{ $question->type === 'QCM' ? 'selected' : '' }}>QCM</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre de la Question</label>
                        <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $question->titre) }}" required>
                        @error('titre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" required>{{ old('description', $question->description) }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Champs pour Vrai/Faux -->
                    <div id="true_false_fields" style="display: {{ $question->type === 'Vrai/Faux' ? 'block' : 'none' }};">
                        <div class="mb-3">
                            <label for="correct_option" class="form-label">Réponse Correcte</label>
                            <select name="correct_option" id="correct_option" class="form-control">
                                <option value="Vrai" {{ old('correct_option', $question->reponses->firstWhere('is_correct', 1)?->text) === 'Vrai' ? 'selected' : '' }}>Vrai</option>
                                <option value="Faux" {{ old('correct_option', $question->reponses->firstWhere('is_correct', 1)?->text) === 'Faux' ? 'selected' : '' }}>Faux</option>
                            </select>
                            @error('correct_option')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Champs pour QCM -->
                    <div id="qcm_fields" style="display: {{ $question->type === 'QCM' ? 'block' : 'none' }};">
                        <div class="mb-3">
                            <label class="form-label">Options</label>
                            <div id="options-container">
                                @foreach ($question->reponses as $index => $reponse)
                                    <div class="mb-2 option-group" data-index="{{ $index }}">
                                        <input type="text" name="options[]" class="form-control option-input" value="{{ old('options.' . $index, $reponse->text) }}" required>
                                        <input type="hidden" name="reponse_ids[]" value="{{ $reponse->id }}">
                                        <button type="button" class="btn btn-danger btn-sm mt-1 remove-option">Supprimer</button>
                                    </div>
                                @endforeach
                                @if ($question->type === 'QCM' && $question->reponses->isEmpty())
                                    <div class="mb-2 option-group" data-index="0">
                                        <input type="text" name="options[]" class="form-control option-input" value="" required>
                                        <input type="hidden" name="reponse_ids[]" value="">
                                        <button type="button" class="btn btn-danger btn-sm mt-1 remove-option">Supprimer</button>
                                    </div>
                                    <div class="mb-2 option-group" data-index="1">
                                        <input type="text" name="options[]" class="form-control option-input" value="" required>
                                        <input type="hidden" name="reponse_ids[]" value="">
                                        <button type="button" class="btn btn-danger btn-sm mt-1 remove-option">Supprimer</button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-secondary mt-2" id="add-option">Ajouter une Option</button>
                            @error('options')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Réponses Correctes</label>
                            <div id="correct-options-container">
                                <!-- Cases à cocher générées dynamiquement -->
                            </div>
                            <small class="form-text text-muted">Cochez les options correctes.</small>
                            @error('correct_option')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('formateur.questions.show', $formation->slug) }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function addOption() {
    const container = document.getElementById('options-container');
    const index = container.querySelectorAll('.option-group').length;
    const newOption = document.createElement('div');
    newOption.className = 'mb-2 option-group';
    newOption.setAttribute('data-index', index);
    newOption.style.transition = 'all 0.3s';
    newOption.style.opacity = 0;
    newOption.innerHTML = `
        <input type="text" name="options[]" class="form-control option-input" value="" required>
        <input type="hidden" name="reponse_ids[]" value="">
        <button type="button" class="btn btn-danger btn-sm mt-1 remove-option" style="display: none;">Supprimer</button>
    `;
    container.appendChild(newOption);

    setTimeout(() => { newOption.style.opacity = 1; }, 10);

    updateCorrectOptions();
    toggleRemoveButtons();
    newOption.querySelector('.option-input').focus();

    // Ajoute l'événement de suppression
    newOption.querySelector('.remove-option').addEventListener('click', function() {
        removeOption(this);
    });
}

// Affiche le bouton supprimer au survol
document.addEventListener('mouseover', function(event) {
    if (event.target.classList.contains('option-group')) {
        const btn = event.target.querySelector('.remove-option');
        if (btn) btn.style.display = 'inline-block';
    }
});
document.addEventListener('mouseout', function(event) {
    if (event.target.classList.contains('option-group')) {
        const btn = event.target.querySelector('.remove-option');
        if (btn) btn.style.display = '';
    }
});

function removeOption(button) {
    const optionGroup = button.closest('.option-group');
    optionGroup.style.opacity = 0;
    setTimeout(() => {
        optionGroup.remove();
        updateCorrectOptions();
        toggleRemoveButtons();
    }, 200);
}

function toggleRemoveButtons() {
    const removeButtons = document.querySelectorAll('.remove-option');
    removeButtons.forEach(button => {
        button.style.display = removeButtons.length > 2 ? 'inline-block' : 'none';
    });
}

function updateCorrectOptions() {
    const container = document.getElementById('options-container');
    const correctOptionsContainer = document.getElementById('correct-options-container');
    correctOptionsContainer.innerHTML = '';
    const options = container.querySelectorAll('.option-group');
    let correctIds = [];
    try {
        correctIds = {!! json_encode(json_decode($question->reponse_correcte ?? '[]', true)) !!} || [];
    } catch (e) {
        correctIds = [];
    }

    options.forEach((option, index) => {
        const reponseId = option.querySelector('[name="reponse_ids[]"]').value || '';
        const isChecked = correctIds.includes(parseInt(reponseId)) ? 'checked' : '';
        const optionValue = option.querySelector('.option-input').value || `Option ${index + 1}`;
        const checkbox = document.createElement('div');
        checkbox.className = 'form-check mb-2';
        checkbox.innerHTML = `
            <input type="checkbox" name="correct_option[]" value="${index}" class="form-check-input" id="correct_option_${index}" ${isChecked}>
            <label class="form-check-label" for="correct_option_${index}">${optionValue}</label>
        `;
        correctOptionsContainer.appendChild(checkbox);

        // Mettre à jour le libellé en temps réel
        const input = option.querySelector('.option-input');
        input.addEventListener('input', () => {
            checkbox.querySelector('label').textContent = input.value || `Option ${index + 1}`;
        });
    });
}

function toggleFields() {
    const type = document.getElementById('type').value;
    document.getElementById('true_false_fields').style.display = type === 'Vrai/Faux' ? 'block' : 'none';
    document.getElementById('qcm_fields').style.display = type === 'QCM' ? 'block' : 'none';
    if (type === 'QCM') {
        updateCorrectOptions();
        toggleRemoveButtons();
    }
}

// Validation avant soumission
document.getElementById('question-form').addEventListener('submit', function(event) {
    const type = document.getElementById('type').value;
    if (type === 'QCM') {
        const options = document.querySelectorAll('#options-container input[name="options[]"]');
        const correctOptions = document.querySelectorAll('#correct-options-container input[name="correct_option[]"]:checked');
        if (options.length < 2) {
            event.preventDefault();
            alert('Veuillez ajouter au moins 2 options.');
        } else if (correctOptions.length === 0) {
            event.preventDefault();
            alert('Veuillez sélectionner au moins une réponse correcte.');
        }
    }
});

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    toggleFields();
    updateCorrectOptions();
    toggleRemoveButtons();
    document.getElementById('add-option').addEventListener('click', addOption);
    document.querySelectorAll('.remove-option').forEach(button => {
        button.addEventListener('click', function() {
            removeOption(this);
        });
    });
});
</script>
@endpush