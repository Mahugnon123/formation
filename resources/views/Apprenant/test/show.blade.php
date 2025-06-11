@extends("Apprenant.app")
@section("content")
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Test : {{ $test->title }}</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('student.test.submit', $test) }}" method="POST">
                    @csrf
                    @foreach ($questions as $question)
                        <div class="mb-4">
                            <h5>{{ $question->titre }}</h5>
                            <p>{{ $question->description }}</p>

                            @if ($question->type === 'QCM')
                                @foreach ($question->reponses as $index => $reponse)
                                    <div class="form-check">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $reponse->id }}" class="form-check-input" required>
                                        <label class="form-check-label">{{ $reponse->text }}</label>
                                    </div>
                                @endforeach
                            @elseif ($question->type === 'Éditeur de code')
                                <textarea name="answers[{{ $question->id }}]" class="form-control" rows="6" required></textarea>
                            @endif
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </form>
            </div>
        </div>
    </div>
@endsection