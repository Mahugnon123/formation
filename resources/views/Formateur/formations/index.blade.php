@extends("Formateur.app")
@section("content")

<div class="content-wrapper">
           
  <div class="container-xxl flex-grow-1 container-p-y">
     <div class="row">
       <div class="col-lg-12 col-md-12 order-1">
          <div class="row">
            	@foreach($formation as $one_formation)
            <div class="col-lg-4 col-sm-6 mb-5">
			        <div class="card p-0 border-primary rounded-0 hover-shadow">
			         <img class="card-img-top rounded-0" src="{{asset($one_formation->image_url)}}" alt="course thumb">
			          <div class="card-body">
			           <ul class="list-inline mb-2">
			            <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>{{$one_formation->created_at}}</li>
			            <li class="list-inline-item"><a class="text-color" href="course-single"></a></li>
			           </ul>
			           <a href="course-single">
			           <h4 class="card-title">{{$one_formation->titre}}</h4>
			          </a>
			           <p class="card-text mb-4"> {{$one_formation->description}}</p><p class="card-text mb-4">25$</p>
			        <a href="{{ url('/course-detail/'.$one_formation->slug)}}" class="btn btn-primary btn-sm">Voir le contenu</a>
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