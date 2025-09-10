@php
    $i = 0;
    $fmt_user = [];
@endphp

<!-- Dépendances CSS et JS en haut -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />

<div>
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <!-- Reste de la modale -->
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-0 border-0 p-4">
                <div class="modal-header border-0">
                    <h3 class="modal-title" id="signupModalLabel">Devenir Formateur Partenaire</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login">

{{-- 
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const input = document.querySelector("#phone");
        const iti = window.intlTelInput(input, {
            initialCountry: "auto",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/js/utils.js"
        });
        input.addEventListener('input', function() {
            // No need to update hidden input here, as the iti object handles it
        });
    });
</script>
 --}}



                        <form method="POST" action="{{ route('partner-requests.store') }}" enctype="multipart/form-data" id="adminPartnerForm">
                            @csrf
                            <!-- Messages de succès et d'erreur -->
                            <div id="formMessage" class="mb-3 d-none text-center" style="position: absolute; left: 0; right: 0; bottom: 24px; z-index: 10;"></div>
      

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="partnerName">Nom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="partnerName" name="nom_complet" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="partnerFirstName">Prénom(s) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="partnerFirstName" name="prenom" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="partnerEmail">Adresse e-mail <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="partnerEmail" name="email" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="telephone_admin">Numéro de téléphone <span class="text-danger">*</span></label>
                                <input id="telephone_admin" name="telephone" type="tel" class="form-control" placeholder="Saisissez votre numéro de téléphone" style="width:100%;" required pattern="[0-9]{8,15}" maxlength="15" />
                                <small class="form-text text-muted">
                                    Saisissez votre numéro de téléphone (exemple : 63122302 ou 0022963122302).
                                </small>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="sex">Sexe <span class="text-danger">*</span></label>
                                <select class="form-control" id="sex" name="sex" required>
                                    <option value="">Choisissez votre sexe</option>
                                    <option value="M">Masculin</option>
                                    <option value="F">Féminin</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3" style="position: relative;">
                                <label for="domainesDropdown">Domaine(s) de formation expertisé(s) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="domainesDropdown" readonly placeholder="Cliquez pour sélectionner" style="background: #fff; cursor:pointer;">
                                <div id="domainesList" style="display:none; position:absolute; z-index:10; background:#fff; width:100%; max-height:200px; overflow-y:auto;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Informatique" id="domaineInformatique">
                                        <label class="form-check-label" for="domaineInformatique">Informatique</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Gestion" id="domaineGestion">
                                        <label class="form-check-label" for="domaineGestion">Gestion</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Comptabilité" id="domaineComptabilite">
                                        <label class="form-check-label" for="domaineComptabilite">Comptabilité</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Marketing" id="domaineMarketing">
                                        <label class="form-check-label" for="domaineMarketing">Marketing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Langues" id="domaineLangues">
                                        <label class="form-check-label" for="domaineLangues">Langues</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Développement personnel" id="domaineDevPerso">
                                        <label class="form-check-label" for="domaineDevPerso">Développement personnel</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Santé" id="domaineSante">
                                        <label class="form-check-label" for="domaineSante">Santé</label>
                                    </div>


                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Ressources humaines" id="domaineRH">
                                        <label class="form-check-label" for="domaineRH">Ressources humaines</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Sciences de l'éducation" id="domaineEducation">
                                        <label class="form-check-label" for="domaineEducation">Sciences de l'éducation</label>
                                    </div>


                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Autre" id="domaineAutre">
                                        <label class="form-check-label" for="domaineAutre">Autre</label>
                                    </div>
                                    <input type="text" class="form-control mt-2" id="autreDomaine" name="autre_domaine" placeholder="Précisez votre domaine" style="display:none;">
                                </div>
                                <!-- Champ caché pour envoyer les domaines sélectionnés -->
                                <input type="hidden" name="domaines_expertise" id="domaines_expertise_hidden">
                                <div class="invalid-feedback"></div>
                            </div>
                         

                            <div class="mb-3">
                                <label for="linkedinProfile">Lien vers le profil LinkedIn (facultatif)</label>
                                <input type="url" class="form-control" id="linkedinProfile" name="linkedin" placeholder="https://www.linkedin.com/in/votre-profil">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="presentation">Brève présentation de votre parcours et de votre expérience en formation <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="presentation" name="presentation" rows="4" required></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="motivation">Pourquoi souhaitez-vous devenir formateur sur notre plateforme ? <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="motivation" name="motivation" rows="4" required></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
      
                            <div class="mb-3">
                                <label for="photo_profil">Photo de profil <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="photo_profil" name="photo_profil" accept="image/jpeg,image/png,image/jpg" required>
                                <small class="form-text text-muted">Format accepté : JPG, PNG. Taille maximale : 10MB. Dimensions recommandées : 500x500 pixels.</small>
                                <div class="invalid-feedback"></div>
                                <div class="mt-3 text-left">
                                    <img id="image_preview"
                                         src="#"
                                         alt="Aperçu de l'image"
                                         style="
                                            display: none;
                                            width: 100%;
                                            max-width: 125px;
                                            aspect-ratio: 3/4;
                                            object-fit: cover;
                                            border-radius: 1rem;
                                            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
                                            border: 1px solid #ddd;
                                         ">
                                </div>
                                
                            </div>
      
                            <div class="mb-3">
                                <label for="cvFile">Curriculum Vitae (CV) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="cvFile" name="cv" accept="application/pdf" required>
                                <small class="form-text text-muted">Format accepté : PDF. Taille maximale : 10MB.</small>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="motivationLetterFile">Lettre de motivation <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="motivationLetterFile" name="lettre_motivation" accept="application/pdf" required>
                                <small class="form-text text-muted">Format accepté : PDF. Taille maximale : 10MB.</small>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="certificatesFiles">Certificats ou diplômes pertinents</label>
                                <input type="file" class="form-control" id="certificatesFiles" name="certificats[]" accept="application/pdf,image/jpeg,image/png,image/jpg" multiple>
                                <small class="form-text text-muted">Formats acceptés : PDF, JPG, PNG. Taille maximale par fichier : 10MB. Maximum 5 fichiers.</small>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="idCardFile">Pièce d'identité <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="idCardFile" name="piece_identite" accept="image/jpeg,image/png,image/jpg,application/pdf" required>
                                <small class="form-text text-muted">Formats acceptés : PDF, JPG, PNG. Taille maximale : 10MB.</small>
                                <div class="invalid-feedback"></div>
                            </div>
      
                            <button type="submit" class="btn btn-primary">Envoyer la demande</button>
                        </form>
                    </div>
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
                                       {{--  @if($one_formation->status === 'Archiver')
                                            <button class="btn btn-secondary btn-sm uniform-btn">Archivé</button>
                                        @endif --}}
                                        <img class="card-img-top rounded-top" src="{{ asset($one_formation->image_url ?? 'images/placeholder.jpg') }}" alt="course thumb" style="height: 150px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="text-color text-dark {{ $one_formation->status === 'Archiver' ? 'text-muted' : '' }} mb-2">{{ $one_formation->titre ?? 'Sans titre' }}</h5>
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
                                                <button class="btn btn-primary uniform-btn" onclick="details(this)" data-element="{{ $j }}fmt{{ $index }}">Voir le contenu</button>
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
                        <h3 class="{{ $formation->status === 'Archiver' ? 'text-muted' : '' }}">{{ $formation->titre ?? 'Sans titre' }}</h3>
                        @if($formation->status === 'Archiver')
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
                            @php
                                // Normaliser en objets
                                $partiesRaw = $formation->chapitre ?? '[]';
                                if (is_string($partiesRaw)) { $decoded = json_decode($partiesRaw); } else { $decoded = $partiesRaw; }
                                $parties = is_array($decoded) ? $decoded : [];
                                $parties = json_decode(json_encode($parties));
                                $sectionKey = $j . 'fmt' . $i;
                                $totalChapters = 0;
                                foreach ($parties as $pTmp) { if (isset($pTmp->chapitres) && is_array($pTmp->chapitres)) { $totalChapters += count($pTmp->chapitres); } }
                            @endphp
                            <div class="row">
                                <div class="col-lg-3 col-md-4 mb-3">
                                    <div class="card shadow-sm" style="border-radius:16px;">
                                        <div class="card-body p-3 p-md-4">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-journal-text me-2" style="color:#125ea2;font-size:1.2rem;"></i>
                                                    <h6 class="mb-0" style="font-weight:800;color:#1e3a8a;">Navigation</h6>
                                                </div>
                                                <div class="d-flex gap-1">
                                                    <button class="btn btn-sm btn-outline-secondary" id="collapseAll-{{ $sectionKey }}" title="Tout réduire"><i class="bi bi-chevron-double-up"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary" id="expandAll-{{ $sectionKey }}" title="Tout déployer"><i class="bi bi-chevron-double-down"></i></button>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control mb-3" id="navSearch-{{ $sectionKey }}" placeholder="Rechercher un chapitre..." style="border-radius:10px;">
                                            <div id="nav-{{ $sectionKey }}">
                                                @php $linearIndexNav = 0; @endphp
                                                @foreach($parties as $pIndex => $partie)
                                                    @php $partyCollapseId = 'party-'.$sectionKey.'-'.$pIndex; @endphp
                                                    <div class="mb-2 party-block" data-party="{{ $pIndex }}">
                                                        <div class="d-flex align-items-center justify-content-between px-2 py-2" data-bs-toggle="collapse" data-bs-target="#{{ $partyCollapseId }}" style="background:#edf6ff;border-radius:10px;cursor:pointer;">
                                                            <div style="color:#1976d2;font-weight:700;">Partie {{ $partie->num_partie ?? ($pIndex+1) }} — {{ $partie->titre ?? 'Sans titre' }}</div>
                                                            <i class="bi bi-chevron-down chevron"></i>
                                                        </div>
                                                        <div class="collapse show mt-2" id="{{ $partyCollapseId }}">
                                                            @if(isset($partie->chapitres) && is_array($partie->chapitres))
                                                                @foreach($partie->chapitres as $cIndex => $chap)
                                                                    @php $currentIndex = $linearIndexNav; $linearIndexNav++; @endphp
                                                                    <button type="button" class="btn d-flex align-items-center nav-chapter px-2 py-2 mt-2" data-target-index="{{ $currentIndex }}" data-party="{{ $pIndex }}" style="width:100%;text-align:left;border-radius:10px;background:#fff;border:1px solid #ecf1f7;">
                                                                        <span class="badge" style="width:34px;height:28px;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;margin-right:8px;font-weight:700;background:#eef3f9;color:#125ea2;">{{ $chap->num_chapitre ?? ($cIndex+1) }}</span>
                                                                        <span class="label" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:80%;">Chapitre {{ $chap->num_chapitre ?? ($cIndex+1) }} — {{ $chap->intitule ?? 'Sans intitulé' }}</span>
                                                                    </button>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    @php $linearIndexContent = 0; @endphp
                                    @foreach($parties as $pIndex => $partie)
                                        @if(isset($partie->chapitres) && is_array($partie->chapitres))
                                            @foreach($partie->chapitres as $cIndex => $one_chapitre)
                                                @php $currentIndex = $linearIndexContent; $linearIndexContent++; @endphp
                                                <div class="chapter-block-{{ $sectionKey }}" data-index="{{ $currentIndex }}" style="display:none;">
                                                    <div class="card" style="border:0;border-radius:16px;overflow:hidden;box-shadow:0 6px 18px rgba(0,0,0,0.06);">
                                                        <div class="card-header p-3 p-md-4" style="background:linear-gradient(135deg,#e3f2fd,#f8fafc);">
                                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                                <div>
                                                                    <div class="text-muted">Partie {{ $partie->num_partie ?? ($pIndex+1) }} — {{ $partie->titre ?? 'Sans titre' }}</div>
                                                                    <h4 class="mt-1 mb-0" style="font-weight:800;color:#2c3e50;">Chapitre {{ $one_chapitre->num_chapitre ?? ($cIndex+1) }} : <span style="font-weight:800;color:#1976d2;">{{ $one_chapitre->intitule ?? 'Sans intitulé' }}</span></h4>
                                                                </div>
                                                                <div class="d-flex align-items-center text-muted small"><i class="bi bi-collection-play me-1"></i> {{ $currentIndex+1 }} / {{ $totalChapters }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-3 p-md-4">
                                                            <div class="mb-3" style="color:#5b6b7c;">
                                                                <h6 class="mb-2" style="color:#125ea2;font-weight:700;">Présentation du chapitre</h6>
                                                                <p class="mb-0">{{ $one_chapitre->chapitre_description ?? '' }}</p>
                                                            </div>
                                                            <hr class="my-3" />
                                                            @if(isset($formation->type) && $formation->type == 'texte')
                                                                <div class="card-text" style="font-size:1.05rem;color:#3c4753;line-height:1.8;">
                                                                    {!! isset($one_chapitre->summernote) ? htmlspecialchars_decode($one_chapitre->summernote) : ($one_chapitre->contenu_texte ?? ($one_chapitre->contenu ?? 'Aucun contenu texte.')) !!}
                                                                </div>
                                                            @else
                                                                @if(isset($one_chapitre->video_url) && $one_chapitre->video_url)
                                                                    <div class="mb-3">
                                                                        <video src="{{ asset($one_chapitre->video_url) }}" controls class="video-chapitre" style="max-height:320px;width:100%;object-fit:cover;background:#000;border-radius:12px;"></video>
                                                                    </div>
                                                                @else
                                                                    <p class="text-danger">Pas de vidéo pour ce chapitre.</p>
                                                                @endif
                                                                @if(isset($one_chapitre->editordata_video) && $one_chapitre->editordata_video)
                                                                    <div class="card-text" style="font-size:1.05rem;color:#3c4753;line-height:1.8;">
                                                                        {!! htmlspecialchars_decode($one_chapitre->editordata_video) !!}
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                                                            <div class="d-flex justify-content-between">
                                                                @if($currentIndex > 0)
                                                                    <button class="btn btn-outline-secondary btn-lg btn-precedent-{{ $sectionKey }}" type="button" data-index="{{ $currentIndex }}"><i class="bi bi-arrow-left"></i> Précédent</button>
                                                                @else
                                                                    <span></span>
                                                                @endif
                                                                @if($currentIndex < ($totalChapters - 1))
                                                                    <button class="btn btn-primary btn-lg btn-suivant-{{ $sectionKey }}" type="button" data-index="{{ $currentIndex }}">Suivant <i class="bi bi-arrow-right"></i></button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach

                                    <div class="mt-3">
                                        <div class="d-flex gap-2">
                                            <form action="javascript:void(0)" method="post" class="delete-formation-form">
                                                @csrf
                                                <input type="hidden" name="slug" value="{{ $formation->slug }}">
                                                <button type="submit" class="btn btn-danger uniform-btn delete-formation-btn" data-element="{{ $j }}{{ $i }}">Supprimer</button>
                                            </form>
                                            <form action="javascript:void(0)" method="post" class="toggle-archive-form">
                                                @csrf
                                                <input type="hidden" name="slug" value="{{ $formation->slug }}">
                                                <button type="submit" class="btn uniform-btn toggle-archive-btn {{ $formation->status === 'Archiver' ? 'btn-success' : 'btn-primary' }}" data-element="{{ $j }}{{ $i }}" data-archived="{{ $formation->status === 'Archiver' ? '1' : '0' }}">{{ $formation->status === 'Archiver' ? 'Désarchiver' : 'Archiver' }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            (function() {
                                const root = document.querySelector('.formation_user[data-element="{{ $sectionKey }}"]');
                                if (!root) return;
                                const blocks = Array.from(root.querySelectorAll('.chapter-block-{{ $sectionKey }}'));
                                const allNavButtons = Array.from(root.querySelectorAll('#nav-{{ $sectionKey }} .nav-chapter'));
                                const searchInput = root.querySelector('#navSearch-{{ $sectionKey }}');
                                const collapseAllBtn = root.querySelector('#collapseAll-{{ $sectionKey }}');
                                const expandAllBtn = root.querySelector('#expandAll-{{ $sectionKey }}');
                                const storageKey = 'formation:{{ $formation->id ?? 0 }}:lastChapterIndex';

                                function updateNavActive(activeIndex) {
                                    allNavButtons.forEach(btn => {
                                        const idx = parseInt(btn.getAttribute('data-target-index'), 10);
                                        if (idx === activeIndex) { btn.classList.add('active'); btn.querySelector('.badge')?.classList.add('text-white'); }
                                        else { btn.classList.remove('active'); btn.querySelector('.badge')?.classList.remove('text-white'); }
                                    });
                                }

                                function showByIndex(targetIndex) {
                                    blocks.forEach((b, i) => { b.style.display = (i === targetIndex) ? '' : 'none'; });
                                    updateNavActive(targetIndex);
                                    try { localStorage.setItem(storageKey, String(targetIndex)); } catch(e) {}
                                    const activeNav = root.querySelector('#nav-{{ $sectionKey }} .nav-chapter.active');
                                    if (activeNav) activeNav.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                                    window.scrollTo({ top: 0, behavior: 'smooth' });
                                }

                                // Init first or stored
                                let saved = parseInt((() => { try { return localStorage.getItem(storageKey) } catch(e) { return null } })() || '-1', 10);
                                if (Number.isNaN(saved) || saved < 0 || saved >= blocks.length) saved = 0;
                                if (blocks.length > 0) showByIndex(saved);

                                // Nav clicks
                                allNavButtons.forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        const target = parseInt(this.getAttribute('data-target-index'), 10);
                                        showByIndex(target);
                                    });
                                });

                                // Prev/Next
                                root.querySelectorAll('.btn-suivant-{{ $sectionKey }}').forEach(function(btn) {
                                    btn.addEventListener('click', function() {
                                        const current = parseInt(this.getAttribute('data-index'), 10);
                                        const next = current + 1;
                                        if (next < blocks.length) showByIndex(next);
                                    });
                                });
                                root.querySelectorAll('.btn-precedent-{{ $sectionKey }}').forEach(function(btn) {
                                    btn.addEventListener('click', function() {
                                        const current = parseInt(this.getAttribute('data-index'), 10);
                                        const prev = current - 1;
                                        if (prev >= 0) showByIndex(prev);
                                    });
                                });

                                // Search filter
                                if (searchInput) {
                                    searchInput.addEventListener('input', function() {
                                        const q = this.value.trim().toLowerCase();
                                        const partyBlocks = Array.from(root.querySelectorAll('#nav-{{ $sectionKey }} .party-block'));
                                        partyBlocks.forEach(pb => {
                                            let visibleCount = 0;
                                            pb.querySelectorAll('.nav-chapter').forEach(btn => {
                                                const label = btn.querySelector('.label')?.textContent?.toLowerCase() || '';
                                                const hit = label.includes(q);
                                                btn.style.display = hit ? '' : 'none';
                                                if (hit) visibleCount++;
                                            });
                                            pb.style.display = visibleCount > 0 ? '' : 'none';
                                        });
                                    });
                                }

                                // Collapse/expand all
                                if (collapseAllBtn) collapseAllBtn.addEventListener('click', () => {
                                    root.querySelectorAll('.party-block .collapse.show').forEach(el => new bootstrap.Collapse(el, { toggle: true }));
                                });
                                if (expandAllBtn) expandAllBtn.addEventListener('click', () => {
                                    root.querySelectorAll('.party-block .collapse:not(.show)').forEach(el => new bootstrap.Collapse(el, { toggle: true }));
                                });
                            })();
                            </script>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endforeach

    <!-- Toast pour messages de succès/erreur -->
    <div id="formateur-toast-message"
         style="display:none;position:fixed;bottom:40px;left:50%;transform:translateX(-50%);z-index:9999;min-width:220px;max-width:90vw;padding:12px 24px;font-size:1.1em;border-radius:8px;"
         class="alert text-center">
    </div>

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
<!-- CSS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
    <!-- pour le domaine -->
<style>
#domainesList {
    margin-top: 4px;
    padding: 8px 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #000;
    border-radius: 6px;
}
#domainesList .form-check {
    margin-bottom: 4px;
}
#domainesList .form-check:last-child {
    margin-bottom: 0;
}


</style>



<style>
  .iti {
  width: 100% !important;
  max-width: 100% !important;
}

.iti--separate-dial-code .iti__selected-flag {
    height: 100%;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  border-right: none;
  display: flex;
  align-items: center;
  padding-left: 12px;
  background: #fff;
}
.iti--separate-dial-code input {
    border-top-left-radius: 0 !important;
  border-bottom-left-radius: 0 !important;
  border-left: none !important;
  height: 38px !important; /* même hauteur que les autres champs Bootstrap */
  line-height: 1.5;
  padding-left: 8px;
}


#phone.form-control {
  width: 100% !important;
  max-width: 100% !important;
  height: 38px !important; /* même hauteur que les autres champs Bootstrap */
  font-size: 15px;
  padding: 8px 12px;
  box-sizing: border-box;
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

    $('#adminPartnerForm').on('submit', function(e) {
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
                showAdminToastMessage(response.message || 'Formateur créé avec succès', false);
                $('#adminPartnerForm')[0].reset();
                $('#image_preview').hide();
                setTimeout(function() {
                    $('#formateur-toast-message').fadeOut(500);
                    $('#signupModal').modal('hide');
                    location.reload();
                }, 5000);
            },
            error: function(xhr) {
                let response = xhr.responseJSON;
                if (response && response.errors) {
                    let allErrors = [];
                    $.each(response.errors, function(field, messages) {
                        $(`#${field}`).addClass('is-invalid');
                        $(`#${field}`).next('.invalid-feedback').text(messages[0]);
                        allErrors.push(messages[0]);
                    });
                    showAdminToastMessage(allErrors.join('<br>'), true);
                } else {
                    $('#formMessage')
                        .removeClass('d-none alert-success')
                        .addClass('alert-danger')
                        .text(response?.message || 'Une erreur s\'est produite lors de la création du formateur.');
                    showAdminToastMessage(response?.message || 'Une erreur s\'est produite lors de la création du formateur.', true);
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

    
});
    </script> 



{{-- pour le domaine  --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdown = document.getElementById('domainesDropdown');
        const list = document.getElementById('domainesList');
        const checkboxes = list.querySelectorAll('.form-check-input');
        const hiddenInput = document.getElementById('domaines_expertise_hidden');
        const autreCheckbox = document.getElementById('domaineAutre');
        const autreInput = document.getElementById('autreDomaine');

        // Affiche/masque la liste au clic
        dropdown.addEventListener('click', function() {
            list.style.display = (list.style.display === 'none' || list.style.display === '') ? 'block' : 'none';
        });

        // Ferme la liste si on clique ailleurs
        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target) && !list.contains(e.target)) {
                list.style.display = 'none';
            }
        });

        // Met à jour l'affichage et le champ caché
        function updateSelected() {
            let selected = [];
            checkboxes.forEach(cb => {
                if (cb.checked && cb.value !== 'Autre') selected.push(cb.value);
            });
            if (autreCheckbox.checked && autreInput.value.trim() !== '') {
                selected.push(autreInput.value.trim());
            }
            dropdown.value = selected.join(', ');
            hiddenInput.value = selected.join(',');
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                if (cb.value === 'Autre') {
                    autreInput.style.display = cb.checked ? 'block' : 'none';
                    if (!cb.checked) autreInput.value = '';
                }
                updateSelected();
            });
        });

        autreInput.addEventListener('input', updateSelected);
    });
    </script>
  
</div>


<script>
    // Fonction toast dédiée à l'admin (nom unique)
    function showAdminToastMessage(msg, isError = false) {
        $('#formateur-toast-message')
            .removeClass('alert-danger alert-success')
            .addClass(isError ? 'alert-danger' : 'alert-success')
            .html(msg)
            .fadeIn(300)
            .delay(3500)
            .fadeOut(500);
    }
    </script>
    
<script>
document.addEventListener('DOMContentLoaded', function() {
    const telInput = document.getElementById('telephone_admin');
    if (telInput) {
        telInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);
        });
    }
});
</script>

<style>
#formateur-toast-message {
    box-shadow: 0 4px 24px rgba(18,70,118,0.18), 0 1.5px 6px rgba(0,0,0,0.06);
    background: #fff;
    color: #333;
    border: 1px solid #e1e7ef;
    font-weight: 500;
}
#formateur-toast-message.alert-success {
    background: #e6f9ec;
    color: #1a7f37;
    border-color: #b6e2c6;
}
#formateur-toast-message.alert-danger {
    background: #ffeaea;
    color: #b42318;
    border-color: #f5c2c7;
}
</style>




