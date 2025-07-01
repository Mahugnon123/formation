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
    <section class="section-sm" style="background:#fff;">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-xl-3 order-1 col-sm-6 mb-4 mb-xl-0">
                    <h3 style="color:#1a1a36; font-weight:700;">{{$formation->titre}}</h3>
                </div>
                <div class="col-xl-6 order-sm-3 order-xl-2 col-12 order-2">
                    <ul class="list-inline text-xl-center">
                        <li class="list-inline-item mr-4 mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock" style="color:#1a1a36; font-size:3em; margin-right:12px;"></i>
                                <div class="text-left ms-2">
                                    <h6 class="mb-0" style="color:#1a1a36; font-weight:600;">Durée</h6>
                                    <p class="mb-0" style="color:#23234c;">{{$formation->duree}}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item mr-4 mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-cash-coin" style="color:#1a1a36; font-size:3em; margin-right:12px;"></i>
                                <div class="text-left ms-2">
                                    <h6 class="mb-0" style="color:#1a1a36; font-weight:600;">Prix</h6>
                                    @if($formation->prix_formation==null)
                                        <p class="mb-0" style="color:#23234c;">
                                            Certificat : <strong>{{ $formation->prix_certification }} FCFA</strong>
                                        </p>
                                    @else
                                    @php
                                        $sommePrix = $formation->prix_formation + $formation->prix_certification;
                                    @endphp
                                        <p class="mb-0" style="color:#23234c;"><strong>{{$sommePrix}} fcfa </strong></p>
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
                            <button type="submit" class="btn" style="background:#1a1a36; color:#fff; font-weight:700; border-radius:8px; padding:10px 28px;">
                                @if($bool==true) Continuer le cour @else S'inscrire @endif
                            </button>
                        </form>
                    @elseif (Auth::check() and Auth::user()->role_id==2)
                        @else
                        <button class="btn" style="background:#1a1a36; color:#fff; font-weight:700; border-radius:8px; padding:10px 28px;" href="#signupModal_" data-toggle="modal" data-target="#signupModal_">S'inscrire</button>

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
                    <div style="border-bottom:2px solid #e3e6f0;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-5">
                    <h2 style="font-weight:700; color:#1a1a36; margin-bottom:18px;" data-aos="fade-right">
                        <i class="bi bi-info-circle" style="color:#1da1f2;"></i> À propos de la formation
                    </h2>
                    <div style="color:#444; font-size:1.08em; text-align:justify; background:#f8f9fa; border-radius:10px; padding:18px 20px;" data-aos="fade-up">
                        {{$formation->a_propos}}
                    </div>
                </div>
                <div class="col-12 mb-5">
                    <h2 style="font-weight:700; color:#1a1a36; margin-bottom:18px; letter-spacing:0.5px;" data-aos="fade-left">
                        <i class="bi bi-list-check" style="color:#1da1f2;"></i> Pré-requis nécessaires
                    </h2>
                    <div style="background:#f8f9fa; border-radius:10px; padding:18px 20px;" data-aos="zoom-in">
                        <ul style="list-style:none; padding-left:0; margin-bottom:0;">
                            @foreach($besoin as $one_besoin)
                                <li style="margin-bottom:10px; display:flex; align-items:flex-start;" data-aos="fade-right">
                                    <span style="display:inline-block; width:18px; height:18px; background:#1a1a36; border-radius:50%; margin-right:10px; margin-top:6px; flex-shrink:0;"></span>
                                    <span style="color:#23234c; font-size:1.08em;">{{$one_besoin->value}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 mb-5">
                    <h2 style="font-weight:700; color:#1a1a36; margin-bottom:18px;" data-aos="fade-right">
                        <i class="bi bi-lightbulb" style="color:#1da1f2;"></i> Ce que vous allez apprendre
                    </h2>
                    <div style="background:#f8f9fa; border-radius:16px; padding:18px 20px;" data-aos="zoom-in-up">
                        <ul style="list-style:none; padding-left:0; margin-bottom:0;">
                            @foreach($contenu as $one_contenu)
                                <li style="margin-bottom:10px; display:flex; align-items:flex-start;" data-aos="fade-left">
                                    <span style="display:inline-block; width:18px; height:18px; background:#1a1a36; border-radius:50%; margin-right:10px; margin-top:6px; flex-shrink:0;"></span>
                                    <span style="color:#23234c; font-size:1.08em;">{{$one_contenu->value}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 mb-5">
                    <h2 style="font-weight:700; color:#1a1a36; margin-bottom:18px;" data-aos="fade-left">
                        <i class="bi bi-award" style="color:#1da1f2;"></i> Compétences à acquérir
                    </h2>
                    <div style="background:#f8f9fa; border-radius:16px; padding:18px 20px;" data-aos="zoom-in">
                        <ul style="list-style:none; padding-left:0; margin-bottom:0;">
                            @foreach($competence as $one_competence)
                                <li style="margin-bottom:10px; display:flex; align-items:flex-start;" data-aos="fade-up">
                                    <span style="display:inline-block; width:18px; height:18px; background:#1a1a36; border-radius:50%; margin-right:10px; margin-top:6px; flex-shrink:0;"></span>
                                    <span style="color:#23234c; font-size:1.08em;">{{$one_competence->value}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                $aosChapitreEffects = ['flip-left', 'flip-right', 'fade-up', 'fade-down', 'zoom-in', 'zoom-in-up'];
                            @endphp
                            @foreach($chapitre as $index => $one_chapitre)
                                @php
                                    $chapitreEffect = $aosChapitreEffects[$index % count($aosChapitreEffects)];
                                    $chapitreDelay = ($index % 4) * 100;
                                @endphp
                                <div class="card shadow-sm mb-4" style="border-radius: 16px; border: 1px solid #e3e6f0;" data-aos="{{ $chapitreEffect }}" data-aos-delay="{{ $chapitreDelay }}">
                                    <div class="card-body d-flex align-items-center p-3 p-md-4" style="gap: 24px;">
                                        <div class="text-center" style="min-width:120px; background:#1a1a36; color:#fff; border-radius:12px; padding:18px 0;">
                                            <div style="font-size:1.1em; font-weight:700; letter-spacing:1px;">Chapitre</div>
                                            <div style="font-size:1.5em; font-weight:700;">{{ $one_chapitre->num_chapitre+1 }}</div>
                                        </div>
                                        <div class="flex-grow-1 ps-md-4">
                                            <div style="font-weight:700; font-size:1.2em; color:#1a1a36; margin-bottom:4px;">
                                                {{ $one_chapitre->intitule }}
                                            </div>
                                            <div style="color:#23234c; font-size:1em; text-align:justify;">
                                                @if(strlen($one_chapitre->chapitre_description)>200)
                                                    {{ substr($one_chapitre->chapitre_description,0,200) }}...
                                                @else
                                                    {{ $one_chapitre->chapitre_description }}
                                                @endif
                                            </div>
                                        </div>
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