@extends("Formateur.app")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@section("content")


<section class="container my-5" style="min-height: 63vh">
  <div class="col-md-12 mx-auto">
    <div class="card shadow-lg p-1 mb-5 bg-white rounded">
      <div class="card-body mx-auto">
        <div class="row mt-15">
          @foreach($formation as $one_formation)
            <div class="col-md-4 mx-auto">
            <div class="shadow-lg p-2 bg-white rounded" style="width:16rem;">
              <div class="card-body">
              	@if($one_formation->prix_formation==null)
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
							    vertical-align: middle;">Gratuit</span></p>
			           @else
			           <p class="card-text mb-4"><span style="font-size: 12px;
							    float: right;
							    font-weight: 600;
							    font-family: Source Sans Pro, Arial, sans-serif;
							    width: fit-content;
							    text-decoration: none;
							    color: black;
							    background-color: rgb(255, 224, 87);
							    border-radius: 10px;
							    padding: 0px 15px;
							    vertical-align: middle;">{{$one_formation->prix_formation}} fcfa</span></p>
			           @endif
               <a href="{{ url('/course-detail/'.$one_formation->slug)}}"> <img src="{{$one_formation->image_url}}" class="card-img-top image-card"></a>
                <hr>

               <h5 style="color: black;font-family: inherit;text-align: center;"> {{$one_formation->created_at}}</h5>
              <h5 style="text-align:center;"> {{$one_formation->titre}}</h5>
              
                <div class="form-group row col-md-12 col-12 mx-auto ">
                  <a class="btn btn-danger mx-auto btn-sm col-5" href="{{ url('/games/'.$one_formation->slug) }}"> <i class="fa fa-trash"></i> </a>
                  <a class="btn btn-primary mx-auto btn-sm col-5" href="{{ url('/games/'.$one_formation->slug) }}"> <i class="fa fa-edit"></i> </a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
      </div>
      </div>
    </div>
  </div>
</section>


<!-- <div class="content-wrapper">
           
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
			           <p class="card-text mb-4"> {{$one_formation->description}}</p>
			           @if($one_formation->prix_formation==null)
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
							    vertical-align: middle;">Gratuit</span></p>
			           @else
			           <p class="card-text mb-4">one_formation->prix_formation fcfa</p>
			           @endif
			       <div class="col-lg-12"> 
			       	<a href="{{ url('/course-detail/'.$one_formation->slug)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit" style="font-size:36px"></i></a>
			       	<a href="{{ url('/course-detail/'.$one_formation->slug)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye" style="font-size:36px"></i></a>
			       	<a href="{{ url('/course-detail/'.$one_formation->slug)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash" style="font-size:36px"></i></a></div>
			      </div>
			    </div>
			  </div>
          @endforeach
       </div>
     </div> 
   </div>
  </div>
 </div> -->
          
@endsection