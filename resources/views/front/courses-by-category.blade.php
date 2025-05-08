@extends("front.app")
@section("content")
<section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb mb-2">
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="{{ url('/') }}">Accueil</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted">{{ $category->nom }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-12 text-center">
            <br>;
            @if ($fmt_meme_categorie->count() > 0)
                <p class="h4 text-primary">
                    {{ $fmt_meme_categorie->count() }} formation(s) disponible(s) dans la catégorie "{{ $category->nom }}".
                </p>
            @else
                <p class="h4 text-muted">
                    Aucune formation disponible dans la catégorie "{{ $category->nom }}".
                </p>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach($fmt_meme_categorie as $formation)
            <a href="/course-single/{{$formation->slug}}" style=" text-decoration: none;">
                <div class="col-lg-3 col-sm-6 mb-5">
                    <div class="card p-0 border-primary rounded-0 hover-shadow">
                        <div style="height: 200px; overflow: hidden;"> <!-- Conteneur avec hauteur fixe -->
                            <img class="card-img-top rounded-0" src="{{asset($formation->image_url)}}" alt="course thumb" style="width: 100%; height: 100%; object-fit: cover;"> <!-- Taille exacte -->
                        </div>
                        <div class="card-body">
                            <ul class="list-inline mb-2">
                                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>
                                    @if($formation->updated_at !=null)
                                        {{date('jS M Y', strtotime($formation->updated_at))}}
                                    @else
                                        02-14-2018
                                    @endif
                                </li>
                                <li class="list-inline-item"><a class="text-color" href="course-single">
                                        @foreach ($categories as $category)
                                            @if($category->id == $formation->category_id)
                                                {{$category->nom}}
                                            @endif
                                        @endforeach
                                    </a></li>
                            </ul>
                            <h4 class="card-title d-flex justify-content-space-between" style="min-height: 2.4em !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                @php
                                    $maxLengthPerLine = 20; // Estimation pour une ligne
                                    $maxLines = 2; // Maximum 2 lignes
                                    $maxLength = $maxLengthPerLine * $maxLines; // 40 caractères maximum
                                    $title = $formation->titre;
                                    $words = explode(' ', $title); // Sépare les mots
                                    $currentLength = 0;
                                    $currentLine = 1;
                                    $displayedTitle = '';
  
                                    foreach ($words as $word) {
                                        $wordLength = strlen($word) + 1; // +1 pour l'espace
                                        if ($currentLength + $wordLength <= $maxLengthPerLine * $currentLine) {
                                            $displayedTitle .= ($displayedTitle ? ' ' : '') . $word;
                                            $currentLength += $wordLength;
                                        } else {
                                            if ($currentLine < $maxLines) {
                                                $currentLine++; // Passe à la ligne suivante
                                                $displayedTitle .= ' ' . $word;
                                                $currentLength = $wordLength; // Réinitialise pour la nouvelle ligne
                                            } else {
                                                break; // Arrête si on dépasse le nombre de lignes
                                            }
                                        }
                                    }
  
                                    if (strlen($title) > $maxLength) {
                                        $displayedTitle = substr($displayedTitle, 0, $maxLength - 3) . '...'; // Tronque et ajoute "..."
                                    } else {
                                        $remainingCharacters = $maxLength - strlen($displayedTitle);
                                        $padding = str_repeat(' ', $remainingCharacters); // Espace insécable
                                        $displayedTitle .= $padding;
                                    }
  
                                    echo $displayedTitle;
                                @endphp
                            </h4>
                            <a href="/course-single/{{$formation->slug}}" class="btn btn-primary" >S'inscrire</a>
                        </div>
                        <div class="card-footer">
                            @if( $formation->prix_formation!=null)
                            @php
                                $sommePrix = $formation->prix_formation + $formation->prix_certification;
                            @endphp
                                <p class="ml-3">
                                    PRIX: <strong>{{$sommePrix}}</strong>
                                </p>
                            @else
                                <p>
                                    PRIX: <strong>0 fcfa</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
</section>
@endsection