@extends("Admin.app")

@section("content")
<style>
/* Désactiver l'effet de survol sur les lignes de la table */
#categoriesTable tbody tr:hover {
    background-color: inherit !important;
}

/* Style pour la barre de recherche DataTables */
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 15px;
    text-align: right;
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    height: auto !important;
    min-height: 40px !important;
    background-color: #fff !important;
}

/* Style pour le champ de recherche */
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #d1e7ff;
    border-radius: 4px;
    padding: 6px 12px;
    width: 300px;
    font-size: 14px;
}

.dataTables_wrapper .dataTables_filter label {
    font-weight: bold;
    color: rgb(18, 70, 118);
}

/* Style pour la pagination */
.dataTables_wrapper .dataTables_paginate {
    margin-top: 15px;
    text-align: right;
    display: block !important;
    visibility: visible !important;
}

/* Style pour la longueur de la page */
.dataTables_wrapper .dataTables_length {
    margin-bottom: 15px;
    display: block !important;
    visibility: visible !important;
}

/* Style pour le toast */
.toast {
    min-width: 200px;
    opacity: 0.9;
    background-color: #f8f9fa;
    border: 1px solid #d1e7ff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 10px auto;
    max-width: 500px;
}

.toast-header {
    background-color: #e9ecef;
    color: #495057;
    font-size: 14px;
    padding: 5px 10px;
}

.toast-body {
    font-size: 14px;
    color: #6c757d;
    padding: 10px;
}

.btn-close {
    font-size: 12px;
}
</style>

<div class="container mt-4">
    <div class="row align-items-center mb-3">
        <div class="col-md-auto ms-5">
            <button class="btn d-flex align-items-center"
                style="border: 1px solid #d1e7ff; background-color: #ffffff; color: rgb(18, 70, 118); padding: 6px 12px; border-radius: 4px;"
                data-toggle="modal" data-target="#createCategoryModal">
                <i class="bx bx-plus me-2"></i> Ajouter une nouvelle catégorie
            </button>
        </div>
    </div>

    <!-- Modal pour la création d'une catégorie -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-0 border-0 p-4">
                <div class="modal-header border-0">
                    <h3 id="createCategoryModalLabel">Créer une nouvelle catégorie</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST" id="createCategoryForm" class="row">
                        @csrf
                        <div class="col-12 mb-3">
                            <label for="nom">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12">
                            <div id="formMessage" class="alert d-none"></div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary uniform-btn">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTable pour la liste des catégories -->
<div class="col-xl">
    <div class="card mb-4 m-2">
        <div class="card-header">
            <h5 class="mb-0 text-center">Liste des catégories</h5>
        </div>
        <div class="card-body">
            <table id="categoriesTable" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom de la catégorie</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $index => $categorie)
                        <tr data-id="{{ $categorie->id }}" data-description="{{ htmlspecialchars($categorie->description ?? '') }}">
                            <td>{{ $categorie->nom ?? 'N/A' }}</td>
                            <td>
                                @if(!is_null($categorie->description) && $categorie->description !== '')
                                    @php
                                        $description = $categorie->description;
                                        if (strlen($description) > 500) {
                                            $description = substr($description, 0, 500);
                                            $lastSpace = strrpos($description, ' ');
                                            if ($lastSpace !== false) {
                                                $description = substr($description, 0, $lastSpace);
                                            }
                                            $description .= '...';
                                        }
                                    @endphp
                                    {{ $description }}
                                @else
                                    Aucune description
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary me-2 edit-btn" data-toggle="modal" data-target="#editModal{{ $index }}" data-index="{{ $index }}">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal{{ $index }}" data-index="{{ $index }}">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Message de succès sous la DataTable -->
            @if (session()->has('message'))
                <div id="success-message" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="5000">
                    <div class="toast-header">
                        <strong class="mr-auto">Succès</strong>
                        <button type="button" class="btn-close" data-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session()->get('message') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modals de modification et suppression -->
@foreach($categories as $index => $categorie)
    <!-- Modal de modification -->
    <div class="modal fade" id="editModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $index }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-0 border-0 p-4">
                <div class="modal-header border-0">
                    <h3 id="editModalLabel{{ $index }}">Modifier la catégorie</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.categories.update', $categorie->id) }}" id="editCategoryForm{{ $index }}" class="row">
                        @csrf
                        @method('PUT')
                        <div class="col-12 mb-3">
                            <label for="edit_nom{{ $index }}" class="form-label">Nom de la catégorie <span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control" id="edit_nom{{ $index }}" value="{{ $categorie->nom ?? '' }}" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="edit_description{{ $index }}" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="edit_description{{ $index }}" name="description" rows="4" required>{{ $categorie->description ?? '' }}</textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12">
                            <div id="formMessage{{ $index }}" class="alert d-none"></div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary uniform-btn">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de suppression -->
    <div class="modal fade" id="deleteModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $index }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-0 border-0 p-4">
                <div class="modal-header border-0">
                    <h3 id="deleteModalLabel{{ $index }}">Confirmer la suppression</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.categories.destroy', $categorie->id) }}" class="row">
                        @csrf
                        @method('DELETE')
                        <div class="col-12 mb-3">
                            <p>Voulez-vous vraiment supprimer <strong>{{ $categorie->nom ?? 'N/A' }}</strong> ?</p>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-danger uniform-btn">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    console.log('Initialisation de DataTables');
    try {
        var table = $('#categoriesTable').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "Aucune donnée disponible dans le tableau",
                "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                "infoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                "infoFiltered": "(filtré de _MAX_ entrées au total)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Afficher _MENU_ entrées",
                "loadingRecords": "Chargement...",
                "processing": "Traitement...",
                "search": "Rechercher :",
                "zeroRecords": "Aucun enregistrement correspondant trouvé",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                },
                "aria": {
                    "sortAscending": ": activer pour trier la colonne par ordre croissant",
                    "sortDescending": ": activer pour trier la colonne par ordre décroissant"
                }
            },
            pageLength: 10,
            columnDefs: [
                { orderable: false, targets: 2 }
            ],
            searching: true,
            paging: true,
            lengthChange: true,
            info: true,
            dom: 'lfrtip'
        });
        console.log('DataTables initialisé avec succès');
    } catch (error) {
        console.error('Erreur lors de l\'initialisation de DataTables :', error);
    }

    // Afficher le toast si présent
    $('.toast').toast('show');

    // Charger la description dans les modals de modification
    @foreach($categories as $index => $categorie)
        $('#editModal{{ $index }}').on('show.bs.modal', function() {
            console.log('Description chargée pour l\'index {{ $index }} :', @json($categorie->description ?? ''));
            $('#edit_description{{ $index }}').val(@json($categorie->description ?? ''));
        });
    @endforeach

    // Gérer le focus lors de la fermeture du modal createCategoryModal
    $('#createCategoryModal').on('hidden.bs.modal', function(event) {
        if (document.activeElement) {
            document.activeElement.blur();
        }
    });

    // Limiter la saisie à 500 caractères pour la description (création)
    $('#description').on('input', function() {
        const maxLength = 500;
        const currentLength = $(this).val().length;
        if (currentLength > maxLength) {
            $(this).val($(this).val().substring(0, maxLength));
            $('#formMessage').removeClass('d-none').addClass('alert-danger').text('La description ne peut pas dépasser 500 caractères.');
        } else {
            $('#formMessage').addClass('d-none').text('');
        }
    });

    // Limiter la saisie à 500 caractères pour la description (modification)
    @foreach($categories as $index => $categorie)
        $('#edit_description{{ $index }}').on('input', function() {
            const maxLength = 500;
            const currentLength = $(this).val().length;
            if (currentLength > maxLength) {
                $(this).val($(this).val().substring(0, maxLength));
                $('#formMessage{{ $index }}').removeClass('d-none').addClass('alert-danger').text('La description ne peut pas dépasser 500 caractères.');
            } else {
                $('#formMessage{{ $index }}').addClass('d-none').text('');
            }
        });
    @endforeach
});
</script>
@endsection