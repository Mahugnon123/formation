@extends('Admin.app')

@section('content')
<style>
    .profile-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 30px;
        margin-top: 30px;
    }
    .profile-sidebar {
        border-right: 1px solid #eee;
    }
    .profile-img {
        width: 100%;
        border-radius: 8px;
        object-fit: cover;
        max-height: 250px;
    }
    .doc-link {
        display: block;
        margin-bottom: 8px;
        color: #0d6efd;
        font-weight: 500;
        text-decoration: none;
    }
    .doc-link:hover {
        text-decoration: underline;
    }
    .info-label {
        font-weight: 600;
        color: #555;
    }
    .info-value {
        margin-bottom: 15px;
        color: #222;
    }
</style>

<div class="container">
    <h2 class="text-center mt-5 mb-4">👤 Détails de la candidature</h2>
    <div class="row profile-card">
        <!-- Sidebar gauche -->
        <div class="col-md-4 profile-sidebar text-center mb-4 mb-md-0">
            <img src="{{ Storage::url($request->photo_profil_path) }}" class="profile-img mb-3" alt="Photo de profil">

            <div class="text-start">
                <a href="{{ Storage::url($request->cv_path) }}" class="doc-link" target="_blank">📄 Voir le CV</a>
                <a href="{{ Storage::url($request->lettre_motivation_path) }}" class="doc-link" target="_blank">📝 Lettre de motivation</a>
                <a href="{{ Storage::url($request->piece_identite_path) }}" class="doc-link" target="_blank">🆔 Pièce d'identité</a>

                @php
                    $certificats = is_array($request->certificats_paths) 
                        ? $request->certificats_paths 
                        : json_decode($request->certificats_paths, true);
                @endphp

                @if ($certificats && count($certificats))
                    @foreach ($certificats as $path)
                        <a href="{{ Storage::url($path) }}" class="doc-link" target="_blank">📚 Certificat</a>
                    @endforeach
                @else
                    <span class="text-muted">Aucun certificat</span>
                @endif
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="col-md-8">
            <h4 class="mb-3">{{ $request->nom_complet }} {{ $request->prenom }}</h4>
            <div>
                <div class="info-label">📧 Email</div>
                <div class="info-value">{{ $request->email }}</div>

                <div class="info-label">📱 Téléphone</div>
                <div class="info-value">{{ $request->telephone }}</div>

                <div class="info-label">👤 Sexe</div>
                <div class="info-value">{{ $request->sex }}</div>

                <div class="info-label">💼 Domaines d’expertise</div>
                <div class="info-value">{{ $request->domaines_expertise }}</div>

                <div class="info-label">🔗 LinkedIn</div>
                <div class="info-value">
                    <a href="{{ $request->linkedin }}" target="_blank" class="text-primary">{{ $request->linkedin }}</a>
                </div>

                <div class="info-label">🗣️ Présentation</div>
                <div class="info-value">{{ $request->presentation }}</div>

                <div class="info-label">🔥 Motivation</div>
                <div class="info-value">{{ $request->motivation }}</div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <form action="{{ route('admin.partner-requests.approve', $request->id) }}" method="POST" class="me-2">
                    @csrf
                    <button type="submit" class="btn btn-success px-4">✅ Approuver</button>
                </form>
                <form action="{{ route('admin.partner-requests.reject', $request->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger px-4">❌ Rejeter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
