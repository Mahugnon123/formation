@extends("Admin.app")

@section("content")
<div class="container-xxl flex-grow-1 container-p-y">
    <h2 class="text-center fw-bold mb-4">📘 Explorez les domaines d’apprentissage</h2>
    <p class="text-center mb-5 text-muted">Choisissez une catégorie pour découvrir les formations associées et développer vos compétences.</p>

    <div class="row g-4">
        @forelse($categories as $category)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0 hover-shadow transition">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3 text-center">
                            <i class="bx bx-category-alt bx-lg text-primary"></i>
                        </div>
                        <h5 class="card-title text-center">{{ $category->nom }}</h5>
                        <p class="card-text text-muted small text-center">Formations disponibles dans le domaine de {{ strtolower($category->nom) }}.</p>
                        <div class="mt-auto text-center">
                            <a href="{{ route('formations.parCategorie', $category->id) }}" class="btn btn-outline-primary btn-sm">
                                Voir les formations
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-danger">Aucune catégorie disponible pour le moment.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        transform: scale(1.02);
        transition: 0.2s ease-in-out;
    }
</style>
@endsection
