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
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="https://facebook.com/themefisher/"><i class="ti-facebook"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="https://instagram.com/themefisher/"><i class="ti-instagram"></i></a></li>
          </ul>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
          <ul class="list-inline">
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="notice">Forum</a></li>
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
            <li class="nav-item @@events">
              <a class="nav-link" href="/events">Evenements</a>
            </li>
            <li class="nav-item @@blog">
              <a class="nav-link" href="/blog">BLOG</a>
            </li>

            
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
            animation: wiggleZoom 4s ease-in-out infinite; /* 6s = 2s d’animation + 4s de pause */
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
                          <input type="password" class="form-control mb-3 @error('password_confirmation') is-invalid @enderror" id="signupPasswordConfirm" name="password_confirmation" placeholder Ew="Confirmer le Mot de passe" required minlength="8">
                      </div>
                      <div class="col-12">
                          <div id="formMessages" class="mt-3"></div>
                      </div>
                      <div class="d-flex">
                        <div class="col-6">
                          <button type="submit" class="btn btn-primary">S'inscrire</button>
                        </div>
                        <div class="col-6">
                          <button type="submit" class="btn btn-primary text-white" data-toggle="modal" data-dismiss="modal"  data-target="#loginModal">
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
                  {{-- <div class="col-12">
                      <div class="form-check mb-3">
                          <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                          <label class="form-check-label" for="remember">{{ __('Remenber_me') }}</label>
                      </div>
                  </div> --}}
                  <div class="col-12">
                      <div id="formM" class="mb-3"></div>
                  </div>
                  <div class="d-flex">
                      <div class="col-6">
                          <button type="submit" class="btn btn-primary">Se connecter</button>
                      </div>
                      <div class="col-6">
                          <button type="submit" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#signupModal">
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
                  <form method="POST" action="/" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                          <div class="col-md-6 mb-3">
                              <label for="partnerName">Nom <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="partnerName" name="nom_complet" required>
                          </div>
                          <div class="col-md-6 mb-3">
                              <label for="partnerFirstName">Prénom(s) <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="partnerFirstName" name="prenom" required>
                          </div>
                      </div>
                      <div class="mb-3">
                          <label for="partnerEmail">Adresse e-mail <span class="text-danger">*</span></label>
                          <input type="email" class="form-control" id="partnerEmail" name="email" required>
                      </div>
                      <div class="mb-3">
                          <label for="partnerPhone">Numéro de téléphone <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="partnerPhone" name="telephone" required>
                      </div>
                      <div class="mb-3">
                            <label for="sex">Sexe <span class="text-danger">*</span></label>
                            <select class="form-control" id="sex" name="sex" required>
                                <option value="">Choisissez votre sexe</option>
                                <option value="M" {{ old('sex') == 'M' ? 'selected' : '' }}>Masculin</option>
                                <option value="F" {{ old('sex') == 'F' ? 'selected' : '' }}>Féminin</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                      <div class="mb-3">
                          <label for="partnerExpertise">Domaine(s) de formation expertisé(s) <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="partnerExpertise" name="domaines_expertise" placeholder="Séparer par des virgules si plusieurs" required>
                      </div>
                      <div class="mb-3">
                          <label for="linkedinProfile">Lien vers le profil LinkedIn (facultatif)</label>
                          <input type="url" class="form-control" id="linkedinProfile" name="linkedin">
                      </div>
                      <div class="mb-3">
                          <label for="presentation">Brève présentation de votre parcours et de votre expérience en formation <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="presentation" name="presentation" rows="4" required></textarea>
                      </div>
                      <div class="mb-3">
                          <label for="motivation">Pourquoi souhaitez-vous devenir formateur sur notre plateforme ? <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="motivation" name="motivation" rows="4" required></textarea>
                      </div>

                      <div class="mb-3">
                        <label for="photo_profil">Photo de profil</label>
                        <input type="file" class="form-control" id="photo_profil" name="photo_profil" accept="image/*" required>
                    </div>
                    <div class="mt-2">
                      <img id="image_preview" src="#" alt="Aperçu de l'image" style="max-width: 300px; max-height: 300px; display: none;">
                  </div><br>
            
                      <div class="mb-3">
                          <label for="cvFile">Curriculum Vitae (CV) <span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="cvFile" name="cv" accept="application/pdf" required>
                      </div>
                      <div class="mb-3">
                          <label for="motivationLetterFile">Lettre de motivation <span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="motivationLetterFile" name="lettre_motivation" accept="application/pdf" required>
                      </div>
                      <div class="mb-3">
                          <label for="certificatesFiles">Certificats ou diplômes pertinents</label>
                          <input type="file" class="form-control" id="certificatesFiles" name="certificats[]" accept="application/pdf,image/*" multiple>
                      </div>
                      <div class="mb-3">
                          <label for="idCardFile">Pièce d'identité </label>
                          <input type="file" class="form-control" id="idCardFile" name="piece_identite" accept="image/*,application/pdf" required>
                      </div>
                      
                      <button type="submit" class="btn btn-primary">Envoyer la demande</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
       
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
                  $('#formMessages').html('<div class="alert alert-success">' + response.message + '</div>');
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
                  $('#formMessages').html('<div class="alert alert-danger">' + (errorMessages || 'Une erreur est survenue.') + '</div>');
              }
          });
      });
  });
</script>
  <!-- Pour la connection  -->
 
 <script>
    $(document).ready(function () {
     /*    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 */
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();
            // $('#formMessages').empty();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    $('#formM').html('<div class="alert alert-success">' + response.message + '</div>');
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
                    $('#formM').html('<div class="alert alert-danger">' + (errorMessages || 'Une erreur est survenue.') + '</div>');
                }
            });
        });
    });
</script>
</body>

</html>
