@extends('Admin.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<div class="container mt-5">
    <h2 class="text-center mb-4">Toutes les demandes</h2>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($requests->isEmpty())
        <p class="text-center">Aucune demande.</p>
    @else
        <div class="table-responsive">
            <table id="demandeTable" class="table table-striped align-middle text-center">
                <thead class="table-custom-header">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Domaines</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td><a href="{{ route('admin.partner-requests.show', $request->id) }}">{{ $request->nom_complet }} {{ $request->prenom }}</a></td>
                            <td>{{ $request->email }}</td>
                            <td>{{ $request->telephone }}</td>
                            <td title="{{ $request->domaines_expertise }}">
                                {{ Str::limit($request->domaines_expertise, 20, '...') }}
                            </td>
                            <td>{{ $request->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if ($request->statut == 'en_attente')
                                    <form action="{{ route('admin.partner-requests.approve', $request->id) }}" method="POST" style="display:inline;" class="d-inline approve-form">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0">
                                            <i class="bx bx-check-circle text-success fs-1"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.partner-requests.reject', $request->id) }}" method="POST" style="display:inline;" class="d-inline reject-form">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0">
                                            <i class="bx bx-x-circle text-danger fs-1"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">Aucune action</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script>
$(document).ready(function() {
    $('#demandeTable').DataTable({
        responsive: true,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const telInput = document.getElementById('telephone');
    if (telInput) {
        telInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);
        });
    }
});
</script>

<style>
body {
    background-color: #f4f4f4;
}
.table-custom-header th {
    background-color: #e0e0e0 !important; /* gris cendré */
    color: #111 !important; /* noir pour le texte */
    font-weight: bold;
    text-align: center;
    vertical-align: middle;
    font-size: 1.05em;
    letter-spacing: 0.5px;
}
.table th, .table td {
    text-align: center !important;
    vertical-align: middle !important;
    justify-content: center;
    align-items: center;
}
.table-striped > tbody > tr:nth-of-type(odd) {
    background-color: #f8f9fa;
}
.table td, .table th {
    vertical-align: middle !important;
    text-align: center;
    padding-top: 8px;
    padding-bottom: 8px;
}
@media (max-width: 767.98px) {
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    #demandeTable {
        min-width: 600px;
    }
}
</style>
@endsection