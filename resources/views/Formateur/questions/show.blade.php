@extends('Formateur.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Questions de Test pour : {{ $formation->titre }}</h4>

        <div class="card">
             <form id="searchForm" method="GET" action="" class="form-inline mb-3">
    <div class="form-group">
        <input type="text" id="searchInput" name="search" class="form-control" placeholder="Rechercher par titre..." value="">
    </div>
    <button type="submit" class="btn btn-primary ml-2">Rechercher</button>
</form>
            <div class="card-header d-flex justify-content-between align-items-center">
                
                <h5 class="mb-0">Liste des Questions</h5>
                <a href="{{ route('formateur.questions.create', $formation->slug) }}" class="btn btn-primary">Ajouter une Question</a>
            </div>
            <div class="card-body">
               
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($questions->isEmpty())
                    <p>Aucune question trouvée pour cette formation.</p>
                @else
                    <table class="table" id="questionsTable">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Réponses</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{ $question->type }}</td>
                                    <td>{{ $question->titre }}</td>
                                    <td>{{ $question->description }}</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            @foreach ($question->reponses as $reponse)
                                                <li>
                                                    <span class="badge {{ $reponse->is_correct ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $reponse->text }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('formateur.questions.edit', [$formation->slug, $question->id]) }}"
                                           class="btn btn-sm btn-primary" title="Modifier">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('formateur.questions.destroy', [$formation->slug, $question->id]) }}"
                                              method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="btn btn-sm btn-danger"
                                                data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-action="{{ route('formateur.questions.destroy', [$formation->slug, $question->id]) }}"
                                                title="Supprimer">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p id="noResultMsg" style="display:none;" class="text-center text-muted mt-3">
    Aucune question ne correspond à votre recherche.
</p>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h4 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h4>
        </div>
        <div class="modal-body">
          Voulez-vous vraiment supprimer cette question ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-danger">Supprimer</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchInput');
    var table = document.getElementById('questionsTable');
    var noResultMsg = document.getElementById('noResultMsg');
    var searchForm = document.getElementById('searchForm');
    if (!searchInput || !table) return;

    // Empêche le submit du formulaire
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        filterQuestions();
    });

    // Filtrage en temps réel
    searchInput.addEventListener('keyup', filterQuestions);

    function filterQuestions() {
        var filter = searchInput.value.toLowerCase();
        var rows = table.querySelectorAll('tbody tr');
        var visibleCount = 0;
        rows.forEach(function(row) {
            var titre = row.children[1].textContent.toLowerCase();
            if (titre.indexOf(filter) > -1) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        noResultMsg.style.display = (visibleCount === 0) ? 'block' : 'none';
    }

    // Lance le filtrage au chargement si un terme est déjà présent
    filterQuestions();

    // Ajout pour la suppression dynamique
    // Quand on clique sur un bouton supprimer, on met à jour l'action du formulaire de la modale
    document.querySelectorAll('button[data-toggle="modal"][data-target="#deleteModal"]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var action = btn.getAttribute('data-action');
            document.getElementById('deleteForm').setAttribute('action', action);
        });
    });
});
</script>
@endsection
