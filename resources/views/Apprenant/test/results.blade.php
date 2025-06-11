@extends("Apprenant.app")
@section("content")
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Résultats du Test : {{ $test->title }}</h4>

        <div class="card">
            <div class="card-body">
                <h5>Votre score : {{ $score }} / {{ $total }}</h5>
                @foreach ($answers as $answer)
                    <div class="mb-4">
                        <h6>{{ $answer->question->titre }}</h6>
                        <p>{{ $answer->question->description }}</p>
                        <p>Votre réponse : {{ $answer->reponse ? $answer->reponse->text : $answer->text_answer }}</p>
                        <p>Statut : {{ $answer->is_correct ? 'Correcte' : 'Incorrecte' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection