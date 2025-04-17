@extends('Apprenant.app')
@section('content')

<div class="m-auto text-center">

    <div class="container  mt-5">
        <div class="d-flex justify-content-center">
            <div class="card m-3">
                <div class="card-body">
                    <h5 class="card-title">{{$chapitre['titre']}}</h5>
                    <p class="card-text">{{$chapitre['description']}}</p>
                    <p class="card-text"><small class="text-muted">{{$chapitre['commentaire']}}</small></p>
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </div>
    
</div>
   

@endsection