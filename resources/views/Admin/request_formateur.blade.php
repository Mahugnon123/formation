@extends('Admin.app')

@section('content')
<h3 class="text-center mt-2 pb-4" style="color:#6c63ff">Requêtes des formateurs</h3>

@if (session()->has('message'))
    <div class="m-3 bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Annonce</div>
            <small>A l'instant</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session()->get('message') }}
        </div>
    </div>
@endif

@if ($requetes->isEmpty())
    <div class="text-center">
        <img src="{{ asset('no-formation.svg') }}" alt="" height="250px"><br><br>
        <h4 style="color:#015a98">Aucune requête pour le moment</h4>
    </div>
@else
    <div id="messagesList" class="list-group mx-3 mx-md-4">
@foreach($requetes as $requete)
    @php
        $lastReponse = $reponse[$requete->id]->last() ?? null;
        $lastDate = $lastReponse ? \Carbon\Carbon::parse($lastReponse->updated_at)->format('d/m/Y H:i') : null;
        $lastAuteur = $lastReponse ? ($users[$lastReponse->user_id]->nom ?? 'Inconnu') : null;
        $isAuteurConnecte = $lastReponse && $lastReponse->user_id == (auth()->user()->id ?? null);
        $hasNewMessage = $requete_has_pending[$requete->id] ?? false;
        $titreTronque = \Illuminate\Support\Str::limit($requete->titre, 50);
    @endphp

    <div class="list-group-item list-group-item-action shadow-sm rounded mb-3 p-3 hoverable"
         style="cursor:pointer;"
         onclick="window.location='{{ route('admin.request.show', $requete->slug) }}'">

        <div class="d-flex justify-content-between align-items-start flex-wrap">
            <div class="flex-grow-1">
                <h5 class="mb-1 text-primary fw-bold">
                    <i class="bi bi-chat-dots me-1"></i> {{ $titreTronque }}
                </h5>
                <p class="mb-0 text-muted">
                    <i class="bi bi-clock me-1"></i>
                    @if ($lastReponse)
                        <strong>Dernier message :</strong> {{ $lastDate }}
                        par <strong>{{ $isAuteurConnecte ? 'vous' : $lastAuteur }}</strong>
                    @else
                        Aucun message
                    @endif
                </p>
            </div>
            @if($hasNewMessage)
                <span class="badge bg-warning text-dark align-self-start mt-2 mt-md-0 ms-md-3">
                    <i class="bi bi-bell-fill me-1"></i> NOUVEAU MESSAGE
                </span>
            @endif
        </div>
    </div>
@endforeach
    </div>
@endif

<style>
    .hoverable {
        transition: box-shadow 0.3s, background 0.3s, transform 0.3s;
        border-radius: 8px;
        background: #fff !important;
        box-shadow: 0 2px 8px rgba(44,62,80,0.10);
    }
    .hoverable:hover {
        background: #f5f7ff !important;
        box-shadow: 0 6px 24px rgba(44,62,80,0.18);
        transform: translateY(-6px);
    }

    @media (max-width: 767.98px) {
        .list-group-item {
            width: 94vw !important;
            max-width: 370px;
            margin: 16px auto;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(44,62,80,0.10);
            background: #fff;
            padding: 16px;
        }
        h3.text-center {
            font-size: 1.3rem;
            padding-bottom: 1rem;
        }
    }
</style>
@endsection
