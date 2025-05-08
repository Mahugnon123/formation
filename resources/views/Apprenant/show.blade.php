@extends("Apprenant.app")
@section("content")
<?php
$link_info = ($user->link_info !=null)? json_decode($user->link_info,true):[];
$site =($user->link_info !=null)? $link_info["site"]:'';
$linkedIn = ($user->link_info !=null)? $link_info["linkedIn"]:''; 
$facebook = ($user->link_info !=null)? $link_info["facebook"]:'';  

?>
@if (session()->has('message'))

        <div class="py-2 mt-3">
            <p class=" py-4 mb-4 bg-sucess text-info rounded-2xl">
                {{session()->get('message')}}
        </p>

        </div>
@endif

<button type="button" class="btn btn-primary d-none" id="liveToastBtn">message</button>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Message</strong>
      <small>A l'instant</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="message">
    </div>
  </div>
</div>
<div>
<div class=" m-3 " style="background-color:#055d9b; height:100px;">
    <h4 class="text-center fw-bold mb-3 " style="color:white" >Informations Privees</h4>
    <h5 class=" m-3" style="color:white">
        <a href="/home" class="text-decoration-none text-light" > Accueil/</a><span class="color:white" id="onglet"></span> 
    </h5>
    <div class="col-12">
                  <div class="card">
                    <h5 class="card-header" style="color:#055d9b;" id="actuelle">PROFIL</h5>
                    <div class="card-body">
                      <p class="card-text">Consulter vos informations personnelles et les modifier.</p>

                      <p class="demo-inline-spacing">
                        <a
                          class="btn btn-primary me-1"
                          data-bs-toggle="collapse"
                          href="#multiCollapseExample1"
                          role="button"
                          aria-expanded="false"
                          aria-controls="multiCollapseExample1"
                          data-element = "Profil"
                          onclick="actuel(this)"
                          >Profil</a
                        >
                        <button
                          class="btn btn-primary me-1"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#multiCollapseExample2"
                          aria-expanded="false"
                          aria-controls="multiCollapseExample2"
                          data-element = "Parametres"
                          onclick="actuel(this)"

                        >
                          Parametres
                          {{-- <button
                          class="btn btn-primary me-1"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#multiCollapseExample3"
                          aria-expanded="false"
                          aria-controls="multiCollapseExample3"
                          data-element = "Profil Etudiant"
                          onclick="actuel(this)";

                        >
                          Profil etudiant --}}

                          <button
                          class="btn btn-primary me-1"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#multiCollapseExample4"
                          aria-expanded="false"
                          aria-controls="multiCollapseExample4"
                          data-element = "Avis"   
                          onclick="actuel(this)";
                     >
                          Avis
                        </button>
                        
                      </p>
                                  <!-- / profil -->
            

                      <div class="row">
                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                <div>
                                <div class="card mb-4" id="formUser" style="display:none;">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Informations Personnelle</h5>
                                    </div>
                                    <div class="card-body" >
                                        <form action="javascript:void(0)" method="post">
                                            @csrf
                                            <div class="card m-3">
                                                <div class="row g-0">
                                                    <div class="col-md-3">
                                                        {{Auth::user()->photo_profil}}
                                                        @if(Auth::user()->photo_profil !=null)
                                                        <img src="/photo_profil/{{Auth::user()->photo_profil}}" id="photo_profile" alt="avatar" class="img-fluid rounded-start" style="cursor: pointer;">
                                                        @else
                                                        <img src="{{asset('/1.png')}}" id="photo_profile" alt="avatar" class="img-fluid rounded-start" style="cursor: pointer;">
                                                        @endif
                                                        <input  class="d-none" type="file" accept=".png, .jpg, .jpeg" id="photo_image">
                                                    </div>
                                                    <div class="col-1"></div>
                                                    <div class="col-md-8 ml-2">
                                                        <label class="col-sm-4 col-form-label" for="pseudo">Pseudo</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"
                                                                    ><i class="bi bi-person-fill"></i
                                                                ></span>
                                                                <input
                                                                    type="text"
                                                                    id="pseudo"
                                                                    class="form-control"
                                                                    aria-describedby="pseudo"
                                                                    value="{{Auth::user()->pseudo}}"
                                                                />
                                                            </div>
                                                        </div>
                                                            <label class="col-sm-4 col-form-label" for="a_propos">Mini Biographie</label>
                                                            <div class="col-sm-10">
                                                                <div class="input-group input-group-merge">
                                                                    <textarea name="a_propos" id="a_propos" cols="60"  max="100">{{ Auth::user()->a_propos }}</textarea>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                    
                                            </div>
                                            <div class="m-3 d-flex align-items-center justify-content-between">
                                                <h4 class="mb-0">A propos de vous</h4>
                                            </div>
                                            <div  class="d-lg-flex d-md-block d-sm-block">

                                                <div class="col mb-3">
                                                    <label class="col-sm-2 col-form-label" for="prenom">Prenom</label>
                                                    <div class="col-sm-10 col-md-10">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"
                                                                ><i class="bi bi-person-fill"></i
                                                            ></span>
                                                            <input
                                                                type="text"
                                                                id="prenom"
                                                                class="form-control"
                                                                aria-describedby="prenom"
                                                                value="{{Auth::user()->prenom}}"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="col-sm-2 col-form-label" for="nom">Nom</label>
                                                    <div class="col-sm-10 col-md-10">
                                                        <div class="input-group input-group-merge">
                                                            <span  class="input-group-text"
                                                                ><i class="bi bi-person-fill"></i
                                                            ></span>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="nom"
                                                                value="{{Auth::user()->nom}}"
                                                                aria-describedby="nom"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div  class="d-lg-flex d-md-block d-sm-block">
                                                <div class="col mb-3">
                                                    <label class="col-sm-4 col-form-label" for="sex">Sex</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span  class="input-group-text"
                                                                ><i class="bi bi-person-fill"></i
                                                            ></span>
                                                            <select name="sex"  id="sex" class="form-control @error('sex') is-invalid @enderror" id="" required="required" autofocus rows="2" cols="60">
                                                                <option value="F" {{ Auth::user()->sexe == 'F' ? 'selected' : '' }}>Feminin</option>
                                                                <option value="M" {{ Auth::user()->sexe == 'M' ? 'selected' : '' }}>Masculin</option>
                                                                <option value="A" {{ Auth::user()->sexe == 'A' ? 'selected' : '' }}>Autres</option>
                                                            

                                                            </select>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="col-sm-4 col-form-label" for="birthday">Date De Naissance</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"
                                                                ><i class="bi bi-person-fill"></i
                                                            ></span>
                                                            <input
                                                                type="date"
                                                                class="form-control"
                                                                id="birthday"
                                                                aria-describedby="birthday"
                                                                value="{{ Auth::user()->birthday }}"

                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div  class="d-lg-flex d-md-block d-sm-block">

                                                <div class="col mb-3">
                                                    <label class="col-sm-2 col-form-label" for="pays">Pays</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span  class="input-group-text"
                                                                ><i class="bi bi-person-fill"></i
                                                            ></span>
                                                            <select name="pays"  id="pays" class=" "autofocus rows="2" cols="60">
                                                                <option value="Benin" {{ Auth::user()->pays == 'Benin' ? 'selected' : '' }}>Benin</option>
                                                                <option value="TOGO" {{ Auth::user()->pays == 'TOGO' ? 'selected' : '' }}>TOGO</option>

                                                            </select>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="col-sm-3 col-form-label" for="phone">Telephone</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"
                                                                ><i class="bi bi-person-fill"></i
                                                            ></span>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="phone"
                                                                aria-describedby="phone"
                                                                required="required"
                                                                value="{{Auth::user()->contact}}"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div  class="d-lg-flex d-md-block d-sm-block">
                                            <div class="col mb-3">
                                                    <label class="col-sm-3 col-form-label" for="site">Site Web</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span  class="input-group-text"
                                                                ><i class="bi bi-person-fill"></i
                                                            ></span>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="site"
                                                                aria-describedby="site"
                                                                value="{{$site}}"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="col-sm-3 col-form-label" for="LinkedIn">LinkedIn</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span  class="input-group-text"
                                                                ><i class="bi bi-person-fill"></i
                                                            ></span>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="LinkedIn"
                                                                value="{{$linkedIn}}"
                                                                aria-describedby="LinkedIn"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="col-sm-3 col-form-label" for="Facebook">Facebook</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span  class="input-group-text"
                                                                ><i class="bi bi-person-fill"></i
                                                            ></span>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="Facebook"
                                                                value="{{$facebook}}"
                                                                aria-describedby="Facebook"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col mb-3">
                                                    <label class="col-sm-2 col-form-label" for="propos">Biographie</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group input-group-merge">
                                                            <span  class="input-group-text"
                                                                ><i class="bi bi-person-fill"></i
                                                            ></span>
                                                            <textarea name="biographie" id="biographie" required="required" cols="80" rows="10">
                                                            {{Auth::user()->biographie}}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-primary updateProfil col-12">Envoyer</button>
                                                        
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                                <div id="userInfo">
                                <button type="submit" class="btn rounded-pill btn-info" onclick="modifier()">Modifier mon profil</button>
                                    
                                    <div class="card m-3" >
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="{{asset('/1.png')}}" alt="avatar" class="img-fluid rounded-start" >
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <p class="card-title">{{Auth::user()->prenom}}  {{Auth::user()->nom}}</p>
                                                    <h3>A propos de moi:</h3>
                                                    <p class="card-text">{{Auth::user()->a_propos}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="card m-3" >
                                            <h4 class="text-dark">Informations sur le compte</h4>
                                            <span>
                                                <h5>Date d'inscription: {{Auth::user()->created_at}}</h5>
                                                <h5>Derniere connexion:{{Auth::user()->last_connexion}}</h5>
                                                <h5>Date de naissance:{{Auth::user()->birthday}}</ </h5>
                                            </span>
                                    </div>

                                </div>
                               
                            </div>
                        </div>
                    <!-- / parametres -->
                        <div class="col-xxl">
                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                
                                <div class="card mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Votre Email</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="javascript:void(0)" method="post">
                                            @csrf
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="mail">Email Actuelle</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span  class="input-group-text"
                                                            ><i class="bi bi-envelope border-dark"></i
                                                        ></span>
                                                        <input
                                                            
                                                            type="email"
                                                            id="mail"
                                                            value="{{Auth::user()->email}}" disabled=true
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="newMail">Nouveau Email</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span  class="input-group-text"
                                                            ><i class="bi bi-envelope"></i
                                                        ></span>
                                                        <input
                                                            type="email"
                                                            class="form-control"
                                                            id="newMail"
                                                            placeholder="li@gmail.com"
                                                            aria-label="li@gmail.com"
                                                            aria-describedby="newMail"
                                                            required="required"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" id="update_email" class="btn btn-primary">Modifier</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            
                                <div class="card mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Votre Mot De Passe</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="javascript:void(0)" method="post">
                                            @csrf
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="pwd2">Mot De passe Actuel</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span  class="input-group-text"
                                                            ><i class="bi bi-bag-fill"></i
                                                        ></span>
                                                        <input
                                                            type="password"
                                                            id="pwd2"
                                                            class="form-control"
                                                            aria-describedby="pwd2"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label" for="pwd3">Nouveau Mot De Passe</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span  class="input-group-text"
                                                            ><i class="bi bi-bag-fill"></i
                                                        ></span>
                                                        <input
                                                            type="password"
                                                            class="form-control"
                                                            id="pwd3"
                                                            aria-describedby="pwd3"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" id="update_pwd" class="btn btn-primary">Modifier</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="nsl">
                                    <h4 class="mb-0">Préférences e-mail</h4>
                                    <form action="javascript:void(0)" method="post">
                                        @csrf
                                        <input type="checkbox" name="newsletter" class="mt-3 mb-1=3" id="newsletter"> Recevoir la Newsletter de SinusTic
                                        <div class="row justify-content-end">
                                            <div class="col-sm-10 mt-3">
                                                <button type="submit" class="btn btn-primary">Envoyer</button>
                                            </div>
                                            </div>
                                    </form>

                                </div>

                                <div>
                                    <h3 class="text-danger mt-3">Supprimer votre compte</h3>

                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalToggle"
                                        > Je desir suprimer mon compte 
                                    </button>
                                    
                                    <!-- Modal 1-->
                                    <div
                                    class="modal fade"
                                    id="modalToggle"
                                    aria-labelledby="modalToggleLabel"
                                    tabindex="-1"
                                    aria-hidden="true"
                                    >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalToggleLabel">Alerte Suppression</h5>
                                            <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                            ></button>
                                        </div>
                                        <div class="modal-body">Voulez-vous vraiment supprimer votre compte?
                                            <p>La suppression de votre compte entraine directement la suppresion de toute vos donnees personnelles et autre lies a ce compte.</p>
                                        </div>
                                        
                                        <div class="modal-footer">
                                        <a href="/delete-compte">Je le veux</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                        <!-- Modal 2-->
                                </div>

                            </div>
                        </div>
            <!-- / avis -->

                        <div class="col-xxl">
                            <div class="collapse multi-collapse" id="multiCollapseExample4">
                                <div class="row g-0">
                                    <div class="col-md-3 ">
                                        <img class="rounded-circle shadow-1-strong m-3 "
                                        src="{{asset('/avis.jpg')}}" alt="avatar" width="250"
                                                        height="250" /> 
                                    </div>
                                    <div class="col-md-9 mt-5">
                                        <h4 class=" text-dark">Soyez le premier à donner votre avis</h4>
                                        <p>Dites-nous ce qui vous plait et ce que vous aimerez qu’on améliore afin de vous offrir la meilleure expérience possible avec SinusTic.</p>
                                        <small>Votre satisfaction est notre priorité.</small>

                                        <a href=""><div class=" border border-primary p-2 mt-2 mb-2 rounded">
                                            Donnez votre avis!  <i class="bi bi-box-arrow-up-left border-dark"></i> 
                                        </div></a>
                                    </div>
                                    <div class="p-3  bg-opacity-10 border border-info border-start-0 rounded-end" style="background-color:#055d9b;">
                                    <i class="bi bi-info-circle-fill text-light"></i> <p class="fw-bold " style="color:white;">Vous avez une question ou besoin specifique ? N'hesitez pas a aller dans le <a href="" style="color:#77c3e2;"> forum de discussion</a>  ou <a href="#" style="color:#77c3e2;">contacter-nous</a>  directement!</p>
                                    </div>
                                </div>
                            <div>

                        </div>
                        
            <!-- / Content -->
                    </div>
                </div>
            </div>
        </div>
             
            <!-- / Content -->

</div>


<script src="{{asset('js/jquery/jquery-3.6.0.min.js')}}"></script>
<script type="text/javascript">
///** */
/**Changer le status d'une formation a valider */

/** CHanger mot de passe */

$(document).ready( function () {
    var trueResp = [];
    $.ajaxSetup({
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
            });
          
            $('body').on('click', '#update_password', function (event) {
              var pwd_actu  = $("#pwd2").val();
              var pwd_modif  = $("#pwd3").val();
              
               // ajax
               $.ajax({
                type:"POST",
                      url: "{{ url('/update-password') }}",
                      data: {
                        pwd_actu : pwd_actu,
                        pwd_modif : pwd_modif,

                        _token: '{{csrf_token()}}',
                      },
                      dataType: 'json',
                      success: function(res){
                        console.log(res);
                        $("#liveToastBtn").click();
                        $("#message").html("Votre mot de passe a ete modifier avec success");

                      },
                      error: function (data, textStatus, errorThrown) {
                     console.log(data);
                      },

                    });
      });
          });


/**  */

$(document).ready( function () {
    var trueResp = [];
    $.ajaxSetup({
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
            });
          
            $('body').on('click', '#update_email', function (event) {
              var mail  = $("#mail").val();
              var newMail  = $("#newMail").val();
              
               // ajax
               $.ajax({
                type:"POST",
                      url: "{{ url('/update-email') }}",
                      data: {
                        mail : mail,
                        newMail : newMail,

                        _token: '{{csrf_token()}}',
                      },
                      dataType: 'json',
                      success: function(res){
                        console.log(res);
                        $("#liveToastBtn").click();
                        $("#message").html("Votre mail a ete modifier avec success");
                      },
                      error: function (data, textStatus, errorThrown) {
                     console.log(data);
                      },

                    });
      });
          
    });

// change profile image


$(document).ready( function () {
    var trueResp = [];
    $.ajaxSetup({
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
            }); 
            $("#photo_profile").click(function(e) {
                $("#photo_image").click();
            });
            $('body').on('click', '.updateProfil', function (event) {
              var nom  = $("#nom").val();
              var prenom  = $("#prenom").val();
              var pseudo  = $("#pseudo").val();
              var sex  = $("#sex").val();
              var birthday  = $("#birthday").val();
              var a_propos  = $("#a_propos").val();
              var pays  = $("#pays").val();
              var phone  = $("#phone").val();
              var site  = $("#site").val();
              var LinkedIn  = $("#LinkedIn").val();
              var Facebook  = $("#Facebook").val();
              var biographie  = $("#biographie").val();
              var profile_photo  = $("#photo_image").val();

               // ajax
               $.ajax({
                type:"POST",
                      url: "{{ url('/update-profile') }}",
                      data: {
                        nom : nom,
                        prenom : prenom,
                        pseudo : pseudo,
                        sex : sex,
                        birthday : birthday,
                        a_propos : a_propos,
                        pays : pays,
                        phone : phone,
                        site : site,
                        LinkedIn : LinkedIn,
                        Facebook : Facebook,
                        biographie : biographie,
                        profile_photo: profile_photo,

                        _token: '{{csrf_token()}}',
                      },
                      dataType: 'json',
                      success: function(res){
                        console.log(res);
                        $("#liveToastBtn").click();
                        $("#message").html("Votre profil a ete modifier avec success");

                      },
                      error: function (data, textStatus, errorThrown) {
                     console.log(data);
                      },

                    });
                    

      });
});

    var user = document.getElementById('userInfo');
    var form = document.getElementById('formUser');

    function modifier(){
        //var userCompte = document.getElementById('userCompte');
        if(user.style.display=='block' ){
            user.style.display='none';
            //userCompte.style.display='none';
            form.style.display='block'
        }else{
            user.style.display='block';
            //userCompte.style.display='block';
            form.style.display='none'
        }
    }
    function actuel(elm){
        var ongletActuel = document.getElementById('actuelle');
        var onglet = document.getElementById('onglet');
        var onglet1 = document.getElementById('multiCollapseExample1');
        var onglet2 = document.getElementById('multiCollapseExample2');
        //var onglet3 = document.getElementById('multiCollapseExample3');
        var onglet4 = document.getElementById('multiCollapseExample4');

        var text = $(elm).data('element');
        if(text == 'Profil'){
            onglet2.style.display = 'none';
            //onglet3.style.display = 'none';
            onglet4.style.display = 'none';
            onglet1.style.display = 'block';
            ongletActuel.innerHTML = text;
            onglet.innerHTML = text;
            if(user.style.display=='none' && form.style.display=='block' ){
            user.style.display='block';
            //userCompte.style.display='none';
            form.style.display='none'
            }
        }
        else if(text == 'Parametres'){
            onglet1.style.display = 'none';
            //onglet3.style.display = 'none';
            onglet4.style.display = 'none';
            onglet2.style.display = 'block';
            ongletActuel.innerHTML = text;
            onglet.innerHTML = text;
        }
        /*else if(text == "Profil Etudiant"){
            onglet1.style.display = 'none';
            onglet2.style.display = 'none';
            onglet4.style.display = 'none';
            onglet3.style.display = 'block';
            ongletActuel.innerHTML = text;
            onglet.innerHTML = text;
        }*/
        else if(text == "Avis"){
            onglet1.style.display = 'none';
            //onglet3.style.display = 'none';
            onglet2.style.display = 'none';
            onglet4.style.display = 'block';
            ongletActuel.innerHTML = text;
            onglet.innerHTML = text;
        }
       
    }
</script>
@endsection

                