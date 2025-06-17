@extends("front.app")
@section("content")

    <?php
    $besoin = json_decode($formation->besoin);
    $contenu = json_decode($formation->contenu);
    $competence = json_decode($formation->competence);
    $chapitre = json_decode($formation->chapitre);
    ?>

    <section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    </div>
            </div>
        </div>
    </section>
    <section class="section-sm">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-xl-3 order-1 col-sm-6 mb-4 mb-xl-0">
                    <h3>{{$formation->titre}}</h3>
                </div>
                <div class="col-xl-6 order-sm-3 order-xl-2 col-12 order-2">
                    <ul class="list-inline text-xl-center">
                        <li class="list-inline-item mr-4 mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <i class="ti-book text-primary icon-md mr-2"></i>
                                <div class="text-left">
                                    <h6 class="mb-0">Durée</h6>
                                    <p class="mb-0">{{$formation->duree}}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item mr-4 mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <i class="ti-wallet text-primary icon-md mr-2"></i>
                                <div class="text-left">
                                    <h6 class="mb-0">Prix</h6>
                                    @if($formation->prix_formation==null)
                                        <p class="mb-0">0 FCFA</p>
                                    @else
                                    @php
                                        $sommePrix = $formation->prix_formation + $formation->prix_certification;
                                    @endphp
                                        <p class="mb-0">{{$sommePrix}} fcfa</p>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-3 text-sm-right text-left order-sm-2 order-3 order-xl-3 col-sm-6 mb-4 mb-xl-0">
                    @if (Auth::check() and Auth::user()->role_id==1)
                        <form method="POST" action="{{ route('apprenant.inscription') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$formation->id}}">
                            <button type="submit" class="btn btn-primary">
                                @if($bool==true) Continuer le cour @else S'inscrire @endif
                            </button>
                        </form>
                    @elseif (Auth::check() and Auth::user()->role_id==2)
                        @else
                        <button class="btn btn-primary" class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#signupModal_" data-toggle="modal" data-target="#signupModal_">S'inscrire</button>

                        <div class="modal fade" id="signupModal_" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content rounded-0 border-0 p-4">
                                    <div class="modal-header border-0">
                                        <h3>Inscription</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="login">
                                            <form method="POST" action="{{ route('register') }}" class="row" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="id" name="id" value="{{$formation->id}}">
                                                <div class="col-12">
                                                    <input type="text" class="form-control mb-3" id="signupPhone" name="nom" placeholder="Nom">
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" class="form-control mb-3" id="signupName" name="prenom" placeholder="Prénom">
                                                </div>
                                                <div class="col-12">
                                                    <input type="email" class="form-control mb-3" id="signupEmail" name="email" placeholder="Email">
                                                </div>

                                                <div class="col-12 d-none">
                                                    <input type="hidden" name="role_id" value="1">
                                                </div>

                                                <div class="col-12">
                                                    <input type="password" class="form-control mb-3" id="signupPassword" name="password" placeholder="Mot de passe">
                                                </div>

                                                <div class="col-12">
                                                    <input type="password" class="form-control mb-3" id="signupPassword" name="password_confirmation" placeholder="Confirmer le Mot de passe">
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" class="btn btn-primary"> <a href="#loginModal" class="text-decoration:none" style="text-decoration:none;">Se connecter </a></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-12 mt-4 order-4">
                    <div class="border-bottom border-primary"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    <h3>A propos de la formation</h3>
                    <p style="text-align: justify;">{{$formation->a_propos}}</p>
                </div>
                <div class="col-12 mb-12">
                    <h3 class="mb-3">Pre-requis necessaires</h3>
                    <div class="col-12 px-0">
                        <div class="row">
                            <div class="col-md-12">
                                <ul style="text-align: justify;" class="list-styled">
                                    @foreach($besoin as $one_besoin)
                                        <li>{{$one_besoin->value}}</li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <h3 class="mb-3">Ce que vous allez apprendre</h3>
                    <ul style="text-align: justify;" class="list-styled">
                        @foreach($contenu as $one_contenu)
                            <li>{{$one_contenu->value}}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-12 mb-4">
                    <h3 class="mb-3">Compétence à acqueri</h3>
                    <ul style="text-align: justify;" class="list-styled">
                        @foreach($competence as $one_competence)
                            <li>{{$one_competence->value}}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($chapitre as $one_chapitre)
                                <div class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                                    <div class="d-md-table-cell text-center p-0 bg-primary text-white mb-4 mb-md-0 text-center"><span class="h5 d-block">Chapitre</span>{{$one_chapitre->num_chapitre+1}} </div>
                                    <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                        <span href="" class="  h4 mb-3 d-block">{{$one_chapitre->intitule}}</span>
                                        @if(strlen($one_chapitre->chapitre_description)>200)<p class="mb-0"> {{substr($one_chapitre->chapitre_description,0,200)}}...</p>
                                        @else
                                            <p style="text-align: justify;" class="mb-0"> {{$one_chapitre->chapitre_description}}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">Autre cours que vous pourriez aimer</h2>
                    <div class="media-body">
                        <h4 class="mt-0"></h4>
                    </div>
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
                                            PRIX: <strong>{{$sommePrix}} fcfa</strong>
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