@extends('Formateur.app')
@section('content')

@php
$rand = random_int(100, 900);
@endphp

<div class="container-xxl mt-4">

    {{-- Alert flottante --}}
    @if(session()->has('message'))
        <div id="toast" class="toast align-items-center text-bg-success border-0 position-fixed top-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1050; min-width: 300px;">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle me-2"></i>
                    <strong>Succès :</strong> {{ session('message') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
            </div>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3 gap-2">
        <h2 class="fw-bold page-title">Mes messages envoyés à l'administration</h2>
        <button id="btnToggleForm" class="btn btn-gradient d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Nouvelle requête
        </button>
    </div>

    {{-- Suppression du formulaire multiple --}}
    {{-- 
    <form action="{{ route('formateur.messages.destroy') }}" method="POST" id="deleteForm" class="mb-3 d-flex align-items-center gap-3 flex-wrap">
        @csrf
        @method('DELETE')
        <input type="hidden" name="total_checked" id="total_checked">
        <button type="submit" id="btnDelete" class="btn btn-danger d-none">
            <i class="bi bi-trash"></i> <span id="deleteCount"></span>
        </button>
        <span id="selectionInfo" class="text-warning fw-semibold d-none"></span>
    </form>
    --}}
    <div id="formMessage" class="card shadow-sm mt-4 mb-4 p-4" style="display:none; max-width: 600px;">
        <h4 class="mb-4 form-title fw-bold">Nouvelle requête</h4>
        <form action="{{ route('formateur.messages.store') }}" method="POST" id="formNewMessage" novalidate>
            @csrf
            <div class="mb-3">
                <label for="titre" class="form-label fw-semibold">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
                <div class="invalid-feedback">Veuillez entrer un titre.</div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                <div class="invalid-feedback">Veuillez entrer une description.</div>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <button type="submit" class="btn btn-gradient">Envoyer</button>
                <button type="button" class="btn btn-outline-secondary" id="btnCancelForm">Annuler</button>
            </div>
        </form>
    </div>

    <div id="messagesList" class="list-group mt-3">
        @forelse($requetes as $requete)
        @php
            $lastReponse = $reponse[$requete->id]->last() ?? null;
            $lastDate = $lastReponse ? $lastReponse->updated_at->format('d/m/Y H:i') : null;
            $lastAuteur = $lastReponse ? ($users[$lastReponse->user_id]->nom ?? 'Inconnu') : null;
            $isAuteurConnecte = $lastAuteur === Auth::user()->nom;
            $hasNewMessage = $requete_has_pending[$requete->id] ?? false;
            $titreTronque = Str::limit($requete->titre, 50);
        @endphp
    
        <div class="list-group-item list-group-item-action card-like mb-3 p-3" 
             style="cursor:pointer;" 
             onclick="window.location='{{ route('formateur.messages.show', $rand . '-' . $requete->titre) }}'">
    
            <div class="d-flex justify-content-between align-items-start flex-wrap">
                {{-- Titre et niveau --}}
                <div class="flex-grow-1">
                    <h5 class="mb-1 item-title fw-bold">
                        <i class="bi bi-chat-dots me-1"></i> {{ $titreTronque }}
                    </h5>
                    
                    <p class="mb-0 text-muted">
                        <i class="bi bi-clock me-1"></i>
                        
                        @if ($lastReponse)
                        <strong>Dernier message :</strong>
                            {{ \Carbon\Carbon::parse($lastReponse->updated_at)->format('d/m/Y H:i') }}
                            par <strong>{{ $isAuteurConnecte ? 'vous' : 'Administrateur' }}</strong>
                        @else
                            Aucun message
                        @endif
                    </p>
                    
                    
                </div>
    
                {{-- Badge notification --}}
                @if($hasNewMessage)
                    <span class="badge badge-new-message align-self-start mt-2 mt-md-0 ms-md-3">
                        <i class="bi bi-bell-fill me-1"></i> NOUVEAU MESSAGE
                    </span>
                 @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">Aucune requête envoyée pour le moment.</div>
    @endforelse
    

    </div>

    {{-- Formulaire nouvelle requête --}}
    

</div>

{{-- Bootstrap 5 Icons CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
/* Page title (neutral dark) */
.page-title { color:#111111; }

/* Gradient primary button */
.btn-gradient { background: linear-gradient(135deg,#4e9af1 0%, #0167c1 100%); color:#fff; border:none; box-shadow: 0 6px 16px rgba(1,103,193,.25); }
.btn-gradient:hover { filter: brightness(.95); color:#fff; }

/* Card-like list items */
.card-like { border-radius: 14px; background:#fff; box-shadow: 0 6px 18px rgba(16,24,40,.06); border:1px solid rgba(16,24,40,.06); }
.card-like:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(16,24,40,.10); transition: all .25s ease; }
.item-title { color:#111111; }

/* New message badge */
.badge-new-message { background:#e9f2ff; color:#0d6efd; border:1px solid rgba(13,110,253,.35); font-weight:800; letter-spacing:.6px; text-transform:uppercase; border-radius:12px; padding:.45rem .9rem; box-shadow: inset 0 1px 0 rgba(255,255,255,.7); }

/* Form title */
.form-title { color:#111111; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // Bootstrap toast (alert message)
    const toastEl = document.getElementById('toast');
    if (toastEl) {
        const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
        toast.show();
    }

    // Toggle form nouvelle requête
    const btnToggleForm = document.getElementById('btnToggleForm');
    const formMessage = document.getElementById('formMessage');
    const btnCancelForm = document.getElementById('btnCancelForm');

    btnToggleForm.addEventListener('click', () => {
        if (formMessage.style.display === 'none' || formMessage.style.display === '') {
            formMessage.style.display = 'block';
            formMessage.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } else {
            formMessage.style.display = 'none';
        }
    });

    btnCancelForm.addEventListener('click', () => {
        formMessage.style.display = 'none';
    });

    // Validation formulaire simple
    const formNewMessage = document.getElementById('formNewMessage');
    formNewMessage.addEventListener('submit', (e) => {
        let valid = true;

        if (!formNewMessage.titre.value.trim()) {
            formNewMessage.titre.classList.add('is-invalid');
            valid = false;
        } else {
            formNewMessage.titre.classList.remove('is-invalid');
        }

        if (!formNewMessage.description.value.trim()) {
            formNewMessage.description.classList.add('is-invalid');
            valid = false;
        } else {
            formNewMessage.description.classList.remove('is-invalid');
        }

        if (!valid) e.preventDefault();
    });

});
</script>

@endsection
