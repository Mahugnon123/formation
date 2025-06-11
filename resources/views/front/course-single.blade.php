@extends("front.app")

@section("content")

@php
    $besoin = json_decode($formation->besoin ?? '[]');
    $contenu = json_decode($formation->contenu ?? '[]');
    $competence = json_decode($formation->competence ?? '[]');
    $chapitre = json_decode($formation->chapitre ?? '[]');
@endphp

<section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8"></div>
        </div>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-xl-3 col-sm-6 mb-4">
                <h3>{{ $formation->titre }}</h3>
            </div>
            <div class="col-xl-6 col-12">
                <ul class="list-inline text-xl-center">
                    <li class="list-inline-item mr-4 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="ti-book text-primary icon-md mr-2"></i>
                            <div class="text-left">
                                <h6 class="mb-0">Durée</h6>
                                <p class="mb-0">{{ $formation->duree }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-inline-item mr-4 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="ti-wallet text-primary icon-md mr-2"></i>
                            <div class="text-left">
                                <h6 class="mb-0">Prix</h6>
                                <p class="mb-0">
                                    {{ $formation->prix_formation ? $formation->prix_formation + $formation->prix_certification . ' FCFA' : '0 FCFA' }}
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-xl-3 text-sm-right text-left col-sm-6 mb-4">
                @auth
                    @if(Auth::user()->role_id == 1)
                        <form method="POST" action="/apprenant">
                            @csrf
                            <input type="hidden" name="id" value="{{ $formation->id }}">
                            <button type="submit" class="btn btn-primary">
                                {{ $bool ? "Continuer le cours" : "S'inscrire" }}
                            </button>
                        </form>
                    @endif
                @else
                    <button class="btn btn-primary" data-toggle="modal" data-target="#signupModal_">S'inscrire</button>
                @endauth
            </div>

            <div class="col-12 mt-4">
                <div class="border-bottom border-primary"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <h3>À propos de la formation</h3>
                <p style="text-align: justify;">{{ $formation->a_propos }}</p>
            </div>

            <div class="col-12 mb-4">
                <h3 class="mb-3">Pré-requis nécessaires</h3>
                @if(is_array($besoin))
                <ul class="list-styled" style="text-align: justify;">
                    @foreach($besoin as $item)
                        <li>{{ $item->value ?? '' }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div class="col-12 mb-4">
                <h3 class="mb-3">Ce que vous allez apprendre</h3>
                @if(is_array($contenu))
                <ul class="list-styled" style="text-align: justify;">
                    @foreach($contenu as $item)
                        <li>{{ $item->value ?? '' }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div class="col-12 mb-4">
                <h3 class="mb-3">Compétences à acquérir</h3>
                @if(is_array($competence))
                <ul class="list-styled" style="text-align: justify;">
                    @foreach($competence as $item)
                        <li>{{ $item->value ?? '' }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div class="col-md-12">
                @if(is_array($chapitre))
                @foreach($chapitre as $item)
                <div class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                    <div class="d-md-table-cell text-center p-0 bg-primary text-white mb-4 mb-md-0">
                        <span class="h5 d-block">Chapitre</span>{{ $item->num_chapitre + 1 ?? 1 }}
                    </div>
                    <div class="d-md-table-cell px-4 vertical-align-middle">
                        <h4 class="mb-3">{{ $item->intitule ?? '' }}</h4>
                        <p style="text-align: justify;">
                            {{ isset($item->chapitre_description) && strlen($item->chapitre_description) > 200 ? substr($item->chapitre_description, 0, 200).'...' : $item->chapitre_description }}
                        </p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
