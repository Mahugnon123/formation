@extends('Admin.app')

@section('content')
    <div class="container py-4">
        <!-- Titre et total des formations -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-center text-dark flex-grow-1">Formations de la catégorie : {{ $categorie->nom }}</h2>
            <p class="mb-0 text-muted">Total des formations : {{ $formations->count() }}</p>
        </div>

        <!-- Grille de cartes avec Bootstrap -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="card-container">
            @forelse($formations as $formation)
                <div class="col">
                    <div class="card h-100 shadow-sm card-rounded" 
                         data-formation-id="{{ $formation->id }}" 
                         tabindex="0" 
                         role="button"
                         aria-label="Voir la formation {{ $formation->titre }}">
                        <!-- Avatar généré -->
                        <div class="avatar-container">
                            <img class="card-img-top rounded-top"
     src="{{ asset($formation->image_url ?? 'images/placeholder.jpg') }}"
     alt="course thumb"
     style="height: 200px; object-fit: cover;"
     onerror="this.onerror=null;this.src='{{ asset('images/default-placeholder.png') }}';">

                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted small mb-2">{{ \Carbon\Carbon::parse($formation->created_at)->format('j M Y') }}</p>
                            <h5 class="card-title fw-bold mb-2">{{ $formation->titre }}</h5>
                            <p class="card-text mb-2">Catégorie : {{ $categorie->nom }}</p>
                            <p class="card-text fw-semibold">Prix : {{ $formation->prix_formation }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Aucune formation trouvée.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('styles')
<style>
    .card-rounded {
        border: 1px solid #e0e0e0;
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
    }

    .card-rounded .avatar-container {
        text-align: center;
        width: 150px;
        height: 150px;
        margin: 0 auto;
        border-radius: 50%;
        overflow: hidden;
        background-color: #f0f0f0;
    }

    .card-rounded .avatar-container .avatar-img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        display: block;
    }

    .card-body {
        min-height: 150px;
    }

    .card-text, .card-title {
        color: #333 !important;
    }

    h2 {
        font-size: 1.75rem;
    }

    .text-muted {
        font-size: 0.9rem;


  

    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.card-rounded');

        cards.forEach(card => {
            const formationId = card.dataset.formationId;

            // Clic ou touche Entrée = redirection
            card.addEventListener('click', () => {
                window.location.href = `/formations/${formationId}`;
            });

            card.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    window.location.href = `/formations/${formationId}`;
                }
            });

            // Animation douce au survol
            card.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';

            card.addEventListener('mouseenter', () => {
                card.style.transform = 'scale(1.03)';
                card.style.boxShadow = '0 0 12px rgba(0, 123, 255, 0.4)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'scale(1)';
                card.style.boxShadow = 'none';
            });
        });
    });
</script>
@endpush

<style>
    .card:hover {
      transform: translateY(-5px) !important;
      transition: transform 0.3s ease, box-shadow 0.3s ease !important;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
      cursor: pointer !important;
    }
  </style>
  