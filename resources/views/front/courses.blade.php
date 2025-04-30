@extends("front.app")
@section("content")
<?php
$i = 1;
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

<div class=" container">
    <h2 class=" text-primary   text-start m-3 pb-2">
        Dans quel domaine souhaitez-vous vous former ?
    </h2>
    <div class="row " style="width:80%">
        @foreach($categories as $category)
            <div class="border py-2 cat rounded-pill m-1">
                <a href="{{ route('courses.category', ['slug' => $category->slug]) }}" style="text-decoration: none; color: inherit;">
                    <h4 class=" m-2" id="cat{{$i++}}" style="">{{$category->nom}}</h4>
                </a>
            </div>
        @endforeach
        <p id="categorie" class="d-none">{{count($categories)}}</p>
    </div>
    <div class="bg-info row align-self-center col-12 mt-3" style=" height: 1px; width:100%;"></div>
</div>

<section class="section-sm">
    <div class="container">
        <div class="row">
            @forelse($formations->chunk(4) as $row)
                @foreach($row as $one_formation)
                    <div class="col-lg-3 col-sm-6 mb-5">
                        <a href="{{ url('/apprenant-course-detail/'.$one_formation->slug)}}">
                            <div class="card p-0 border-primary rounded-0 hover-shadow">
                                <div style="height: 200px; overflow: hidden;">
                                    <img class="card-img-top rounded-0" src="{{asset($one_formation->image_url)}}" alt="{{$one_formation->titre}}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="card-body">
                                    <ul class="list-inline mb-2">
                                        <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>{{\Carbon\Carbon::parse($one_formation->created_at)->format('d M Y')}}</li>
                                    </ul>
                                    <h4 class="card-title">{{$one_formation->titre}}</h4>
                                    @if(strlen($one_formation->description)>70)
                                        <p class="card-text mb-4">{{substr($one_formation->description,0,70)}}...</p>
                                    @else
                                        <p class="card-text mb-4"> {{$one_formation->description}} </p>
                                    @endif
                                    @if($one_formation->prix_formation==null)
                                        <p class="card-text mb-4" ><span class="badge bg-success rounded-pill">Gratuit</span></p>
                                    @else
                                        <p class="card-text mb-4"><span class="badge bg-warning text-dark rounded-pill">{{$one_formation->prix_formation}} fcfa</span></p>
                                    @endif
                                    <a href="{{ url('/apprenant-course-detail/'.$one_formation->slug)}}" class="btn btn-primary btn-sm">Voir plus</a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @empty
                <div class="col-12">
                    <p class="text-center">Aucune formation disponible pour cette catégorie.</p>
                </div>
            @endforelse
        </div>
        {{ $formations->links('vendor.pagination.bootstrap-5') }}
    </div>
    <style>
        .cat:hover{
            background-color: green;
            color:white;
        }
        .card {
            transition: transform 0.2s ease-in-out; /* Ajoute une transition pour l'effet */
        }

        .card:hover {
            transform: scale(1.05); /* Agrandit la carte de 5% au survol */
            z-index: 10; /* Optionnel : place la carte au-dessus des autres pour éviter le clipping */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Optionnel : renforce l'ombre au survol */
        }
        .card-body {
            padding: 20px; /* Ajustez la valeur selon vos besoins */
            transition: background-color 0.3s ease; /* Ajoute une transition pour l'effet de survol */
        }


    </style>
</section>

@endsection