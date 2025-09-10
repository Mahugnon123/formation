@extends("Formateur.app")
@section('styles')
<style>
    .formations-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 12px; }
    .search-input-group { position: relative; width: 320px; max-width: 100%; }
    .search-input-group .search-icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #6c757d; }
    .search-input-group input { padding-left: 36px; border-radius: 10px; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px rgba(0,0,0,0.03); transition: border-color .2s ease, box-shadow .2s ease; }
    .search-input-group input:focus { outline: none; border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13,110,253,.12); }

    #formations-container { row-gap: 24px; }

    .formation-card .card { border: 1px solid #eef1f5; border-radius: 14px; overflow: hidden; transition: transform .18s ease, box-shadow .18s ease; box-shadow: 0 2px 10px rgba(0,0,0,0.04); background: #fff; }
    .formation-card .card:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(13,110,253,0.12); }
    .image-wrapper { position: relative; height: 160px; overflow: hidden; background: #f5f7fb; border-radius: 10px; }
    .image-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: transform .35s ease; }
    .formation-card .card:hover .image-wrapper img { transform: scale(1.05); }
    .price-badge { position: absolute; top: 10px; right: 10px; font-size: 12px; font-weight: 600; color: #111827; background: #ffe057; border-radius: 999px; padding: 6px 12px; }
    .meta-date { color: #6b7280; font-size: 12px; margin: 10px 0 0; }
    .formation-title { font-weight: 600; color: #111827; text-align: center; margin: 6px 0 14px; min-height: 2.8em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; }
    .card-actions .btn { border-radius: 10px; }

    .empty-state { text-align: center; padding: 24px 12px; }
    .empty-state h4 { color: #015a98; margin-top: 12px; font-weight: 600; }
</style>
@endsection
@section("content")

<section class="container my-5" style="min-height: 63vh">
    <div class="col-md-12 mx-auto">
        <div class="mb-4 formations-toolbar">
            <div class="search-input-group">
                <i class="fa fa-search search-icon"></i>
                <input type="text" class="form-control form-control-sm" id="search" name="search" placeholder="Rechercher une formation...">
            </div>
            <a href="{{ url('/formations/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Nouvelle formation</a>
        </div>
        <div class="card shadow-lg p-1 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="row mt-15" id="formations-container">
@forelse($formations as $one_formation)
@php
    $prixFormation = $one_formation->prix_formation;
    $prixCertification = $one_formation->prix_certification ?? 0;
    $totalPrix = !is_null($prixFormation) ? ($prixFormation + $prixCertification) : null;
@endphp
                    <div class="col-md-3 mx-auto formation-card" data-title="{{ Str::lower($one_formation->titre) }}">
                        <div class="card p-2">
                            <div class="image-wrapper">
                                @if(is_null($totalPrix))
                                    <span class="price-badge">Gratuit</span>
                                @else
                                    <span class="price-badge">{{ number_format($totalPrix, 0, ',', ' ') }} FCFA</span>
                                @endif
                                <a href="{{ url('/course-detail/'.$one_formation->slug) }}">
                                    <img src="{{ $one_formation->image_url }}" alt="{{ $one_formation->titre }}">
                                </a>
                            </div>
                            <div class="meta-date text-center">{{ optional($one_formation->created_at)->format('d M Y') }}</div>
                            <h5 class="formation-title">{{ Str::limit($one_formation->titre, 60) }}</h5>
                            <div class="card-actions form-group row col-md-12 col-12">
                                <div class="col-6 text-center">
                                    <form action="{{ route('formations.destroy', $one_formation->slug) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette formation ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm w-100"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                                <div class="col-6 text-center">
                                    <a class="btn btn-outline-primary btn-sm w-100" href="{{ route('formations.edit', $one_formation->slug) }}"><i class="fa fa-edit"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
@empty
                    <div class="col-md-12 empty-state" id="initial-empty" data-empty-state>
                        <img src="{{ asset('no-formation.svg') }}" alt="Aucune formation ajoutée" height="250">
                        <h4>Aucune formation ajoutée par ce formateur.</h4>
                    </div>
@endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const formationsContainer = document.getElementById('formations-container');
        const formationCards = Array.from(document.querySelectorAll('.formation-card'));
        let emptyState = document.querySelector('[data-empty-state]');

        function renderEmptyState(message) {
            const html = `
                <div class="col-md-12 empty-state" data-empty-state>
                    <img src="{{ asset('no-formation.svg') }}" alt="Aucune formation" height="250">
                    <h4>${message}</h4>
                </div>
            `;
            formationsContainer.insertAdjacentHTML('afterbegin', html);
            return formationsContainer.querySelector('[data-empty-state]');
        }

        function removeEmptyState() {
            if (emptyState) { emptyState.remove(); emptyState = null; }
        }

        function filterCards() {
            const term = (searchInput.value || '').toLowerCase().trim();
            let visibleCount = 0;
            formationCards.forEach(card => {
                const title = (card.dataset.title || '').toLowerCase();
                const show = title.includes(term);
                card.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });

            if (visibleCount === 0) {
                const message = term ? 'Aucune formation ne correspond à votre recherche.' : 'Aucune formation ajoutée par ce formateur.';
                if (!emptyState) emptyState = renderEmptyState(message);
                else emptyState.querySelector('h4').textContent = message;
            } else {
                removeEmptyState();
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterCards);
        }

        filterCards();
    });
</script>

@endsection