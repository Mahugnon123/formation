@extends('Apprenant.app')
@section('content')

<div class="container mt-5">
    <div class="card shadow mb-4 mx-auto" style="border-radius: 18px; border:1px solid #e0e0e0; width:100%; max-width:none;">
        <div class="card-header" style="background:#f5f5f5; color:#444; text-align:center; border-top-left-radius:18px; border-top-right-radius:18px; box-shadow: 0 4px 16px rgba(0,0,0,0.08);">
            <i class="bi bi-journal-text" style="font-size: 2rem;"></i>
            <h3 class="mt-2 mb-0" style="font-weight: 700; color:#444;">Note du chapitre</h3>
        </div>
        <div class="mt-1"></div>

        <div class="card-body">
            <h4 class="card-title mb-3" style="color:#1976d2; font-weight:600;">
                <i class="bi bi-bookmark-star"></i> {{ $chapitre['titre'] ?? ($chapitre['intitule'] ?? 'Titre du chapitre') }}
            </h4>
            <div class="mb-3">
                <strong>Description :</strong>
                <div>{{ $chapitre['description'] ?? '' }}</div>
            </div>
            @if(!empty($chapitre['commentaire']))
                <div class="mb-3">
                    <strong>Commentaire :</strong>
                    <div>{{ $chapitre['commentaire'] }}</div>
                </div>
            @endif
            @if(!empty($chapitre['updated_at']))
                <div class="text-end text-muted" style="font-size:0.95rem;">
                    <i class="bi bi-clock-history"></i> Modifié le {{ $chapitre['updated_at'] }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection