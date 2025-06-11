@php
    $i = 0;
    $fmt_user = [];
@endphp

<div>
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-0 border-0 p-4">
                <div class="modal-header border-0">
                    <h3 id="signupModalLabel">Devenir Formateur Partenaire</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createFormateurForm" action="{{ route('partner-requests.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom" name="nom_complet" value="{{ old('nom') }}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenom">Prénom(s) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email">Adresse e-mail <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="telephone">Numéro de téléphone <span class="text-danger">*</span></label>
                                <div class="input-group shadow-sm">
                                    <select class="form-select" id="indicatif" name="indicatif" style="max-width: 120px; border-top-right-radius: 0; border-bottom-right-radius: 0;" required>
                                        <option value="" disabled selected>Indicatif</option>
                                        <option value="+229" {{ old('indicatif') == '+229' ? 'selected' : '' }}>+229 (Bénin)</option>
                                        <option value="+225" {{ old('indicatif') == '+225' ? 'selected' : '' }}>+225 (Côte d'Ivoire)</option>
                                        <option value="+226" {{ old('indicatif') == '+226' ? 'selected' : '' }}>+226 (Burkina Faso)</option>
                                        <option value="+227" {{ old('indicatif') == '+227' ? 'selected' : '' }}>+227 (Niger)</option>
                                        <option value="+228" {{ old('indicatif') == '+228' ? 'selected' : '' }}>+228 (Togo)</option>
                                        <option value="+221" {{ old('indicatif') == '+221' ? 'selected' : '' }}>+221 (Sénégal)</option>
                                        <option value="+223" {{ old('indicatif') == '+223' ? 'selected' : '' }}>+223 (Mali)</option>
                                        <option value="+224" {{ old('indicatif') == '+224' ? 'selected' : '' }}>+224 (Guinée)</option>
                                        <option value="+237" {{ old('indicatif') == '+237' ? 'selected' : '' }}>+237 (Cameroun)</option>
                                        <option value="+234" {{ old('indicatif') == '+234' ? 'selected' : '' }}>+234 (Nigéria)</option>
                                        <option value="+242" {{ old('indicatif') == '+242' ? 'selected' : '' }}>+242 (Congo)</option>
                                        <option value="+243" {{ old('indicatif') == '+243' ? 'selected' : '' }}>+243 (RDC)</option>
                                        <option value="+233" {{ old('indicatif') == '+233' ? 'selected' : '' }}>+233 (Ghana)</option>
                                        <option value="+241" {{ old('indicatif') == '+241' ? 'selected' : '' }}>+241 (Gabon)</option>
                                        <option value="+235" {{ old('indicatif') == '+235' ? 'selected' : '' }}>+235 (Tchad)</option>
                                        <option value="+236" {{ old('indicatif') == '+236' ? 'selected' : '' }}>+236 (Centrafrique)</option>
                                        <option value="+33" {{ old('indicatif') == '+33' ? 'selected' : '' }}>+33 (France)</option>
                                        <option value="+1" {{ old('indicatif') == '+1' ? 'selected' : '' }}>+1 (États-Unis/Canada)</option>
                                        <option value="+44" {{ old('indicatif') == '+44' ? 'selected' : '' }}>+44 (Royaume-Uni)</option>
                                        <option value="+32" {{ old('indicatif') == '+32' ? 'selected' : '' }}>+32 (Belgique)</option>
                                        <option value="+213" {{ old('indicatif') == '+213' ? 'selected' : '' }}>+213 (Algérie)</option>
                                        <option value="+212" {{ old('indicatif') == '+212' ? 'selected' : '' }}>+212 (Maroc)</option>
                                        <option value="+216" {{ old('indicatif') == '+216' ? 'selected' : '' }}>+216 (Tunisie)</option>
                                    </select>
                                    <input type="tel" pattern="[0-9]{8,15}" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}" required placeholder="Numéro sans indicatif">
                                </div>
                                <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide (8 à 15 chiffres).</div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="sex">Sexe <span class="text-danger">*</span></label>
                                <select class="form-control" id="sex" name="sex" required>
                                    <option value="">Choisissez votre sexe</option>
                                    <option value="M" {{ old('sex') == 'M' ? 'selected' : '' }}>Masculin</option>
                                    <option value="F" {{ old('sex') == 'F' ? 'selected' : '' }}>Féminin</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="domaines_expertise">Domaine(s) de formation expertisé(s) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="domaines_expertise" name="domaines_expertise" placeholder="Séparer par des virgules si plusieurs" value="{{ old('domaines_expertise') }}" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="linkedin">Lien vers le profil LinkedIn</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ old('linkedin') }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="presentation">Brève présentation de votre parcours et de votre expérience en formation <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="presentation" name="presentation" rows="4" required>{{ old('presentation') }}</textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="motivation">Pourquoi souhaitez-vous devenir formateur sur notre plateforme ? <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="motivation" name="motivation" rows="4" required>{{ old('motivation') }}</textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="photo_profil">Photo de profil <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="photo_profil" name="photo_profil" accept="image/*" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mt-2">
                                <img id="image_preview" src="#" alt="Aperçu de l'image" style="max-width: 150px; max-height: 150px; display: none;">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="cv">Curriculum Vitae (CV) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="cv" name="cv" accept="application/pdf" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="lettre_motivation">Lettre de motivation <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="lettre_motivation" name="lettre_motivation" accept="application/pdf" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="certificats">Certificats ou diplômes pertinents</label>
                                <input type="file" class="form-control" id="certificats" name="certificats[]" accept="application/pdf,image/*" multiple>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="piece_identite">Pièce d'identité <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="piece_identite" name="piece_identite" accept="image/*,application/pdf" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 d-none">
                                <input type="hidden" name="role_id" value="2">
                            </div>
                            <div class="col-12">
                                <div id="formMessage" class="alert d-none"></div>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary uniform-btn">Soumettre</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(empty($formateurs) || $formateurs->isEmpty())
        <h4 class="m-3 text-center" id="aucun">Aucun formateur 😓</h4>
    @else
        <div class="table-responsive m-3" id="fmt">
            <table id="listFormateur" class="table table-striped table-bordered mt-3 shadow p-3 mb-5 bg-body rounded">
                <thead>
                    <tr style="background-color: rgb(96, 96, 98); font-family: 'Roboto', sans-serif;">
                        <th scope="col" style="color: white;">Nom</th>
                        <th scope="col" style="color: white;">Prénom</th>
                        <th scope="col" style="color: white;">Email</th>
                        <th scope="col" style="color: white;">Formations</th>
                        <th scope="col" style="color: white;">Compte</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formateurs as $formateur)
                        @php
                            $fmt_formateur = [];
                            foreach($formations as $formation) {
                                if ($formation->user_slug == $formateur->slug) {
                                    $fmt_formateur[] = $formation;
                                }
                            }
                            $fmt_user[$i] = $fmt_formateur;
                        @endphp
                        <tr>
                            <td>
                                @if($formateur->deleted_at)
                                    <span class="text-danger">{{ $formateur->nom }}</span>
                                @else
                                    {{ $formateur->nom }}
                                @endif
                            </td>
                            <td>
                                @if($formateur->deleted_at)
                                    <span class="text-danger">{{ $formateur->prenom }}</span>
                                @else
                                    {{ $formateur->prenom }}
                                @endif
                            </td>
                            <td>
                                @if($formateur->deleted_at)
                                    <span class="text-danger">{{ $formateur->email }}</span>
                                @else
                                    {{ $formateur->email }}
                                @endif
                            </td>
                            <td>
                                @if(empty($fmt_user[$i]) || count($fmt_user[$i]) == 0)
                                    Aucune
                                @else
                                    {{ count($fmt_user[$i]) }} réalisée(s)
                                    <button type="button" class="btn rounded-pill btn-primary uniform-btn" data-element="formateur{{ $i }}" onclick="formateur(this)" aria-expanded="false" aria-controls="fmts{{ $i }}">Voir tout</button>
                                @endif
                            </td>
                            <td>
                                <form action="javascript:void(0)" method="post" class="toggle-status-form">
                                    @csrf
                                    <input type="hidden" name="slug" value="{{ $formateur->slug }}">
                                    <button class="btn toggle-status-btn uniform-btn {{ $formateur->deleted_at ? 'btn-danger' : 'btn-primary' }}" type="submit" data-element="{{ $i }}" data-slug="{{ $formateur->slug }}">
                                        <i class="bi {{ $formateur->deleted_at ? 'bi-lock-fill' : 'bi-unlock-fill' }}"></i>
                                        <span class="status-text d-none">{{ $formateur->deleted_at ? 'Activer' : 'Désactiver' }}</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @foreach($fmt_user as $j => $formations)
        <div class="content-wrapper formations" style="display: none; background-color: #e4e5e7" data-element="fmts{{ $j }}">
            <div id="fmtsSee" style="display: none;">
                <button type="button" class="btn btn-secondary mb-3 uniform-btn" onclick="backToList()">Retour à la liste des formateurs</button>
            </div>
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-lg-12 col-md-12 order-1">
                        <div class="row">
                            @foreach($formations as $index => $one_formation)
                                @if(in_array($one_formation, $formations))
                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                        <div class="card p-0 border-primary rounded-card h-100">
                                            @if($one_formation->archived)
                                                <button class="btn btn-secondary btn-sm uniform-btn">Archivé</button>
                                            @endif
                                            <img class="card-img-top rounded-top" src="{{ asset($one_formation->image_url ?? 'images/placeholder.jpg') }}" alt="course thumb" style="height: 150px; object-fit: cover;">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="text-color text-dark {{ $one_formation->archived ? 'text-muted' : '' }} mb-2">{{ $one_formation->titre ?? 'Sans titre' }}</h5>
                                                <ul class="list-inline mb-2 flex-grow-1">
                                                    <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>{{ $one_formation->created_at ?? 'N/A' }}</li>
                                                </ul>
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item text-dark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
                                                            <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z" />
                                                            <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z" />
                                                        </svg>
                                                        <strong class="text-dark">Certificat:</strong>
                                                        {{ $one_formation->prix_certification ? $one_formation->prix_certification . ' XOF' : 'Gratuite' }}
                                                    </li>
                                                    <li class="list-inline-item text-dark mt-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                                        </svg>
                                                        <strong class="text-dark">Durée:</strong> {{ $one_formation->duree ?? 'Non spécifiée' }}
                                                    </li>
                                                    <li class="list-inline-item text-dark mt-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-credit-card-2-back" viewBox="0 0 16 16">
                                                            <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z" />
                                                            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z" />
                                                        </svg>
                                                        <strong class="text-dark">Prix:</strong> {{ $one_formation->prix_formation ? $one_formation->prix_formation . ' XOF' : 'Gratuit' }}
                                                    </li>
                                                </ul>
                                                <div class="mt-3 d-flex justify-content-center">
                                                    @if($one_formation->archived)
                                                        <form action="javascript:void(0)" method="post" class="toggle-archive-form" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" name="slug" value="{{ $one_formation->slug }}">
                                                            <button type="submit" class="btn uniform-btn btn-success toggle-archive-btn" data-element="{{ $j }}fmt{{ $index }}" data-archived="1">
                                                                Désarchiver
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-primary uniform-btn" onclick="details(this)" data-element="{{ $j }}fmt{{ $index }}">Voir le contenu</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach($fmt_user as $j => $formations)
        @foreach($formations as $i => $formation)
            <section class="section-sm formation_user" style="display:none;" data-element="{{ $j }}fmt{{ $i }}">
                <div class="container">
                    <div class="row align-items-center ml-3 mb-5">
                        <div class="col-xl-3 order-1 col-sm-6 mb-4 mb-xl-0">
                            <h3 class="{{ $formation->archived ? 'text-muted' : '' }}">{{ $formation->titre ?? 'Sans titre' }}</h3>
                            @if($formation->archived)
                                <span class="badge bg-secondary">Archivé</span>
                            @endif
                        </div>
                        <div class="col-xl-6 order-sm-3 order-xl-2 col-12 order-2">
                            <ul class="list-inline text-xl-center">
                                <li class="list-inline-item mr-4 mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <i class="ti-book text-primary icon-md mr-2"></i>
                                        <div class="text-left">
                                            <h6 class="mb-0">Durée</h6>
                                            <p class="mb-0">{{ $formation->duree ?? 'Non spécifiée' }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item mr-4 mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <i class="ti-wallet text-primary icon-md mr-2"></i>
                                        <div class="text-left">
                                            <h6 class="mb-0">Prix</h6>
                                            <p class="mb-0">{{ $formation->prix_formation ? $formation->prix_formation . ' FCFA' : 'Gratuite' }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 ml-3 order-4">
                            <div class="border-bottom border-primary"></div>
                        </div>
                    </div>
                    <div class="row ml-3">
                        <div class="col-12 mb-4">
                            <h3>A propos de la formation</h3>
                            <p>{{ $formation->a_propos ?? 'Aucune description disponible' }}</p>
                        </div>
                        <div class="col-12 mb-12">
                            <h3 class="mb-3">Pré-requis nécessaires</h3>
                            <div class="col-12 px-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="list-styled">
                                            @php
                                                $besoin = $formation->besoin;
                                                if (is_string($besoin)) {
                                                    $decoded = json_decode($besoin, true);
                                                    $besoin = is_array($decoded) ? $decoded : [];
                                                } elseif (!is_array($besoin)) {
                                                    $besoin = [];
                                                }
                                            @endphp
                                            @if(!empty($besoin))
                                                @foreach($besoin as $one_besoin)
                                                    <li style="text-align: justify;">{{ is_array($one_besoin) ? ($one_besoin['value'] ?? $one_besoin) : (is_object($one_besoin) ? ($one_besoin->value ?? $one_besoin) : $one_besoin) }}</li>
                                                @endforeach
                                            @else
                                                <li>Aucun pré-requis spécifié</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4 m-3">
                            <h3 class="mb-3">Ce que vous allez apprendre</h3>
                            <ul class="list-styled">
                                @php
                                    $contenu = $formation->contenu;
                                    if (is_string($contenu)) {
                                        $decoded = json_decode($contenu, true);
                                        $contenu = is_array($decoded) ? $decoded : [];
                                    } elseif (!is_array($contenu)) {
                                        $contenu = [];
                                    }
                                @endphp
                                @if(!empty($contenu))
                                    @foreach($contenu as $one_contenu)
                                        <li style="text-align: justify;">{{ is_array($one_contenu) ? ($one_contenu['value'] ?? $one_contenu) : (is_object($one_contenu) ? ($one_contenu->value ?? $one_contenu) : $one_contenu) }}</li>
                                    @endforeach
                                @else
                                    <li>Aucun contenu spécifié</li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-12 mb-4 m-3">
                            <h3 class="mb-3">Compétences acquises</h3>
                            <ul class="list-styled">
                                @php
                                    $competence = $formation->competence;
                                    if (is_string($competence)) {
                                        $decoded = json_decode($competence, true);
                                        $competence = is_array($decoded) ? $decoded : [];
                                    } elseif (!is_array($competence)) {
                                        $competence = [];
                                    }
                                @endphp
                                @if(!empty($competence))
                                    @foreach($competence as $one_competence)
                                        <li style="text-align: justify;">{{ is_array($one_competence) ? ($one_competence['value'] ?? $one_competence) : (is_object($one_competence) ? ($one_competence->value ?? $one_competence) : $one_competence) }}</li>
                                    @endforeach
                                @else
                                    <li>Aucune compétence spécifiée</li>
                                @endif
                            </ul>
                        </div>
                        <div class="container m-3">
                            <div class="row">
                                <div class="col-md-11">
                                    @php
                                        $chapitre = $formation->chapitre;
                                        if (is_string($chapitre)) {
                                            $decoded = json_decode($chapitre, true);
                                            $chapitre = is_array($decoded) ? $decoded : [];
                                        } elseif (!is_array($chapitre)) {
                                            $chapitre = [];
                                        }
                                    @endphp
                                    @if(!empty($chapitre))
                                        @foreach($chapitre as $index => $one_chapitre)
                                            <div class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                                                <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                                                    <span class="h3 mb-3 d-block" style="font-weight: bold;">
                                                        Chapitre {{ $index + 1 }} :
                                                        {{ is_array($one_chapitre) ? ($one_chapitre['intitule'] ?? 'Chapitre sans titre') : ($one_chapitre->intitule ?? 'Chapitre sans titre') }}
                                                    </span>
                                                    <p class="mb-0" style="font-size: 1.15rem;">
                                                        <span style="font-weight: bold; text-decoration: underline;">Description</span><br>
                                                        @php
                                                            $description = is_array($one_chapitre) ? ($one_chapitre['chapitre_description'] ?? 'Aucune description') : ($one_chapitre->chapitre_description ?? 'Aucune description');
                                                        @endphp
                                                        <span style="text-align: justify; display: block;">
                                                            {{ strlen($description) > 200 ? substr($description, 0, 200) . '...' : $description }}
                                                        </span>
                                                    </p>
                                                    @php
                                                        $summernote = is_array($one_chapitre) ? ($one_chapitre['summernote'] ?? null) : ($one_chapitre->summernote ?? null);
                                                    @endphp
                                                    @if($summernote)
                                                        <div class="mt-2" style="font-size: 1.15rem;">
                                                            <span style="font-weight: bold; text-decoration: underline;">Contenu</span>
                                                            <div style="text-align: justify;">{!! html_entity_decode($summernote) !!}</div>
                                                        </div>
                                                    @endif
                                                    @php
                                                        $video_url = is_array($one_chapitre) ? ($one_chapitre['video_url'] ?? null) : ($one_chapitre->video_url ?? null);
                                                    @endphp
                                                    @if($video_url)
                                                        <div class="col-xl-6 col-sm-4 col-md-7 mt-2">
                                                            <span class="badge bg-warning text-dark mb-1">Vidéo</span>
                                                            <video width="100%" height="100%" controls>
                                                                <source src="{{ asset($video_url) }}" type="video/mp4">
                                                                Votre navigateur ne supporte pas la lecture vidéo.
                                                            </video>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>Aucun chapitre disponible</p>
                                    @endif
                                </div>
                                <div class="col-md-11 mt-3">
                                    <div class="d-flex gap-2">
                                        <form action="javascript:void(0)" method="post" class="delete-formation-form">
                                            @csrf
                                            <input type="hidden" name="slug" value="{{ $formation->slug }}">
                                            <button type="submit" class="btn btn-danger uniform-btn delete-formation-btn" data-element="{{ $j }}{{ $i }}">
                                                Supprimer
                                            </button>
                                        </form>
                                        <form action="javascript:void(0)" method="post" class="toggle-archive-form">
                                            @csrf
                                            <input type="hidden" name="slug" value="{{ $formation->slug }}">
                                            <button type="submit" class="btn uniform-btn toggle-archive-btn {{ $formation->archived ? 'btn-success' : 'btn-primary' }}" data-element="{{ $j }}{{ $i }}" data-archived="{{ $formation->archived ? '1' : '0' }}">
                                                {{ $formation->archived ? 'Désarchiver' : 'Archiver' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endforeach

    <div id="formateur-toast-message" style="display:none;position:fixed;bottom:30px;left:50%;transform:translateX(-50%);z-index:9999;min-width:220px;padding:8px 16px;" class="alert text-center p-2"></div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p id="confirmationMessage"></p>
                    <button type="button" class="btn btn-primary" id="confirmActionBtn">Confirmer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-select, .form-control {
            transition: all 0.3s ease;
        }
        .form-select:focus, .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0,123,255,0.3);
        }
        .input-group {
            border-radius: 8px;
            overflow: hidden;
        }
        .form-label {
            font-size: 0.9rem;
            color: #333;
        }
        .invalid-feedback {
            font-size: 0.85rem;
        }
        .uniform-btn {
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 5px;
            min-width: 100px;
            text-align: center;
        }
        .d-flex.gap-2 {
            gap: 10px;
        }
        .rounded-card {
            border-radius: 15px !important;
            overflow: hidden;
        }
        .rounded-card .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .card.h-100 {
            display: flex;
            flex-direction: column;
        }
        .card-img-top {
            max-height: 150px;
            object-fit: cover;
        }
        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1rem;
        }
        .card-body h5 {
            font-size: 1.1rem;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }
        .card-body ul {
            font-size: 0.9rem;
        }
        .card-body .btn {
            font-size: 0.9rem;
            padding: 0.4rem 0.8rem;
        }
        .col-lg-3 {
            padding-left: 10px;
            padding-right: 10px;
        }
        .mt-3.d-flex.justify-content-between {
            flex-wrap: nowrap;
            align-items: center;
            gap: 0.5rem;
        }
        .mt-3.d-flex.justify-content-between form {
            margin-bottom: 0;
        }
        .mt-3.d-flex.justify-content-between .btn {
            margin: 0;
            width: auto;
        }
        .btn-group-spacing {
            display: flex;
            flex-wrap: nowrap;
            align-items: center;
            gap: 0.5rem;
        }
        #signupModal .modal-content {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        #signupModal .modal-header {
            background-color:white;
            border-bottom: none;
        }
        #signupModal .modal-header h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color:rgb(149, 143, 238);
        }
        #signupModal .modal-body {
            padding: 2rem;
        }
        #signupModal .form-control {
            border-radius: 5px;
            border: 1px solid #d1e7ff;
            transition: border-color 0.3s ease;
        }
        #signupModal .form-control:focus {
            border-color: #124676;
            box-shadow: 0 0 5px rgba(18, 70, 118, 0.2);
        }
        #signupModal .btn-primary {
            background-color: #124676;
            border-color: #124676;
            transition: background-color 0.3s ease;
        }
        #signupModal .btn-primary:hover {
            background-color: #0e3558;
            border-color: #0e3558;
        }
        .toggle-status-btn i {
            font-size: 1.25rem;
        }
        .toggle-status-btn {
            padding: 6px 10px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .formation_user, 
        .formation_user h3, 
        .formation_user p, 
        .formation_user li, 
        .formation_user .text-muted {
            color: #000 !important;
        }
        .card.p-0.border-primary.rounded-card.h-100 {
            border: 2px solid #fff !important;
            border-radius: 15px !important;
            box-shadow: 0 2px 8px rgba(18,70,118,0.08);
            transition: box-shadow 0.3s, transform 0.3s;
            background: #fff;
        }
        .card.p-0.border-primary.rounded-card.h-100:hover {
            box-shadow: 0 8px 24px rgba(18,70,118,0.18), 0 1.5px 6px rgba(0,0,0,0.06);
            transform: translateY(-4px) scale(1.03);
            border-color: #e1e7ef !important;
            z-index: 2;
        }
    </style>


    <script>
$(document).ready(function() {
    try {
        var table_user = $('#listFormateur').DataTable({
            lengthChange: false,
            buttons: [
                { extend: 'excel', text: 'Exporter en Excel' },
                { extend: 'pdf', text: 'Exporter en PDF' }
            ],
            language: { url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json" },
            dom: 'Bfrtip'
        });
        table_user.buttons().container().appendTo('#listFormateur_wrapper .col-md-6:eq(0)');
    } catch (e) {
        console.error('Erreur lors de l\'initialisation de DataTables:', e);
    }

    $('#photo_profil').on('change', function(event) {
        const file = event.target.files[0];
        const imagePreview = $('#image_preview');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.hide();
        }
    });

    window.formateur = function(elm) {
        const formateurId = $(elm).data('element') ? $(elm).data('element').replace('formateur', '') : null;
        if (!formateurId) {
            console.error('data-element est undefined pour cet élément');
            return;
        }
        const targetSection = $(`.formations[data-element="fmts${formateurId}"]`);
        const fmt = $('#fmt');
        const fmtsSee = $('#fmtsSee');
        const formationUserSections = $('.formation_user');
        if (targetSection.length) {
            fmt.hide();
            formationUserSections.hide();
            targetSection.show();
            fmtsSee.show();
            $(elm).attr('aria-expanded', 'true');
        } else {
            console.error('Section cible non trouvée pour fmts' + formateurId);
        }
    };

    window.details = function(elm) {
        const elementId = $(elm).data('element');
        const targetSection = $(`.formation_user[data-element="${elementId}"]`);
        const formations = $('.formations');
        if (targetSection.length) {
            formations.hide();
            targetSection.show();
        } else {
            console.error('Section détails non trouvée pour ' + elementId);
        }
    };

    window.backToList = function() {
        const fmt = $('#fmt');
        const fmtsSee = $('#fmtsSee');
        const formations = $('.formations');
        const formationUserSections = $('.formation_user');
        fmt.show();
        fmtsSee.hide();
        formations.hide();
        formationUserSections.hide();
        $('[data-element^="formateur"]').attr('aria-expanded', 'false');
    };

    $('#createFormateurForm').on('submit', function(e) {
        e.preventDefault();
        $('.invalid-feedback').text('');
        $('#formMessage').removeClass('alert-success alert-danger').addClass('d-none').text('');
        let formData = new FormData(this);
        $.ajax({
            url: '{{ route("partner-requests.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#formMessage')
                    .removeClass('d-none alert-danger')
                    .addClass('alert-success')
                    .text(response.message || 'Formateur créé avec succès');
                $('#createFormateurForm')[0].reset();
                $('#image_preview').hide();
                setTimeout(function() {
                    $('#signupModal').modal('hide');
                    location.reload();
                }, 2000);
            },
            error: function(xhr) {
                let response = xhr.responseJSON;
                if (response && response.errors) {
                    $.each(response.errors, function(field, messages) {
                        $(`#${field}`).addClass('is-invalid');
                        $(`#${field}`).next('.invalid-feedback').text(messages[0]);
                    });
                } else {
                    $('#formMessage')
                        .removeClass('d-none alert-success')
                        .addClass('alert-danger')
                        .text(response?.message || 'Une erreur s\'est produite lors de la création du formateur.');
                }
            }
        });
    });

    function showConfirmationModal(message, callback) {
        $('#confirmationMessage').text(message);
        $('#confirmActionBtn').off('click').on('click', function() {
            callback();
            $('#confirmationModal').modal('hide');
        });
        $('#confirmationModal').modal('show');
    }

    $('.toggle-status-form').on('submit', function(e) {
        e.preventDefault();
        const slug = $(this).find('input[name="slug"]').val();
        const button = $(this).find('.toggle-status-btn');
        const icon = button.find('i');
        const statusText = button.find('.status-text');
        const action = statusText.text().trim() === 'Activer' ? 'restore' : 'destroy';
        const url = action === 'restore' ? '{{ route("formateurs.restore") }}' : '{{ route("formateurs.destroy") }}';
        $.ajax({
            url: url,
            method: 'POST',
            data: { _token: '{{ csrf_token() }}', slug: slug },
            success: function(response) {
                if (action === 'restore') {
                    statusText.text('Désactiver');
                    button.removeClass('btn-danger').addClass('btn-primary');
                    icon.removeClass('bi-lock-fill').addClass('bi-unlock-fill');
                    button.closest('tr').find('td').removeClass('text-danger');
                    showToastMessage(response.message || 'Formateur activé avec succès', false);
                } else {
                    statusText.text('Activer');
                    button.removeClass('btn-primary').addClass('btn-danger');
                    icon.removeClass('bi-unlock-fill').addClass('bi-lock-fill');
                    button.closest('tr').find('td').addClass('text-danger');
                    showToastMessage(response.message || 'Formateur désactivé avec succès', false);
                }
            },
            error: function(xhr) {
                showToastMessage(xhr.responseJSON?.message || 'Une erreur s\'est produite', true);
            }
        });
    });

    $('.delete-formation-form').on('submit', function(e) {
        e.preventDefault();
        const slug = $(this).find('input[name="slug"]').val();
        const elementId = $(this).find('.delete-formation-btn').data('element');
        showConfirmationModal('Êtes-vous sûr de vouloir supprimer cette formation ? Cette action est irréversible.', function() {
            $.ajax({
                url: '{{ route("formation.destroy") }}',
                method: 'POST',
                data: { _token: '{{ csrf_token() }}', slug: slug },
                success: function(response) {
                    showToastMessage(response.message || 'Formation supprimée avec succès', false);
                    location.reload();
                },
                error: function(xhr) {
                    showToastMessage(xhr.responseJSON?.message || 'Une erreur s\'est produite lors de la suppression', true);
                }
            });
        });
    });

    $('.toggle-archive-form').on('submit', function(e) {
        e.preventDefault();
        const slug = $(this).find('input[name="slug"]').val();
        const btn = $(this).find('.toggle-archive-btn');
        const elementId = btn.data('element');
        const isArchived = btn.data('archived') == 1;
        const actionUrl = isArchived ? '{{ route("formation.unarchive") }}' : '{{ route("formation.archive") }}';
        const confirmMsg = isArchived
            ? "Êtes-vous sûr de vouloir désarchiver cette formation ? Elle sera à nouveau accessible."
            : "Êtes-vous sûr de vouloir archiver cette formation ? Elle ne sera plus accessible pour être suivie.";
        showConfirmationModal(confirmMsg, function() {
            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: { _token: '{{ csrf_token() }}', slug: slug },
                success: function(response) {
                    const card = $(`.formations [data-element="${elementId}"]`).closest('.card');
                    const cardButtonContainer = card.find('.mt-3.d-flex.justify-content-center');
                    if (response.success) { // Vérifie si la réponse du serveur indique un succès
                        if (isArchived) {
                            showToastMessage(response.message || 'Formation désarchivée avec succès', false);
                            btn.data('archived', '0').text('Archiver').removeClass('btn-success').addClass('btn-primary');
                            $(`.formation_user[data-element="${elementId}"] .badge`).remove();
                            $(`.formation_user[data-element="${elementId}"] h3`).removeClass('text-muted');
                            cardButtonContainer.html('<button class="btn btn-primary uniform-btn" onclick="details(this)" data-element="' + elementId + '">Voir le contenu</button>');
                            card.find('.btn-secondary.btn-sm').remove();
                        } else {
                            showToastMessage(response.message || 'Formation archivée avec succès', false);
                            btn.data('archived', '1').text('Désarchiver').removeClass('btn-primary').addClass('btn-success');
                            $(`.formation_user[data-element="${elementId}"] h3`).addClass('text-muted').after('<span class="badge bg-secondary">Archivé</span>');
                            cardButtonContainer.html('<form action="javascript:void(0)" method="post" class="toggle-archive-form" style="display:inline;"><input type="hidden" name="slug" value="' + slug + '"><button type="submit" class="btn uniform-btn btn-success toggle-archive-btn" data-element="' + elementId + '" data-archived="1">Désarchiver</button></form>');
                            card.prepend('<button class="btn btn-secondary btn-sm uniform-btn">Archivé</button>');
                        }
                    } else {
                        showToastMessage('Une erreur est survenue lors de la mise à jour de l\'état.', true);
                    }
                },
                error: function(xhr) {
                    showToastMessage(xhr.responseJSON?.message || 'Une erreur s\'est produite', true);
                }
            });
        });
    });

    $('#tabFormateurs').on('click', function() {
        $('#fmt').show();
        $('.formations').hide();
        $('.formation_user').hide();
        $('#fmtsSee').hide();
    });

    function showToastMessage(msg, isError = false) {
        $('#formateur-toast-message')
            .removeClass('alert-danger alert-success')
            .addClass(isError ? 'alert-danger' : 'alert-success')
            .text(msg)
            .fadeIn(300)
            .delay(2500)
            .fadeOut(500);
    }

    document.getElementById('telephone').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</div>