@extends("front.app")
@section("content")
<?php 
$i=1;
$j=1;
?>
<!-- page title -->
<section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="index">Accueil</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">Nos formations</li>
        </ul>
        <!-- <p class="text-lighten mb-0">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p> -->
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- courses -->

<!-- categories 

<div class="container text-center m-3 pb-3">
  <div class="row row-cols-md-3">
    @foreach ($categories as $category)
    <div class="col">
      @if($category->parent_id ==null)
      <div class="d-flex align-items-center">
        <img
            src="/assets/img/elements/{{$category->image_url}}"
            alt=""
            style="width: 45px; height: 45px"
            class="rounded-circle"
            />
        <div class="m-3">
          <p class="fs-2 mb-1 text-info text-uppercase  text-primary font-secondary">
            {{$category->nom}}
          </p>
        </div>
      </div>
      @php($i=0)
      <div class="row ">
      @foreach($categories as $sous_category)
        @if($sous_category->parent_id == $category->id)
        @php($i++)
          <div class=" text-capitalize">
          <button  class="btn btn-outline-success "> {{$sous_category->nom}} </button>
          </div>
        @endif
      @endforeach
      </div>

        @if($i==0)
          <p>Bientot disponible</p>
        @endif
      @endif
    </div>
    @endforeach
  </div>
</div>
-->
<div class=" container">
  <h2 class=" text-primary  text-start m-3 pb-2">
  Dans quel domaine souhaitez-vous vous former ?
</h2>
  <div class="row " style="width:80%">
      @foreach($categories as $category)
      
          <div class="border py-2 cat rounded-pill m-1">
            <h4 class=" m-2" id="cat{{$i++}}" style="">{{$category->nom}}</h4>
          </div>
      @endforeach
      <p id="categorie" class="d-none">{{count($categories)}}</p>
  </div>
  <div class="bg-info row align-self-center col-12 mt-3" style=" height: 1px; width:100%;"></div>

</div>

<section class="m-3 "id="principale">
  <div class="row justify-content-center">
  @foreach($formations as $formation)
    <div class="col-sm-3 ">
    <a  href="/course-single/{{$formation->slug}}" style=" text-decoration: none;">
    <div class="card p-0 border-primary rounded-0 hover-shadow ">
      <img class="img-fluid rounded-0 image-card" src="{{asset($formation->image_url)}}" alt="course thumb" >
      <div class="card-body">
      <h3 class="card-title text-info d-flex ">{{$formation->titre}}
      </h3>
      <h4 class="text-color text-dark" href="course-single/{{$formation->slug}}">

       @if(strlen($formation->description)>70)<p class="card-text mb-4">{{substr($formation->description,0,70)}}...</p>
       @else
          <p class="card-text mb-4"> {{$formation->description}} </p>
       @endif

      </h4>
        <ul class="list-inline mb-2">
      
          <li class="list-inline-item text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
            <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
            <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
          </svg> <strong class="text-dark">Certificat:</strong> 
            @if( $formation->prix_certification!=null)
            {{$formation->prix_certification}} XOF
            @else
               Gratuite
            @endif</li><br>
            <li class="list-inline-item text-dark mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
              <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
            </svg>  <strong class="text-dark"> Durée:</strong> {{$formation->duree}}
          </li><br>
          <li class="list-inline-item text-dark mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-credit-card-2-back" viewBox="0 0 16 16">
            <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z"/>
            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z"/>
          </svg> <strong class="text-dark">Prix:</strong> @if( $formation->prix_formation!=null)
            {{$formation->prix_formation}} XOF
            @else
               Gratuite
            @endif</li><br>
        </ul>

      </div>
    </div>
    </a>
    </div>
    @endforeach

  </div>
</section>
@foreach ($categories as $category)
<section class="section " id="formationCat" style="display:none;" >
  <div class="row justify-content-center">
  @foreach($formations as $formation)
  @if($formation->category_id ==$category->id)
    <div class="col-sm-3 ">
    <a  href="/course-single/{{$formation->slug}}" style=" text-decoration: none;">
    <div class="card p-0 border-primary rounded-0 hover-shadow" id="{{$j++}}">
      <img class="card-img-top rounded-0 image-card" src="{{asset($formation->image_url)}}" alt="course thumb" >
      <div class="card-body">
      <h3 class="card-title text-info d-flex ">@foreach ($categories as $category)
              @if($category->id == $formation->category_id)
                {{$category->nom}}
              @endif
            @endforeach
      </h3>
      <h4 class="text-color text-dark" href="course-single/{{$formation->slug}}">{{$formation->titre}} </h4>
        <ul class="list-inline mb-2">
        
          <li class="list-inline-item text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
            <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
            <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
          </svg> <strong class="text-dark">Certificat:</strong> 
            @if( $formation->prix_certification!=null)
            {{$formation->prix_certification}} XOF
            @else
               Gratuite
            @endif</li><br>
            <li class="list-inline-item text-dark mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
              <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
            </svg>  <strong class="text-dark"> Durée:</strong> {{$formation->duree}}
          </li><br>
          <li class="list-inline-item text-dark mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-credit-card-2-back" viewBox="0 0 16 16">
            <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z"/>
            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z"/>
          </svg> <strong class="text-dark">Prix:</strong> @if( $formation->prix_formation!=null)
            {{$formation->prix_formation}} XOF
            @else
               Gratuite
            @endif</li><br>
        </ul>

      </div>
    </div>
    </a>
    </div>
    @endif
    @endforeach

  </div>
</section>
@endforeach
<style>
  .cat:hover{
    background-color: green;
    color:white;
  }
</style>
<!-- /courses -->
<script>
  /**Afficher les formations d'une categorie */
  let cat = document.getElementById("categorie");
  let catval = cat.innerText;
  let tabCat=[];
  let formCat=[];
  let formationCat= document.getElementById('formationCat');

  let principale = document.getElementById("principale");
  console.log(cat.innerText);
  for(let i=1; i<=parseInt(catval);i++ ){
     tabCat[i-1] = document.getElementById("cat"+i);
     formCat[i-1] = document.getElementById(i);
     console.log(tabCat);

  }
  console.log(tabCat);

  for(let i=0; i<tabCat.length-1 ;i++ ){
    
    tabCat[i].addEventListener("click", () => {
      
    if(tabCat[i].display != "none"){
      formCat[i].style.display = "none";
      principale.style.display = "block";
      formationCat.style.display = "none";

    } else {
      formCat[i].style.display = "block";
      principale.style.display = "none";
      formationCat.style.display = "block";

    }
    })
    break;
  }


function togg(){
  if(getComputedStyle(d2).display != "none"){
    d2.style.display = "none";
  } else {
    d2.style.display = "block";
  }
};

</script>
@endsection
