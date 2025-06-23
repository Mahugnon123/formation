@extends("Apprenant.app")
@section("content")
@php
$random_slug = random_int(1,50);
    $chapitreNames = [];
    // $formation est un tableau [formation_id => titre], on va chercher les objets Formation
    foreach($resumes as $resume) {
        $formationObj = \App\Models\Formation::find($resume->formation_id);
        if ($formationObj && $formationObj->chapitre) {
            $chaps = is_array($formationObj->chapitre) ? $formationObj->chapitre : json_decode($formationObj->chapitre, true);
            foreach ($chaps as $ch) {
                $chapitreNames[$resume->formation_id][$ch['num_chapitre']] = $ch['intitule'];
            }
        }
    }
@endphp
@if (session('success'))
    <div class="alert alert-secondary alert-dismissible fade show mx-auto mt-3" role="alert" style="max-width:600px; text-align:center;">
        <i class="bi bi-info-circle-fill me-2"></i>
    {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
</div>
@endif

<div class="container">
    <h3 class="text-center mt-4 mb-4" style="color:#1976d2; font-weight:700;">
        <i class="bi bi-clipboard2-check" style="font-size:2rem;"></i>
        Vos notes de chapitres
    </h3>
    <div class="mb-4 text-center" style="color:#566a7f;">
        Retrouvez, modifiez ou supprimez vos notes de chaque formation en toute simplicité.
</div>
    <div class="bg-secondary mb-4" style="height:2px; width:100%;"></div>

@if(count($resumes) == 0)
<div class="text-center">
            <img src="{{asset('no-found.svg')}}" alt="" height="200px" class="mb-3">
            <h4 style="color:#1976d2">Aucune note trouvée</h4>
</div>
@else
        @foreach($resumes as $resume)
            <div class="card shadow mb-4" style="border-radius: 18px;">
                <div class="card-header" style="background:#f5f5f5; color:#444; text-align:center; border-top-left-radius: 18px; border-top-right-radius: 18px;">
                    <h5 class="mb-0" style="font-weight:600;">
                        <i class="bi bi-journal-bookmark"></i>
                        Formation en {{ $formation[$resume->formation_id] }}
                    </h5>
                </div>
                <div class="mt-1"></div>
                    <div class="card-body">
                    <div class="row g-3">
                        @php($resumeChapitre = is_array($resume->resumeChapitre) ? $resume->resumeChapitre : json_decode($resume->resumeChapitre, true))
                        @foreach($resumeChapitre as $key => $value)
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="card h-100 shadow-sm border-0" style="border-radius: 14px; transition: transform 0.2s;">
                                    <div class="card-body">
                                        <div class="mb-1 text-muted" style="font-size:0.95rem;">
                                            Chapitre : {{ $chapitreNames[$resume->formation_id][$value['chapitre_id']] ?? 'N/A' }}
                                        </div>
                                        <h5 class="card-title" style="color:#1976d2;"><br>
                                            <i class="bi bi-bookmark-star"></i> {{ $value['titre'] }}
                                        </h5>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                <i class="bi bi-clock-history"></i>
                                                Dernière modification : {{ $value['updated_at'] }}
                                            </small>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center" style="border-bottom-left-radius: 14px; border-bottom-right-radius: 14px;">
                                        <form action="chapitre/{{$random_slug}}-{{$value['titre']}}" method="post" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="id_chapitre" value="{{$value['chapitre_id']}}">
                                            <input type="hidden" name="id" value="{{$resume->id}}">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye"></i> Voir plus
                                            </button>
                                        </form>
                                        <div>
                                            <button type="button" class="btn btn-outline-secondary btn-sm me-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#popup{{$value['chapitre_id']}}_{{$resume->id}}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#Suppopup{{$value['chapitre_id']}}_{{$resume->id}}">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Place TOUS les modals ici, en dehors des colonnes/cartes -->
    @foreach($resumes as $resume)
        @php($resumeChapitre = is_array($resume->resumeChapitre) ? $resume->resumeChapitre : json_decode($resume->resumeChapitre, true))
        @foreach($resumeChapitre as $key => $value)
            <!-- Modal Suppression -->
            <div id="Suppopup{{$value['chapitre_id']}}_{{$resume->id}}" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                        <div class="modal-header custom-modal-header">
                            <h5 class="modal-title">{{ $value['titre'] }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/apprenant-resume" method="POST">
                                                    @csrf
                            <input type="hidden" name="id_chpt" value="{{$value['chapitre_id']}}">
                            <input type="hidden" name="id_resume" value="{{$resume->id}}">
                                                    <div class="modal-body">
                                <p>Voulez-vous vraiment supprimer la note de ce chapitre ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
            <!-- Modal Modification -->
            <div id="popup{{$value['chapitre_id']}}_{{$resume->id}}" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                        <div class="modal-header custom-modal-header">
                            <h5 class="modal-title">Modifier votre note</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="/note-du-chapitre" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                <div class="mb-2">
                                    <label for="titre" class="form-label">Titre</label>
                                    <input type="text" name="titre" class="form-control" value="{{$value['titre']}}" required>
                                                    </div>
                                <div class="mb-2">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3" required>{{$value['description']}}</textarea>
                                            </div>
                                <div class="mb-2">
                                    <label for="commentaire" class="form-label">Commentaire</label>
                                    <textarea name="commentaire" class="form-control" rows="3">{{$value['commentaire']}}</textarea>
                                </div>
                                <input type="hidden" name="chapitre_id" value="{{$value['chapitre_id']}}">
                                <input type="hidden" name="id_resume" value="{{$resume->id}}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
                @endforeach
      </div>

<style>
.card:hover {
    transform: translateY(-4px) scale(1.01);
    box-shadow: 0 8px 24px rgba(25, 118, 210, 0.12);
}
.custom-modal-header {
    background: #7b8a9a !important;
    color: #fff !important;
}
.custom-modal-header .modal-title {
    color: #fff !important;
}
</style>
@endsection
