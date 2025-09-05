@php
use Illuminate\Support\Str;
@endphp

@extends("front.app")
@section("content")

<!-- hero slider -->
<section class="hero-section overlay bg-cover" data-background="../theme/images/banner/banner-2.jpg">
  <div class="container">
    <div class="hero-slider">
      <!-- slider item -->
      <div class="hero-slider-item">
        <div class="row">
          <div class="col-md-8">
            <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".1">Votre brillant avenir est notre mission</h1>
            <p class="text-muted mb-4" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".4">Nous vous permettrons de bénéficier de plus de souplesse pour accorder votre carrière, vos études ainsi que votre vie privée.</p>
            <a href="{{ route('courses.index') }}" class="btn btn-primary" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".7">Allons-y</a>
          </div>
        </div>
      </div>
      <!-- slider item -->
      <div class="hero-slider-item">
        <div class="row">
          <div class="col-md-8">
            <h1 class="text-white" data-animation-out="fadeOutUp" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".1">Votre brillant avenir est notre mission</h1>
            <p class="text-muted mb-4" data-animation-out="fadeOutUp" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".4">Nous vous permettrons de bénéficier de plus de souplesse pour accorder votre carrière, vos études ainsi que votre vie privée</p>
            <a href="{{ route('courses.index') }}" class="btn btn-primary" data-animation-out="fadeOutUp" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".7">Allons-y</a>
          </div>
        </div>
      </div>
      <!-- slider item -->
      <div class="hero-slider-item">
        <div class="row">
          <div class="col-md-8">
            <h1 class="text-white" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">Votre brillant avenir est notre mission</h1>
            <p class="text-muted mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".4">Nous vous permettrons de bénéficier de plus de souplesse pour accorder votre carrière, vos études ainsi que votre vie privée</p>
            <a href="{{ route('courses.index') }}" class="btn btn-primary" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="zoomIn" data-delay-in=".7">Allons-y</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /hero slider -->

<!-- banner-feature -->
<!-- <section class="bg-gray overflow-md-hidden">
  <div class="container-fluid p-0">
    <div class="row no-gutters">
      <div class="col-xl-4 col-lg-5 align-self-end">
        <img class="img-fluid w-100" src="../theme/images/banner/banner-feature.png" alt="banner-feature">
      </div>
      <div class="col-xl-8 col-lg-7">
        <div class="row feature-blocks bg-gray justify-content-between">
          <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
            <i class="ti-book mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
            <h3 class="mb-xl-4 mb-lg-3 mb-4">Scholorship News</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
              et dolore magna aliqua. Ut enim ad</p>
          </div>
          <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
            <i class="ti-blackboard mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
            <h3 class="mb-xl-4 mb-lg-3 mb-4">Our Notice Board</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
              et dolore magna aliqua. Ut enim ad</p>
          </div>
          <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
            <i class="ti-agenda mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
            <h3 class="mb-xl-4 mb-lg-3 mb-4">Our Achievements</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
              et dolore magna aliqua. Ut enim ad</p>
          </div>
          <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
            <i class="ti-write mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
            <h3 class="mb-xl-4 mb-lg-3 mb-4">Admission Now</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
              et dolore magna aliqua. Ut enim ad</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->
<!-- /banner-feature -->

<!-- about us -->
<section class="section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 order-2 order-md-1">
        <h3 class="section-title">Pourquoi choisir EduPulse</h3>
        <p>EduPulse est une plateforme e-learning qui accorde une grande place aux échanges entre pairs, comme sur un réseau social. De même, les contenus sont enrichis de quiz, de sondages et de travaux collaboratifs, ce qui renforce l'engagement et la réussite de l'apprenant. Au final, celui-ci, acteur de sa formation, aura plus de facilités à mettre en pratique ses nouveaux acquis. En un mot : il deviendra plus performant. </p>
        <a href="about" class="btn btn-outline-primary">Voir plus</a>
      </div>
      <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
        <img class="img-fluid w-100" src="plateforme-e-learning-entreprise.jpg" alt="about image">
      </div>
    </div>
  </div>
</section>
<!-- /about us -->

<!-- courses -->
<section class="section-sm">
  <div class="container">
      <div class="row">
          <div class="col-12">
              <div class="d-flex align-items-center section-title justify-content-between">
                  <h2 class="mb-0 text-nowrap mr-3">Nos formations les plus récentes</h2>
                  <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                  <div>
                      <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary ml-sm-3 d-none d-sm-block">Voir toutes nos formations</a>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          @foreach($latestFormations->chunk(4) as $row)
              @foreach($row as $one_formation)
              <div class="col-lg-3 col-sm-6 mb-5">
                <a href="{{ url('/apprenant-course-detail/'.$one_formation->slug)}}">
                    <div class="card p-0 border-primary rounded-0 hover-shadow">
                        <div style="height: 200px; overflow: hidden;"> <img class="card-img-top rounded-0" src="{{asset($one_formation->image_url)}}" alt="course thumb" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <ul class="list-inline mb-2">
                                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>{{$one_formation->created_at}}</li>
                            </ul>
                            <h4 class="card-title d-flex justify-content-space-between" style="min-height: 2.4em !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;text-align:center;">
                              @php
                                  $maxLengthPerLine = 20; // Estimation pour une ligne
                                  $maxLines = 2; // Maximum 2 lignes
                                  $maxLength = $maxLengthPerLine * $maxLines; // 40 caractères maximum
                                  $title = $one_formation->titre;
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
                          @if(strlen($one_formation->description) > 50)
                          <p class="card-text mb-4" style="min-height: 2.8em !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                              @php
                                  $maxLengthPerLine = 25; // Estimation pour une ligne (ajuste selon la largeur)
                                  $maxLines = 2; // Maximum 2 lignes
                                  $maxLength = $maxLengthPerLine * $maxLines; // 50 caractères maximum
                                  $description = $one_formation->description;
                                  $words = explode(' ', $description); // Sépare les mots
                                  $currentLength = 0;
                                  $currentLine = 1;
                                  $displayedDescription = '';
                      
                                  foreach ($words as $word) {
                                      $wordLength = strlen($word) + 1; // +1 pour l'espace
                                      if ($currentLength + $wordLength <= $maxLengthPerLine * $currentLine) {
                                          $displayedDescription .= ($displayedDescription ? ' ' : '') . $word;
                                          $currentLength += $wordLength;
                                      } else {
                                          if ($currentLine < $maxLines) {
                                              $currentLine++; // Passe à la ligne suivante
                                              $displayedDescription .= ' ' . $word;
                                              $currentLength = $wordLength; // Réinitialise pour la nouvelle ligne
                                          } else {
                                              break; // Arrête si on dépasse le nombre de lignes
                                          }
                                      }
                                  }
                      
                                  if (strlen($description) > $maxLength) {
                                      $displayedDescription = substr($displayedDescription, 0, $maxLength - 3) . '...'; // Tronque et ajoute "..."
                                  }
                      
                                  echo $displayedDescription;
                              @endphp
                          </p>
                      @else
                          <p class="card-text mb-4" style="min-height: 2.8em !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                              @php
                                  $maxLengthPerLine = 25; // Estimation pour une ligne
                                  $maxLines = 2; // Maximum 2 lignes
                                  $maxLength = $maxLengthPerLine * $maxLines; // 50 caractères maximum
                                  $description = $one_formation->description;
                                  $words = explode(' ', $description); // Sépare les mots
                                  $currentLength = 0;
                                  $currentLine = 1;
                                  $displayedDescription = '';
                      
                                  foreach ($words as $word) {
                                      $wordLength = strlen($word) + 1; // +1 pour l'espace
                                      if ($currentLength + $wordLength <= $maxLengthPerLine * $currentLine) {
                                          $displayedDescription .= ($displayedDescription ? ' ' : '') . $word;
                                          $currentLength += $wordLength;
                                      } else {
                                          if ($currentLine < $maxLines) {
                                              $currentLine++; // Passe à la ligne suivante
                                              $displayedDescription .= ' ' . $word;
                                              $currentLength = $wordLength; // Réinitialise pour la nouvelle ligne
                                          } else {
                                              break; // Arrête si on dépasse le nombre de lignes
                                          }
                                      }
                                  }
                      
                                  $remainingCharacters = $maxLength - strlen($displayedDescription);
                                  $padding = str_repeat(' ', $remainingCharacters); // Espace insécable
                                  $displayedDescription .= $padding;
                      
                                  echo $displayedDescription;
                              @endphp
                          </p>
                      @endif
                            @if($one_formation->prix_formation==null)
                                <p class="card-text mb-4" ><span style="font-size: 12px;
                                    float: right;
                                    font-weight: 600;
                                    font-family: Source Sans Pro, Arial, sans-serif;
                                    width: fit-content;
                                    text-decoration: none;
                                    color: black;
                                    background-color: rgb(255, 224, 87);
                                    border-radius: 10px;
                                    padding: 0px 15px;
                                    vertical-align: middle;">Gratuit</span></p>
                            @else
                            @php
											        $sommePrix = $one_formation->prix_formation + $one_formation->prix_certification;
										        @endphp
                                <p class="card-text mb-4"><span style="font-size: 12px;
                                    float: right;
                                    font-weight: 600;
                                    font-family: Source Sans Pro, Arial, sans-serif;
                                    width: fit-content;
                                    text-decoration: none;
                                    color: black;
                                    background-color: rgb(255, 224, 87);
                                    border-radius: 10px;
                                    padding: 0px 15px;
                                    vertical-align: middle;">{{$sommePrix}} fcfa</span></p>
                            @endif
                            <a href="{{ url('/apprenant-course-detail/'.$one_formation->slug)}}" class="btn btn-primary" style="padding-left: 10px; padding-right: 10px;">Voir plus</a>
                        </div>
                    </div>
                </a>
            </div>
                  <style>
                    
                    .cat:hover{
                        background-color: green;
                        color:white;
                    }
                    .card {
                    /* ... styles de carte ... */
                    transition: transform 0.2s ease-in-out; /* Ajoute une transition pour l'effet */
                }
              
                  .card:hover {
                    transform: scale(1.1); /* Agrandit la carte de 10% au survol */
                    z-index: 10; /* Optionnel : place la carte au-dessus des autres pour éviter le clipping */
                    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Optionnel : renforce l'ombre au survol */
                }
                  .card-body {
                    padding: 20px; /* Ajustez la valeur selon vos besoins */
                    transition: background-color 0.3s ease; /* Ajoute une transition pour l'effet de survol */
                }
                </style>
              @endforeach
          @endforeach
      </div>
      <div class="row">
          <div class="col-12 text-center">
              <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary d-sm-none d-inline-block">Voir toutes nos formations</a>
          </div>
      </div>
  </div>
</section>
<!-- /courses -->

<!-- cta -->
<!-- <section class="section bg-primary">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h6 class="text-white font-secondary mb-0">Click to Join the Advance Workshop</h6>
        <h2 class="section-title text-white">Training In Advannce Networking</h2>
        <a href="contact" class="btn btn-light">join now</a>
      </div>
    </div>
  </div>
</section> -->
<!-- /cta -->

<!-- teachers -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="section-title">Nos Formateurs</h2>
      </div>
      @if(isset($teachers) && $teachers->count() > 0)
        <div class="col-12">
          <div class="owl-carousel owl-theme" id="teacherCarousel">
            @foreach($teachers as $teacher)
              @php
                  $photo = $teacher->photo_profil;
                  if ($photo) {
                      // Si le chemin commence déjà par un dossier connu, on ne touche pas
                      if (
                          strpos($photo, 'photo_profil/') === 0 ||
                          strpos($photo, 'partner_requests/photos/') === 0
                      ) {
                          $photoPath = $photo;
                      } else {
                          // Sinon, on suppose que c'est dans photo_profil/
                          $photoPath = 'photo_profil/' . ltrim($photo, '/');
                      }
                      $photoUrl = asset('storage/' . $photoPath);
                  } else {
                      $photoUrl = asset('assets/img/avatars/1.png');
                  }
              @endphp
              <div class="item">
                <div class="card border-0 rounded-0 hover-shadow">
                  <div class="teacher-image-wrapper">
                    <img class="card-img-top teacher-image" src="{{ $photoUrl }}" alt="teacher">
                  </div>
                  <div class="card-body text-center">
                    <h4 class="card-title" style="font-size: 1.5rem;">{{ $teacher->nom }} {{ $teacher->prenom }}</h4>
                    <ul class="list-inline mt-3 mb-0">
                      <li class="list-inline-item">
                        <a class="text-color" href="{{ json_decode($teacher->link_info)->facebook ?? '#' }}">
                          <i class="ti-facebook"></i>
                        </a>
                      </li>
                     {{--  <li class="list-inline-item">
                        <a class="text-color" href="{{ json_decode($teacher->link_info)->twitter ?? '#' }}">
                          <i class="ti-twitter-alt"></i>
                        </a>
                      </li> --}}
                      {{-- <li class="list-inline-item">
                        <a class="text-color" href="mailto:{{ $teacher->email }}">
                          <i class="ti-google"></i>
                        </a>
                      </li> --}}

                        @if($teacher->email)
    <a class="text-color"
       href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $teacher->email }}"
       target="_blank"
       rel="noopener">
        {{-- <i class="ti-email"></i> --}}
        <i class="ti-google"></i>
    </a>
@endif
                      <li class="list-inline-item">
                        <a class="text-color" href="{{ json_decode($teacher->link_info)->linkedIn ?? '#' }}">
                          <i class="ti-linkedin"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @else
        <p class="text-center">Aucun formateur disponible pour le moment.</p>
      @endif
    </div>
  </div>
</section>

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>

<style>
.section-title {
  font-size: 2.5rem;
  font-weight: bold;
  margin-bottom: 30px;
  text-align: center;
}
.card {
  transition: transform 0.5s ease;
  max-width: 350px;
  margin: auto;
}
.card:hover {
  transform: scale(1.02);
  box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
}
.card-title {
  margin-bottom: 15px;
  color: #333;
  font-weight: 600;
}
.text-color {
  color: #00458C;
}
.text-color:hover {
  color: #003366;
}
.owl-nav {
  display: block !important;
  position: absolute;
  top: 50%;
  width: 100%;
  transform: translateY(-50%);
}
.owl-prev, .owl-next {
  position: absolute;
  font-size: 2rem !important;
  color: #00458C !important;
}
.owl-prev {
  left: -40px;
}
.owl-next {
  right: -40px;
}
.owl-dots {
  display: none !important;
}
.teacher-image-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 100%; /* Crée un carré parfait */
    overflow: hidden;
    background-color: #f8f9fa;
    border-radius: 8px 8px 0 0;
}

.teacher-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.3s ease-in-out;
}

.card {
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.card:hover .teacher-image {
    transform: scale(1.05);
}

.card-body {
    padding: 1.5rem;
}

.card-title {
    margin-bottom: 0.5rem;
    color: #2c3e50;
    font-weight: 600;
    min-height: 3.2em;
    max-height: 3.2em;
    line-height: 1.6em;
    display: -webkit-box;
    -webkit-line-clamp: 2;      /* Limite à 2 lignes */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-word;
    text-align: center;
    align-items: center;
    justify-content: center;
}
</style>

<!-- jQuery + Owl Carousel JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
$(document).ready(function(){
  $("#teacherCarousel").owlCarousel({
    items: 3, // Affiche 3 formateurs à la fois
    slideBy: 3, // Fait défiler 3 formateurs à la fois
    loop: true,
    autoplay: true,
    autoplayTimeout: 6000,
    autoplaySpeed: 1000,
    smartSpeed: 1000,
    nav: true,
    dots: false,
    navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
    responsive: {
      0: {
        items: 1,
        slideBy: 1
      },
      600: {
        items: 2,
        slideBy: 2
      },
      1000: {
        items: 3,
        slideBy: 3
      }
    }
  });
});
</script>
<!-- /teachers -->

{{-- <!-- success story -->
<section class="section bg-cover" data-background="../theme/images/backgrounds/success-story.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-sm-4 position-relative success-video">
        <a class="play-btn venobox" href="https://youtu.be/nA1Aqp0sPQo" data-vbtype="video">
          <i class="ti-control-play"></i>
        </a>
      </div>
      <div class="col-lg-6 col-sm-8">
        <div class="bg-white p-5">
          <h2 class="section-title">Nos Réussites</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p>
        </div>
      </div>
    </div>
  </div>
</section> --}}
<!-- /success story -->

{{-- <!-- events -->
<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex align-items-center section-title justify-content-between">
          <h2 class="mb-0 text-nowrap mr-3">Evènements à venir</h2>
          <div class="border-top w-100 border-primary d-none d-sm-block"></div>
          <div>
            <a href="events" class="btn btn-sm btn-outline-primary ml-sm-3 d-none d-sm-block">Voir toutes nos évènements</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
  <!-- event -->
  <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
    <div class="card border-0 rounded-0 hover-shadow">
      <div class="card-img position-relative">
        <img class="card-img-top rounded-0" src="../theme/images/events/event-1.jpg" alt="event thumb">
        <div class="card-date"><span>18</span><br>Janvier</div>
      </div>
      <div class="card-body">
        <!-- location -->
        <p><i class="ti-location-pin text-primary mr-2"></i>Présentation</p>
        <a href="/event-single"><h4 class="card-title">Lorem ipsum dolor amet, consectetur adipisicing.</h4></a>
      </div>
    </div>
  </div>
 
  
</div>
    <!-- mobile see all button -->
    <div class="row">
      <div class="col-12 text-center">
        <a href="course" class="btn btn-sm btn-outline-primary d-sm-none d-inline-block">Voir toutes nos évènements</a>
      </div>
    </div>
  </div>
</section>
<!-- /events --> --}}
<!-- Stats (Confiance) -->
<section class="section bg-secondary" id="stats">
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-12 text-center">
        <h2 class="section-title text-white">La confiance de notre communauté</h2>
      </div>
          </div>
    <div class="row text-center g-4">
      <div class="col-6 col-md-3">
        <div class="stat-card p-4">
          <div class="stat-number" data-count="{{ $stats_apprenants ?? 1250 }}">0</div>
          <div class="stat-label">Apprenants</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-card p-4">
          <div class="stat-number" data-count="{{ $stats_cours ?? 85 }}">0</div>
          <div class="stat-label">Cours publiés</div>
        </div>
      </div>
      <div class="col-6 col-md-3 mt-4 mt-md-0">
        <div class="stat-card p-4">
          <div class="stat-number" data-count="{{ $stats_heures ?? 42 }}">0</div>
          <div class="stat-label">Enseignants</div>
        </div>
      </div>
      <div class="col-6 col-md-3 mt-4 mt-md-0">
        <div class="stat-card p-4">
          <div class="stat-number" data-count="{{ $stats_reussite ?? 92 }}" data-suffix="%">0</div>
          <div class="stat-label">Taux de réussite</div>
        </div>
      </div>
      
    </div>
  </div>
</section>

{{-- FAQ section --}}
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title mb-4" style="font-weight:800; color:#1a1a37 ;">FAQ</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="faq-accordion" id="faqAccordion">
          <div class="faq-item active reveal">
            <button class="faq-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-1" aria-expanded="false" aria-controls="faq-1">
              Comment se déroulent les formations ?
                      </button>
            <div id="faq-1" class="collapse faq-collapse" data-bs-parent="#faqAccordion">
              <div class="faq-content">
                Toutes nos formations sont 100% en ligne. Une fois votre inscription terminée, vous aurez accès à un espace apprenant sur votre compte avec toutes les vidéos et ressources des formations.
                      </div>
                  </div>
              </div>

          <div class="faq-item reveal">
            <button class="faq-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-2" aria-expanded="false" aria-controls="faq-2">
              Quels sont les prérequis pour se former ?
                      </button>
            <div id="faq-2" class="collapse faq-collapse" data-bs-parent="#faqAccordion">
              <div class="faq-content">
                Aucun prérequis strict. Avoir la motivation d’apprendre et un appareil connecté suffit pour démarrer.
                      </div>
                  </div>
              </div>

          <div class="faq-item reveal">
            <button class="faq-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-3" aria-expanded="false" aria-controls="faq-3">
              Puis-je gagner de l'argent en affiliation ?
                      </button>
            <div id="faq-3" class="collapse faq-collapse" data-bs-parent="#faqAccordion">
              <div class="faq-content">
                Oui. Vous pouvez recommander nos formations et percevoir une commission sur chaque vente réalisée grâce à vous.
                      </div>
                  </div>
          </div>

          <div class="faq-item reveal">
            <button class="faq-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-4" aria-expanded="false" aria-controls="faq-4">
              Quelles sont les méthodes de paiement disponibles ?
            </button>
            <div id="faq-4" class="collapse faq-collapse" data-bs-parent="#faqAccordion">
              <div class="faq-content">
                Cartes bancaires, mobile money et autres passerelles selon votre pays. Les paiements sont sécurisés.
              </div>
            </div>
          </div>

          <div class="faq-item reveal">
            <button class="faq-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-5" aria-expanded="false" aria-controls="faq-5">
              J’aimerais discuter avec un humain.
            </button>
            <div id="faq-5" class="collapse faq-collapse" data-bs-parent="#faqAccordion">
              <div class="faq-content">
                Contactez notre support via la page Contact ou par email. Nous répondons sous 24h ouvrées.
              </div>
            </div>
          </div>

              </div>
          </div>
      </div>
  </div>
</section>

<style>
.faq-accordion { max-width: 100%; }
.faq-item { margin-bottom: 18px; border-radius: 14px; overflow: hidden; border:1px solid #e5e7eb; background:#fff; }
.faq-item.active .faq-button { border-color:#0d6efd; box-shadow: inset 0 0 0 2px #0d6efd; }
.faq-button {
  width: 100%; text-align: left; padding: 18px 22px; font-size: 1.35rem; font-weight: 700; color:#1f2937; background:#fff;
  border:2px solid #e5e7eb; border-radius: 14px; transition: all .2s ease; outline: none;
}
.faq-button:hover { background:#f8fafc; }
.faq-content { padding: 16px 22px 22px 22px; color:#374151; font-size:1rem; line-height:1.6; }
/* Animation panels */
.faq-collapse { max-height:0; opacity:0; overflow:hidden; transition:max-height .35s cubic-bezier(.4,0,.2,1), opacity .25s ease; display:block; }
.faq-collapse.show { opacity:1; }


</style>

<script>
(function(){
  const accordion = document.getElementById('faqAccordion');
  if (!accordion) return;
  const items = Array.from(accordion.querySelectorAll('.faq-item'));
  const buttons = Array.from(accordion.querySelectorAll('.faq-button'));
  const panels = Array.from(accordion.querySelectorAll('.faq-collapse'));

  function closeAll() {
    items.forEach(it => it.classList.remove('active'));
    panels.forEach(p => { p.classList.remove('show'); p.style.maxHeight = '0px'; p.style.opacity = '0'; });
    buttons.forEach(b => b.setAttribute('aria-expanded','false'));
  }

  // Initial state: all closed
  closeAll();

  buttons.forEach(btn => {
    btn.addEventListener('click', function(e){
      e.preventDefault();
      const targetSel = this.getAttribute('data-bs-target') || this.getAttribute('data-target');
      const target = targetSel ? accordion.querySelector(targetSel) : this.nextElementSibling;
      if (!target) return;
      const alreadyOpen = target.classList.contains('show');
      closeAll();
      if (!alreadyOpen) {
        const item = this.closest('.faq-item');
        if (item) item.classList.add('active');
        target.classList.add('show');
        target.style.maxHeight = target.scrollHeight + 'px';
        target.style.opacity = '1';
        this.setAttribute('aria-expanded','true');
      }
    });
  });
})();
</script>
  

<!-- blog -->
{{-- <section class="section pt-0">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">Dernières nouvelles</h2>
      </div>
    </div>
    <div class="row justify-content-center">
  <!-- blog post -->
  <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
    <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
      <img class="card-img-top rounded-0" src="../theme/images/blog/post-1.jpg" alt="Post thumb">
      <div class="card-body">
        <!-- post meta -->
        <ul class="list-inline mb-3">
          <!-- post date -->
          <li class="list-inline-item mr-3 ml-0">28 Novembre 2022</li>
          <!-- author -->
          <li class="list-inline-item mr-3 ml-0"></li>
        </ul>
        <a href="blog-single">
          <h4 class="card-title">Lorem ipsum dolor amet, adipisicing eiusmod tempor.</h4>
        </a>
        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicin</p>
        <a href="blog-single" class="btn btn-primary btn-sm">Voir plus</a>
      </div>
    </div>
  </article>
  
</div>
  </div>
</section>--> --}}
<!-- /blog -->



<!-- Témoignages -->
<section class="section" id="temoignages">
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-12 text-center"><h2 class="section-title">Témoignages de nos apprenants</h2></div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="owl-carousel owl-theme" id="testimonialsCarousel">
          @php
            $testimonials = $testimonials ?? [
              ['nom'=>'A. Koffi','texte'=>'Les cours sont très clairs et concrets. J’ai pu lancer mon projet rapidement.','note'=>5],
              ['nom'=>'M. Diallo','texte'=>'Excellente plateforme, très bon suivi des formateurs.','note'=>4],
              ['nom'=>'S. Ahouansou','texte'=>'Le format vidéo + exercices m’a beaucoup aidé.','note'=>5],
              ['nom'=>'R. Bamba','texte'=>'Bon rapport qualité/prix et certificats reconnus.','note'=>4],
              ['nom'=>'N. Zannou','texte'=>'Interface simple et efficace, j’ai adoré la progression par étapes.','note'=>5],
              ['nom'=>'C. Amoussou','texte'=>'Support réactif, j’ai toujours eu de l’aide quand j’en avais besoin.','note'=>4],
              ['nom'=>'P. Kouassi','texte'=>'Les contenus sont à jour et très orientés pratique.','note'=>5],
              ['nom'=>'E. Mensah','texte'=>'J’ai obtenu mon certificat et un nouveau job grâce à ces cours.','note'=>5],
            ];
          @endphp
          @foreach($testimonials as $t)
            <div class="item">
              <div class="testimonial-card p-4 h-100 reveal">
                <div class="stars mb-2">
                  @for($i=1;$i<=5;$i++)
                    <i class="ti-star {{ $i <= ($t['note'] ?? 5) ? 'filled' : '' }}"></i>
                  @endfor
                </div>
                <p class="mb-3">“{{ $t['texte'] }}”</p>
                <div class="fw-bold">{{ $t['nom'] }}</div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>



<style>
/* Stats */
.stat-card{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; }
.stat-number{ font-size:2.2rem; font-weight:800; color:#0d6efd; line-height:1; }
.stat-label{ margin-top:6px; color:#555; font-weight:600; }
/* Témoignages */
.testimonial-card{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; min-height:170px; }
.stars .ti-star{ color:#d1d5db; }
.stars .ti-star.filled{ color:#f59e0b; }
/* Newsletter */
#newsletter .form-control{ border:none; }
#newsletter .btn{ font-weight:700; }
/* Reveal animation */
.reveal{ opacity:0; transform: translateY(22px); transition: opacity .6s ease, transform .6s ease; }
.reveal.in-view{ opacity:1; transform: translateY(0); }
</style>

<script>
// Count-up when in viewport
(function(){
  const counters = document.querySelectorAll('.stat-number');
  if(!('IntersectionObserver' in window) || counters.length===0){ return; }
  const animate = el => {
    const target = Number(el.getAttribute('data-count')||0);
    const suffix = el.getAttribute('data-suffix')||'';
    const duration = 1200; // ms
    const start = performance.now();
    function step(now){
      const p = Math.min((now-start)/duration, 1);
      const val = Math.floor(target * (0.1 + 0.9*p));
      el.textContent = val + suffix;
      if(p<1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  };
  const io = new IntersectionObserver(entries=>{
    entries.forEach(e=>{
      if(e.isIntersecting){ animate(e.target); io.unobserve(e.target); }
    });
  }, { threshold: 0.4 });
  counters.forEach(c=>io.observe(c));
})();

// Reveal on scroll (FAQ + Testimonials)
(function(){
  const els = document.querySelectorAll('.reveal');
  if(!('IntersectionObserver' in window)){ els.forEach(el=>el.classList.add('in-view')); return; }
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if(e.isIntersecting){ e.target.classList.add('in-view'); io.unobserve(e.target); }
    });
  }, { threshold: 0.15 });
  els.forEach(el=>io.observe(el));
})();

// Testimonials carousel
$(document).ready(function(){
  if ($('#testimonialsCarousel').length) {
    $('#testimonialsCarousel').owlCarousel({
      items: 2,
      margin: 16,
      loop: true,
      autoplay: true,
      autoplayTimeout: 6000,
      smartSpeed: 800,
      nav: false,
      dots: true,
      responsive: { 0:{ items:1 }, 768:{ items:2 } }
    });
  }
});
</script>

@endsection