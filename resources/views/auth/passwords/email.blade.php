@extends("auth.app")

@section("content")


<h4 class="mb-2 text-center text-primary">Mot de passe oublié ? 🔐</h4>
<p class="mb-4 text-center">
    Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
</p>

@if (session('status'))
    <div class="alert alert-success text-center">
        {{ session('status') }}
    </div>
@endif

<form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Adresse email</label>
        <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            placeholder="ex: utilisateur@domaine.com"
            autofocus
            value="{{ old('email') }}"
            required
        />
        @error('email')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <button class="btn btn-primary d-grid w-100">Envoyer</button>
</form>

<div class="text-center">
    <a href="{{ route('login') }}">
        <i class="bx bx-chevron-left scaleX-n1-rtl"></i>
        Retour à la connexion
    </a>
</div>
@endsection





