@extends("Formateur.app")
@section("content")

<?php 

$chapitre = json_decode($formation->chapitre);

 ?>
  <div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
       <div class="row">
         <div class="col-lg-12 col-md-12 order-1">
            <div class="row">
            	@foreach($chapitre as $one_chapitre)
            	<div class="col-lg-4 col-sm-6 mb-5">
			          <div class="card p-0 border-primary rounded-0 hover-shadow">
			           <video src="{{asset($one_chapitre->video_url)}}" controls height="150px">{{asset($one_chapitre->video_url)}} </video>
			           <div class="card-body">
			           <ul class="list-inline mb-2">
			           <li class="list-inline-item"><a class="text-color" href="course-single"></a></li>
			           </ul>
			           <a href="course-single">
			            <h4 class="card-title">{{$one_chapitre->intitule}}</h4>
			           </a>
			        <p class="card-text mb-4"> {{$one_chapitre->chapitre_description}}</p>
			        <!-- <a href="" class="btn btn-primary btn-sm">Suivre</a> -->
			      </div>
			    </div>
			   </div>
          @endforeach
        </div>
       </div> 
  </div>
</div>
</div>
          
@endsection