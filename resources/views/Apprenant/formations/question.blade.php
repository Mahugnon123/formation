@extends("Apprenant.app")
@section("content")

@php
use Illuminate\Support\Str;
$rand = random_int(100, 900);
@endphp

@if (session()->has('message'))
<div class="container mt-4">
    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
        <strong>Annonce :</strong> {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
</div>
@endif

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-primary">Mes messages privés</h3>
        <button class="btn btn-primary" onclick="showForm('formMessage')">Nouveau message privé</button>
    </div>

    @if($requetes->isEmpty())
        <div class="alert alert-warning text-center">Aucun message privé pour le moment.</div>
    @else
        <div class="row g-3">
            @foreach($requetes as $requete)
                @php
                    $last = $reponse[$requete->id]->last() ?? null;
                    $lastDate = $last ? $last->updated_at->format('d/m/Y H:i') : 'Aucun';
                    $lastAuteur = $last ? ($users[$last->user_id]->nom ?? 'Inconnu') : '';
                @endphp

                <div class="col-md-6 mb-4">
                    <a href="{{ url('/requete/'.$rand.'-'.$requete->nom) }}" class="text-decoration-none text-dark">
                        <div class="card shadow-sm hoverable h-100">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-chat-dots me-2"></i>{{ Str::limit($requete->nom, 30, '...') }}</span>
                                    @if ($requete_has_pending[$requete->id] ?? false)
                                        <span class="badge bg-warning text-dark">🔔 Nouveau message</span>
                                    @endif
                                </h5>
                                <p class="text-muted mb-1">
                                    Formation : {{ Str::limit($formations[$requete->id]->titre ?? 'Inconnue', 40, '...') }}
                                </p>
                                <p class="mb-0 text-muted small">
                                    Dernier message : {{ $lastDate }} 
                                    @if($lastAuteur)
                                        par <strong>{{ $lastAuteur }}</strong>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Formulaire nouveau message --}}
    <div class="card mt-4 d-none" id="formMessage">
        <div class="card-body">
            <h5 class="card-title">Nouveau message privé</h5>
            <form action="/apprenant-requete" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="col-md-6">
                        <label for="fmt_id" class="form-label">Formation</label>
                        <select name="fmt_id" id="fmt_id" class="form-select" required>
                            @foreach($formation_iscrt as $fmt)
                                <option value="{{ $fmt->id }}">{{ $fmt->titre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-secondary">Envoyer</button>
            </form>
        </div>
    </div>
</div>

<style>
.hoverable:hover {
    background-color: #f8f9fa;
    transition: 0.3s;
}
</style>

<script>
function showForm(elm) {
    let element = document.getElementById(elm);
    element.classList.toggle('d-none');
}
</script>

@endsection
