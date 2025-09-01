@extends('Formateur.app')

@section('content')
    <h3 class="text-center mt-2 pb-4">📩 Requêtes des apprenants</h3>

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
    <div class="container">
        <div class="row">
            
            @foreach ($requetes as $requete)
                <div class="col-12 col-md-6 mb-4">
                    <a href="{{ route('requete.show', $requete->slug) }}" class="text-decoration-none text-dark">
                        <div class="card shadow-sm border-0 hoverable h-100">
                            <div class="card-body">
                                <h5 class="card-title text-primary d-flex justify-content-between align-items-center">
                                
                                <span><i class="bi bi-chat-dots me-2"></i>{{ Str::limit($requete->nom, 40, '...') }}</span>
                                
                                    <div>
                                      
                                        @if ($requete_has_pending[$requete->id] ?? false)
                                            <span class="badge bg-warning text-dark ms-2">🔔 Nouveau message</span>
                                        @endif
                                    </div>
                                    
                                </h5>
                                <h6 class="card-subtitle mb-3 text-muted">
                                    <i class="bi bi-book me-1"></i>
                                    {{ $formations_associees[$requete->id]->titre ?? 'Formation inconnue' }}
                                </h6>
                                <p class="mb-1">
                                    <i class="bi bi-person me-1 text-secondary"></i>
                                    <strong>Apprenant :</strong>
                                    {{ $users[$requete->user_id]->prenom ?? '' }} {{ $users[$requete->user_id]->nom ?? 'Inconnu' }}
                                </p>
                                <p class="mb-1">
                                    <i class="bi bi-clock me-1 text-secondary"></i>
                                    <strong>Dernier message :</strong>
                                    @if ($reponse[$requete->id]->isNotEmpty())
                                        @php
                                            $lastReponse = $reponse[$requete->id]->sortBy('created_at')->last();
                                        @endphp
                                        {{ date('d/m/Y H:i', strtotime($lastReponse->updated_at)) }}
                                        par <strong>{{ $users[$lastReponse->user_id]->nom ?? 'Inconnu' }}</strong>
                                    @else
                                        Aucun
                                    @endif
                                </p>
                                
                                <div class="text-end mt-3">
                                    <span class="text-primary fw-semibold">Voir les détails <i class="bi bi-arrow-right-circle"></i></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    
    @endif

    <style>
        .hoverable {
            transition: all 0.3s ease-in-out;
        }

        .hoverable:hover {
            background-color: #eef7ff;
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, i) => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = 1;
                    card.style.transform = 'translateY(0)';
                }, i * 100);
            });
        });
    </script>
@endsection
