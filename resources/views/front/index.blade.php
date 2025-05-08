@extends("front.app")
@section("content")

<!-- hero slider -->
<section class="hero-section overlay bg-cover" data-background="../theme/images/banner/banner-1.jpg">
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
        <h3 class="section-title">Pourquoi choisir SinusTic Formation</h3>
        <p>SinusTic Formation est une plateforme e-learning qui accorde une grande place aux échanges entre pairs, comme sur un réseau social. De même, les contenus sont enrichis de quiz, de sondages et de travaux collaboratifs, ce qui renforce l’engagement et la réussite de l’apprenant. Au final, celui-ci, acteur de sa formation, aura plus de facilités à mettre en pratique ses nouveaux acquis. En un mot : il deviendra plus performant. </p>
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
        <h2 class="section-title">Nos formateurs</h2>
      </div>
      <!-- teacher -->
      <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-1.jpg" alt="teacher">
          <div class="card-body">
            <a href="/teacher-single">
              <h4 class="card-title">Jacke Masito</h4>
            </a>
            <p>Enseigant</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>
<!-- /teachers -->


<!-- success story -->
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
</section>
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

{{-- <section class="section">
  <div class="container">
      <div class="faq-section">
          <h2>Questions Fréquemment Posées</h2>
          <div class="accordion" id="faqlist">
              <div class="accordion-item">
                  <h2 class="accordion-header" id="heading-1">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1" aria-expanded="true" aria-controls="faq-content-1">
                          <i class="fa fa-question-circle question-icon"></i> De quoi ai-je besoin pour louer une voiture ?
                      </button>
                  </h2>
                  <div id="faq-content-1" class="accordion-collapse collapse show" aria-labelledby="heading-1" data-bs-parent="#faqlist">
                      <div class="accordion-body">
                          Pour réserver votre véhicule, vous n'avez besoin que de : Une copie du passeport pour les étrangers et ANIP pour les clients du Bénin.
                      </div>
                  </div>
              </div>

              <div class="accordion-item">
                  <h2 class="accordion-header" id="heading-2">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2" aria-expanded="false" aria-controls="faq-content-2">
                          <i class="fa fa-question-circle question-icon"></i> Comment puis-je vous contacter ?
                      </button>
                  </h2>
                  <div id="faq-content-2" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#faqlist">
                      <div class="accordion-body">
                          Vous pouvez nous contacter par téléphone au +229 00 00 00 00 ou par email à info@example.com.
                      </div>
                  </div>
              </div>

              <div class="accordion-item">
                  <h2 class="accordion-header" id="heading-3">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3" aria-expanded="false" aria-controls="faq-content-3">
                          <i class="fa fa-question-circle question-icon"></i> Quelle est votre politique d'annulation ?
                      </button>
                  </h2>
                  <div id="faq-content-3" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#faqlist">
                      <div class="accordion-body">
                          Les annulations effectuées au moins 24 heures avant la date de location sont entièrement remboursables.
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<style>
  /* Styles généraux de la section FAQ */
.faq-section {
    margin-top: 30px;
    margin-bottom: 30px;
}

/* Styles pour le conteneur de l'accordéon */
.accordion {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    border-radius: 5px;
    overflow: hidden; /* Pour que les bordures arrondies fonctionnent bien avec les items */
}

/* Styles pour chaque item de l'accordéon */
.accordion-item {
    border: 1px solid #e7e7e7;
    margin-bottom: 5px;
    background-color: white;
    border-radius: 5px;
}

.accordion-item:first-child {
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.accordion-item:last-child {
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    margin-bottom: 0;
}

/* Styles pour l'en-tête (le bouton) */
.accordion-button {
    background-color: transparent;
    color: #333;
    padding: 15px;
    font-weight: normal;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    border: 0;
    border-bottom: 1px solid #e7e7e7; /* Séparateur entre les questions */
    border-radius: 0 !important; /* Important pour surcharger le style Bootstrap */
    box-shadow: none !important; /* Important pour surcharger le style Bootstrap au focus */
}

.accordion-button:not(.collapsed) {
    background-color: #f8f9fa; /* Fond légèrement grisé quand ouvert */
    color: #007bff; /* Couleur du texte quand ouvert (facultatif) */
    box-shadow: none;
}

.accordion-button:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
}

/* Style pour l'icône de question */
.accordion-button .question-icon {
    color: #007bff; /* Couleur bleue */
    margin-right: 10px;
    font-size: 1.2em;
}

/* Style pour l'icône de flèche (à adapter selon votre icône) */
.accordion-button::after {
    flex-shrink: 0;
    width: 1.25rem;
    height: 1.25rem;
    margin-left: auto;
    content: "";
    background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='%23333'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-size: 1.25rem;
    transition: transform 0.2s ease-in-out;
}

.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='%23007bff'%3e%3cpath fill-rule='evenodd' d='M1.646 11.354a.5.5 0 0 1 .708 0L8 5.707l5.646 5.647a.5.5 0 0 1 .708-.708l-6-6a.5.5 0 0 1-.708 0l-6 6a.5.5 0 0 1 0 .708z'/%3e%3c/svg%3e");
    transform: rotate(-180deg);
}

/* Styles pour le contenu (la réponse) */
.accordion-body {
    padding: 15px;
    border-top: 1px solid #e7e7e7; /* Séparateur entre la question et la réponse */
    background-color: white;
}

.accordion-body p {
    margin-bottom: 0;
}
</style> --}}
  

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
@endsection
