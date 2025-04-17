@extends("Apprenant.app")
@section("content")


  <div class="container">
  <h5 class="text-center mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#015a98" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
    <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
    <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
    </svg> Toutes les formations auquelles vous vous etes inscrit.e 
    <div class="bg-primary row align-self-center col-12 mr-3 ml-3" style="w-100; height: 2px"></div>

  </h5>
  </div>
  <div class="content-wrapper">
  @if($userfmt == null)
  <div class="text-center">
    <img src="{{asset('no-formation.svg')}}" alt="" height="250px"><br><br>
    <h4 style="color:#015a98">Aucune formation </h4>
  </div>  
@else 
  
 <section class="container my-5" style="min-height: 63vh">
  <div class="col-md-12 mx-auto">
    <div class="card shadow-lg p-1 mb-5 bg-white rounded">
      <div class="card-body mx-auto">
        <div class="row mt-15">
        @for($i=0; $i< count($formations);$i++)
            <div class="col-md-4 mx-auto">
            <div class="shadow-lg p-2 bg-white rounded" style="width:16rem;">
            <a href="/apprenant-suivi/{{$formations[$i]->slug}}" class=" text-decoration-none">
              <div class="card-body">
			           <p class="card-text mb-4" ><span style="font-size: 12px;
							    float: right;
							    font-weight: 600;
							    font-family: Source Sans Pro, Arial, sans-serif;
							    width: fit-content;
							    text-decoration: none;
							    color: black;
							    background-color: rgb(255, 224, 87);
							    border-radius: 10px;
							    padding: 0px 15px;
							    vertical-align: middle;">Statuit: {{$status[$i]}}</span></p>
			         
               <a href="/apprenant-suivi/{{$formations[$i]->slug}}"> <img src="{{asset($formations[$i]->image_url)}}" class="card-img-top image-card"></a>
                <hr>

               <h5 style="color: black;font-family: inherit;text-align: center;"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="indigo" class="bi bi-calendar" viewBox="0 0 16 16">
              <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
            </svg> Duree: {{$formations[$i]->duree}}</h5>
              <h5 style="text-align:center;">{{$formations[$i]->titre}}</h5>
              
               
              </div>
            </a>
            </div>
          </div>
          @endfor
      </div>
      </div>
    </div>
  </div>
</section>
@endif
@endsection