@extends('Formateur.app')
@section('content')
<div class="container my-5">
    <h3>Vos apprenants inscrits à vos formations</h3>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Date d'inscription</th>
                <th>Formation</th>
            </tr>
        </thead>
        <tbody>
            @forelse($apprenants as $apprenant)
                <tr>
                    <td>{{ $apprenant->nom }} {{ $apprenant->prenom }}</td>
                    <td>{{ $apprenant->email }}</td>
                    <td>
                        @foreach($apprenant->inscriptions as $inscription)
                            @if(in_array($inscription->formation_id, $formations->toArray()))
                                {{ $inscription->created_at->format('d/m/Y') }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($apprenant->inscriptions as $inscription)
                            @if(in_array($inscription->formation_id, $formations->toArray()))
                                {{ $inscription->formation->titre }}<br>
                            @endif
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Aucun apprenant inscrit à vos formations.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection