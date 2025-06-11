@extends('Admin.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

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
        <!-- ... -->
<table id="demandeTable" class="table table-striped align-middle">
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
                <td>{{ $request->domaines_expertise }}</td>
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
<!-- ... -->
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#demandeTable').DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
        }
    });
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
.table td, .table th {
    vertical-align: middle;
    text-align: center;
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
</style>
@endsection