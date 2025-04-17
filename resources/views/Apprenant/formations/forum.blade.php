@extends("Apprenant.app")
@section("content")
<?php
?>
@if (session()->has('message'))

                      <div
                        class=" m-3 bs-toast toast fade show bg-success"
                        role="alert"
                        aria-live="assertive"
                        aria-atomic="true"
                      >
                        <div class="toast-header">
                          <i class="bx bx-bell me-2"></i>
                          <div class="me-auto fw-semibold">Annonce</div>
                          <small>A l'instant</small>
                          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                        {{session()->get('message')}}
                        </div>
                      </div>
    @endif

<h3 class="text-center mt-2 pb-4 ">Mes messages prives</h3>
<a href="#form" class="" style="text-decoration:none"><button type="button" class="btn-primary py-2 pb-2 m-3" style="color:white;">Repondre au message </button></a>

              <div class="m-3">
              <h3>{{$requete->nom}}</h3>    
              <p > <h4>Participants:</h4>
              <h5>{{$users[$requete->user_id]['nom']}} & {{$enseignant['nom']}} </h5></p>


              <div class="card mb-3 mt-2" >
                    <div class="row g-0">
                      <div class="col-md-1">
                        <img class="rounded-circle shadow-1-strong m-3"
                            src="{{asset('/1.png')}}" alt="avatar" width="90"
                                        height="90" />                      
                      </div>
                      <div class="col-md-11">
                        <div class="card-body">
                          <h5 class="card-title">{{$requete->nom}}</h5>
                          <p class="card-text">{{$requete->descritption}}</p>
                          <p class="card-text"><small class="text-muted">Envoyer, le {{date('d/m/Y H:i:s', strtotime($requete['updated_at']))}}</small></p>

                        </div>
                      </div>
                    </div>
                  </div>

                  @if($reponses == null)
                    <h5>Aucune reponse</h5>
                  @else
                    @foreach($reponses as $reponse)
                    <div class="card m-3" id="{{$reponse->slug}}">
                      <div class="" style='width:100%; heigth:50px; background-color: <?php printf( "#%06X\n", mt_rand( 0, 0x222222 )); ?>'> .</div>

                    <div class="row g-0">
                      <div class="col-md-1">
                        <img class="rounded-circle shadow-1-strong m-3"
                        src="{{asset('/1.png')}}" alt="avatar" width="90"
                                        height="90" />                        
                      </div>
                      <div class="col-md-11">
                        <div class="card-body">
                        <h5 class="card-title">@ {{$users[$reponse->user_id]['nom']}}<small class="text-muted"> Envoyer, le {{date('d/m/Y H:i:s', strtotime($reponse['updated_at']))}}</small></h5>
                          <p class="card-text">{{$reponse->description}}</p>
                          <button class="btn reply"  data-element="{{$reponse->slug}}" data-value="{{substr($reponse->description,0,50)}}..." onclick="Reply(this)";>  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indigo" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg> <a href="#form" style="text-decoration:none;">Repondre</a>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                    
                @endforeach
                @endif
                  <section style="background-color: #eee;" id="form">
                      <div class="container my-5 py-5">
                        <div class="row d-flex justify-content-center">
                          <div class="col-md-12 col-lg-10 col-xl-8">
                            <div class="card">
                            
                              <div class="card-body py-3 border-0" style="background-color: #f8f9fa;" >
                                <form action="/forum-response" method="post">
                                @csrf
                                  
                                  <input type="text" class="d-none" name="parent_id" id="parent_id" >
                                  <input type="text" class="d-none" name="requete_slug" id="requete_slug" value="{{$requete->slug}}" >

                                    <div class="form-outline w-100">
                                    <p class="border  border-primary" style="display: none;" id="replyRps"></p><br>
                                      <textarea class="form-control" required='required'  name="description" id="description" rows="4"
                                        style="background: #fff;"> </textarea>
                                      <label class="form-label" for="description">Description</label>
                                    </div>
                                  </div>
                                  <div class="float-end mt-2 pb-2">
                                    <button type="submit" class="btn btn-primary btn-sm fw-bold">Publier</button>
                                  </div>
                                  </form>
                              </div>
                          </div>
                        </div>
                      </div>
                  </section>
              </div>
                
             
  <script>

function Reply(elm){

  var parent_id = document.getElementById('parent_id');
 // var replyText = document.getElementById('replyRps');
  var texteraReply = document.getElementById('description');
  //console.log(replyText);
  var reply = $(elm).data('element');
  var descripReply = $(elm).data('value');
  console.log(descripReply);
  parent_id.value = reply;
  texteraReply.innerHTML = "<a href='#"+reply+"' class='border  border-primary' > <h5>"+descripReply+" </h5> </a>";
}
  </script>                
@endsection