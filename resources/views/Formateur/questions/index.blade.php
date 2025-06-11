@extends('Formateur.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Questions de Test</h4>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Vos Formations</h5>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($formations->isEmpty())
                    <p>Aucune formation trouvée. Créez une formation pour ajouter des questions.</p>
                @else
                    <div class="row">
    @foreach ($formations as $formation)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                @if(!empty($formation->image_url))
                    <img src="{{ asset($formation->image_url) }}" class="card-img-top" alt="Image de la formation" style="height: 180px; object-fit: cover;">
                @else
                    <img src="{{ asset('images/default-formation.jpg') }}" class="card-img-top" alt="Image par défaut" style="height: 180px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"style="font-weight: bold;">{{ $formation->titre }}</h5>
                    <p class="card-text">{{ Str::limit($formation->description, 100) }}</p>
                    <a href="{{ route('formateur.questions.show', $formation->slug) }}"
                       class="btn btn-primary mt-auto">Voir les Questions</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
                @endif
            </div>
        </div>
    </div>
@endsection