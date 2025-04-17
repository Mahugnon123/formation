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
          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>
<!-- /header -->
<!-- Modal -->
<div class="modal fade" id="signupModal" tab/="-1" role="dialog" aria-hidden="true">
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
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="signupPhone" name="nom" placeholder="Nom">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="signupName" name="prenom" placeholder="Prénom">
                        </div>
                        <div class="col-12">
                            <input type="email" class="form-control mb-3" id="signupEmail" name="email" placeholder="Email">
                        </div>

                       <!--  <div class="col-12">
                            <input type="number" class="form-control mb-3" id="signupEmail" name="contact" placeholder="Contact">
                        </div>

                          <div class="col-12">
                            <input type="date" class="form-control mb-3" id="date" name="birthday" placeholder="birthday">
                        </div>

                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="pays" name="pays" placeholder="Pays">
                        </div>

                        <div class="col-12">
                            <input id="photo_profil" type="file" class="form-control mb-3 @error('photo_profil') is-invalid @enderror" accept="image/*" required name="photo_profil" value="{{ old('photo_profil') }}" placeholder="Photo de profil">
                        </div>


                        <div class="col-12">
                             <select  class="form-control" name="sex">
                                  <option >
                                    Choisissez votre sexe
                                  </option>
                                  <option value="M">
                                    Masculin
                                  </option>
                                  <option value="F">
                                    Feminin
                                  </option>
                             </select>
                        </div>  -->

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
                            <button type="button" class="btn btn-primary"> <a href="#loginModal" class="text-decoration:none"  style="text-decoration:none;">Se connecter </a></button>
                        </div>
                        </div>
                        
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="loginModal" tab/="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Connexion</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}" class="row">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control mb-3" id="loginPhone" name="email" placeholder="Email">
                    </div>
                    <div class="col-12">
                        <input type="password" class="form-control mb-3" id="loginPassword" name="password" placeholder="Mot de passe">
                    </div>
                    <div class="col-12">
                          <input type="checkbox" name="remember" id="remember" class="form-checkbox"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2">{{ __('Remember Me') }}</span>                   
                     </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
                </form>
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
 

</body>

</html>
