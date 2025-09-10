@extends("Formateur.app")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section("content")

<section class="container my-5" style="min-height: 63vh">
    <div class="col-md-12 mx-auto">
        <div class="mb-4">
            <div class="form-inline" role="search">
                <div class="input-group w-100">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" id="search" placeholder="Rechercher une formation...">
                </div>
            </div>
        </div>
        <div class="card shadow-sm p-2 mb-4 bg-white rounded">
            <div class="card-body">
                <div class="row" id="formations-container">
                    @forelse($formations as $one_formation)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex mb-4 formation-card">
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
                <p class="text-center text-muted my-4 d-none" id="no-results-filter">Aucune formation trouvée.</p>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('#search');
        const cardsContainer = document.querySelector('#formations-container');
        const noResultsFilter = document.querySelector('#no-results-filter');

        function filterCards(term) {
            const normalized = term.trim().toLowerCase();
            const cards = cardsContainer ? cardsContainer.querySelectorAll('.formation-card') : [];
            let visibleCount = 0;

            cards.forEach(function(wrapper) {
                const titleEl = wrapper.querySelector('.formation-title');
                const title = titleEl ? titleEl.textContent.toLowerCase() : '';
                const matches = title.includes(normalized);
                wrapper.style.display = matches ? '' : 'none';
                if (matches) visibleCount++;
            });

            if (noResultsFilter) {
                noResultsFilter.classList.toggle('d-none', visibleCount !== 0);
            }
        }

        function debounce(fn, delay) {
            let timeoutId;
            return function(...args) {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => fn.apply(this, args), delay);
            };
        }

        if (searchInput) {
            searchInput.addEventListener('input', debounce(function(e) {
                filterCards(e.target.value);
            }, 150));
        }
    });
</script>

<style>
    .card .card-img-top:hover {
        transform: scale(1.05);
    }
    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
        transition: box-shadow .2s ease;
    }
    .input-group .input-group-text {
        background-color: #fff;
    }
    .btn-group .btn + .btn,
    .btn-group form + a {
        margin-left: 4px;
    }
</style>

@endsection