@extends('Formateur.app')
@section('content')
<div class="container my-5">
    <h3 style=" color: #1976d2; font-weight: bold; padding: 18px 24px; border-radius: 10px; box-shadow: 0 2px 8px rgba(25,118,210,0.08); display: flex; align-items: center; gap: 12px;">
        <i class="bi bi-mortarboard-fill" style="font-size: 2rem;"></i>
        Formations que vous aviez ajoutées suivies par {{ $apprenant->nom }} {{ $apprenant->prenom }}
    </h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Date d'inscription</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($formations as $f)
                <tr>
                    <td>{{ $f['titre'] }}</td>
                    <td>{{ $f['date_inscription'] }}</td>
                    <td>{{ $f['status'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Aucune formation suivie.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('formateur.apprenants') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection