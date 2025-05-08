@extends("Formateur.app")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section("content")

<section class="container my-5" style="min-height: 63vh">
    <div class="col-md-12 mx-auto">
        <div class="mb-4">
            <form class="form-inline" onsubmit="return false;">
                <div class="form-group mr-2">
                    <input type="text" class="form-control form-control-sm" id="search" placeholder="Rechercher une formation...">
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Rechercher</button>
            </form>
        </div>
        <div class="card shadow-lg p-1 mb-5 bg-white rounded">
            <div class="card-body mx-auto">
                <div class="row mt-15" id="formations-container">
                    @forelse($formations as $one_formation)
                        <div class="col-md-3 mx-auto formation-card">
                            <div class="shadow-lg p-2 bg-white rounded" style="width:16rem;">
                                <div class="card-body">
                                    @if($one_formation->prix_formation == null)
                                        <p class="card-text mb-4">
                                            <span style="font-size: 12px; float: right; font-weight: 600; font-family: Source Sans Pro, Arial, sans-serif; width: fit-content; text-decoration: none; color: black; background-color: rgb(255, 224, 87); border-radius: 10px; padding: 0px 15px; vertical-align: middle;">Gratuit</span>
                                        </p>
                                    @else
                                        <p class="card-text mb-4">
                                            <span style="font-size: 12px; float: right; font-weight: 600; font-family: Source Sans Pro, Arial, sans-serif; width: fit-content; text-decoration: none; color: black; background-color: rgb(255, 224, 87); border-radius: 10px; padding: 0px 15px; vertical-align: middle;">{{ $one_formation->prix_formation }} fcfa</span>
                                        </p>
                                    @endif
                                    <div style="height: 150px; overflow: hidden;">
                                        <a href="{{ url('/course-detail/'.$one_formation->slug) }}">
                                            <img src="{{ $one_formation->image_url }}" class="card-img-top image-card" style="width: 100%; height: 100%; object-fit: cover;">
                                        </a>
                                    </div>
                                    <hr>
                                    <h5 style="color: black; font-family: inherit; text-align: center;">{{ $one_formation->created_at }}</h5>
                                    <h5 class="formation-title" style="min-height: 2.8em; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; text-align: center;">
                                        {{ Str::limit($one_formation->titre, 50) }}
                                    </h5>
                                    <div class="form-group row col-md-12 col-12">
                                        <div class="col-6 text-center">
                                            <form action="{{ route('formations.destroy', $one_formation->slug) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette formation ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                        <div class="col-6 text-center">
                                            <a class="btn btn-primary btn-sm w-100" href="{{ route('formations.edit', $one_formation->slug) }}"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center" id="no-results" style="display: none;">Aucune formation trouvée.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const formationCards = document.querySelectorAll('.col-md-3');
    const searchForm = document.querySelector('.form-inline'); // Sélectionne le formulaire

    // Empêche la soumission du formulaire lors du clic sur "Rechercher" (optionnel si tu veux seulement le filtrage en direct)
    searchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche la soumission du formulaire
        // Ici, tu peux choisir de laisser le filtrage en direct faire le travail
        // ou ajouter une logique supplémentaire si nécessaire après "Rechercher"
    });

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        formationCards.forEach(function(card) {
            const formationTitleElement = card.querySelector('h5');

            if (formationTitleElement) {
                const formationTitle = formationTitleElement.textContent.toLowerCase();
                // Affiche la carte si le titre CONTIENT le terme de recherche, sinon masque-la
                if (formationTitle.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    });
});
</script>

@endsection