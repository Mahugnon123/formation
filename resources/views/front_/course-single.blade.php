@extends("front.app")
@section("content")

<!-- page title -->
<section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="/courses">Votre Cour</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">{{$formation->titre}}</li>
        </ul>
        <p class="text-lighten mb-0">{{substr($formation->description,0,90).'...' }} </p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- section -->
<section class="section-sm">
  <div class="container">
    <div class="row">
      <div class="col-12 mb-4">
        <!-- course thumb -->
        <img src="../theme/images/courses/{{$formation->photo_url}}" class="img-fluid w-100">
      </div>
    </div>
    <!-- course info -->
    <div class="row align-items-center mb-5">
      <div class="col-xl-3 order-1 col-sm-6 mb-4 mb-xl-0">
        <h2>{{$formation->titre}}</h2>
      </div>
      <div class="col-xl-6 order-sm-3 order-xl-2 col-12 order-2">
        <ul class="list-inline text-xl-center">
          <li class="list-inline-item mr-4 mb-3 mb-sm-0">
            <div class="d-flex align-items-center">
              <i class="ti-book text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">CHIPITRES</h6>
                <p class="mb-0">{{count($chapitres)}}</p>
              </div>
            </div>
          </li>
          <li class="list-inline-item mr-4 mb-3 mb-sm-0">
            <div class="d-flex align-items-center">
              <i class="ti-alarm-clock text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">DURATION</h6>
                <p class="mb-0">{{$formation->duree}}</p>
              </div>
            </div>
          </li>
          <li class="list-inline-item mr-4 mb-3 mb-sm-0">
            <div class="d-flex align-items-center">
              <i class="ti-wallet text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">FRAIS</h6>
                @if( $formation->prix_certification==null)
                <p class="mb-0">A partir de: 
                  0$
                  </p>
                  @else
                    <p class="mb-0">{{$formation->prix_certification}}</p>
                  
                  @endif
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-xl-3 text-sm-right text-left order-sm-2 order-3 order-xl-3 col-sm-6 mb-4 mb-xl-0">
        @if (!Auth::check())
        <form action="/apprenant-formation" method="post">
        @csrf
              <input type="hidden"  id="id" name="id" value="{{$formation->id}}">
              <button type="submit" class="btn btn-primary"> @if($bool == true) Continuer @else S'inscrire @endif</button>
        </form>
        @else
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popup">S'inscrire</button>
        @endif
      </div>
      
      <!-- border -->
      <div class="col-12 mt-4 order-4">
        <div class="border-bottom border-primary"></div>
      </div>
    </div>

     <!-- Pop-up -->
     <div id="popup" class="modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <p>Oops vous n'etes pas connecter</p>
                            </div>
                            
                            <div class="modal-body">
                                <p>Vous devez vous connecter avant de vous s'inscrire a un cour!</p>                                
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" data-dismiss="modal">OK</button>
                            </div>

                        </div>
                    </div>
        </div>
    <!-- course details -->
    <div class="row">
      <div class="col-12 mb-4">
        <h3>A propos du cour</h3>
        <p> {{$formation->apropos}} </p>
      </div>
      <div class="col-12 mb-4">
        <h3 class="mb-3">Pre-requis necessaires</h3>
        <div class="col-12 px-0">
          <div class="row">
            <div class="col-md-12">
              <ul class="list-styled">
              @foreach($formation->conditions as $condition)
                <li>{{$condition}}</li>
              @endforeach
              </ul>
            </div>
            
          </div>
        </div>
      </div>

    <div class="container">
    <div class="row">
      <div class="col-12">
          <!-- notice item -->
          @for($i=1; $i<= count($chapitres); $i++)
          <div class="d-md-table mb-4 w-100 border-bottom hover-shadow">
            <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block">{{$i}}</span> Chapitre</div>
            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
              <a href="/notice-single" class="h4 mb-3 d-block">{{$chapitres[$i]["nom"]}}</a>
              <p class="mb-0"> {{$chapitres[$i]["description"]}}</p>
            </div>
            <div class="d-md-table-cell text-right pr-0 pr-md-4"> Duree: {{$chapitres[$i]["duree"]}}</div>
          </div>
          @endfor
      </div>
    </div>
    </div>

       
       <!-- projet -->

  <div class="container">
  <h2 class="section-title">Projets a realiser</h2>
  <div class="bg-primary row align-self-center col-12" style="w-100; height: 2px"></div>
    <div class="row m-3">
    @for($i=1; $i<= count($formation->projets); $i++)
      
      <div class="col-lg-4 col-sm-6 mb-5">
        <div class="card border-0 rounded-0 hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-0" src="../theme/images/events/event-1.jpg" alt="event thumb">
            <div class="card-date"><span>{{$formation->projets[$i]["nom"]}}</span></div>
          </div>
          <div class="card-body">
           
            <h4><i class="bi bi-calendar-minus text-primary mr-2"></i>Duree: {{$formation->projets[$i]["duree"]}}</h4>
              <p class="text text-primary">{{$formation->projets[$i]["description"]}}</p>
          </div>
          <div class="card-footer">
            <p><h3>Competences: </h3>{{$formation->projets[$i]["competences"]}}</p>
          </div>
        </div>
      </div>
      @endfor
    </div>
  </div>
</div>
   
      <!-- teacher -->
      <div class="col-12">
        <h5 class="mb-3">Teacher</h5>
        <div class="d-flex justify-content-between align-items-center flex-wrap">
          <div class="media mb-2 mb-sm-0">
            <img class="mr-4 img-fluid" src="../theme/images/teacher.jpg" alt="Teacher">
            <div class="media-body">
              <h4 class="mt-0">Sam Somrat</h4>
              Photographer
            </div>
          </div>
          <div class="social-link">
            <h6 class="d-none d-sm-block">Social Link</h6>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="d-inline-block text-light p-1" href="https://themefisher.com/"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="d-inline-block text-light p-1" href="https://themefisher.com/"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="d-inline-block text-light p-1" href="https://themefisher.com/"><i class="ti-linkedin"></i></a></li>
              <li class="list-inline-item"><a class="d-inline-block text-light p-1" href="https://themefisher.com/"><i class="ti-instagram"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="border-bottom border-primary mt-4"></div>
      </div>
    </div>
  </div>
</section>
<!-- /section -->

<!-- related course -->
<section class="section pt-0">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">Autre cours que vous pourriez aimer</h2>
      </div>
    </div>
    
      <!-- course item -->
      <div class="row justify-content-center">
      <!-- course item -->
      @foreach($fmt_meme_category as $formation)
      <div class="col-lg-4 col-sm-6 mb-5">
        <div class="card p-0 border-primary rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="../theme/images/courses/{{$formation->photo_url}}" alt="course thumb">
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
            <a href="course-single">
              <h4 class="card-title d-flex justify-content-space-between">
                {{$formation->titre}}
                @if( $formation->prix_formation!=null)
                    <p class="ml-3">
                      PRIX: <strong>{{$formation->prix_formation}}</strong>
                    </p>
                    @else
                    <p>
                      PRIX: <strong>0$</strong>
                    </p>
                    @endif
              </h4>
            </a>
            <a  href="/course-single/{{$formation->slug}}" class="btn btn-primary" >S'inscrire</a>

          </div>
        </div>
      </div>
  @endforeach
 
</div>
</div>
</section>
<!-- /related course -->


@endsection
</body>
</html>