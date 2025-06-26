@extends("Formateur.app")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section("content")
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade in text-center" role="alert" style="...">
        <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-check-circle" style="margin-right: 8px;"></i>
        {{ session('success') }}
    </div>
@endif


<section class="container my-5" style="min-height: 63vh">
    <div class="col-md-12 mx-auto">
        {{-- <div class="mb-4">
            <form action="{{ route('formations.index') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" class="form-control form-control-sm" name="search" placeholder="Rechercher une formation...">
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Rechercher</button>
            </form>
        </div> --}}
        <div class="card shadow-lg p-1 mb-5 bg-white rounded">
            <div class="card-body ">
				<div class="mb-4">
					<form action="{{ route('formations.index') }}" method="GET" class="form-inline">
						<div class="form-group mr-2">
							<input type="text" class="form-control form-control-sm" name="search" placeholder="Rechercher une formation...">
						</div>
						<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Rechercher</button>
					</form>
				</div>
                <div class="row mt-15">
                    @foreach($formation as $one_formation)
                        <div class="col-md-3 mx-auto">
                            <div class="shadow-lg p-2 bg-white rounded" style="width:16rem;">
                                <div class="card-body">
                                    @if($one_formation->prix_formation == null)
                                        <p class="card-text mb-4">
                                            <span style="font-size: 12px; float: right; font-weight: 600; font-family: Source Sans Pro, Arial, sans-serif; width: fit-content; text-decoration: none; color: black; background-color: rgb(255, 224, 87); border-radius: 10px; padding: 0px 15px; vertical-align: middle;">Gratuit</span>
                                        </p>
                                    @else
										@php
											 $sommePrix = $one_formation->prix_formation + $one_formation->prix_certification;
										@endphp
										<p class="card-text mb-4">
											<span style="font-size: 12px; float: right; font-weight: 600; font-family: Source Sans Pro, Arial, sans-serif; width: fit-content; text-decoration: none; color: black; background-color: rgb(255, 224, 87); border-radius: 10px; padding: 0px 15px; vertical-align: middle;">{{ $sommePrix }} fcfa</span>
										</p>
                                    @endif
                                    <div style="height: 150px; overflow: hidden;">
                                        <a href="{{ url('/course-detail/'.$one_formation->slug)}}">
                                            <img src="{{$one_formation->image_url}}" class="card-img-top image-card" style="width: 100%; height: 100%; object-fit: cover;">
                                        </a>
                                    </div>
                                    <hr>
                                    <h5 style="color: black; font-family: inherit; text-align: center;"> {{$one_formation->created_at}}</h5>
                                    <h5 style="min-height: 2.8em !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;text-align:center;">
                                        @php
                                            $maxLengthPerLine = 25;
                                            $maxLines = 2;
                                            $maxLength = $maxLengthPerLine * $maxLines;
                                            $title = $one_formation->titre;
                                            $words = explode(' ', $title);
                                            $currentLength = 0;
                                            $currentLine = 1;
                                            $displayedTitle = '';

                                            foreach ($words as $word) {
                                                $wordLength = strlen($word) + 1;
                                                if ($currentLength + $wordLength <= $maxLengthPerLine * $currentLine) {
                                                    $displayedTitle .= ($displayedTitle ? ' ' : '') . $word;
                                                    $currentLength += $wordLength;
                                                } else {
                                                    if ($currentLine < $maxLines) {
                                                        $currentLine++;
                                                        $displayedTitle .= ' ' . $word;
                                                        $currentLength = $wordLength;
                                                    } else {
                                                        break;
                                                    }
                                                }
                                            }

                                            if (strlen($title) > $maxLength) {
                                                $displayedTitle = substr($displayedTitle, 0, $maxLength - 3) . '...';
                                            } else {
                                                $remainingCharacters = $maxLength - strlen($displayedTitle);
                                                $padding = str_repeat(' ', $remainingCharacters);
                                                $displayedTitle .= $padding;
                                            }

                                            echo $displayedTitle;
                                        @endphp
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const formationCards = document.querySelectorAll('.col-md-3.mx-auto');
    const noSearchResultsHTML = `
        <div class="col-md-12 text-center mt-3">
            <img src="{{ asset('no-formation.svg') }}" alt="Aucune formation trouvée" height="250px"><br><br>
            <h4 style="color:#015a98">Aucune formation ne correspond à votre recherche.</h4>
        </div>
    `;
    const noFormationsAddedHTML = `
        <div class="col-md-12 text-center mt-3">
            <img src="{{ asset('no-formation.svg') }}" alt="Aucune formation ajoutée" height="250px"><br><br>
            <h4 style="color:#015a98">Aucune formation ajoutée par ce formateur.</h4>
        </div>
    `;
    const formationsContainer = document.querySelector('.row.mt-15');

    let noResultsDisplayed = false;
    let noInitialFormations = false;

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let resultsFound = false;

        formationCards.forEach(function(card) {
            const formationTitleElement = card.querySelector('h5:nth-child(5)');

            if (formationTitleElement) {
                const formationTitle = formationTitleElement.textContent.toLowerCase();
                const shouldShow = formationTitle.includes(searchTerm);
                card.style.display = shouldShow ? '' : 'none';
                if (shouldShow) {
                    resultsFound = true;
                }
            }
        });

        if (resultsFound) {
            if (noResultsDisplayed) {
                const existingNoResults = formationsContainer.querySelector('.col-md-12.text-center.mt-3');
                if (existingNoResults) {
                    formationsContainer.removeChild(existingNoResults);
                    noResultsDisplayed = false;
                }
            }
            noInitialFormations = false; // Réinitialiser si des résultats sont trouvés après une recherche
        } else {
            if (!noResultsDisplayed && searchInput.value !== '') { // Afficher seulement si une recherche a été effectuée
                formationsContainer.insertAdjacentHTML('afterbegin', noSearchResultsHTML);
                noResultsDisplayed = true;
                noInitialFormations = false;
            } else if (searchInput.value === '' && !noInitialFormations) {
                // Si le champ de recherche est vide et qu'aucun résultat initial n'a été trouvé
                const existingNoResults = formationsContainer.querySelector('.col-md-12.text-center.mt-3');
                if (existingNoResults) {
                    formationsContainer.removeChild(existingNoResults);
                }
                formationsContainer.insertAdjacentHTML('afterbegin', noFormationsAddedHTML);
                noInitialFormations = true;
                noResultsDisplayed = false;
            }
        }
    });

    function checkInitialResults() {
        const initialResultsFound = Array.from(formationCards).some(card => card.style.display !== 'none');
        if (!initialResultsFound && searchInput.value === '') {
            formationsContainer.insertAdjacentHTML('afterbegin', noFormationsAddedHTML);
            noInitialFormations = true;
        }
    }
    checkInitialResults();
});
</script>

@endsection