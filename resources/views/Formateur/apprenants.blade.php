@extends('Formateur.app')
@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="bi bi-people-fill me-2"></i>Vos apprenants inscrits à vos formations</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive p-3">
                <table id="apprenantsTable" class="table table-striped table-hover align-middle mb-0" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>NOM</th>
                            <th>PRÉNOM</th>
                            <th>EMAIL</th>
                            <th>FORMATIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($apprenants as $data)
                            <tr>
                                <td><span style="font-weight:600; color:#1976d2;">{{ $data['apprenant']->nom }}</span></td>
                                <td>{{ $data['apprenant']->prenom }}</td>
                                <td><a href="mailto:{{ $data['apprenant']->email }}" style="color:#333; text-decoration:underline;">{{ $data['apprenant']->email }}</a></td>
                                <td>
                                    @php
                                        $formationsData = array_map(function($f) {
                                            return [
                                                "titre" => $f->titre,
                                                "date" => $f->date_inscription ?? null,
                                                "progression" => $f->progression ?? null,
                                                "statut" => $f->status ?? null
                                            ];
                                        }, $data["formations"]);
                                    @endphp
                                    @if(count($data['formations']) > 0)
                                        <span style="color:#18804b;font-weight:600;">{{ count($data['formations']) }} suivie(s)</span><br>
                                        <a href="{{ route('formateur.apprenant.formations', $data['apprenant']->id) }}" class="btn btn-sm btn-primary mt-1">
                                            Voir tout
                                        </a>
                                    @else
                                        <span class="text-muted">Aucune</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Aucun apprenant inscrit à vos formations.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour afficher les formations -->
<div class="modal fade" id="formationsModal" tabindex="-1" role="dialog" aria-labelledby="formationsModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="formationsModalLabel">Formations suivies</h4>
      </div>
      <div class="modal-body">
        <div id="formationsList"></div>
      </div>
    </div>
  </div>
</div>

<!-- DataTables CSS & JS + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap.min.css"/>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#apprenantsTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
        },
        pageLength: 8,
        lengthMenu: [ [8, 15, 25, 50, -1], [8, 15, 25, 50, "Tous"] ],
        columnDefs: [
            { orderable: false, targets: [3] } // Désactive le tri sur Formations
        ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Exporter en Excel',
                className: 'btn btn-secondary mb-2 me-2'
            },
            {
                extend: 'pdfHtml5',
                text: 'Exporter en PDF',
                className: 'btn btn-secondary mb-2'
            }
        ]
    });

    // Modal formations
    $(document).on('click', '.voir-formations-btn', function() {
        var formations = $(this).data('formations');
        var nom = $(this).data('nom');
        $('#formationsModalLabel').text('Formations suivies par ' + nom);
        var list = '';
        if (formations.length > 0) {
            list += '<table class="table table-bordered"><thead><tr><th>Titre</th><th>Date</th><th>Progression</th><th>Statut</th></tr></thead><tbody>';
            formations.forEach(function(f) {
                list += '<tr>' +
                    '<td>' + (f.titre ?? '-') + '</td>' +
                    '<td>' + (f.date ?? '-') + '</td>' +
                    '<td>' + (f.progression ?? '-') + '</td>' +
                    '<td>' + (f.statut ?? '-') + '</td>' +
                '</tr>';
            });
            list += '</tbody></table>';
        } else {
            list = '<div class="text-muted">Aucune formation</div>';
        }
        $('#formationsList').html(list);
        $('#formationsModal').modal('show'); // <-- Bootstrap 3
    });
});

$(function() {
    $('#formationsModal').modal('show');
});
</script>

<style>
    .card-header {
        border-bottom: 2px solid #1976d2;
    }
    .badge.bg-success {
        background-color: #18804b !important;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .dataTables_filter input {
        border-radius: 20px;
        border: 1px solid #1976d2;
        padding: 4px 12px;
    }
    .dataTables_length select {
        border-radius: 8px;
        border: 1px solid #1976d2;
        padding: 2px 8px;
    }
    .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        margin: 0 2px;
    }
    .dt-buttons .btn {
        margin-right: 8px;
    }
    .voir-formations-btn {
        border-radius: 18px;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(25,118,210,0.08);
    }
</style>


@endsection