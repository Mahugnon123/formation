{{-- filepath: c:\Users\HP\Desktop\formation\resources\views\Admin\request_formateur.blade.php --}}
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
        <div style="width:100%;">
           @foreach ($requetes as $requete)
    <div class="card mb-3 shadow-sm hoverable" style="border-left: 4px solid #6c63ff;">
        <div class="card-body d-flex align-items-center" style="padding: 18px 24px;">
            {{-- Colonne gauche : titre et destinataire --}}
            <div style="min-width: 220px;">
                <span class="fw-bold" style="font-size: 1.1rem;">
                    <a href="{{ route('admin.request.show', $requete->slug) }}" style="color: #222; text-decoration:none;">
                        {{ $requete->titre }}
                    </a>
                </span>
                <div class="text-muted" style="font-size: 0.95rem;">
                    Envoyée au Formateur :
                </div>
            </div>
            {{-- Colonne centre : nombre de messages --}}
            <div class="flex-grow-1 text-center">
               <span class="fw-bold message-count" style="font-size:1.1rem;">
    {{ $reponse[$requete->id]->count() }} Message(s)
</span>
            </div>
            {{-- Colonne droite : dernière réponse --}}
            <div class="text-end" style="min-width: 200px;">
                @if ($reponse[$requete->id]->isNotEmpty())
                    <span class="text-muted" style="font-size: 0.95rem;">
                        Dernière réponse :<br>
                        {{ date('d/m/Y H:i:s', strtotime($reponse[$requete->id]->last()->updated_at)) }}<br>
                        par <strong>{{ $users[$reponse[$requete->id]->last()->user_id]->nom ?? 'Inconnu' }}</strong>
                    </span>
                @else
                    <span class="text-muted" style="font-size: 0.95rem;">Aucune réponse</span>
                @endif
            </div>
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
        transform: translateY(-6px); /* Soulèvement */
    }
    .card {
        border: none;
    }
    .message-count {
        color: #111 !important;
    }



    @media (max-width: 767.98px) {
    body, .container, .row {
        padding: 0 !important;
        margin: 0 !important;
    }
    .card {
        width: 94vw !important;
        max-width: 370px;
        margin: 16px auto !important;
        border-radius: 14px !important;
        box-shadow: 0 2px 12px rgba(44,62,80,0.10) !important;
        border: none !important;
        background: #fff !important;
    }
    .card-body {
        padding: 14px 16px !important;
        border-radius: 14px !important;
    }
    .card-body.d-flex.align-items-center {
        flex-direction: column !important;
        align-items: flex-start !important;
        text-align: left !important;
    }
    .card-body > div {
        width: 100% !important;
        min-width: unset !important;
        margin-bottom: 6px;
        text-align: left !important;
    }
    .card-body > div:last-child {
        margin-bottom: 0;
    }
    .flex-grow-1.text-center {
        text-align: left !important;
        margin-bottom: 4px;
        font-weight: bold;
        font-size: 1.1rem;
    }
    .text-end {
        text-align: left !important;
        font-size: 0.95rem;
        color: #666;
    }
    h3.text-center {
        font-size: 1.2rem !important;
        padding-bottom: 1rem !important;
    }
}
</style>
@endsection