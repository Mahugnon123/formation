<!DOCTYPE html>

<html
  lang="fr"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{$formation->titre}} - SinusTic</title>

    <meta name="description" content="Plateforme de formation en ligne" />
    
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
   
    <!-- ajax 

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    -->
    <!-- calendar -->


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('SinusTic.png')}}" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>

    <style>
        .chapter-content {
            transition: all 0.3s ease;
            opacity: 1;
            transform: translateY(0);
            padding: 2rem;
        }
        .chapter-content.hidden {
            display: none;
        }
        .progress {
            height: 10px;
            border-radius: 5px;
            margin-bottom: 2rem;
        }
        .progress-bar {
            transition: width 0.6s ease;
        }
        .chapter-nav {
            position: sticky;
            top: 0;
            background: white;
            z-index: 1000;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .note-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .note-card:hover {
            transform: translateY(-5px);
        }
        .btn-navigation {
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-navigation:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .chapter-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #566a7f;
        }
        .chapter-description {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #697a8d;
        }
        .video-container {
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .content-wrapper {
            background: #f8f9fa;
            min-height: 100vh;
        }
        .chapter-body {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .note-card {
            position: sticky;
            top: 2rem;
            max-height: calc(100vh - 4rem);
            overflow-y: auto;
        }
        .note-content {
            font-size: 0.9rem;
            display: none; /* Caché par défaut */
        }
        .note-content.active {
            display: block; /* Affiché quand la classe active est présente */
        }
        .note-content textarea {
            font-size: 0.9rem;
        }
        .chapter-content {
            min-height: calc(100vh - 200px);
        }
        #toggleNotes {
            transition: all 0.3s ease;
        }
        #toggleNotes.active {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-bleu-custom {
            background-color: #1976d2 !important;   /* Bleu vif */
            color: #fff !important;
            border: none;
        }
        .btn-bleu-custom:hover, .btn-bleu-custom:focus {
            background-color: #125ea2 !important;   /* Bleu un peu plus foncé au survol */
            color: #fff !important;
        }
    </style>
  </head>

  <body>
    <?php 
    $chapitre = json_decode($formation->chapitre);
    $total_chapitre = count($chapitre);
     ?>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="/home" class="app-brand-link">
              
              <span class="app-brand-text demo menu-text fw-bolder ms-2"><img src="{{asset('SinusTic.png')}}" height="50px", width="100px"></span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>  

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="/home" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Tableau de bord</div>
              </a>
            </li>

            <!-- Layouts -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">{{$formation->titre}}</span>
            </li>
              
            @foreach($chapitre as $one_formation)
              <li class="menu-item">
                <button class="menu-link menu-toggle chapter-link" 
                        data-chapter="{{$one_formation->num_chapitre}}"
                        id="chapter-menu-{{$one_formation->num_chapitre}}">
                  @if(trim(strtolower($formation->type)) == 'texte')
                    <i class="menu-icon tf-icons bx bx-file"></i>
                  @else
                    <i class="menu-icon tf-icons bx bx-video"></i>
                  @endif
                  <div data-i18n="Layouts">{{$one_formation->intitule}}</div>
                </button>
              </li>
            @endforeach
            <!-- Quiz Menu -->
            <li class="menu-item">
              <button class="menu-link menu-toggle quiz-link bg-secondary text-dark" id="quiz-menu">
                <i class="menu-icon tf-icons bx bx-question-mark"></i>
                <div data-i18n="Quiz">Test de fin de formation</div>
              </button>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              {{-- <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Rechercher..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search --> --}}

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{Auth::user()->prenom}} {{Auth::user()->nom}}</span>
                            <small class="text-muted">{{Auth::user()->role_id == 1 ? 'Apprenant' : 'Formateur'}}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Mon profil</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Réglages</span>
                      </a>
                    </li>
                    
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Se déconnecter</span>
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- Progress Bar -->
                                @php
                                    $progress = isset($progressionValue) ? floatval($progressionValue) : 0;
                                    $radius = 16;
                                    $circumference = 2 * pi() * $radius;
                                    $offset = $circumference * (1 - $progress / 100);
                                @endphp
                                <div class="d-flex align-items-center mb-4">
                                    <svg width="40" height="40" viewBox="0 0 40 40" class="me-2">
                                        <circle
                                            cx="20" cy="20" r="16"
                                            fill="none"
                                            stroke="#e6e6e6"
                                            stroke-width="4"
                                        />
                                        <circle
                                            id="progressCircle"
                                            cx="20" cy="20" r="16"
                                            fill="none"
                                            stroke="#388e3c"
                                            stroke-width="4"
                                            stroke-dasharray="{{ $circumference }}"
                                            stroke-dashoffset="{{ $offset }}"
                                            stroke-linecap="round"
                                            transform="rotate(-90 20 20)"
                                            style="transition: stroke-dashoffset 0.6s;"
                                        />
                                    </svg>
                                    <span id="progressText" style="font-size:1.2rem;">{{ round($progress) }}% de progression</span>
                                </div>

                                <!-- Chapter Content -->
                                @foreach($chapitre as $index => $one_chaître)
                                    <div class="chapter-content" id="element{{$one_chaître->num_chapitre}}" 
                                         style="display: {{$one_chaître->num_chapitre == 0 ? 'block' : 'none'}}">
                                        <div class="chapter-body">
                                            <h2 class="chapter-title">{{ $one_chaître->intitule }}</h2>
                                            
                                            @if($formation->editordata=="")
                                                <div class="video-container">
                                                    <video width="100%" controls>
                                                        <source src="{{$one_chaître->video_url}}" type="video/ogg">
                                                    </video>
                                                </div>
                                            @else
                                                {!! htmlspecialchars_decode($one_chaître->summernote) !!}
                                            @endif

                                            <form action="javascript:void(0);" id="progressChpt{{$one_chaître->num_chapitre}}" method="post">
                                                @csrf
                                                <input type="hidden" name="progres[]" id="progres{{$one_chaître->num_chapitre}}" 
                                                       data-element="{{$one_chaître->num_chapitre}}">
                                                <input type="hidden" id="fmt{{$one_chaître->num_chapitre}}" value="{{$formation->id}}">
                                                <input type="hidden" id="position" value="{{$one_chaître->num_chapitre}}">
                                                <input type="hidden" id="total_chapitre" value="{{$total_chapitre}}">
                                                <input type="hidden" id="chapitres">
                                            </form>

                                            <div class="chapter-description mt-4">
                                                <h3>Contenu de la formation</h3>
                                                <p>{{$one_chaître->chapitre_description}}</p>
                                            </div>

                                            <div class="d-flex justify-content-between mt-4">
                                                @if($one_chaître->num_chapitre > 0)
                                                    <button class="btn btn-secondary btn-lg btn-navigation btn-precedent" 
                                                            type="button" 
                                                            id="precedent{{$one_chaître->num_chapitre}}" 
                                                            data-element="{{$one_chaître->num_chapitre}}">
                                                        <i class="bi bi-arrow-left"></i> Précédent
                                                    </button>
                                                @else
                                                    <div></div>
                                                @endif

                                                @if($one_chaître->num_chapitre == $total_chapitre - 1)
                                                    <button type="button" 
                                                            class="btn btn-success btn-lg btn-navigation btn-test" 
                                                            id="passerTest">
                                                        Passer le test <i class="bi bi-check-circle"></i>
                                                    </button>
                                                @else
                                                    <button type="button" 
                                                            class="btn btn-bleu-custom btn-lg btn-navigation btn-suivant" 
                                                            id="fini{{$one_chaître->num_chapitre}}"
                                                            data-element="{{$one_chaître->num_chapitre}}">
                                                        Suivant <i class="bi bi-arrow-right"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="quiz-content" id="quiz-section" style="display: none;">
                                  <div class="quiz-body">
                                    <h2>Test de fin de formation en {{ $formation->titre }}</h2>
                                    <p>Bienvenue dans le test de fin de formation. Répondez aux questions pour valider votre formation.</p>
                                    <!-- Ajoute ici ton formulaire de quiz, tes questions, etc. -->
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                , 
                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder"> SinusTic</a>
              </div>
              <div>
                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
              </div>
            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
  
 <script src="{{asset('js/jquery/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript">
    function showNote(elm){
        var element = document.getElementById(elm);
        var hideNote = document.getElementById('hideNote');

        if( element.style.display == 'none'){
          element.style.display = 'block';
          hideNote.style.display = 'none';

        }else{
          element.style.display = 'none';
          hideNote.style.display = 'block';

        }
      }
      
      function showHide(elm){
        var element = document.getElementById(elm);
        var voir = document.getElementById('voir');

        if( element.style.display == 'none'){
          element.style.display = 'block';
          voir.innerHTML = 'voir moins'
        }else{
          element.style.display = 'none';
          voir.innerHTML = 'voir plus'

        }
      }
  /*function replace(buttonclicked){

   var buttonelement = $(buttonclicked).data('element');
   var total_chapitre = $(buttonclicked).data('total_chapitre');
   if (total_chapitre > (buttonelement+1)) {

  $('#element'+buttonelement).replaceWith($('#element'+(buttonelement+1)));
   $('#element'+(buttonelement+1)).css('display', 'block');
   $('#precedent').css('display', 'block');
   
   }
   else
   {
    $('#suivant').css('display', 'none');
   }
  
  } 
*/
  $(document).ready( function () {
    var trueResp = [];
    $.ajaxSetup({
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
            });

            $('input[name="progres[]"]').each((item, i) => {
              trueResp[item] = $(i).data('element');
              
            });

          $(trueResp).each((item, i) => {

            $('body').on('click', '#fini'+i, function (event) {
              var progress  = $("#progres"+i).data('element');
              var fmt  = $("#fmt"+i).val();
              var position  = $("#position").val();
              var total_chapitre  = $("#total_chapitre").val();
              var chapitres  = $("#chapitres").val();

              $("#fini"+i).html('Patienter...');
              

               // ajax
               $.ajax({
                      type:"POST",
                      url: "{{ url('/progression-chapitre') }}",
                      data: {
                        progress : progress,
                        fmt: fmt,
                        chapitres: chapitres,

                        _token: '{{csrf_token()}}'
                      },
                      dataType: 'json',
                      success: function(res){
                        console.log(res[0]);
                          
                         if (parseInt(total_chapitre) > (parseInt(position)+1)) {

                           $('#element'+position).replaceWith($('#element'+(parseInt(position)+1)));
                           $('#element'+(parseInt(position)+1)).css('display', 'block');
                           $('#precedent').css('display', 'block');
                           $('#progression').css('width',res[0]+"%");
                           $('#chapitres').val(res[1]);

                           }
                            else
                            {
                             $("#progressChpt").css('display', 'none');
                            }



                        
                      $("#fini"+i).html("J'ai fini");
                      //$("#progressChpt").css('display', 'none');
                    
                      },
                      error: function (data, textStatus, errorThrown) {
                     console.log(data);
                      },

                    });
                    

      });
          });
});


  $(document).ready( function () {

          $.ajaxSetup({
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
            });

                   $('body').on('click', '#btn-save', function (event) {

                    var chapitre_id  = $("#chapitre_id").val();
                    var formation_id  = $("#formation_id").val();
                    var titre = $("#titre").val();
                    var description = $("#description").val();
                    var commentaire = $("#commentaire").val();


                    $("#btn-save").html('Patienter...');
                    $("#btn-save"). attr("disabled", true);
                   
                    // ajax
                    $.ajax({
                      type:"POST",
                      url: "{{ url('/save-chapitre') }}",
                      data: {
                        chapitre_id : chapitre_id,
                        formation_id : formation_id,
                        titre:titre,
                        description:description,
                        commentaire:commentaire,


                        _token: '{{csrf_token()}}'
                      },
                      dataType: 'json',
                      success: function(res){

                        console.log(res);
                      $("#btn-save").html('Enregistrer');
                      $("#note").css('display', 'none');
                    
                      },

                     error: function (data, textStatus, errorThrown) {
                     console.log(data);

                    },

                            });
                        });
    });



    </script>
 <script>
$(document).ready(function() {
    var total = {{$total_chapitre}};
    var currentChapter = {{$lastChapterIndex ?? 0}};
    var completedChapters = [];

    // Récupérer la progression initiale
    $.ajax({
        type: "GET",
        url: "{{ url('/get-progression') }}",
        data: {
            formation_id: {{$formation->id}}
        },
        dataType: 'json',
        success: function(res) {
            if (res.chapitres) {
                completedChapters = JSON.parse(res.chapitres);
            }
            if (res.chapitre_courant) {
                currentChapter = res.chapitre_courant;
            }
            updateButtons();
            showChapter(currentChapter);
        }
    });

    function setProgressCircle(percent) {
        const radius = 16;
        const circumference = 2 * Math.PI * radius;
        const offset = circumference * (1 - percent / 100);
        const circle = document.getElementById('progressCircle');
        if (circle) {
            circle.style.strokeDashoffset = offset;
        }
        const text = document.getElementById('progressText');
        if (text) {
            text.textContent = Math.round(percent) + '% de progression';
        }
    }

    function updateProgressBar(completedCount) {
        const progression = total > 0 ? Math.min(100, (completedCount * 100) / total) : 0;
        const roundedProgression = Math.round(progression);
        setProgressCircle(progression);
    }

    function updateButtons() {
        // Le bouton précédent n'est pas affiché pour le premier chapitre
        if (currentChapter === 0) {
            $('.btn-precedent').hide();
        } else {
            $('.btn-precedent').show();
        }
        
        // Le bouton suivant est remplacé par "Passer le test" pour le dernier chapitre
        if (currentChapter === total - 1) {
            $('.btn-suivant').hide();
            $('.btn-test').show();
        } else {
            $('.btn-suivant').show();
            $('.btn-test').hide();
        }
        
        // Mettre à jour la barre de progression
        updateProgressBar(completedChapters.length);

        // Mettre à jour l'état des boutons en fonction des chapitres complétés
        $('.btn-suivant').each(function() {
            const chapterId = $(this).data('element');
            if (completedChapters.includes(chapterId)) {
                $(this).addClass('btn-success').removeClass('btn-primary');
            } else {
                $(this).addClass('btn-primary').removeClass('btn-success');
            }
            $(this).html('Suivant <i class="bi bi-arrow-right"></i>');
        });
    }

    function showChapter(chapterId) {
        $('.chapter-content').hide();
        $(`#element${chapterId}`).show();
        currentChapter = chapterId;
        highlightCurrentChapterMenu(chapterId);

        // Réaffiche la colonne notes et remet la largeur normale
        $('.col-lg-2').show();
        $('.col-lg-12').removeClass('col-lg-12').addClass('col-lg-10');

        // Afficher le bouton de note
        toggleNoteButton(true);
    }

    // Gestion du bouton "Suivant"
    $('.btn-suivant').click(function() {
        const progress = $(this).data('element');
        const fmt = $(`#fmt${currentChapter}`).val();

        $(this).html('<i class="bi bi-arrow-repeat spin"></i> Patienter...').prop('disabled', true);

        $.ajax({
            type: "POST",
            url: "{{ url('/progression-chapitre') }}",
            data: {
                progress: progress,
                fmt: fmt,
                chapitres: JSON.stringify(completedChapters),
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(res) {
                if (res.error) {
                    console.error(res.error);
                    return;
                }

                // Mettre à jour les chapitres complétés
                completedChapters = res.chapitres_completes;
                
                // Mettre à jour la progression
                updateProgressBar(completedChapters.length);

                if (currentChapter < total - 1) {
                    showChapter(currentChapter + 1);
                    updateButtons();
                }

                $('.btn-suivant').html('Suivant <i class="bi bi-arrow-right"></i>').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('Erreur:', error);
                $('.btn-suivant').html('Suivant <i class="bi bi-arrow-right"></i>').prop('disabled', false);
            }
        });
    });

    // Gestion du bouton "Précédent"
    $('.btn-precedent').click(function() {
        if (currentChapter > 0) {
            showChapter(currentChapter - 1);
            updateButtons();
        }
    });

    // Gestion des liens du menu
    $('.chapter-link').click(function() {
        const chapterId = $(this).data('chapter');
        showChapter(chapterId);
        updateButtons();
    });

    // Gestion du bouton "Passer le test"
    $(document).on('click', '.btn-test', function(e) {
        e.preventDefault();

        // Marquer tous les chapitres comme complétés
        completedChapters = [];
        for (let i = 0; i < total; i++) {
            completedChapters.push(i);
        }

        // Mettre à jour la progression à 100% côté backend
        $.ajax({
            type: "POST",
            url: "{{ url('/progression-chapitre') }}",
            data: {
                progress: total - 1,
                fmt: {{$formation->id}},
                chapitres: JSON.stringify(completedChapters),
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(res) {
                // Mettre à jour la progression à 100% côté frontend
                updateProgressBar(total);
                // Afficher la section quiz et masquer la colonne notes
                $('.chapter-content').hide();
                $('#quiz-section').show();
                $('.col-lg-2').hide();
                $('.col-lg-10').removeClass('col-lg-10').addClass('col-lg-12');

                // Masquer le bouton de note
                toggleNoteButton(false);
            },
            error: function(xhr, status, error) {
                console.error('Erreur:', error);
            }
        });
    });

    function highlightCurrentChapterMenu(chapterId) {
        // Retirer l'état actif de tous les boutons
        $(".chapter-link").removeClass("bg-dark text-white bg-secondary text-white");
        // Ajouter l'état actif au bouton du chapitre courant
        $("#chapter-menu-" + chapterId).addClass("bg-secondary text-white");
    }

    // Appel initial pour surligner le chapitre courant au chargement
    $(document).ready(function() {
        highlightCurrentChapterMenu(currentChapter);
    });

    // Gestion du menu Quiz
    $("#quiz-menu").click(function() {
        $('.chapter-content').hide();
        $('#quiz-section').show();
        $('.col-lg-2').hide();
        $('.col-lg-10').removeClass('col-lg-10').addClass('col-lg-12');

        // Masquer le bouton de note
        toggleNoteButton(false);
    });

    function toggleNoteButton(show) {
        if (show) {
            $('#openNotes').show();
        } else {
            $('#openNotes').hide();
            $('#notesPanel').fadeOut(); // Ferme le panneau si ouvert
        }
    }
});
</script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        $(document).ready(function() {
            // Gérer le clic sur les liens des chapitres
            $('.chapter-link').click(function() {
                const chapterNumber = $(this).data('chapter');
                const formationId = {{ $formation->id }};
                
                // Mettre à jour la progression via AJAX
                $.ajax({
                    url: '/update-progression',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        formation_id: formationId,
                        chapter_number: chapterNumber
                    },
                    success: function(response) {
                        if (response.success) {
                            // Mettre à jour l'affichage du chapitre
                            showChapter(chapterNumber);
                        }
                    }
                });
            });

            // Fonction pour afficher un chapitre
            function showChapter(chapterNumber) {
                // Cacher tous les chapitres
                $('.chapter-content').addClass('hidden');
                
                // Afficher le chapitre sélectionné
                $(`#element${chapterNumber}`).removeClass('hidden');
                
                // Mettre à jour la barre de progression
                updateProgressBar();
            }

            // Fonction pour mettre à jour la barre de progression
            function updateProgressBar() {
                const total = {{ $total_chapitre }};
                const completedChapters = {{ json_encode($progression ? json_decode($progression->chapitres_completes, true) : []) }};
                const progression = total > 0 ? (completedChapters.length * 100) / total : 0;
                
                $('.progress-bar').css('width', progression + '%');
                $('.progress-bar').attr('aria-valuenow', progression);
                $('.progress-value').text(Math.round(progression) + '%');
            }

            // Afficher le dernier chapitre visité au chargement
            const lastChapterIndex = {{ $lastChapterIndex }};
            if (lastChapterIndex > 0) {
                showChapter(lastChapterIndex);
            } else {
                showChapter(0);
            }
        });
    </script>

    <script>
    $(document).ready(function() {
        $('#toggleNotes').on('click', function() {
            $('.note-content').toggleClass('active');
        });
    });
    </script>

    <!-- Bouton flottant -->
    <button id="openNotes" class="btn btn-primary rounded-circle shadow" style="position: fixed; bottom: 30px; right: 30px; z-index: 1050; width: 60px; height: 60px;">
        <i class="bi bi-pencil-square" style="font-size: 1.5rem;"></i>
    </button>

    <!-- Panneau de notes flottant -->
    <div id="notesPanel" class="card shadow" style="position: fixed; bottom: 100px; right: 30px; width: 350px; display: none; z-index: 1051;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Prendre une note</h5>
            <button type="button" class="btn-close" id="closeNotes"></button>
        </div>
        <div class="card-body">
            <form id="quickNoteForm">
                @csrf
                <input type="hidden" name="formation_id" value="{{ $formation->id }}">
                <input type="hidden" name="chapitre_id" id="currentChapterId" value="">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="commentaire" class="form-label">Commentaire</label>
                    <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enregistrer la note</button>
            </form>
        </div>
    </div>

    <script>
    $(function() {
        // Ouvrir le panneau de notes
        $('#openNotes').on('click', function() {
            // Récupérer l'ID du chapitre courant
            const currentChapter = $('.chapter-content:visible').attr('id').replace('element', '');
            $('#currentChapterId').val(currentChapter);

            // Vérifier si une note existe déjà
            const note = userNotes[currentChapter];
            if (note) {
                // Pré-remplir le formulaire
                $('#titre').val(note.titre);
                $('#description').val(note.description);
                $('#commentaire').val(note.commentaire);
                // Changer le texte du bouton
                $('#quickNoteForm button[type="submit"]').text('Modifier la note');
            } else {
                // Vider le formulaire
                $('#quickNoteForm')[0].reset();
                $('#quickNoteForm button[type="submit"]').text('Enregistrer la note');
            }
            $('#notesPanel').fadeIn();
        });

        // Fermer le panneau de notes
        $('#closeNotes').on('click', function() {
            $('#notesPanel').fadeOut();
        });

        // Gestion de la soumission du formulaire
        $('#quickNoteForm').on('submit', function(e) {
            e.preventDefault();
            
            // Vérifier que l'ID du chapitre est défini
            const chapterId = $('#currentChapterId').val();
            if (!chapterId) {
                alert('Erreur: ID du chapitre non défini');
                return;
            }

            // Vérifier que tous les champs requis sont remplis
            const titre = $('#titre').val();
            const description = $('#description').val();
            
            if (!titre || !description) {
                alert('Veuillez remplir tous les champs obligatoires');
                return;
            }

            // Afficher un indicateur de chargement
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enregistrement...');
            
            // Log des données avant l'envoi
            const formData = $(this).serialize();
            console.log('Sending data:', formData);
            
            $.ajax({
                url: "{{ url('/save-chapitre') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log('Server response:', response);
                    if (response.success) {
                        alert('Note enregistrée avec succès !');
                        const chapterId = $('#currentChapterId').val();
                        userNotes[chapterId] = {
                            titre: $('#titre').val(),
                            description: $('#description').val(),
                            commentaire: $('#commentaire').val(),
                            updated_at: (new Date()).toLocaleString('fr-FR')
                        };
                        // Fermer le panneau de notes automatiquement
                        $('#notesPanel').fadeOut();
                    } else {
                        alert('Erreur: ' + (response.error || 'Une erreur est survenue'));
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Status:', status);
                    console.log('Error:', error);
                    console.log('Response:', xhr.responseText);
                    
                    let errorMessage = 'Erreur lors de l\'enregistrement de la note';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage += ': ' + xhr.responseJSON.error;
                    }
                    alert(errorMessage);
                },
                complete: function() {
                    submitButton.prop('disabled', false).html('Enregistrer la note');
                }
            });
        });
    });
    </script>

    <script>
    // On récupère les notes de l'utilisateur pour cette formation
    var userNotes = @json($resumeNotes);
    </script>

    
  </body>
</html>

