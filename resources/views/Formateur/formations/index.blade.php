@extends("Formateur.app")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section("content")

<section class="container my-5" style="min-height: 63vh">
    <div class="col-md-12 mx-auto">
        <div class="hero-box p-4 p-md-5 mb-4 rounded-3">
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                <div>
                    <h3 class="mb-1" style="font-weight:700;">Vos formations</h3>
                    <p class="mb-0 text-muted small">Parcourez, filtrez et gérez vos cours.</p>
                </div>
                <a href="{{ url('/formations/create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Nouvelle formation</a>
            </div>
            <div class="mt-3">
                <div class="input-group search-pill">
                    <span class="input-group-addon"><i class="fa fa-search text-muted"></i></span>
                    <input type="text" class="form-control" id="search" placeholder="Rechercher une formation...">
                    <span class="input-group-btn">
                        <button class="btn btn-light" id="clear-search" type="button" title="Effacer"><i class="fa fa-times"></i></button>
                    </span>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-2 flex-wrap gap-2">
                    <div class="chips-group">
                        <button class="btn btn-sm btn-chip active" data-filter="all">Tous</button>
                        <button class="btn btn-sm btn-chip" data-filter="free">Gratuit</button>
                        <button class="btn btn-sm btn-chip" data-filter="paid">Payant</button>
                    </div>
                    <div class="text-muted small" id="results-count"></div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm p-2 mb-4 bg-white rounded">
            <div class="card-body">
                <div class="row" id="formations-container">
                    @forelse($formations as $one_formation)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex mb-4 formation-card" data-price="{{ $one_formation->prix_formation ? 'paid' : 'free' }}">
                            <div class="card w-100 shadow-sm h-100">
                                <div class="position-relative overflow-hidden" style="height: 180px;">
                                    @if($one_formation->prix_formation == null)
                                        <span class="badge badge-warning" style="position:absolute; right:10px; top:10px; font-weight:600;">Gratuit</span>
                                    @else
                                        <span class="badge badge-warning" style="position:absolute; right:10px; top:10px; font-weight:600;">{{ $one_formation->prix_formation }} fcfa</span>
                                    @endif
                                    <a href="{{ url('/course-detail/'.$one_formation->slug) }}">
                                        <img src="{{ $one_formation->image_url }}" class="card-img-top" style="width:100%; height:100%; object-fit:cover; transition: transform .3s ease;">
                                    </a>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2 text-center text-muted small">
                                        {{ $one_formation->created_at ? \Carbon\Carbon::parse($one_formation->created_at)->format('d M Y') : '' }}
                                    </div>
                                    <h6 class="formation-title text-center mb-3" style="min-height: 2.8em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                        {{ Str::limit($one_formation->titre, 60) }}
                                    </h6>
                                    <div class="mt-auto">
                                        <div class="btn-group w-100" role="group">
                                            <form action="{{ route('formations.destroy', $one_formation->slug) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette formation ?');" class="w-50">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm w-100" title="Supprimer"><i class="fa fa-trash"></i></button>
                                            </form>
                                            <a class="btn btn-primary btn-sm w-50" href="{{ route('formations.edit', $one_formation->slug) }}" title="Modifier"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center text-muted my-4">Aucune formation disponible.</p>
                        </div>
                    @endforelse
                </div>
                <div class="text-center text-muted my-4 d-none" id="no-results-filter">
                    <div class="empty-state">
                        <div class="emoji">🔎</div>
                        <div class="mt-2">Aucune formation ne correspond à votre recherche.</div>
                        <button class="btn btn-link btn-sm mt-2" id="reset-filters">Réinitialiser les filtres</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('#search');
        const clearBtn = document.querySelector('#clear-search');
        const cardsContainer = document.querySelector('#formations-container');
        const noResultsFilter = document.querySelector('#no-results-filter');
        const resetFiltersBtn = document.querySelector('#reset-filters');
        const filterChips = document.querySelectorAll('.btn-chip');
        const resultsCount = document.querySelector('#results-count');

        let priceFilter = 'all';

        // Store original titles for safe highlighting
        const titleEls = cardsContainer ? cardsContainer.querySelectorAll('.formation-title') : [];
        titleEls.forEach(function(el){ el.dataset.original = (el.textContent || '').trim(); });

        function escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }

        function highlight(el, term) {
            const original = el.dataset.original || '';
            if (!term) { el.textContent = original; return; }
            const regex = new RegExp('(' + escapeRegExp(term) + ')', 'ig');
            el.innerHTML = original.replace(regex, '<mark>$1</mark>');
        }

        function updateResultsCount(count) {
            if (resultsCount) {
                const label = count <= 1 ? 'résultat' : 'résultats';
                resultsCount.textContent = count + ' ' + label;
            }
        }

        function filterCards() {
            const term = (searchInput ? searchInput.value : '').trim().toLowerCase();
            const cards = cardsContainer ? cardsContainer.querySelectorAll('.formation-card') : [];
            let visibleCount = 0;

            cards.forEach(function(wrapper) {
                const titleEl = wrapper.querySelector('.formation-title');
                const title = titleEl ? (titleEl.dataset.original || titleEl.textContent).toLowerCase() : '';
                const price = wrapper.getAttribute('data-price') || 'all';

                const matchesText = !term || title.indexOf(term) !== -1;
                const matchesPrice = priceFilter === 'all' || price === priceFilter;

                const isVisible = matchesText && matchesPrice;
                wrapper.style.display = isVisible ? '' : 'none';

                if (titleEl) highlight(titleEl, term);

                if (isVisible) visibleCount++;
            });

            if (noResultsFilter) {
                noResultsFilter.classList.toggle('d-none', visibleCount !== 0);
            }
            updateResultsCount(visibleCount);
        }

        function debounce(fn, delay) {
            let timeoutId;
            return function(...args) {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => fn.apply(this, args), delay);
            };
        }

        if (searchInput) {
            searchInput.addEventListener('input', debounce(function() { filterCards(); }, 150));
        }
        if (clearBtn) {
            clearBtn.addEventListener('click', function(){
                if (searchInput) searchInput.value = '';
                filterCards();
                if (searchInput) searchInput.focus();
            });
        }
        if (resetFiltersBtn) {
            resetFiltersBtn.addEventListener('click', function(){
                priceFilter = 'all';
                filterChips.forEach(function(btn){ btn.classList.toggle('active', btn.getAttribute('data-filter') === 'all'); });
                if (searchInput) searchInput.value = '';
                filterCards();
            });
        }
        if (filterChips && filterChips.length) {
            filterChips.forEach(function(btn){
                btn.addEventListener('click', function(){
                    filterChips.forEach(function(b){ b.classList.remove('active'); });
                    this.classList.add('active');
                    priceFilter = this.getAttribute('data-filter') || 'all';
                    filterCards();
                });
            });
        }

        // Initial render
        filterCards();
    });
</script>

<style>
    .hero-box {
        background: linear-gradient(135deg, #eef5ff 0%, #ffffff 100%);
        border: 1px solid #e9ecef;
    }
    .search-pill .form-control {
        border-left: 0;
        box-shadow: none;
    }
    .search-pill .input-group-addon {
        background: #fff;
        border-right: 0;
    }
    #clear-search {
        background: #fff;
        border-left: 0;
    }
    .chips-group .btn-chip {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 999px;
        padding: 6px 12px;
        margin-right: 6px;
        color: #495057;
    }
    .chips-group .btn-chip.active {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }
    .card .card-img-top:hover {
        transform: scale(1.05);
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 1rem 1.5rem rgba(0,0,0,.12);
        transition: box-shadow .2s ease, transform .2s ease;
    }
    mark { background: #fff3cd; padding: 0 .15em; }
    .badge.badge-warning { background-color: #ffe057; color: #111; }
    .empty-state .emoji { font-size: 1.8rem; }
    .btn-group .btn + .btn,
    .btn-group form + a { margin-left: 4px; }
</style>

@endsection