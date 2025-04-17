<!DOCTYPE html>

<html
  lang="en"
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

    <title>Tableau de bord des Apprenants</title>

    <meta name="description" content="" />
    
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
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/SinusTic.png" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
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
            <a href="index.html" class="app-brand-link">
              
              <span class="app-brand-text demo menu-text fw-bolder ms-2"><img src="{{asset('/SinusTic.png')}}" height="50px", width="100px"></span>
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
              <button href="javascript:void(0);" class="menu-link menu-toggle" onclick="" id="suivante" data-element="{{$one_formation->num_chapitre}}">
                <i class="menu-icon tf-icons bx bx-video"></i>
                <div data-i18n="Layouts">{{$one_formation->intitule}}</div>
              </button>
             
            </li>
            @endforeach
           
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
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

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
                            <span class="fw-semibold d-block">Helena</span>
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

          @foreach($chapitre as $one_chaître)


          @php

          $num= $one_chaître->num_chapitre;

          @endphp


          @if($one_chaître->num_chapitre==0)

             <style type="text/css">

             #element{{$one_chaître->num_chapitre}}
             {
                 display: block;
              }

              </style>

           @else
            <style type="text/css">

             #element{{$one_chaître->num_chapitre}}{
        
             display: none;

              }


           </style>
          @endif
          <div class="container-xxl flex-grow-1 container-p-y" id="element{{$one_chaître->num_chapitre}}">
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-12">
                      <div class="card-title">
                      <div class="progress">
                        <div class="progress-bar bg-primary" id="progression"  role="progressbar" style="width: {{$progression}}%" aria-valuenow="{{$progression}}" aria-valuemin="0" aria-valuemax="100"><!-- {{$progression}}% --></div>
                      </div>
                      </div>

                        <div class="card-body">
                          <h5 class="card-title text-primary">{{$one_chaître->intitule }} </h5>
                          @if($formation->editordata=="")
                          <video width="100%"  controls >
                          <source src="{{$one_chaître->video_url }}" type=video/ogg>
                          </video>
                          @else

                          <?php 
                          echo (htmlspecialchars_decode($one_chaître->summernote));

                           ?>
                           @endif

                        <button class="btn btn-primary nextBtn btn-lg pull-left" style="display:none" href="javascript:void(0);" type="button" onclick="" id="precedent" data-element="{{$one_chaître->num_chapitre}}"><i class="fa fa-arrow-left" aria-hidden="true"></i></button> 

                          <form action="javascript:void(0);"  id="progressChpt" method="post">
                            @csrf
                              <input type="hidden" class="" name="progres[]" id="progres{{$one_chaître->num_chapitre}}"  data-element="{{$one_chaître->num_chapitre}}">

                              <input type="hidden" class="d-none"  id="fmt{{$one_chaître->num_chapitre}}"  value="{{$formation->id}}">

                              <input type="hidden" class="d-none"  id="position"  value="{{$one_chaître->num_chapitre}}">

                              <input type="hidden" class="d-none"  id="total_chapitre"  value="{{$total_chapitre}}">
                              <input type="hidden" class="d-none"  id="chapitres" >

                              <div class="mt-3">
                                    <button type="button" class="btn btn-primary nextBtn btn-lg pull-right" id="fini{{$one_chaître->num_chapitre}}" > <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                              </div>
                          </form>


                    
                         <h3 class="mt-5">Contenu de la formation</h3>
                          <p>{{$one_chaître->chapitre_description}}</p>
                          
                        </div>
                        
                        
                      </div>
                      
                    </div>
                  </div>
                </div>
                
                @if($resume !=[])
                  @php( $resumeChapitre = (is_array($resume->resumeChapitre))?$resume->resumeChapitre:json_decode($resume->resumeChapitre, true))
                  @if($resume->formation_id ==$formation->id && count($resumeChapitre)>0 && array_key_exists($one_chaître->num_chapitre,$resumeChapitre))
                <div class="col-lg-4 col-md-4 order-1" >
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mb-4">
                    <button class=" mt-2 btn-primary" id='hideNote' style="display:none;" onclick="showNote('note')"; ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                      <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                    </svg>Voir la Note </button>

                      <div class="card" id="note">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-center justify-content-between">
                            
                                <div class="mb-3">
                                <h3 class="text text-center mt-2">Votre Note </h3>
                                    <label  class="form-label">Titre </label>
                                    <div>{{$resumeChapitre[$one_chaître->num_chapitre]['titre']}}</p>
                                </div>
                                <div class="mb-3">
                                  <label for="description" class="form-label">Description </label>
                                    <p>{{$resumeChapitre[$one_chaître->num_chapitre]['description']}}</p>
                                                   
                                </div>          
                                <div class="mb-3">
                                <label  class="form-label">Commentaire </label>
                                    @if(strlen($resumeChapitre[$one_chaître->num_chapitre]['commentaire'])>200) <p>{{substr($resumeChapitre[$one_chaître->num_chapitre]['commentaire'],0,200)}} <span style="display:none;" id="resteDscpt">{{substr($resumeChapitre[$one_chaître->num_chapitre]['commentaire'],200,strlen($resumeChapitre[$one_chaître->num_chapitre]['commentaire']))}}</span>  <button type="button" id="voir" onclick="showHide('resteDscpt')"; >Voir plus</button></p>
                                    @else <p>{{$resumeChapitre[$one_chaître->num_chapitre]['commentaire']}}</p>
                                    @endif   
                                    </div>
                                                      
                                <div class="mt-3">
                                  <button type="button" class="btn btn-primary" id='fermer' onclick="showNote('note')"; > Fermer</button>
                                </div>
                              </div>
                              
                            </div>
                         
                          </div>
                        
                        </div>
                      </div>
                    </div>
                    @else
                <div class="col-lg-4 col-md-4 order-1" id="note">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-center justify-content-between">
                            <form action="javascript:void(0)" id="formulaire" name="note" method="POST">
                              @csrf
                            <div class="col-12  note-class"  style="height:50%">
                                <input type="hidden" name="formation_id" id="formation_id" value="{{$formation->id}}">
                                <input type="hidden" name="chapitre_id" id="chapitre_id" value="{{$one_chaître->num_chapitre}}">
                              <div >
                              <h3 class="text text-center mt-2">Prendre Note </h3>
                                <div class="mb-3">
                                    <label for="titre" class="form-label">Titre </label>
                                    <input type="text" class="form-control" id="titre" required="required" placeholder="mon resume de chapitre">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description </label>
                                    <textarea class="form-control" id="description" rows="3" required="required" cols="50"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="commentaire" class="form-label">Commentaire </label>
                                    <textarea class="form-control" id="commentaire" rows="8" required="required" cols="50"></textarea>
                                </div>
                                                      
                                <div class="mt-3">
                                <button type="submit" class="btn btn-primary" id="btn-save"> Enregistrer</button>
                                </div>
                              </div>
                              
                            </div>

                            </form>
                         
                          </div>
                        
                        </div>
                      </div>
                    </div>
                   
                  </div>
                </div>
                @endif
                @else
                <div class="col-lg-4 col-md-4 order-1" id="note">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-center justify-content-between">
                            <form action="javascript:void(0)" id="formulaire" name="note" method="POST">
                              @csrf
                            <div class="col-12  note-class"  style="height:50%">
                                <input type="hidden" name="formation_id" id="formation_id" value="{{$formation->id}}">
                                <input type="hidden" name="chapitre_id" id="chapitre_id" value="{{$one_chaître->num_chapitre}}">
                              <div >
                              <h3 class="text text-center mt-2">Prendre Note </h3>
                                <div class="mb-3">
                                    <label for="titre" class="form-label">Titre </label>
                                    <input type="text" class="form-control" id="titre" required="required" placeholder="mon resume de chapitre">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description </label>
                                    <textarea class="form-control" id="description" rows="3" required="required" cols="50"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="commentaire" class="form-label">Commentaire </label>
                                    <textarea class="form-control" id="commentaire" rows="8" required="required" cols="50"></textarea>
                                </div>
                                                      
                                <div class="mt-3">
                                <button type="submit" class="btn btn-primary" id="btn-save"> Enregistrer</button>
                                </div>
                              </div>
                              
                            </div>

                            </form>
                         
                          </div>
                        
                        </div>
                      </div>
                    </div>
                   
                  </div>
                </div>
              @endif
              </div>           
             </div>
            
             @endforeach
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
                  

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
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
  </body>
</html>

