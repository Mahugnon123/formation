@extends('Formateur.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Ajouter une Question pour : {{ $formation->titre }}</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('formateur.questions.store', $formation->slug) }}" method="POST">
                    @csrf
                    <!-- Affichage des erreurs -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="type" class="form-label">Type de Question</label>
                        <select name="type" id="type" class="form-control" required onchange="updateFields()">
                            <option value="">Sélectionner un type</option>
                            <option value="Vrai/Faux">Vrai/Faux</option>
                            <option value="QCM">QCM</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre de la Question</label>
                        <input type="text" name="titre" id="titre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>

                    <!-- Champs pour Vrai/Faux -->
                    <div id="true_false_fields" style="display: none;">
                        <div class="mb-3">
                            <label for="correct_option" class="form-label">Réponse Correcte</label>
                            <select name="correct_option" id="correct_option" class="form-control" required>
                                <option value="">Sélectionner une réponse</option>
                                <option value="Vrai">Vrai</option>
                                <option value="Faux">Faux</option>
                            </select>
                        </div>
                    </div>

                    <!-- Champs pour QCM -->
                    <div id="qcm_fields" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label">Options</label>
                            <div id="options-container">
                                <div class="mb-2 option-group">
                                    <input type="text" name="options[]" class="form-control" placeholder="Option 1" required>
                                    <button type="button" class="btn btn-danger btn-sm mt-1 remove-option" style="display: none;">Supprimer</button>
                                </div>
                                <div class="mb-2 option-group">
                                    <input type="text" name="options[]" class="form-control" placeholder="Option 2" required>
                                    <button type="button" class="btn btn-danger btn-sm mt-1 remove-option" style="display: none;">Supprimer</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary mt-2" onclick="addOption()">Ajouter une option</button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Réponses Correctes (Indices)</label>
                            <div id="correct-options-container">
                                <!-- Les cases à cocher seront générées dynamiquement -->
                            </div>
                            <small class="form-text text-muted">Cochez les indices des réponses correctes (0 pour la première option, 1 pour la deuxième, etc.).</small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>

   @section('scripts')
<script>
function addOption() {
    const container = document.getElementById('options-container');
    const index = container.querySelectorAll('.option-group').length;
    const newOption = document.createElement('div');
    newOption.classList.add('mb-2', 'option-group');
    newOption.style.transition = 'all 0.3s';
    newOption.innerHTML = `
        <input type="text" name="options[]" class="form-control" placeholder="Option ${index + 1}" required>
        <button type="button" class="btn btn-danger btn-sm mt-1 remove-option" style="display: none;">Supprimer</button>
    `;
    container.appendChild(newOption);

    // Animation d'apparition
    newOption.style.opacity = 0;
    setTimeout(() => { newOption.style.opacity = 1; }, 10);

    updateCorrectOptions();
    toggleRemoveButtons();

    // Focus sur la nouvelle option
    newOption.querySelector('input').focus();
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
    // Animation de disparition
    optionGroup.style.opacity = 0;
    setTimeout(() => {
        optionGroup.remove();
        updateCorrectOptions();
        toggleRemoveButtons();
    }, 200);
}

function toggleRemoveButtons() {
    const removeButtons = document.querySelectorAll('.remove-option');
    const optionGroups = document.querySelectorAll('.option-group');
    removeButtons.forEach(button => {
        button.style.display = optionGroups.length > 2 ? 'inline-block' : 'none';
    });
}

function updateCorrectOptions() {
    const container = document.getElementById('options-container');
    const correctOptionsContainer = document.getElementById('correct-options-container');
    correctOptionsContainer.innerHTML = '';
    const options = container.querySelectorAll('.option-group');
    options.forEach((option, index) => {
        const input = option.querySelector('input');
        const checkbox = document.createElement('div');
        checkbox.className = 'form-check mb-2';
        checkbox.innerHTML = `
            <input type="checkbox" name="correct_option[]" value="${index}" class="form-check-input" id="correct_option_${index}">
            <label class="form-check-label" for="correct_option_${index}">${input.value ? input.value : `Option ${index + 1}`}</label>
        `;
        correctOptionsContainer.appendChild(checkbox);

        // Met à jour le label dynamiquement
        input.addEventListener('input', function() {
            checkbox.querySelector('label').textContent = input.value ? input.value : `Option ${index + 1}`;
        });
    });
}

function updateFields() {
    const typeSelect = document.getElementById('type');
    const type = typeSelect.value;
    const trueFalseFields = document.getElementById('true_false_fields');
    const qcmFields = document.getElementById('qcm_fields');

    trueFalseFields.style.display = 'none';
    qcmFields.style.display = 'none';

    document.querySelectorAll('#true_false_fields select').forEach(field => {
        field.disabled = true;
        field.value = '';
    });
    document.querySelectorAll('#qcm_fields input').forEach(field => {
        field.disabled = true;
        field.value = '';
    });

    if (type === 'Vrai/Faux') {
        trueFalseFields.style.display = 'block';
        document.querySelectorAll('#true_false_fields select').forEach(field => {
            field.disabled = false;
        });
        document.querySelectorAll('#qcm_fields input').forEach(field => field.disabled = true);
    } else if (type === 'QCM') {
        qcmFields.style.display = 'block';
        document.querySelectorAll('#qcm_fields input').forEach(field => {
            field.disabled = false;
        });
        document.querySelectorAll('#true_false_fields select').forEach(field => field.disabled = true);
        updateCorrectOptions();
        toggleRemoveButtons();
    }
}

// Validation avant soumission
document.querySelector('form').addEventListener('submit', function(event) {
    const type = document.getElementById('type').value;
    if (!type) {
        event.preventDefault();
        alert('Veuillez sélectionner un type de question.');
        return;
    }

    if (type === 'Vrai/Faux') {
        const correctOption = document.querySelector('#true_false_fields select[name="correct_option"]').value;
        if (!correctOption) {
            event.preventDefault();
            alert('Veuillez sélectionner une réponse correcte pour Vrai/Faux.');
        }
    } else if (type === 'QCM') {
        const options = document.querySelectorAll('#qcm_fields input[name="options[]"]:not(:disabled)');
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
    updateFields();
    document.getElementById('type').addEventListener('change', updateFields);
    document.querySelectorAll('#options-container input').forEach(input => {
        input.addEventListener('input', updateCorrectOptions);
    });
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-option')) {
            removeOption(event.target);
        }
    });
});
</script>
@endsection
@endsection