@extends("front.app")
@section("content")

<?php 
$besoin=json_decode($formation->besoin);
$contenu=json_decode($formation->Contenu);
$competence=json_decode($formation->competence);
$chapitre = json_decode($formation->chapitre);
 ?>
 
<!-- page title -->
<section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <!-- <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="/">Votre Cour</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">{{$formation->titre}}</li>
        </ul> -->
        <!-- <p class="text-lighten mb-0">{{$formation->description}}</p> -->
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- section -->
<section class="section-sm">
  <div class="container">
   <!--  <div class="row">
      <div class="col-12 mb-4">
       
        <img src="{{asset($formation->image_url)}}" class="img-fluid w-100">
      </div>
    </div> -->
  
    <div class="row align-items-center mb-5">
      <div class="col-xl-3 order-1 col-sm-6 mb-4 mb-xl-0">
        <h3>{{$formation->titre}}</h3>
      </div>
      <div class="col-xl-6 order-sm-3 order-xl-2 col-12 order-2">
        <ul class="list-inline text-xl-center">
          <li class="list-inline-item mr-4 mb-3 mb-sm-0">
            <div class="d-flex align-items-center">
              <i class="ti-book text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">Durée</h6>
                <p class="mb-0">{{$formation->duree}}</p>
              </div>
            </div>
          </li>
          <!-- <li class="list-inline-item mr-4 mb-3 mb-sm-0">
            <div class="d-flex align-items-center">
              <i class="ti-alarm-clock text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">DURATION</h6>
                <p class="mb-0">03 Hours</p>
              </div>
            </div>
          </li> -->
          <li class="list-inline-item mr-4 mb-3 mb-sm-0">
            <div class="d-flex align-items-center">
              <i class="ti-wallet text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">Prix</h6>
                @if($formation->prix_formation==null)
                 <p class="mb-0">0 FCFA</p>
                 @else
                 <p class="mb-0">{{$formation->prix_formation}} fcfa</p>
                 @endif
                <!-- <p class="mb-0">From: $699</p> -->
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-xl-3 text-sm-right text-left order-sm-2 order-3 order-xl-3 col-sm-6 mb-4 mb-xl-0">
        @if (Auth::check() and Auth::user()->role_id==1)
       <!--  <form action="" method="post">
        @csrf
              <input type="hidden"  id="id" name="id" value="{{$formation->id}}"> -->
              <a href="/apprenant-suivi/{{$formation->slug}}"><button type="submit" class="btn btn-primary"> 
                @if($bool==true) Continuer le cour @else
                S'inscrire         {{$bool}} @endif
               </button></a>
        <!-- </form> -->
       @elseif (Auth::check() and Auth::user()->role_id==2)
      <!--  <button class="btn btn-primary" class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#signupModal" disabled='true' data-toggle="modal" data-target="#signupModal" >S'inscrire</button> -->
       @else
        <button class="btn btn-primary" class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#signupModal_" data-toggle="modal" data-target="#signupModal_">S'inscrire</button>

    <div class="modal fade" id="signupModal_" tab/="-1" role="dialog" aria-hidden="true">
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
                        <input type="hidden"  id="id" name="id" value="{{$formation->id}}">
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

  


        @endif
      </div>
      <!-- border -->
      <div class="col-12 mt-4 order-4">
        <div class="border-bottom border-primary"></div>
      </div>
    </div>
    <!-- course details -->
    <div class="row">
      <div class="col-12 mb-4">
        <h3>A propos de la formation</h3>
        <p>{{$formation->a_propos}}</p>
      </div>
      <div class="col-12 mb-12">
        <h3 class="mb-3">Pre-requis necessaires</h3>
        <div class="col-12 px-0">
          <div class="row">
            <div class="col-md-12">
              <ul class="list-styled">
                @foreach($besoin as $one_besoin)
                <li>{{$one_besoin->value}}</li>
                @endforeach
              </ul>
            </div>
            
          </div>
        </div>
      </div>
      <div class="col-12 mb-4">
        <h3 class="mb-3">Ce que vous allez apprendre</h3>
        <ul class="list-styled">
          @foreach($contenu as $one_contenu)
          <li>{{$one_contenu->value}}</li>
          @endforeach
        </ul>
      </div>

      <div class="col-12 mb-4">
        <h3 class="mb-3">Compétence à acqueri</h3>
        <ul class="list-styled">
          @foreach($competence as $one_competence)
          <li>{{$one_competence->value}}</li>
          @endforeach
        </ul>
      </div>



      <div class="container">
    <div class="row">

      
      <div class="col-md-12">
            
            @foreach($chapitre as $one_chapitre)
          <div class="d-md-table mb-4 w-100 border-bottom hover-shadow">
            <div class="d-md-table-cell text-center p-0 bg-primary text-white mb-4 mb-md-0 text-center"><span class="h5 d-block">Chapitre</span>{{$one_chapitre->num_chapitre+1}} </div>
            <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
              <span href="" class="  h4 mb-3 d-block">{{$one_chapitre->intitule}}</span>
              @if(strlen($one_chapitre->chapitre_description)>200)<p class="mb-0"> {{substr($one_chapitre->chapitre_description,0,200)}}...</p>
              @else
              <p class="mb-0"> {{$one_chapitre->chapitre_description}}</p>
              @endif
            </div>
          </div>
         @endforeach
      </div>
    
    </div>
    </div>
      
      <!-- teacher -->
     <!--  <div class="col-12">
        <h5 class="mb-3">A PROPOS DE L'ENSEIGNAT</h5>
        <div class="d-flex justify-content-between align-items-center flex-wrap">
          <div class="media mb-2 mb-sm-0">
            <img class="mr-4 img-fluid" src="" width="30%;" alt="Teacher">
            <div class="media-body">
              <h4 class="mt-0"></h4>
             
            </div>
          </div>
          <div class="social-link">
            <h6 class="d-none d-sm-block">Reseaux</h6>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="d-inline-block text-light p-1" href="https://themefisher.com/"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="d-inline-block text-light p-1" href="https://themefisher.com/"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="d-inline-block text-light p-1" href="https://themefisher.com/"><i class="ti-linkedin"></i></a></li>
              <li class="list-inline-item"><a class="d-inline-block text-light p-1" href="https://themefisher.com/"><i class="ti-instagram"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="border-bottom border-primary mt-4"></div>
      </div> -->
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
        <div class="media-body">
              <h4 class="mt-0"></h4>
             
            </div>
      </div>
    </div>
    
      <!-- course item -->
      <div class="row justify-content-center">
      <!-- course item -->
      @foreach($fmt_meme_categorie as $formation)
      <a  href="/course-single/{{$formation->slug}}" style=" text-decoration: none;">
      <div class="col-lg-4 col-sm-6 mb-5">
        <div class="card p-0 border-primary rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="{{asset($formation->image_url)}}" alt="course thumb">
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
              <h4 class="card-title d-flex justify-content-space-between">
                {{$formation->titre}}
               
              </h4>

            <a  href="/course-single/{{$formation->slug}}" class="btn btn-primary" >S'inscrire</a>

          </div>
          <div class="card-footer">
            @if( $formation->prix_formation!=null)
                      <p class="ml-3">
                        PRIX: <strong>{{$formation->prix_formation}}</strong>
                      </p>
                      @else
                      <p>
                        PRIX: <strong>0$</strong>
                      </p>
                      @endif
          </div>
        </div>
      </div>
      </a>
  @endforeach
 
</div>
</div>
</section>
<!-- /related course -->


@endsection
</body>
</html>