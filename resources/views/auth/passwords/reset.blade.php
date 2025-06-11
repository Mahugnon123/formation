@extends("auth.app")

@section("content")
<h4 class="mb-2 text-center text-primary">Réinitialiser le mot de passe 🔐</h4>
<p class="mb-4 text-center">
    Entrez votre adresse email et votre nouveau mot de passe pour réinitialiser votre compte.
</p>

@if (session('status'))
    <div class="alert alert-success text-center">
        {{ session('status') }}
    </div>
@endif

<form id="formAuthentication" class="mb-3" action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
        <label for="email" class="form-label">Adresse email</label>
        <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            placeholder="ex: utilisateur@domaine.com"
            value="{{ $email ?? old('email') }}"
            required
            autofocus
        />
        @error('email')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Nouveau mot de passe</label>
        <input
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            id="password"
            name="password"
            placeholder="Entrez votre mot de passe"
            required
        />
        @error('password')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password-confirm" class="form-label">Confirmer le mot de passe</label>
        <input
            type="password"
            class="form-control"
            id="password-confirm"
            name="password_confirmation"
            placeholder="Confirmez votre mot de passe"
            required
        />
    </div>

    <button class="btn btn-primary d-grid w-100">Réinitialiser le mot de passe</button>
</form>

<div class="text-center">
    <a href="{{ route('login') }}">
        <i class="bx bx-chevron-left scaleX-n1-rtl"></i>
        Retour à la connexion
    </a>
</div>
@endsection