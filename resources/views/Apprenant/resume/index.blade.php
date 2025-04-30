@extends("Apprenant.app")
@section("content")
<?php
$random_slug = random_int(1,50);
?>
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container">
<h5 class="text-center mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#015a98" class="bi bi-clipboard2-check" viewBox="0 0 16 16">
  <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
  <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
  <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3Z"/>
  </svg> Voir et modifier vos divers resumes des chapitres de chaque formation en toute faciliter.
  <div class="bg-secondary row align-self-center col-12" style="w-100; height: 1px"></div>

</h5>
</div>

@if(count($resumes) == 0)
<div class="text-center">
    <img src="{{asset('no-found.svg')}}" alt="" height="250px"><br><br>
    <h4 style="color:#015a98">Aucune note trouvee</h4>
</div>
@else
<div class="row ">
    
        <div class="col-12">
        @foreach($resumes as $resume)
            <div class="card mt-3">
                    <h5 class="card-title text-center">{{$formation[$resume->formation_id]}}</h5>
                    <div class="card-body">
                    <div class="row">
                        @php( $resumeChapitre = (is_array($resume->resumeChapitre))?$resume->resumeChapitre:json_decode($resume->resumeChapitre, true))
                        <div class="d-flex justify-content-spaced-between">
                                @foreach( $resumeChapitre as $key=> $value)
                               <div class="card  col-lg-4 col-md-6 col-sm-6 m-2">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$value['titre']}}</h5>
                                        <p class="card-text">{{$value['description']}}</p>
                                        <p class="card-text"><small class="text-muted">Derniere modification, le {{date('d/m/Y ', strtotime($value['updated_at']))}}</small></p>
                                        <form action="chapitre/{{$random_slug}}-{{$value['titre']}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_chapitre" id="id_chapitre" class="d-none" value="{{$value['chapitre_id']}}">
                                            <input type="hidden" name="id" value="{{$resume->id}}" class="d-none">
                                            <h4 class="" > <button type="submit" class="btn bg bg-primary" style="color:white;">Voir plus <i class="bi bi-chevron-right"></i></button> </h4>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content">
                                            <button type="submit"  class="btn btn-link btn-sm btn-rounded col">
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#popup{{$value['chapitre_id']}}" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="indigo" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                </svg> 
                                                        </a>
                                            </button>
                                            <button type="button"  class="btn btn-link btn-sm btn-rounded col" data-bs-toggle="modal" data-bs-target="#Suppopup{{$value['chapitre_id']}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                    </svg> 
                                            </button>
                                        </div>
                                    </div>
                                    <div id="Suppopup{{$value['chapitre_id']}}" class="modal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info">
                                                    <p>{{$value['titre']}}</p>
                                                </div>
                                                <form action="/apprenant-resume" method="POST">
                                                    @csrf
                                                    <input type="hidden" id="id_chpt" name="id_chpt" value="{{$value['chapitre_id']}}">
                                                    <input type="hidden" id="id_resume" name="id_resume" value="{{$resume->id}}">

                                                    <div class="modal-body">
                                                        <p>Voulez-vous vraiment supprimer le resume de ce chapitre ?</p>                                
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-info" data-dismiss="modal">Valider</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div id="popup{{$value['chapitre_id']}}" class="modal h-auto w-75">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-dark">
                                                    <h3 style="color:white;">Modifier votre note</h3>
                                                </div>
                                                <form action="/note-du-chapitre" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                    <label for="titre">Titre</label><br>
                                                    <input type="text" name="titre" id="titre" value="{{$value['titre']}}" required="required"><br>
                                                    
                                                    <label for="description">Description</label><br>
                                                            <textarea name="description" id="description" cols="50" rows="4" required="required"> {{$value['description']}}</textarea>
                                                            <label for="commentaire">Commentaire</label><br>
                                                            <textarea name="commentaire" id="commentaire" cols="50" rows="6" required="required">{{$value['commentaire']}} </textarea>
                                                    <input type="hidden" id="chapitre_id" name="chapitre_id" value="{{$value['chapitre_id']}}">
                                                    <input type="hidden" id="id_resume" name="id_resume" value="{{$resume->id}}">
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" data-dismiss="modal">Modifier</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach

      </div>

    </div>
  @endif


 
@endsection
