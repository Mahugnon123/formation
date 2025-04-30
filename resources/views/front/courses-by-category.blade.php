@extends("front.app")
@section("content")
<section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb mb-2">
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="{{ url('/') }}">Accueil</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted">{{ $category->nom }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-12 text-center">
            <br>;
            @if ($fmt_meme_categorie->count() > 0)
                <p class="h4 text-primary">
                    {{ $fmt_meme_categorie->count() }} formation(s) disponible(s) dans la catégorie "{{ $category->nom }}".
                </p>
            @else
                <p class="h4 text-muted">
                    Aucune formation disponible dans la catégorie "{{ $category->nom }}".
                </p>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        @forelse($fmt_meme_categorie as $formation)
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
                            <li class="list-inline-item"><a class="text-color" href="{{ route('courses.index', ['category_slug' => $formation->category->slug]) }}">
                                {{ $formation->category->nom }}
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
        @empty
        
        @endforelse
    </div>
</div>
@endsection