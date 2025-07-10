<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">
<head>

  
  <!-- Basic Page Needs
	================================================== -->
  <meta charset="utf-8">
  <title>SinusTic Formation</title>

  <!-- Mobile Specific Metas
	================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Educenter HTML Template v1.0">
  <meta charset="utf-8">

  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{asset('../theme/plugins/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('../theme/plugins/bootstrap/bootstrap.min.css')}}">

  <!-- slick slider -->
  <link rel="stylesheet" href="{{asset('../theme/plugins/slick/slick.css')}}">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="{{asset('../theme/plugins/themify-icons/themify-icons.css')}}">
  <!-- animation css -->
  <link rel="stylesheet" href="{{asset('../theme/plugins/animate/animate.css')}}">
  <!-- aos -->
  <link rel="stylesheet" href="{{asset('../theme/plugins/aos/aos.css')}}">
  <!-- venobox popup -->
  <link rel="stylesheet" href="{{asset('../theme/plugins/venobox/venobox.css')}}">

  <!-- Main Stylesheet -->
  <link href="{{asset('../theme/css/style.css')}}" rel="stylesheet">

  <!--Favicon-->
  <link rel="shortcut icon" href="{{asset('/SinusTic.png')}}" type="image/x-icon">
  <link rel="icon" href="{{asset('/SinusTic.png')}}" type="image/x-icon">
  
  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>
</head>

<body>


  <!-- preloader start -->
  <!-- <div class="preloader">
    <img src="../theme/plugins/animate/6bfd37fece3f505417478ae4e2257150.gif" width="150px" alt="preloader">
  </div> -->
  <!-- preloader end -->

<!-- header -->
<header class="fixed-top header">
  <!-- top header -->
  <div class="top-header py-2 bg-white">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-lg-4 text-center text-lg-left">
          <a class="text-color mr-3" href="tel:+443003030266"><strong>APPEL</strong> (+229)</a>
          <ul class="list-inline d-inline">
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="https://www.facebook.com/profile.php?id=100086420568006"><i class="ti-facebook"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-twitter-alt"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-instagram"></i></a></li>
          </ul>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
          <ul class="list-inline">
{{--             <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="notice">Forum</a></li> --}}
            @if (Auth::check())
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="/home">Tableau de bord</a></li>
            @else
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#loginModal" data-toggle="modal" data-target="#loginModal">Connexion</a></li>
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#signupModal" data-toggle="modal" data-target="#signupModal">Inscription</a></li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- navbar -->
  <div class="navigation w-100">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark p-0">
        <a class="navbar-brand" href="/"><img src="{{asset('/SinusTic.png')}}" width="100px;" alt="logo"></a>
        <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item ">
              <a class="nav-link" href="/">Accueil</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="/about">À propos</a>
            </li>
            <li class="nav-item @@courses">
              <a class="nav-link" href="/courses">Formations</a>
            </li>
            {{-- <li class="nav-item @@events">
              <a class="nav-link" href="/events">Evenements</a>
            </li>
            <li class="nav-item @@blog">
              <a class="nav-link" href="/blog">BLOG</a>
            </li> --}}

            
            <!-- <li class="nav-item dropdown view">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pages
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/teacher">Professeure</a></li>
                <li><a class="dropdown-item" href="/research">Research</a></li>
                <li><a class="dropdown-item" href="/scholarship">Scholarship</a></li>
                <li><a class="dropdown-item" href="/course-single">Course Details</a></li>
                <li><a class="dropdown-item" href="/event-single">Event Details</a></li>
                <li><a class="dropdown-item" href="/blog-single">Blog Details</a></li>
                
                <li class="dropdown-item dropdown dropleft">
                  <a class="dropdown-toggle" href="#" id="navbarDropdownSubmenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sub Menu
                  </a>
                  <ul class="dropdown-menu dropdown-submenu" aria-labelledby="navbarDropdownSubmenu">
                    <li><a class="dropdown-item" href="#!">Sub Menu 01</a></li>
                    <li><a class="dropdown-item" href="#!">Sub Menu 02</a></li>
                    <li><a class="dropdown-item" href="#!">Sub Menu 03</a></li>
                  </ul>
                </li>
              </ul>
            </li> -->
            <li class="nav-item @@contact">
              <a class="nav-link" href="/contact">CONTACT</a>
            </li>
    <li class="nav-item">
            <button 
                type="button" 
                class="btn btn-info button-wiggle " 
                data-bs-toggle="offcanvas" 
                data-bs-target="#offcanvasStart" 
                aria-controls="offcanvasStart" 
                data-toggle="modal" 
                data-target="#partnerModal"
                style="background-color:#00458C; color:#fff; font-size:13px; cursor:pointer;">
                Être partenaire
            </button>
        </li>
        
        <style>
          @keyframes wiggleZoom {
            0%, 100% {
              transform: scale(1) rotate(0deg);
            }
            10% {
              transform: scale(1.2) rotate(-3deg); /* zoom plus fort + petit tilt */
            }
            20% {
              transform: scale(1.2) rotate(3deg);
            }
            30% {
              transform: scale(1.2) rotate(-3deg);
            }
            40% {
              transform: scale(1.2) rotate(3deg);
            }
            50% {
              transform: scale(1.2) rotate(0deg);
            }
            60%, 100% {
              transform: scale(1) rotate(0deg); /* retour à l'état normal */
            }
          }
          
          .button-wiggle {
            animation: wiggleZoom 4s ease-in-out infinite; /* 6s = 2s d'animation + 4s de pause */
            vertical-align: middle;
            padding: 8px 16px;
            display: inline-block;
            margin: 30px 0;
            border: 2px solid #00A2E8;
            border-radius: 10px;
            transition: all 0.3s ease;
          }
          </style>
          
        

          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>
<!-- /header -->
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                  <form id="signupForm" method="POST" action="{{ route('register') }}" class="row">
                      @csrf
                      <div class="col-12">
                          <input type="text" class="form-control mb-3 @error('nom') is-invalid @enderror" id="signupPhone" name="nom" placeholder="Nom" value="{{ old('nom') }}" required>
                      </div>
                      <div class="col-12">
                          <input type="text" class="form-control mb-3 @error('prenom') is-invalid @enderror" id="signupName" name="prenom" placeholder="Prénom" value="{{ old('prenom') }}" required>
                      </div>
                      <div class="col-12">
                          <input type="email" class="form-control mb-3 @error('email') is-invalid @enderror" id="signupEmail" name="email" placeholder="Email" value="{{ old('email') }}" required>
                      </div>
                      <div class="col-12 d-none">
                          <input type="hidden" name="role_id" value="1">
                      </div>
                      <div class="col-12">
                          <input type="password" class="form-control mb-3 @error('password') is-invalid @enderror" id="signupPassword" name="password" placeholder="Mot de passe" required minlength="8">
                      </div>
                      <div class="col-12">
                          <input type="password" class="form-control mb-3 @error('password_confirmation') is-invalid @enderror" id="signupPasswordConfirm" name="password_confirmation" placeholder ="Confirmer le Mot de passe" required minlength="8">
                      </div>
                      <div class="col-12">
                          <div id="formMessagesSignup" class="mt-3"></div>
                      </div>
                      <div class="d-flex">
                        <div class="col-6">
                          <button type="submit" class="btn btn-primary">S'inscrire</button>
                        </div>
                        <div class="col-6">
                          <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-dismiss="modal"  data-target="#loginModal">
                            Se connecter
                          </button>
                        </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
{{-- formulaire de connexion --}}

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content rounded-0 border-0 p-4">
          <div class="modal-header border-0">
              <h3>Connexion</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="loginForm" method="POST" action="{{ route('login') }}" class="row">
                  @csrf
                  <div class="col-12">
                      <input type="email" class="form-control mb-3 @error('email') is-invalid @enderror" id="loginEmail" name="email" placeholder="Email" value="{{ old('email') }}" required>
                      @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-12">
                      <input type="password" class="form-control mb-3 @error('password') is-invalid @enderror" id="loginPassword" name="password" placeholder="Mot de passe" required minlength="8">
                      @error('password')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-12">
                      <div id="formMessagesLogin" class="mb-3"></div>
                  </div>
                  <div class="d-flex">
                      <div class="col-6">
                          <button type="submit" class="btn btn-primary">Se connecter</button>
                      </div>
                      <div class="col-6">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#signupModal">
                              <span class=" text-decoration-none">S'inscrire</span>
                          </button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="partnerModal" tabindex="-1" role="dialog" aria-labelledby="partnerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content rounded-0 border-0 p-4">
          <div class="modal-header border-0">
              <h3 class="modal-title" id="partnerModalLabel">Devenir Formateur Partenaire</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="login">
                  <form method="POST" action="{{ route('partner-requests.store') }}" enctype="multipart/form-data" id="partnerForm">
                      @csrf
                      <!-- Message de succès/erreur unique -->
                      <div id="formMessagesPartner" class="mb-3"></div>

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
                        <label for="telephone">Numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="tel" name="telephone" id="telephone" class="form-control" required pattern="[0-9]{8,15}" placeholder="Ex: 97776655">
                        <small class="form-text text-muted">Saisissez uniquement des chiffres (8 à 15 chiffres, sans espace ni symbole).</small>
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
                                 style="display: none; width: 100%; max-width: 125px; max-height: 125px; aspect-ratio: 3/4; object-fit: cover; border-radius: 1rem; box-shadow: 0 8px 20px rgba(0,0,0,0.12); border: 1px solid #ddd;">
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
                        <small class="form-text text-muted">Formats acceptés : PDF, JPG, PNG. Taille maximale par fichier : 10MB.</small>
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
<div id="toast-message" style="display:none;position:fixed;bottom:40px;left:50%;transform:translateX(-50%);z-index:9999;min-width:220px;padding:12px 24px;font-size:1.1em;border-radius:8px;" class="alert text-center"></div>
       
<div>
            @yield('content')
</div>
        <div>
            @include('front.footer')
        </div><!-- jQuery -->
<script src="{{asset('../theme/plugins/jQuery/jquery.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('../theme/plugins/bootstrap/bootstrap.min.js')}}"></script>
<!-- slick slider -->
<script src="{{asset('../theme/plugins/slick/slick.min.js')}}"></script>
<!-- aos -->
<script src="{{asset('../theme/plugins/aos/aos.js')}}"></script>
<!-- venobox popup -->
<script src="{{asset('../theme/plugins/venobox/venobox.min.js')}}"></script>
<!-- filter -->
<script src="{{asset('../theme/plugins/filterizr/jquery.filterizr.min.js')}}"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU"></script>
<script src="{{asset('../theme/plugins/google-map/gmap.js')}}"></script>

  <!-- Main Script -->
<script src="{{asset('../theme/js/script.js')}}"></script>
<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
 @stack('scripts')
 
<script>
  document.getElementById('photo_profil').addEventListener('change', function() {
      const file = this.files[0];
      const imagePreview = document.getElementById('image_preview');

      if (file) {
          const reader = new FileReader();

          reader.onload = function(e) {
              imagePreview.src = e.target.result;
              imagePreview.style.display = 'block'; // Affiche l'aperçu
          }

          reader.readAsDataURL(file);
      } else {
          imagePreview.src = '#';
          imagePreview.style.display = 'none'; // Cache l'aperçu si aucun fichier n'est sélectionné
      }
  });
</script>
<!-- Pour le formulaire d'inscription  -->
<script>
  $(document).ready(function () {
      $('#signupForm').on('submit', function (e) {
          e.preventDefault();

          $.ajax({
              url: $(this).attr('action'),
              method: 'POST',
              data: $(this).serialize(),
              dataType: 'json',
              success: function (response) {
                  $('#formMessagesSignup').html('<div class="alert alert-success">' + response.message + '</div>');
                  setTimeout(function () {
                      window.location.href = response.redirect;
                  }, 2000);
              },
              error: function (xhr) {
                  let errors = xhr.responseJSON.errors || {};
                  let errorMessages = '';
                  for (let field in errors) {
                      errorMessages += errors[field][0] + '<br>';
                  }
                  $('#formMessagesSignup').html('<div class="alert alert-danger">' + (errorMessages || 'Une erreur est survenue.') + '</div>');
              }
          });
      });
  });
</script>
  <!-- Pour la connection  -->
 
 <script>
    $(document).ready(function () {
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();
            // $('#formMessages').empty();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    $('#formMessagesLogin').html('<div class="alert alert-success">' + response.message + '</div>');
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    }, 2000);
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors || {};
                    let errorMessages = '';
                    for (let field in errors) {
                        errorMessages += errors[field][0] + '<br>';
                    }
                    $('#formMessagesLogin').html('<div class="alert alert-danger">' + (errorMessages || 'Une erreur est survenue.') + '</div>');
                }
            });
        });
    });
</script>

<!-- Ajout du script pour gérer les messages -->
<script>
$(document).ready(function() {
    // Configuration globale d'AJAX pour inclure le token CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Prévisualisation de l'image
    $('#photo_profil').change(function() {
        const file = this.files[0];
        const reader = new FileReader();
        const preview = $('#image_preview');

        if (file) {
            reader.onload = function(e) {
                preview.attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        } else {
            preview.hide();
        }
    });

    // Validation des fichiers
    function validateFile(input, maxSize = 10) {
        const file = input.files[0];
        if (file && file.size > maxSize * 1024 * 1024) {
            input.value = '';
            return false;
        }
        return true;
    }

    // Gestion de la soumission du formulaire
    $('#partnerForm').on('submit', function(e) {
        e.preventDefault();
        
        // Réinitialiser les messages d'erreur
        $('.invalid-feedback').empty();
        $('#formMessagesPartner').empty();
        
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Envoi en cours...');
        
        const formData = new FormData(this);
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Affiche le toast flottant
                $('#toast-message')
                    .removeClass('alert-danger')
                    .addClass('alert-success')
                    .text(response.message || 'Votre demande a bien été transmise !')
                    .fadeIn(300);

                $('#partnerForm')[0].reset();
                $('#image_preview').hide();

                setTimeout(function() {
                    $('#toast-message').fadeOut(500);
                    $('#partnerModal').modal('hide');
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                }, 5000);
            },
            error: function(xhr) {
                let errorMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    errorMessage += '<i class="ti-alert"></i> Veuillez corriger les erreurs suivantes :<ul>';
                    
                    for (const field in errors) {
                        errorMessage += `<li>${errors[field][0]}</li>`;
                        $([name="${field}"]).addClass('is-invalid')
                            .siblings('.invalid-feedback').text(errors[field][0]);
                    }
                    
                    errorMessage += '</ul>';
                } else {
                    errorMessage += '<i class="ti-alert"></i> Une erreur est survenue. Veuillez réessayer.';
                }
                
                errorMessage += `
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`;
                
                $('#formMessagesPartner').html(errorMessage);
                $('#partnerModal').animate({ scrollTop: 0 }, 'slow');
            },
            complete: function() {
                submitBtn.prop('disabled', false).text('Envoyer la demande');
            }
        });
    });

    // Validation en temps réel des champs
    $('#partnerForm input, #partnerForm select, #partnerForm textarea').on('input change', function() {
        $(this).removeClass('is-invalid').siblings('.invalid-feedback').empty();
    });

    // Validation des fichiers au changement
    $('input[type="file"]').on('change', function() {
        if (!validateFile(this)) {
            $(this).addClass('is-invalid')
                .siblings('.invalid-feedback')
                .text('Le fichier est trop volumineux. Taille maximale : 10MB');
        } else {
            $(this).removeClass('is-invalid')
                .siblings('.invalid-feedback')
                .empty();
        }
    });
});
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const telInput = document.getElementById('telephone');
        telInput.addEventListener('input', function(e) {
            // Remplace tout caractère non-chiffre par rien
            this.value = this.value.replace(/[^0-9]/g, '');
        });
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

<style>
.alert {
    margin-bottom: 20px;
    border-radius: 4px;
    padding: 15px 20px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border-left: 4px solid #dc3545;
}

.alert i {
    margin-right: 8px;
}

.alert ul {
    margin-top: 10px;
    margin-bottom: 0;
    padding-left: 20px;
}

.alert-dismissible .close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 15px;
    color: inherit;
}

.invalid-feedback {
    display: none;
    color: #dc3545;
    font-size: 80%;
    margin-top: 0.25rem;
}

.is-invalid {
    border-color: #dc3545;
}

.is-invalid ~ .invalid-feedback {
    display: block;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.input-group .form-select {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.input-group .form-control {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
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
        


<script>
  AOS.init({
    duration: 900,
    once: true
  });
</script>
 

</body>

</html>
